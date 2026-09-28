<?php

namespace App\Livewire;

use App\Models\UserVerification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class MyKyc extends Component
{
    use WithFileUploads;

    public $document_type = 'citizenship';
    public $document_number = '';
    public $front_image;
    public $back_image;

    public function submitKyc()
    {
        $this->validate([
            'document_type' => 'required|in:citizenship,passport,national_id,driving_license',
            'document_number' => 'required|string|max:50',
            'front_image' => 'required|image|max:5120',
            'back_image' => 'nullable|image|max:5120',
        ]);

        $user = Auth::user();

        $frontPath = $this->front_image->store('kyc/' . $user->id, 'public');
        $backPath = $this->back_image ? $this->back_image->store('kyc/' . $user->id, 'public') : null;

        UserVerification::create([
            'user_id' => $user->id,
            'document_type' => $this->document_type,
            'document_number' => $this->document_number,
            'front_image_path' => $frontPath,
            'back_image_path' => $backPath,
            'status' => 'pending',
        ]);

        $this->reset(['document_number', 'front_image', 'back_image']);
        session()->flash('success', 'Your National ID documents have been submitted for verification! Our moderation team audits submissions within 24 hours.');
    }

    public function render()
    {
        $latestVerification = UserVerification::where('user_id', Auth::id())->latest()->first();

        return view('livewire.my-kyc', [
            'latestVerification' => $latestVerification,
        ])->layout('components.layouts.app', ['title' => 'National ID & KYC Verification - MeroZodi']);
    }
}
