<!-- RSVP Section -->
<section id="rsvp" class="relative py-20 bg-gradient-to-br from-brown-50 via-cream-100 to-brown-100 overflow-hidden">
    <!-- Decorative Background -->
    <div class="absolute inset-0 opacity-5">
        <svg class="absolute top-10 right-10 w-56 h-56 text-brown-300 animate-float" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
        </svg>
        <svg class="absolute bottom-10 left-10 w-48 h-48 text-brown-200 animate-float animation-delay-4000" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17 8C8 10 5.9 16.17 3.82 21.34l-.59 1.66 1.66-.59C10.83 20.1 17 18 19 9l1-4-4 1-2 2 2 2c-1 2.5-3.5 5-6.5 6.5l1.5-4.5L17 8z"/>
        </svg>
    </div>

    <div class="relative z-10 container mx-auto px-4 max-w-2xl">
        <!-- Header -->
        <div class="text-center mb-12 animate-on-scroll" data-animation="fade-in-up">
            <h2 class="text-5xl md:text-6xl font-script text-brown-800 mb-4">RSVP</h2>
            <div class="flex items-center justify-center gap-4 mt-6">
                <div class="w-20 h-0.5 bg-gradient-to-r from-transparent to-brown-400"></div>
                <svg class="w-6 h-6 text-brown-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
                <div class="w-20 h-0.5 bg-gradient-to-l from-transparent to-brown-400"></div>
            </div>
            <p class="text-brown-700 max-w-xl mx-auto mt-6">
                Mohon konfirmasi kehadiran Anda pada acara pernikahan kami
            </p>
        </div>

        <!-- Form Card -->
        <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl p-8 border-2 border-brown-300 animate-on-scroll" data-animation="zoom-in" data-delay="200">
            <!-- Alert Container -->
            <div id="alert-container" class="mb-6"></div>

            <form id="rsvp-form" class="space-y-6">
                @csrf
                @include('templates.partials.invitation-code')

                <!-- Name Input -->
                <div>
                    <label for="name" class="block text-sm font-medium text-brown-800 mb-2">
                        Nama Lengkap <span class="text-brown-600">*</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $invitation?->name) }}"
                        required
                        class="w-full px-4 py-3 border-2 border-brown-200 rounded-xl focus:ring-2 focus:ring-brown-500 focus:border-brown-500 transition-all duration-200 bg-white"
                        placeholder="Masukkan nama lengkap Anda"
                    >
                </div>

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-sm font-medium text-brown-800 mb-2">
                        Email <span class="text-brown-500 text-xs">(Optional)</span>
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="w-full px-4 py-3 border-2 border-brown-200 rounded-xl focus:ring-2 focus:ring-brown-500 focus:border-brown-500 transition-all duration-200 bg-white"
                        placeholder="email@example.com"
                    >
                </div>

                <!-- Attendance Select -->
                <div>
                    <label for="attendance" class="block text-sm font-medium text-brown-800 mb-2">
                        Konfirmasi Kehadiran <span class="text-brown-600">*</span>
                    </label>
                    <select
                        id="attendance"
                        name="attendance"
                        required
                        class="w-full px-4 py-3 border-2 border-brown-200 rounded-xl focus:ring-2 focus:ring-brown-500 focus:border-brown-500 transition-all duration-200 bg-white"
                    >
                        <option value="">Pilih Konfirmasi</option>
                        <option value="hadir">Hadir</option>
                        <option value="tidak_hadir">Tidak Hadir</option>
                        <option value="masih_ragu">Masih Ragu</option>
                    </select>
                </div>

                <!-- Number of Guests (Hidden by default) -->
                <div id="guests-field" class="hidden">
                    <label for="number_of_guests" class="block text-sm font-medium text-brown-800 mb-2">
                        Jumlah Tamu
                    </label>
                    <input
                        type="number"
                        id="number_of_guests"
                        name="number_of_guests"
                        min="1"
                        value="1"
                        class="w-full px-4 py-3 border-2 border-brown-200 rounded-xl focus:ring-2 focus:ring-brown-500 focus:border-brown-500 transition-all duration-200 bg-white"
                    >
                </div>

                <!-- Message Textarea -->
                <div>
                    <label for="message" class="block text-sm font-medium text-brown-800 mb-2">
                        Ucapan & Doa <span class="text-brown-500 text-xs">(Optional)</span>
                    </label>
                    <textarea
                        id="message"
                        name="message"
                        rows="4"
                        class="w-full px-4 py-3 border-2 border-brown-200 rounded-xl focus:ring-2 focus:ring-brown-500 focus:border-brown-500 transition-all duration-200 resize-none bg-white"
                        placeholder="Tulis ucapan dan doa untuk kami..."
                    ></textarea>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    id="submit-btn"
                    class="w-full bg-gradient-to-r from-brown-600 to-brown-700 text-white py-4 px-6 rounded-xl font-medium text-lg hover:shadow-lg hover:from-brown-700 hover:to-brown-800 active:scale-95 transition-all duration-200 flex items-center justify-center"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Kirim Konfirmasi
                </button>
            </form>
        </div>

        <!-- Attendance Stats -->
        <div class="grid grid-cols-3 gap-4 mt-8 animate-on-scroll" data-animation="fade-in-up" data-delay="400">
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-4 shadow-lg text-center border-2 border-brown-200">
                <div class="text-3xl font-bold text-brown-700" id="confirmed-count">{{ $confirmedGuests ?? 0 }}</div>
                <p class="text-xs text-brown-600 mt-1">Terkonfirmasi</p>
            </div>

            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-4 shadow-lg text-center border-2 border-brown-300">
                <div class="text-3xl font-bold text-brown-600">{{ $attendingCount ?? 0 }}</div>
                <p class="text-xs text-brown-600 mt-1">Hadir</p>
            </div>

            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-4 shadow-lg text-center border-2 border-brown-200">
                <div class="text-3xl font-bold text-brown-500">{{ $notAttendingCount ?? 0 }}</div>
                <p class="text-xs text-brown-600 mt-1">Tidak Hadir</p>
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

@include('templates.partials.wishes', ['theme' => [
    'section' => 'bg-cream-100',
    'title' => 'font-script text-brown-800',
    'divider' => 'bg-brown-400',
    'card' => 'bg-white/90 shadow-lg border-2 border-brown-200',
    'avatar' => 'bg-brown-600 text-cream-50',
    'name' => 'text-brown-800',
    'meta' => 'text-brown-500',
    'message' => 'text-brown-700',
    'badge' => 'bg-brown-100 text-brown-700',
    'empty' => 'text-brown-600',
]])

<!-- Footer -->
<footer class="relative bg-gradient-to-br from-brown-800 to-brown-900 text-cream-100 py-12 overflow-hidden">
    <!-- Decorative Top Wave -->
    <div class="absolute top-0 left-0 right-0">
        <svg class="w-full h-12 text-brown-700" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0 Q150,60 300,40 T600,0 Q750,60 900,40 T1200,0 L1200,120 L0,120 Z" fill="currentColor"/>
        </svg>
    </div>

    <div class="relative z-10 container mx-auto px-4 text-center pt-8">
        <!-- Leaf Icon -->
        <svg class="w-12 h-12 mx-auto text-brown-600 mb-4" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17 8C8 10 5.9 16.17 3.82 21.34l-.59 1.66 1.66-.59C10.83 20.1 17 18 19 9l1-4-4 1-2 2 2 2c-1 2.5-3.5 5-6.5 6.5l1.5-4.5L17 8z"/>
        </svg>

        <h3 class="font-script text-3xl text-cream-100 mb-4">{{ $event->brideNickname() }} & {{ $event->groomNickname() }}</h3>
        <p class="text-cream-200 mb-6">{{ $event->dateMedium() }}</p>

        <div class="w-32 h-0.5 bg-gradient-to-r from-transparent via-brown-500 to-transparent mx-auto mb-6"></div>

        <p class="text-sm text-cream-300">
            Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i<br class="hidden md:block"/>
            berkenan hadir untuk memberikan doa restu kepada kami.
        </p>

        <div class="mt-8 text-xs text-cream-400">
            <p>&copy; 2025 Wedding Invitation. All rights reserved.</p>
        </div>
    </div>
</footer>

<script>
// RSVP Form Handler
const attendanceSelect = document.getElementById('attendance');
const guestsField = document.getElementById('guests-field');
const rsvpForm = document.getElementById('rsvp-form');
const submitBtn = document.getElementById('submit-btn');
const alertContainer = document.getElementById('alert-container');

// Show/hide guests field based on attendance selection
attendanceSelect.addEventListener('change', function() {
    if (this.value === 'hadir') {
        guestsField.classList.remove('hidden');
        document.getElementById('number_of_guests').required = true;
    } else {
        guestsField.classList.add('hidden');
        document.getElementById('number_of_guests').required = false;
    }
});

// Form submission
rsvpForm.addEventListener('submit', async function(e) {
    e.preventDefault();

    submitBtn.disabled = true;
    submitBtn.innerHTML = `
        <svg class="animate-spin w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Mengirim...
    `;

    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());

    try {
        const response = await fetch('{{ $rsvpUrl }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.ok) {
            showAlert('success', result.message);
            rsvpForm.reset();
            guestsField.classList.add('hidden');

            // Update confirmed count
            const confirmedCount = document.getElementById('confirmed-count');
            confirmedCount.textContent = parseInt(confirmedCount.textContent) + 1;
        } else {
            const errors = result.errors ? Object.values(result.errors).flat().join('<br>') : result.message;
            showAlert('error', errors);
        }
    } catch (error) {
        showAlert('error', 'Terjadi kesalahan. Silakan coba lagi.');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = `
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Kirim Konfirmasi
        `;
    }
});

function showAlert(type, message) {
    const bgColor = type === 'success'
        ? 'bg-green-100 border-green-600 text-green-800'
        : 'bg-red-100 border-red-600 text-red-800';

    alertContainer.innerHTML = `
        <div class="${bgColor} border-l-4 p-4 rounded-lg shadow-md" role="alert">
            <p>${message}</p>
        </div>
    `;

    setTimeout(() => {
        alertContainer.innerHTML = '';
    }, 5000);
}
</script>
