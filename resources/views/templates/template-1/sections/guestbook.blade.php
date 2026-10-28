<!-- Guest Book Section -->
<section id="wishes" class="relative py-16 sm:py-20 lg:py-24 bg-gradient-to-br from-gray-50 to-white overflow-hidden">
    <!-- Wave Divider Top -->
    <x-wave-divider position="top" color="white" />

    <!-- Animated Background -->
    <x-animated-background variant="light" />

    <!-- Decorative Ornaments -->
    <x-decorative-ornament position="top-left" type="floral" color="primary" />
    <x-decorative-ornament position="bottom-right" type="geometric" color="gold" />

    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-serif text-gray-800 mb-4">
                Ucapan & Doa
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-transparent via-gold-500 to-transparent mx-auto mb-6"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Kirimkan ucapan & doa untuk kami
            </p>
        </div>

        <!-- Wishes List -->
        <div class="space-y-5 mb-12">
            @forelse($wishes ?? [] as $wish)
            <div class="group relative bg-white/80 backdrop-blur-sm rounded-3xl shadow-lg p-6 border border-white/60 hover:shadow-2xl hover:-translate-y-0.5 transition-all duration-300">
                <!-- Subtle gradient overlay -->
                <div class="absolute inset-0 bg-gradient-to-br from-primary-500/5 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                <div class="relative z-10 flex items-start space-x-4">
                    <!-- Avatar -->
                    <div class="flex-shrink-0">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center shadow-md ring-4 ring-white/50 group-hover:scale-110 transition-transform duration-300">
                            <span class="text-white font-bold text-xl">
                                {{ strtoupper(substr($wish->name, 0, 1)) }}
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between mb-2">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">{{ $wish->name }}</h3>
                                <p class="text-xs text-gray-500 font-medium mt-0.5">
                                    {{ $wish->created_at->diffForHumans() }}
                                    @if($wish->attendance === 'hadir')
                                        <span class="ml-2 inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 shadow-sm">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Hadir
                                        </span>
                                    @else
                                        <span class="ml-2 inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-gray-100 to-gray-200 text-gray-600 shadow-sm">
                                            Tidak Hadir
                                        </span>
                                    @endif
                                </p>
                            </div>

                            <!-- Like Button -->
                            <button class="flex items-center space-x-1.5 text-gray-400 hover:text-red-500 transition-all duration-200 hover:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                <span class="text-sm font-medium">0</span>
                            </button>
                        </div>

                        <!-- Message -->
                        @if($wish->message)
                        <div class="mt-3 p-4 bg-gradient-to-br from-gray-50 to-white rounded-xl border border-gray-100 shadow-sm">
                            <p class="text-gray-700 leading-relaxed italic">"{{ $wish->message }}"</p>
                        </div>
                        @endif

                        <!-- Guest Count -->
                        @if($wish->attendance === 'hadir' && $wish->number_of_guests > 1)
                        <div class="mt-3 inline-flex items-center px-3 py-1.5 bg-primary-50 rounded-lg border border-primary-100">
                            <svg class="w-4 h-4 text-primary-600 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span class="text-sm font-semibold text-primary-700">{{ $wish->number_of_guests }} orang</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                </svg>
                <p class="text-gray-500">Belum ada ucapan. Jadilah yang pertama!</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if(isset($wishes) && $wishes->hasPages())
        <div class="flex justify-center">
            {{ $wishes->links() }}
        </div>
        @endif

        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-12">
            <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg p-6 text-center border border-white/50 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-primary-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative z-10">
                    <div class="text-4xl font-bold bg-gradient-to-br from-primary-600 to-primary-400 bg-clip-text text-transparent mb-2 animate-fade-in">
                        {{ $totalWishes ?? 0 }}
                    </div>
                    <div class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Total Ucapan</div>
                </div>
            </div>

            <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg p-6 text-center border border-white/50 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-green-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative z-10">
                    <div class="text-4xl font-bold bg-gradient-to-br from-green-600 to-emerald-400 bg-clip-text text-transparent mb-2 animate-fade-in">
                        {{ $attendingCount ?? 0 }}
                    </div>
                    <div class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Hadir</div>
                </div>
            </div>

            <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg p-6 text-center border border-white/50 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-gray-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative z-10">
                    <div class="text-4xl font-bold bg-gradient-to-br from-gray-600 to-gray-400 bg-clip-text text-transparent mb-2 animate-fade-in">
                        {{ $notAttendingCount ?? 0 }}
                    </div>
                    <div class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Tidak Hadir</div>
                </div>
            </div>

            <div class="group relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg p-6 text-center border border-white/50 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-gold-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative z-10">
                    <div class="text-4xl font-bold bg-gradient-to-br from-gold-600 to-gold-400 bg-clip-text text-transparent mb-2 animate-fade-in">
                        {{ $totalGuests ?? 0 }}
                    </div>
                    <div class="text-xs font-semibold text-gray-600 uppercase tracking-wider">Total Tamu</div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center mt-12">
            <p class="text-gray-600 mb-4">Belum konfirmasi kehadiran?</p>
            <a href="#rsvp" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-primary-600 to-primary-500 text-white rounded-full hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Kirim RSVP & Ucapan
            </a>
        </div>
    </div>
</section>
