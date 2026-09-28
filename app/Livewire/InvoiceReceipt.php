<?php

namespace App\Livewire;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InvoiceReceipt extends Component
{
    public Payment $payment;

    public function mount($paymentId)
    {
        $this->payment = Payment::with(['user.profile', 'subscription.plan'])->findOrFail($paymentId);

        // Security check: only invoice owner or admin can view
        if (Auth::id() !== $this->payment->user_id && !Auth::user()?->is_admin) {
            abort(403, 'Unauthorized access to this invoice.');
        }
    }

    public function render()
    {
        return view('livewire/invoice-receipt')
            ->layout('layouts.app', ['title' => 'Tax Invoice #' . $this->payment->transaction_id . ' - MeroZodi']);
    }
}
