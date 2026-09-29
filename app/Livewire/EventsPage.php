<?php

namespace App\Livewire;

use App\Models\MatrimonyEvent;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class EventsPage extends Component
{
    use WithPagination;

    #[Url(as: 'type', except: 'all')]
    public $filterType = 'all';

    #[Url(except: '')]
    public $search = '';

    public $registeredEvents = [];
    public $selectedEventForModal = null;

    public function mount()
    {
        // Load registered events from session
        $this->registeredEvents = session()->get('registered_events', []);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterType()
    {
        $this->resetPage();
    }

    public function registerForEvent($eventId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Please log in to RSVP for MeroZodi matrimonial events.');
        }

        if (!in_array($eventId, $this->registeredEvents)) {
            $this->registeredEvents[] = $eventId;
            session()->put('registered_events', $this->registeredEvents);
        }

        session()->flash('event_success', 'You have successfully reserved your spot for this event! Confirmation details have been sent to your registered email.');
    }

    public function openEventDetails($eventId)
    {
        $this->selectedEventForModal = MatrimonyEvent::with('faqs')->find($eventId);
    }

    public function closeEventModal()
    {
        $this->selectedEventForModal = null;
    }

    public function render()
    {
        $query = MatrimonyEvent::query()
            ->with('faqs')
            ->where('is_active', true)
            ->where('event_datetime', '>=', now())
            ->orderBy('event_datetime', 'asc');

        if ($this->filterType !== 'all') {
            $query->where('type', $this->filterType);
        }

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('location_venue', 'like', '%' . $this->search . '%');
            });
        }

        $events = $query->paginate(6);

        return view('livewire.events-page', [
            'events' => $events,
        ])->layout('components.layouts.app', ['title' => 'Matrimonial Events & Speed Dating - MeroZodi']);
    }
}
