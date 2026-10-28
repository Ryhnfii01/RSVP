{{--
    Musik latar bersama untuk semua template.
    Diputar saat tamu menekan tombol #open-invitation (browser hanya mengizinkan
    audio setelah ada interaksi). Tidak tampil jika musik belum diatur.
    Parameter: $buttonClass = warna tombol sesuai tema template.
--}}
@php($musicUrl = $event->musicUrl())
@if ($musicUrl)
<audio id="wedding-music" src="{{ $musicUrl }}" loop preload="none"></audio>

<button type="button" id="wedding-music-toggle" aria-label="Putar musik" aria-pressed="false"
        class="hidden fixed bottom-24 right-4 z-40 w-12 h-12 rounded-full shadow-lg items-center justify-center transition-transform active:scale-95 {{ $buttonClass ?? 'bg-white/90 text-gray-800' }}">
    {{-- Ikon putar --}}
    <svg data-music-icon="play" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/>
    </svg>
    {{-- Ikon jeda --}}
    <svg data-music-icon="pause" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
    </svg>
</button>

<script>
(() => {
    const audio = document.getElementById('wedding-music');
    const button = document.getElementById('wedding-music-toggle');
    const openButton = document.getElementById('open-invitation');

    const sync = () => {
        const playing = !audio.paused;
        button.querySelector('[data-music-icon="play"]').classList.toggle('hidden', playing);
        button.querySelector('[data-music-icon="pause"]').classList.toggle('hidden', !playing);
        button.setAttribute('aria-pressed', playing ? 'true' : 'false');
        button.setAttribute('aria-label', playing ? 'Jeda musik' : 'Putar musik');
    };

    const show = () => {
        button.classList.remove('hidden');
        button.classList.add('flex');
    };

    const play = () => audio.play().catch(() => {}).finally(sync);

    audio.addEventListener('play', sync);
    audio.addEventListener('pause', sync);

    button.addEventListener('click', () => {
        if (audio.paused) {
            play();
        } else {
            audio.pause();
        }
    });

    if (openButton) {
        openButton.addEventListener('click', () => {
            show();
            play();
        });
    } else {
        show();
    }
})();
</script>
@endif
