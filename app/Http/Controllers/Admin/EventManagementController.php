<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use App\Support\ClientCredentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * Super admin: daftar semua acara dan membuat acara baru.
 */
class EventManagementController extends Controller
{
    public function index()
    {
        $events = Event::with('owner')
            ->withCount('guests')
            ->orderByDesc('created_at')
            ->get();

        $managedEvent = Event::managedBy(auth()->user());

        return view('admin.events.index', compact('events', 'managedEvent'));
    }

    public function create()
    {
        $clients = User::where('role', User::ROLE_CLIENT)->orderBy('name')->get();

        return view('admin.events.create', compact('clients'));
    }

    public function store(Request $request)
    {
        // "Rina Dimas" -> "rina-dimas"
        if ($request->filled('slug')) {
            $request->merge(['slug' => Str::slug($request->input('slug'))]);
        }

        $validated = $request->validate([
            'bride_name' => 'required|string|max:255',
            'groom_name' => 'required|string|max:255',
            'event_date' => 'nullable|date',
            'template' => ['required', Rule::in(array_keys(Event::TEMPLATES))],
            'slug' => 'nullable|alpha_dash|max:100|unique:events,slug',
            'owner' => 'required|in:none,existing,new',
            'user_id' => [
                'required_if:owner,existing',
                'nullable',
                Rule::exists('users', 'id')->where('role', User::ROLE_CLIENT),
            ],
            'client_name' => 'required_if:owner,new|nullable|string|max:255',
            'client_email' => 'required_if:owner,new|nullable|email|max:255|unique:users,email',
            'client_phone' => 'nullable|string|max:20',
        ]);

        // Akun client baru memakai password sementara yang digenerate sistem
        $newClient = null;
        $password = null;

        $event = DB::transaction(function () use ($validated, &$newClient, &$password) {
            if ($validated['owner'] === 'new') {
                $password = ClientCredentials::generatePassword();
                $newClient = User::create([
                    'name' => $validated['client_name'],
                    'email' => $validated['client_email'],
                    'phone' => $validated['client_phone'] ?? null,
                    'password' => $password,
                    'must_change_password' => true,
                    'role' => User::ROLE_CLIENT,
                ]);
            }

            $ownerId = match ($validated['owner']) {
                'existing' => $validated['user_id'],
                'new' => $newClient->id,
                default => null,
            };

            return Event::create([
                'user_id' => $ownerId,
                'bride_name' => $validated['bride_name'],
                'groom_name' => $validated['groom_name'],
                'event_date' => $validated['event_date'] ?? null,
                'template' => $validated['template'],
                'slug' => $validated['slug'] ?? null,
                'event_type' => 'wedding',
                'is_active' => false,
            ]);
        });

        // Langsung kelola acara baru untuk melengkapi detailnya
        session(['admin_event_id' => $event->id]);

        $redirect = redirect()->route('admin.event-settings.edit')
            ->with('success', 'Acara berhasil dibuat. Lengkapi detail acaranya di bawah.');

        return $newClient
            ? $redirect->with('client_credentials', ClientCredentials::forFlash($newClient, $password))
            : $redirect;
    }

    /**
     * Pilih acara lalu buka dashboard-nya.
     */
    public function manage(Event $event)
    {
        session(['admin_event_id' => $event->id]);

        return redirect()->route('admin.dashboard');
    }
}
