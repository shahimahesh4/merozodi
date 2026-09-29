<div class="py-10 bg-slate-50 min-h-[90vh]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900">Manage Your Photo Album</h1>
                <p class="text-xs text-slate-500 mt-1">Profiles with at least 3 high-quality photos receive 5x more connection requests</p>
            </div>
            <a wire:navigate href="{{ route('my.profile') }}" class="btn btn-outline btn-sm rounded-xl text-xs font-bold border-slate-300">
                <i class="fa-solid fa-arrow-left"></i> Back to Profile
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success shadow-sm mb-6 rounded-2xl text-white font-semibold">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('info'))
            <div class="alert alert-info shadow-sm mb-6 rounded-2xl text-white font-semibold">
                <i class="fa-solid fa-circle-info"></i>
                <span>{{ session('info') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Upload Box -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-3xl p-6 shadow-xs border border-slate-200/80">
                    <h3 class="text-base font-bold text-slate-900 mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-cloud-arrow-up text-rose-500"></i> Add New Photos
                    </h3>
                    <p class="text-xs text-slate-500 mb-4">Upload JPG, PNG or WEBP up to 5MB.</p>

                    <form wire:submit="uploadPhotos" class="space-y-4">
                        <div class="border-2 border-dashed border-slate-200 hover:border-rose-400 rounded-2xl p-6 text-center cursor-pointer transition bg-slate-50">
                            <input type="file" wire:model="photos" multiple accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100">
                            @error('photos.*') <span class="text-rose-600 text-xs mt-2 block">{{ $message }}</span> @enderror
                        </div>

                        <div wire:loading wire:target="photos" class="text-xs text-rose-600 font-bold">
                            <i class="fa-solid fa-spinner fa-spin mr-1"></i> Processing photo previews...
                        </div>

                        @if(count($photos) > 0)
                            <button type="submit" class="w-full py-3 bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 text-white font-bold text-xs rounded-xl shadow-md transition">
                                <i class="fa-solid fa-upload"></i> Upload {{ count($photos) }} Selected Photos
                            </button>
                        @endif
                    </form>

                    <div class="mt-6 p-4 rounded-2xl bg-amber-50 border border-amber-100 text-xs text-amber-800 space-y-1">
                        <p class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-shield-halved text-amber-600"></i> Photo Guidelines:</p>
                        <p>&bull; Clear front-facing portrait photos</p>
                        <p>&bull; No group photos or sunglasses covering face</p>
                        <p>&bull; Watermarked photos are kept private for verified members</p>
                    </div>
                </div>
            </div>

            <!-- Existing Gallery Grid -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl p-6 md:p-8 shadow-xs border border-slate-200/80">
                    <h3 class="text-base font-bold text-slate-900 mb-6 flex items-center justify-between">
                        <span>Your Uploaded Photos ({{ $galleries->count() }})</span>
                    </h3>

                    @if($galleries->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                            @foreach($galleries as $g)
                                <div class="relative group rounded-2xl overflow-hidden border border-slate-200 bg-slate-50 shadow-xs flex flex-col justify-between">
                                    <div class="relative aspect-square overflow-hidden">
                                        <img src="{{ asset('storage/' . $g->image_path) }}" alt="Photo" class="w-full h-full object-cover">
                                        
                                        <!-- Top Badge for Avatar -->
                                        @if($g->is_profile)
                                            <div class="absolute top-2 left-2 bg-rose-600 text-white text-[10px] font-extrabold px-2.5 py-0.5 rounded-full shadow-md">
                                                Primary Avatar
                                            </div>
                                        @endif

                                        @if($g->is_private)
                                            <div class="absolute top-2 right-2 bg-slate-900/80 text-white text-[10px] font-bold px-2 py-0.5 rounded-full backdrop-blur-xs">
                                                <i class="fa-solid fa-lock"></i> Private
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Bottom Control Bar -->
                                    <div class="p-2.5 bg-white border-t border-slate-100 flex items-center justify-between text-xs">
                                        @if(!$g->is_profile)
                                            <button wire:click="setAsAvatar({{ $g->id }})" class="text-[11px] font-bold text-rose-600 hover:underline">
                                                Set as Profile
                                            </button>
                                        @else
                                            <span class="text-[11px] font-bold text-slate-400">Current Profile</span>
                                        @endif

                                        <div class="flex items-center gap-2">
                                            <button wire:click="togglePrivate({{ $g->id }})" class="p-1 text-slate-400 hover:text-slate-700" title="{{ $g->is_private ? 'Make Public' : 'Make Private' }}">
                                                <i class="fa-solid {{ $g->is_private ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                                            </button>
                                            <button wire:click="deletePhoto({{ $g->id }})" wire:confirm="Are you sure you want to delete this photo?" class="p-1 text-rose-400 hover:text-rose-600" title="Delete Photo">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-12 text-center text-slate-400 text-xs">
                            <i class="fa-regular fa-images text-4xl mb-3 block text-slate-300"></i>
                            You have not uploaded any photos yet. Use the upload box to add photos.
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </div>
</div>
