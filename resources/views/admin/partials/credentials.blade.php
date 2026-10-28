{{--
    Kredensial client yang baru dibuat / direset. Hanya tampil sekali (session flash):
    password tidak bisa dilihat lagi setelah halaman ditinggalkan.
--}}
@if ($credentials = session('client_credentials'))
<div class="mb-6 rounded-2xl border-2 border-primary-200 bg-primary-50 p-6" role="status">
    <div class="flex flex-wrap items-start justify-between gap-4 mb-4">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">Login details for {{ $credentials['name'] }}</h3>
            <p class="text-sm text-gray-600">Shown only once. Send them to the client now; the password cannot be viewed again later.</p>
        </div>
    </div>

    <dl class="grid sm:grid-cols-3 gap-3 mb-4">
        <div class="rounded-xl bg-white p-3 border border-primary-100">
            <dt class="text-xs text-gray-500">Login page</dt>
            <dd class="text-sm font-medium text-gray-900 break-all">{{ $credentials['login_url'] }}</dd>
        </div>
        <div class="rounded-xl bg-white p-3 border border-primary-100">
            <dt class="text-xs text-gray-500">Email</dt>
            <dd class="text-sm font-medium text-gray-900 break-all">{{ $credentials['email'] }}</dd>
        </div>
        <div class="rounded-xl bg-white p-3 border border-primary-100">
            <dt class="text-xs text-gray-500">Temporary password</dt>
            <dd id="credential-password" class="text-lg font-mono font-semibold text-gray-900 tracking-wide">{{ $credentials['password'] }}</dd>
        </div>
    </dl>

    <div class="flex flex-wrap items-center gap-3">
        <a href="{{ $credentials['whatsapp_url'] }}" target="_blank" rel="noopener"
           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-medium text-white bg-[#25D366] hover:bg-[#1ebe57]">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91C21.95 6.45 17.5 2 12.04 2zm5.8 14.03c-.24.68-1.42 1.3-1.95 1.35-.5.05-.97.23-3.27-.68-2.77-1.09-4.52-3.92-4.66-4.1-.13-.18-1.1-1.47-1.1-2.8 0-1.33.7-1.98.95-2.25.24-.27.53-.34.71-.34h.51c.16 0 .38-.06.6.46.24.55.79 1.9.86 2.04.07.14.11.3.02.48-.09.18-.14.3-.27.46-.14.16-.29.36-.41.48-.14.14-.28.29-.12.56.16.27.71 1.17 1.52 1.9 1.05.93 1.93 1.22 2.2 1.36.27.14.43.11.59-.07.16-.18.68-.79.86-1.06.18-.27.36-.23.6-.14.25.09 1.58.75 1.85.88.27.14.45.2.52.32.07.11.07.66-.17 1.33z"/></svg>
            {{ $credentials['has_phone'] ? 'Send to client on WhatsApp' : 'Send via WhatsApp (pick contact)' }}
        </a>
        <button type="button" id="copy-credentials" data-message="{{ $credentials['message'] }}"
                class="px-5 py-2.5 rounded-xl font-medium text-primary-700 border border-primary-300 bg-white hover:bg-primary-50">
            Copy message
        </button>
    </div>
</div>

<script>
    document.getElementById('copy-credentials').addEventListener('click', (event) => {
        const button = event.currentTarget;
        navigator.clipboard.writeText(button.dataset.message)
            .then(() => { button.textContent = 'Copied'; })
            .catch(() => { button.textContent = 'Copy failed: select the details above'; });
    });
</script>
@endif
