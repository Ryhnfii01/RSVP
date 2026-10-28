<!-- Gift Section -->
<section id="gift" class="relative py-16 sm:py-20 lg:py-24 bg-white overflow-hidden">
    <!-- Animated Background -->
    <x-animated-background variant="rose" />

    <!-- Decorative Ornaments -->
    <x-decorative-ornament position="top-left" type="hearts" color="gold" />
    <x-decorative-ornament position="bottom-right" type="hearts" color="primary" />

    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-serif text-gray-800 mb-4">
                Wedding Gift
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-transparent via-gold-500 to-transparent mx-auto mb-6"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Doa restu Anda merupakan karunia yang sangat berarti bagi kami.
                Namun jika memberi adalah ungkapan tanda kasih, Anda dapat memberi kado secara cashless.
            </p>
        </div>

        <!-- Bank Accounts -->
        <div class="grid md:grid-cols-2 gap-6 mb-12">
            <!-- BCA Account - Groom -->
            <div class="group relative bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl p-8 border border-white/60 hover:shadow-2xl hover:-translate-y-1 transition-all duration-500">
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-br from-primary-500/10 via-primary-400/5 to-transparent rounded-3xl"></div>

                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Bank Transfer</p>
                                <p class="text-2xl font-bold bg-gradient-to-r from-primary-600 to-primary-500 bg-clip-text text-transparent">BCA</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <p class="text-xs text-gray-500 mb-2 font-medium uppercase tracking-wide">Nomor Rekening</p>
                        <div class="flex items-center justify-between bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border border-gray-200/50 shadow-sm">
                            <p id="bca-number" class="text-lg font-mono font-bold text-gray-800 tracking-wider">1234567890</p>
                            <button onclick="copyToClipboard('bca-number', 'bca-btn')"
                                    id="bca-btn"
                                    class="ml-3 px-4 py-2 bg-gradient-to-r from-primary-600 to-primary-500 text-white text-sm font-semibold rounded-lg hover:from-primary-700 hover:to-primary-600 active:scale-95 transition-all duration-200 shadow-md hover:shadow-lg">
                                <span class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>Copy</span>
                                </span>
                            </button>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-200/50">
                        <p class="text-xs text-gray-500 mb-1 font-medium uppercase tracking-wide">Atas Nama</p>
                        <p class="text-base font-semibold text-gray-800">Nama Lengkap Pria</p>
                    </div>
                </div>
            </div>

            <!-- Mandiri Account - Bride -->
            <div class="group relative bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl p-8 border border-white/60 hover:shadow-2xl hover:-translate-y-1 transition-all duration-500">
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-br from-gold-500/10 via-gold-400/5 to-transparent rounded-3xl"></div>

                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-gold-500 to-gold-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Bank Transfer</p>
                                <p class="text-2xl font-bold bg-gradient-to-r from-gold-600 to-gold-500 bg-clip-text text-transparent">Mandiri</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <p class="text-xs text-gray-500 mb-2 font-medium uppercase tracking-wide">Nomor Rekening</p>
                        <div class="flex items-center justify-between bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border border-gray-200/50 shadow-sm">
                            <p id="mandiri-number" class="text-lg font-mono font-bold text-gray-800 tracking-wider">0987654321</p>
                            <button onclick="copyToClipboard('mandiri-number', 'mandiri-btn')"
                                    id="mandiri-btn"
                                    class="ml-3 px-4 py-2 bg-gradient-to-r from-gold-600 to-gold-500 text-white text-sm font-semibold rounded-lg hover:from-gold-700 hover:to-gold-600 active:scale-95 transition-all duration-200 shadow-md hover:shadow-lg">
                                <span class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>Copy</span>
                                </span>
                            </button>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-200/50">
                        <p class="text-xs text-gray-500 mb-1 font-medium uppercase tracking-wide">Atas Nama</p>
                        <p class="text-base font-semibold text-gray-800">Nama Lengkap Wanita</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Digital Wallet / QR Code Section -->
        <div class="relative bg-white/70 backdrop-blur-md rounded-3xl shadow-xl p-8 border border-white/50 overflow-hidden">
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 via-pink-500/5 to-transparent"></div>

            <div class="relative z-10 text-center mb-8">
                <h3 class="text-2xl font-serif bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-2">E-Wallet & QRIS</h3>
                <p class="text-sm text-gray-600">Scan QR Code untuk pembayaran digital</p>
            </div>

            <div class="relative z-10 grid md:grid-cols-3 gap-6">
                <!-- QRIS -->
                <div class="group text-center">
                    <div class="w-48 h-48 mx-auto bg-white rounded-2xl p-4 mb-4 flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 border-2 border-gray-100 group-hover:border-primary-200">
                        <!-- Placeholder QR Code -->
                        <div class="text-center">
                            <svg class="w-32 h-32 text-gray-300 mx-auto group-hover:text-primary-300 transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 11h8V3H3v8zm2-6h4v4H5V5zm-2 8v8h8v-8H3zm2 6v-4h4v4H5zm8-14v8h8V3h-8zm2 6v-4h4v4h-4z"></path>
                                <path d="M13 13h2v2h-2zm2 2h2v2h-2zm-2 2h2v2h-2zm4-2h2v2h-2zm0-2h2v2h-2zm2 0h2v2h-2zm-2-2h2v2h-2zm0-2h2v2h-2zm-4-2h2v2h-2z"></path>
                            </svg>
                            <p class="text-xs text-gray-500 mt-2 font-medium">QR Code</p>
                        </div>
                        <!-- Uncomment when you have QR image -->
                        {{-- <img src="{{ asset('images/qr-code/qris.png') }}" alt="QRIS" class="w-full h-full object-contain"> --}}
                    </div>
                    <p class="text-base font-bold text-gray-800 mb-1">QRIS</p>
                    <p class="text-xs text-gray-500 font-medium">All E-Wallet</p>
                </div>

                <!-- GoPay -->
                <div class="group text-center">
                    <div class="w-48 h-48 mx-auto bg-white rounded-2xl p-4 mb-4 flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 border-2 border-gray-100 group-hover:border-green-200">
                        <div class="text-center">
                            <svg class="w-32 h-32 text-gray-300 mx-auto group-hover:text-green-400 transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 11h8V3H3v8zm2-6h4v4H5V5zm-2 8v8h8v-8H3zm2 6v-4h4v4H5zm8-14v8h8V3h-8zm2 6v-4h4v4h-4z"></path>
                                <path d="M13 13h2v2h-2zm2 2h2v2h-2zm-2 2h2v2h-2zm4-2h2v2h-2zm0-2h2v2h-2zm2 0h2v2h-2zm-2-2h2v2h-2zm0-2h2v2h-2zm-4-2h2v2h-2z"></path>
                            </svg>
                            <p class="text-xs text-gray-500 mt-2 font-medium">QR Code</p>
                        </div>
                    </div>
                    <p class="text-base font-bold text-gray-800 mb-1">GoPay</p>
                    <p class="text-xs text-gray-500 font-medium">081234567890</p>
                </div>

                <!-- OVO -->
                <div class="group text-center">
                    <div class="w-48 h-48 mx-auto bg-white rounded-2xl p-4 mb-4 flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 border-2 border-gray-100 group-hover:border-purple-200">
                        <div class="text-center">
                            <svg class="w-32 h-32 text-gray-300 mx-auto group-hover:text-purple-400 transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 11h8V3H3v8zm2-6h4v4H5V5zm-2 8v8h8v-8H3zm2 6v-4h4v4H5zm8-14v8h8V3h-8zm2 6v-4h4v4h-4z"></path>
                                <path d="M13 13h2v2h-2zm2 2h2v2h-2zm-2 2h2v2h-2zm4-2h2v2h-2zm0-2h2v2h-2zm2 0h2v2h-2zm-2-2h2v2h-2zm0-2h2v2h-2zm-4-2h2v2h-2z"></path>
                            </svg>
                            <p class="text-xs text-gray-500 mt-2 font-medium">QR Code</p>
                        </div>
                    </div>
                    <p class="text-base font-bold text-gray-800 mb-1">OVO</p>
                    <p class="text-xs text-gray-500 font-medium">081234567890</p>
                </div>
            </div>
        </div>

        <!-- Physical Address -->
        <div class="mt-8 text-center relative bg-white/70 backdrop-blur-sm rounded-3xl p-10 border border-white/50 shadow-xl overflow-hidden">
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-primary-500/10 via-gold-500/10 to-primary-500/10"></div>

            <div class="relative z-10">
                <div class="w-16 h-16 bg-gradient-to-br from-gold-400 to-gold-500 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-serif bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-3">Kirim Hadiah Langsung</h3>
                <p class="text-gray-600 mb-6 max-w-md mx-auto">Anda juga dapat mengirimkan hadiah ke alamat berikut:</p>
                <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-5 max-w-lg mx-auto shadow-inner border border-gray-100">
                    <p class="text-base font-semibold text-gray-800 leading-relaxed">
                        Jl. Contoh No. 123, Kelurahan, Kecamatan<br>
                        Kota, Provinsi 12345
                    </p>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-sm text-gray-600">
                            <span class="font-medium text-gray-700">a.n. Nama Penerima</span>
                            <span class="mx-2">•</span>
                            <span class="font-mono">0812-3456-7890</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
function copyToClipboard(elementId, buttonId) {
    const text = document.getElementById(elementId).textContent;
    const button = document.getElementById(buttonId);

    navigator.clipboard.writeText(text).then(() => {
        const originalText = button.textContent;
        button.textContent = '✓ Copied!';
        button.classList.add('bg-green-600');

        setTimeout(() => {
            button.textContent = originalText;
            button.classList.remove('bg-green-600');
        }, 2000);
    }).catch(err => {
        console.error('Failed to copy:', err);
        alert('Gagal menyalin. Silakan copy manual: ' + text);
    });
}
</script>
@endpush
