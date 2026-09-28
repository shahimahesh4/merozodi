<?php

namespace App\Livewire;

use App\Models\UserGallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class MyGallery extends Component
{
    use WithFileUploads;

    public $photos = [];

    public function uploadPhotos()
    {
        $this->validate([
            'photos.*' => 'image|max:5120', // max 5MB per photo
        ]);

        $user = Auth::user();

        foreach ($this->photos as $photo) {
            $path = $photo->store('galleries/' . $user->id, 'public');

            $isFirst = $user->galleries()->count() === 0;

            $gallery = UserGallery::create([
                'user_id' => $user->id,
                'image_path' => $path,
                'is_profile' => $isFirst,
                'is_approved' => true,
            ]);

            if ($isFirst) {
                $user->update(['avatar' => $path]);
            }
        }

        $this->photos = [];
        session()->flash('success', 'Photos uploaded successfully! 📸');
    }

    public function setAsAvatar($galleryId)
    {
        $user = Auth::user();
        $gallery = UserGallery::where('user_id', $user->id)->where('id', $galleryId)->firstOrFail();

        UserGallery::where('user_id', $user->id)->update(['is_profile' => false]);
        $gallery->update(['is_profile' => true]);

        $user->update(['avatar' => $gallery->image_path]);

        session()->flash('success', 'Primary profile photo updated! 👤');
    }

    public function togglePrivate($galleryId)
    {
        $gallery = UserGallery::where('user_id', Auth::id())->where('id', $galleryId)->firstOrFail();
        $gallery->update(['is_private' => !$gallery->is_private]);
        session()->flash('info', 'Photo privacy status updated.');
    }

    public function deletePhoto($galleryId)
    {
        $gallery = UserGallery::where('user_id', Auth::id())->where('id', $galleryId)->firstOrFail();
        
        if (Storage::disk('public')->exists($gallery->image_path)) {
            Storage::disk('public')->delete($gallery->image_path);
        }
        
        $gallery->delete();

        session()->flash('info', 'Photo deleted from your album.');
    }

    public function render()
    {
        $galleries = UserGallery::where('user_id', Auth::id())->latest()->get();

        return view('livewire.my-gallery', [
            'galleries' => $galleries,
        ])->layout('components.layouts.app', ['title' => 'Manage Photo Album - MeroZodi']);
    }
}
