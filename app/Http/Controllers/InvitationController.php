<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    /**
     * Homepage - Template Selector
     */
    public function home()
    {
        return view('home');
    }

    /**
     * Undangan publik sebuah acara: /u/{slug}
     */
    public function show(Event $event)
    {
        $data = $this->getInvitationData($event, route('invitation.rsvp', $event));
        return view($event->templateView(), $data);
    }

    /**
     * Link personal tamu: /u/{slug}/{code}. Mencatat kapan link pertama kali dibuka.
     */
    public function personal(Event $event, string $code)
    {
        $invitation = $event->invitations()->where('code', $code)->firstOrFail();

        if (! $invitation->opened_at) {
            $invitation->forceFill(['opened_at' => now()])->save();
        }

        $data = $this->getInvitationData($event, route('invitation.rsvp', $event));
        $data['invitation'] = $invitation;
        $data['guestName'] = $invitation->name;

        return view($event->templateView(), $data);
    }

    /**
     * Template 1 - Elegant Modern (demo)
     */
    public function template1()
    {
        return $this->demo('template-1', 'template1.rsvp.store');
    }

    /**
     * Template 2 - Classic Romantic (demo)
     */
    public function template2()
    {
        return $this->demo('template-2', 'template2.rsvp.store');
    }

    /**
     * Template 3 - Elegant Nature (demo)
     */
    public function template3()
    {
        return $this->demo('template-3', 'template3.rsvp.store');
    }

    /**
     * Template 4 - Bugis Emerald (demo)
     */
    public function template4()
    {
        return $this->demo('template-4', 'template4.rsvp.store');
    }

    /**
     * Halaman demo template memakai data acara aktif.
     */
    private function demo(string $template, string $rsvpRoute)
    {
        $event = Event::getActive() ?? new Event();
        $data = $this->getInvitationData($event, route($rsvpRoute));
        return view('templates.' . $template . '.index', $data);
    }

    /**
     * Get common invitation data
     */
    private function getInvitationData(Event $event, string $rsvpUrl)
    {
        $eventDate = $event->countdownTarget();
        $guests = $event->guests();
        $totalCapacity = 200;

        $confirmedGuests = (clone $guests)->where('is_confirmed', true)->count();

        // Buku tamu: hanya ucapan yang lolos moderasi
        $wishes = (clone $guests)->visibleWish()
            ->latest()
            ->paginate(10);

        $totalWishes = (clone $guests)->visibleWish()->count();
        $attendingCount = (clone $guests)->where('attendance', 'hadir')->count();
        $notAttendingCount = (clone $guests)->where('attendance', 'tidak_hadir')->count();
        $totalGuests = (clone $guests)->where('attendance', 'hadir')->sum('number_of_guests');

        // Diisi oleh personal() saat dibuka lewat link personal
        $invitation = null;

        // Nama di sampul: link personal > ?to=Nama > sapaan umum
        $guestName = Str::limit(trim((string) request('to')), 80, '') ?: 'Bapak/Ibu/Saudara/i';

        return compact(
            'event',
            'invitation',
            'guestName',
            'eventDate',
            'rsvpUrl',
            'confirmedGuests',
            'totalCapacity',
            'wishes',
            'totalWishes',
            'attendingCount',
            'notAttendingCount',
            'totalGuests'
        );
    }
}
