<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Guest;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        // Acara yang sedang dikelola + daftar pilihan untuk sidebar admin
        View::composer('admin.layouts.app', function ($view) {
            $user = auth()->user();
            $managedEvent = Event::managedBy($user);

            $view->with([
                'managedEvent' => $managedEvent,
                'selectableEvents' => $user ? Event::selectableBy($user) : collect(),
                // Angka di menu Wishes: ucapan yang menunggu persetujuan
                'pendingWishes' => $managedEvent
                    ? $managedEvent->guests()->withWish()->where('message_status', Guest::WISH_PENDING)->count()
                    : 0,
            ]);
        });
    }

    /**
     * Batas permintaan untuk form publik dan login.
     * Banyak tamu bisa berbagi satu IP (jaringan seluler, Wi-Fi gedung), jadi batas
     * per IP dibuat longgar untuk orang sungguhan tapi menghentikan spam otomatis.
     */
    private function configureRateLimiting(): void
    {
        RateLimiter::for('rsvp', function (Request $request) {
            $tooMany = function (Request $request) {
                $message = 'Terlalu banyak kiriman dari jaringan Anda. Silakan coba lagi beberapa menit lagi.';

                return $request->isJson() || $request->expectsJson()
                    ? response()->json(['success' => false, 'message' => $message], 429)
                    : redirect()->to(url()->previous() . '#rsvp')->withErrors(['rsvp' => $message])->withInput();
            };

            return [
                Limit::perMinute(10)->by('rsvp-minute:' . $request->ip())->response($tooMany),
                Limit::perHour(100)->by('rsvp-hour:' . $request->ip())->response($tooMany),
            ];
        });

        // Tebak password: per email + IP, dan per IP untuk menebak banyak email
        RateLimiter::for('login', function (Request $request) {
            $tooMany = fn () => back()->withErrors([
                'email' => 'Terlalu banyak percobaan masuk. Silakan coba lagi dalam 1 menit.',
            ])->onlyInput('email');

            return [
                Limit::perMinute(5)->by(Str::lower((string) $request->input('email')) . '|' . $request->ip())->response($tooMany),
                Limit::perMinute(20)->by('login-ip:' . $request->ip())->response($tooMany),
            ];
        });

        // Link personal: cukup longgar untuk dibuka berulang, tapi menghalangi menebak kode
        RateLimiter::for('personal-link', fn (Request $request) => Limit::perMinute(60)->by($request->ip()));
    }
}
