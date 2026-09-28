<div class="py-10 bg-slate-50 min-h-[90vh]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900">National ID & KYC Verification</h1>
                <p class="text-xs text-slate-500 mt-1">Get the official Verified Profile Badge and build instant trust with matches</p>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline btn-sm rounded-xl text-xs font-bold border-slate-300">
                <i class="fa-solid fa-arrow-left"></i> Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success shadow-sm mb-6 rounded-2xl text-white font-semibold">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Current Verification Status Card -->
        <div class="bg-white rounded-3xl p-6 md:p-8 shadow-xs border border-slate-200/80 mb-8">
            <h2 class="text-base font-bold text-slate-900 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-shield-halved text-rose-600"></i> Verification Status
            </h2>

            @if(auth()->user()->is_verified)
                <div class="p-6 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center text-xl shadow-md">
                        <i class="fa-solid fa-certificate"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-emerald-900 text-base">Verified Member Badge Active</h3>
                        <p class="text-xs text-emerald-700 mt-0.5">
                            Your National ID / Citizenship has been audited and approved by the MeroZodi safety team.
                        </p>
                    </div>
                </div>
            @elseif($latestVerification && $latestVerification->status === 'pending')
                <div class="p-6 rounded-2xl bg-amber-50 border border-amber-200 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500 text-white flex items-center justify-center text-xl shadow-md">
                        <i class="fa-solid fa-hourglass-half"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-amber-900 text-base">Documents Under Review</h3>
                        <p class="text-xs text-amber-700 mt-0.5">
                            Your documents were submitted on {{ $latestVerification->created_at->format('M d, Y') }}. Our compliance team is currently auditing them.
                        </p>
                    </div>
                </div>
            @elseif($latestVerification && $latestVerification->status === 'rejected')
                <div class="p-6 rounded-2xl bg-rose-50 border border-rose-200 space-y-2">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-rose-600 text-white flex items-center justify-center text-lg">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                        <div>
                            <h3 class="font-extrabold text-rose-900 text-sm">Previous Submission Rejected</h3>
                            <p class="text-xs text-rose-700">Reason: {{ $latestVerification->admin_notes ?? 'Image was blurry or unreadable. Please re-upload a clear photo.' }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-slate-200 text-slate-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-id-card"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-800 text-sm">Not Yet Verified</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Submit your Government ID to gain verified status badge.</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Verification Form -->
        @if(!auth()->user()->is_verified && (!$latestVerification || $latestVerification->status !== 'pending'))
            <div class="bg-white rounded-3xl p-6 md:p-8 shadow-xs border border-slate-200/80">
                <h2 class="text-base font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-cloud-arrow-up text-rose-600"></i> Submit Verification Document
                </h2>

                <form wire:submit="submitKyc" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1.5">Document Type</label>
                            <select wire:model="document_type" class="select select-bordered w-full rounded-xl">
                                <option value="citizenship">Nepali Citizenship Card (Nagarikta)</option>
                                <option value="passport">Nepali National Passport</option>
                                <option value="national_id">National ID Card (Rastriya Parichayapatra)</option>
                                <option value="driving_license">Driving License</option>
                            </select>
                            @error('document_type') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1.5">Document / ID Number</label>
                            <input type="text" wire:model="document_number" class="input input-bordered w-full rounded-xl" placeholder="e.g. 27-01-78-01234">
                            @error('document_number') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Front Image -->
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1.5">Document Front Photo</label>
                            <div class="border-2 border-dashed border-slate-200 hover:border-rose-400 rounded-2xl p-6 text-center bg-slate-50">
                                <input type="file" wire:model="front_image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-rose-50 file:text-rose-700">
                                @error('front_image') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Back Image -->
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1.5">Document Back Photo (Optional)</label>
                            <div class="border-2 border-dashed border-slate-200 hover:border-rose-400 rounded-2xl p-6 text-center bg-slate-50">
                                <input type="file" wire:model="back_image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-rose-50 file:text-rose-700">
                                @error('back_image') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 text-xs text-slate-600 space-y-1">
                        <p class="font-bold text-slate-800"><i class="fa-solid fa-lock text-rose-500 mr-1.5"></i> Privacy Guarantee:</p>
                        <p>Your identity documents are securely encrypted and accessed only by authorized compliance personnel for identity verification. They are never shared publicly or visible to other members.</p>
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-rose-200 transition">
                        <i class="fa-solid fa-paper-plane mr-1.5"></i> Submit for Verification
                    </button>
                </form>
            </div>
        @endif

    </div>
</div>
