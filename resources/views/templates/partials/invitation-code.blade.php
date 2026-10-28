{{-- Kode link personal, supaya jawaban RSVP terhubung ke tamu undangan (F-07) --}}
@if ($invitation)
<input type="hidden" name="invitation" value="{{ $invitation->code }}">
@endif
