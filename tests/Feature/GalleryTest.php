<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\GalleryPhoto;
use App\Models\User;
use App\Support\PhotoStorage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * F-09: upload, urutkan, dan hapus foto galeri.
 */
class GalleryTest extends TestCase
{
    use RefreshDatabase;

    /** PNG 1x1 piksel yang valid (tidak butuh ekstensi GD untuk membuatnya). */
    private const PNG = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==';

    private User $client;
    private Event $event;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');

        $this->client = User::factory()->create(['role' => User::ROLE_CLIENT]);
        $this->event = Event::create(['user_id' => $this->client->id, 'bride_name' => 'Rina', 'groom_name' => 'Dimas', 'template' => 'template-2']);
    }

    private function png(string $name = 'foto.png'): UploadedFile
    {
        return UploadedFile::fake()->createWithContent($name, base64_decode(self::PNG));
    }

    private function upload(int $count)
    {
        return $this->actingAs($this->client)->post('/admin/gallery', [
            'photos' => array_map(fn ($i) => $this->png("foto-{$i}.png"), range(1, $count)),
        ]);
    }

    public function test_upload_stores_photos_in_order(): void
    {
        $this->upload(3)
            ->assertRedirect(route('admin.gallery.index'))
            ->assertSessionHas('success', '3 foto ditambahkan ke galeri.');

        $photos = $this->event->photos()->get();
        $this->assertSame([1, 2, 3], $photos->pluck('sort_order')->all());

        foreach ($photos as $photo) {
            Storage::disk('public')->assertExists($photo->path);
            $this->assertStringStartsWith("gallery/{$this->event->id}/", $photo->path);
            $this->assertSame(1, $photo->width);
        }
    }

    public function test_photos_appear_on_invitation_and_gallery_is_hidden_when_empty(): void
    {
        $this->get('/u/rina-dimas')->assertOk()->assertDontSee('id="gallery"', false);

        $this->upload(2);
        $photo = $this->event->photos()->first();

        $this->get('/u/rina-dimas')
            ->assertOk()
            ->assertSee('id="gallery"', false)
            ->assertSee($photo->url(), false)
            ->assertDontSee('Photo 1');
    }

    public function test_move_reorders_photos(): void
    {
        $this->upload(3);
        [$first, $second, $third] = $this->event->photos()->get()->all();

        $this->actingAs($this->client)->post("/admin/gallery/{$third->id}/move", ['direction' => 'up'])->assertRedirect();
        $this->assertSame([$first->id, $third->id, $second->id], $this->event->photos()->pluck('id')->all());

        // Foto pertama tidak bisa digeser lebih ke depan
        $this->actingAs($this->client)->post("/admin/gallery/{$first->id}/move", ['direction' => 'up'])->assertRedirect();
        $this->assertSame([$first->id, $third->id, $second->id], $this->event->photos()->pluck('id')->all());
    }

    public function test_delete_removes_record_and_file(): void
    {
        $this->upload(1);
        $photo = $this->event->photos()->first();

        $this->actingAs($this->client)->delete("/admin/gallery/{$photo->id}")->assertRedirect(route('admin.gallery.index'));

        $this->assertNull(GalleryPhoto::find($photo->id));
        Storage::disk('public')->assertMissing($photo->path);
    }

    public function test_rejects_non_images_and_respects_limit(): void
    {
        $this->actingAs($this->client)
            ->post('/admin/gallery', ['photos' => [UploadedFile::fake()->createWithContent('surat.pdf', '%PDF-1.4 bukan foto')]])
            ->assertSessionHasErrors('photos.0');

        // Isi sampai batas, lalu upload berikutnya ditolak
        foreach (range(1, \App\Http\Controllers\Admin\GalleryController::MAX_PHOTOS) as $i) {
            $this->event->photos()->create(['path' => "gallery/x/{$i}.png", 'sort_order' => $i, 'size' => 1]);
        }

        $this->upload(1)->assertSessionHasErrors('photos');
    }

    public function test_client_cannot_touch_other_events_photos(): void
    {
        $other = Event::create(['bride_name' => 'Sari', 'groom_name' => 'Budi']);
        $photo = $other->photos()->create(['path' => 'gallery/9/a.png', 'sort_order' => 1, 'size' => 1]);

        $this->actingAs($this->client)->delete("/admin/gallery/{$photo->id}")->assertNotFound();
        $this->actingAs($this->client)->post("/admin/gallery/{$photo->id}/move", ['direction' => 'down'])->assertNotFound();
        $this->assertNotNull($photo->fresh());
    }

    public function test_large_photo_is_resized_and_compressed_when_gd_is_available(): void
    {
        if (! PhotoStorage::canCompress()) {
            $this->markTestSkipped('Ekstensi GD belum aktif; foto disimpan tanpa kompresi.');
        }

        $big = imagecreatetruecolor(3000, 2000);
        ob_start();
        imagejpeg($big, null, 95);
        $file = UploadedFile::fake()->createWithContent('besar.jpg', ob_get_clean());

        $this->actingAs($this->client)->post('/admin/gallery', ['photos' => [$file]])->assertRedirect();

        $photo = $this->event->photos()->first();
        $this->assertSame(1600, $photo->width);
        $this->assertSame(1067, $photo->height);
        $this->assertMatchesRegularExpression('/\.(webp|jpg)$/', $photo->path);
    }
}
