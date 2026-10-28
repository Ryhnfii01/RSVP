{{--
    Buku tamu: menampilkan ucapan & doa yang dikirim lewat form RSVP.
    Parameter: $theme = kelas warna sesuai template
    (section, title, divider, card, avatar, name, meta, message, badge, empty).
--}}
<section id="wishes" class="py-16 sm:py-20 {{ $theme['section'] }}">
    <div class="container mx-auto px-4 max-w-3xl">
        <div class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl mb-4 {{ $theme['title'] }}">Ucapan & Doa</h2>
            <div class="w-24 h-0.5 mx-auto mb-4 {{ $theme['divider'] }}"></div>
            <p class="{{ $theme['meta'] }}">
                {{ $totalWishes ?? 0 }} ucapan &middot; {{ $attendingCount ?? 0 }} tamu akan hadir
            </p>
        </div>

        <div class="space-y-4">
            @forelse ($wishes as $wish)
            <article class="rounded-2xl p-5 {{ $theme['card'] }}">
                <div class="flex items-start gap-4">
                    <div class="shrink-0 w-11 h-11 rounded-full flex items-center justify-center font-semibold {{ $theme['avatar'] }}" aria-hidden="true">
                        {{ mb_strtoupper(mb_substr($wish->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-x-2 gap-y-1">
                            <h3 class="font-semibold {{ $theme['name'] }}">{{ $wish->name }}</h3>
                            <span class="text-xs px-2 py-0.5 rounded-full {{ $theme['badge'] }}">
                                {{ $wish->attendance === 'hadir' ? 'Hadir' : 'Tidak hadir' }}
                            </span>
                        </div>
                        <p class="text-xs mt-0.5 {{ $theme['meta'] }}">{{ $wish->created_at->locale('id')->diffForHumans() }}</p>
                        <p class="mt-3 leading-relaxed break-words {{ $theme['message'] }}">{{ $wish->message }}</p>
                    </div>
                </div>
            </article>
            @empty
            <p class="text-center py-10 {{ $theme['empty'] }}">Belum ada ucapan. Jadilah yang pertama mengirim doa lewat form di atas.</p>
            @endforelse
        </div>

        @if ($wishes->hasPages())
        <div class="mt-8 flex justify-center">
            {{ $wishes->fragment('wishes')->links() }}
        </div>
        @endif
    </div>
</section>
