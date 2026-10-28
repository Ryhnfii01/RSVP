@if ($event->bankAccounts()->isNotEmpty() || $event->ewallets()->isNotEmpty())
<!-- Gift Section -->
<section id="gift" class="relative py-20 bg-gradient-to-br from-cream-100 via-brown-50 to-cream-50 overflow-hidden">
    <!-- Parallax Background -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none opacity-5">
        <svg class="parallax absolute top-10 left-20 w-56 h-56 text-brown-400" data-speed="0.2" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17 8C8 10 5.9 16.17 3.82 21.34l-.59 1.66 1.66-.59C10.83 20.1 17 18 19 9l1-4-4 1-2 2 2 2c-1 2.5-3.5 5-6.5 6.5l1.5-4.5L17 8z"/>
        </svg>
        <svg class="parallax absolute bottom-20 right-10 w-48 h-48 text-brown-300" data-speed="0.3" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
        </svg>
    </div>

    <div class="relative z-10 container mx-auto px-4 max-w-4xl">
        <!-- Header -->
        <div class="text-center mb-16 animate-on-scroll" data-animation="fade-in-up">
            <h2 class="text-5xl md:text-6xl font-script text-brown-800 mb-4">Wedding Gift</h2>
            <div class="flex items-center justify-center gap-4 mt-6">
                <div class="w-20 h-0.5 bg-gradient-to-r from-transparent to-brown-400"></div>
                <svg class="w-6 h-6 text-brown-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
                <div class="w-20 h-0.5 bg-gradient-to-l from-transparent to-brown-400"></div>
            </div>
            <p class="text-brown-700 mt-6 max-w-2xl mx-auto">
                Tanpa mengurangi rasa hormat, bagi Anda yang ingin memberikan tanda kasih untuk kami, dapat melalui:
            </p>
        </div>

        <!-- Gift Cards -->
        <div class="space-y-6 stagger-animation">
            @foreach ($event->bankAccounts()->concat($event->ewallets()) as $i => $account)
            <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl p-8 border-2 border-brown-300 hover:shadow-2xl transition-all duration-300">
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <!-- Icon with Nature Frame -->
                    <div class="relative flex-shrink-0">
                        <div class="w-20 h-20 bg-gradient-to-br from-brown-200 to-brown-300 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-10 h-10 text-brown-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                        <!-- Leaf Ornaments -->
                        <svg class="absolute -top-2 -left-2 w-6 h-6 text-brown-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17 8C8 10 5.9 16.17 3.82 21.34l-.59 1.66 1.66-.59C10.83 20.1 17 18 19 9l1-4-4 1-2 2 2 2c-1 2.5-3.5 5-6.5 6.5l1.5-4.5L17 8z"/>
                        </svg>
                        <svg class="absolute -bottom-2 -right-2 w-6 h-6 text-brown-600 transform rotate-180" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17 8C8 10 5.9 16.17 3.82 21.34l-.59 1.66 1.66-.59C10.83 20.1 17 18 19 9l1-4-4 1-2 2 2 2c-1 2.5-3.5 5-6.5 6.5l1.5-4.5L17 8z"/>
                        </svg>
                    </div>

                    <!-- Details -->
                    <div class="flex-1 text-center md:text-left">
                        <h3 class="text-2xl font-serif text-brown-800 mb-2">{{ $account['type'] === 'bank' ? 'Transfer Bank' : 'E-Wallet' }}</h3>
                        <p class="text-brown-600 mb-3">{{ $account['provider'] ?? '' }}</p>
                        <div class="bg-brown-50 rounded-xl p-4 mb-3">
                            <p class="text-sm text-brown-600 mb-1">{{ $account['type'] === 'bank' ? 'Nomor Rekening' : 'Nomor HP' }}</p>
                            <p class="text-2xl font-bold text-brown-800 tracking-wider" id="gift-number-{{ $i }}">{{ $account['number'] }}</p>
                        </div>
                        <p class="text-brown-700 font-medium">a.n. {{ $account['holder'] ?? '' }}</p>
                    </div>

                    <!-- Copy Button -->
                    <button
                        onclick="copyToClipboard('gift-number-{{ $i }}', this)"
                        class="px-6 py-3 bg-gradient-to-r from-brown-600 to-brown-700 text-white rounded-full font-medium hover:shadow-lg hover:from-brown-700 hover:to-brown-800 active:scale-95 transition-all duration-200 flex items-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        Salin
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Thank You Message -->
        <div class="mt-12 text-center animate-on-scroll" data-animation="fade-in-up" data-delay="400">
            <div class="bg-gradient-to-br from-brown-600 to-brown-700 rounded-3xl p-8 shadow-2xl border-4 border-cream-100 relative overflow-hidden">
                <!-- Decorative Leaves -->
                <svg class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-12 h-12 text-brown-800" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>

                <p class="text-cream-100 text-lg leading-relaxed">
                    Kehadiran dan doa restu Anda adalah hadiah terindah bagi kami. Terima kasih atas segala kebaikan dan dukungan yang telah diberikan.
                </p>
            </div>
        </div>
    </div>

    <!-- Bottom Grass Wave -->
    <div class="absolute bottom-0 left-0 right-0 pointer-events-none">
        <svg class="w-full h-24 text-brown-700 opacity-10" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,20 Q100,60 200,40 T400,20 Q500,60 600,40 T800,20 Q900,60 1000,40 T1200,20 L1200,120 L0,120 Z" fill="currentColor"/>
        </svg>
    </div>
</section>

<script>
function copyToClipboard(elementId, button) {
    const text = document.getElementById(elementId).textContent.trim();

    navigator.clipboard.writeText(text).then(() => {
        // Store original button content
        const originalContent = button.innerHTML;

        // Change button to show success
        button.innerHTML = `
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Tersalin!
        `;
        button.classList.add('bg-green-600');
        button.classList.remove('from-brown-600', 'to-brown-700');

        // Reset after 2 seconds
        setTimeout(() => {
            button.innerHTML = originalContent;
            button.classList.remove('bg-green-600');
            button.classList.add('from-brown-600', 'to-brown-700');
        }, 2000);
    }).catch(err => {
        console.error('Failed to copy:', err);
        alert('Gagal menyalin. Silakan salin secara manual.');
    });
}
</script>
@endif
