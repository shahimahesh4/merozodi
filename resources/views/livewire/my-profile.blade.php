<div class="py-10 bg-slate-50 min-h-[90vh]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900">Manage Your Matrimonial Profile</h1>
                <p class="text-xs text-slate-500 mt-1">Keep your profile updated to receive higher quality matches</p>
            </div>
            <div class="flex gap-3">
                <a wire:navigate href="{{ route('profile.show', auth()->id()) }}" class="btn btn-outline btn-sm rounded-xl text-xs font-bold border-slate-300">
                    <i class="fa-solid fa-eye"></i> View Live Profile
                </a>
                <button wire:click="saveProfile" class="btn btn-primary btn-sm rounded-xl text-xs font-bold bg-rose-600 border-none text-white hover:bg-rose-700 shadow-md">
                    <i class="fa-solid fa-floppy-disk"></i> Save All Changes
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success shadow-sm mb-6 rounded-2xl text-white font-semibold">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- Left Side Navigation Tabs (Horizontal scroll on mobile, vertical on desktop) -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl lg:rounded-3xl p-2 lg:p-3 shadow-xs border border-slate-200/80 flex flex-row lg:flex-col gap-1 overflow-x-auto no-scrollbar">
                    <button type="button" wire:click="$set('activeSection', 'basic')" class="shrink-0 text-left px-3.5 py-2 lg:p-3 rounded-xl lg:rounded-2xl text-xs font-bold transition flex items-center gap-2 tap-active {{ $activeSection === 'basic' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-slate-50' }}">
                        <i class="fa-solid fa-user text-[11px]"></i> <span>Basic & Living</span>
                    </button>
                    <button type="button" wire:click="$set('activeSection', 'cultural')" class="shrink-0 text-left px-3.5 py-2 lg:p-3 rounded-xl lg:rounded-2xl text-xs font-bold transition flex items-center gap-2 tap-active {{ $activeSection === 'cultural' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-slate-50' }}">
                        <i class="fa-solid fa-moon text-[11px]"></i> <span>Cultural & Rashi</span>
                    </button>
                    <button type="button" wire:click="$set('activeSection', 'lifestyle')" class="shrink-0 text-left px-3.5 py-2 lg:p-3 rounded-xl lg:rounded-2xl text-xs font-bold transition flex items-center gap-2 tap-active {{ $activeSection === 'lifestyle' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-slate-50' }}">
                        <i class="fa-solid fa-heart-pulse text-[11px]"></i> <span>Lifestyle</span>
                    </button>
                    <button type="button" wire:click="$set('activeSection', 'career')" class="shrink-0 text-left px-3.5 py-2 lg:p-3 rounded-xl lg:rounded-2xl text-xs font-bold transition flex items-center gap-2 tap-active {{ $activeSection === 'career' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-slate-50' }}">
                        <i class="fa-solid fa-graduation-cap text-[11px]"></i> <span>Career</span>
                    </button>
                    <button type="button" wire:click="$set('activeSection', 'family')" class="shrink-0 text-left px-3.5 py-2 lg:p-3 rounded-xl lg:rounded-2xl text-xs font-bold transition flex items-center gap-2 tap-active {{ $activeSection === 'family' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-slate-50' }}">
                        <i class="fa-solid fa-people-roof text-[11px]"></i> <span>Family</span>
                    </button>
                    <button type="button" wire:click="$set('activeSection', 'preferences')" class="shrink-0 text-left px-3.5 py-2 lg:p-3 rounded-xl lg:rounded-2xl text-xs font-bold transition flex items-center gap-2 tap-active {{ $activeSection === 'preferences' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-slate-50' }}">
                        <i class="fa-solid fa-sliders text-[11px]"></i> <span>Preferences</span>
                    </button>
                </div>
            </div>

            <!-- Right Side Editor Form Card -->
            <div class="lg:col-span-3">
                <form wire:submit="saveProfile" class="bg-white rounded-3xl p-6 md:p-8 shadow-xs border border-slate-200/80 space-y-6">
                    
                    <!-- Section 1: Basic Info -->
                    @if($activeSection === 'basic')
                        <div class="space-y-5">
                            <h3 class="text-base font-bold text-slate-900 pb-3 border-b border-slate-100 flex items-center gap-2">
                                <i class="fa-solid fa-user text-rose-500"></i> Core Demographics & Living Location
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Full Name</label>
                                    <input type="text" wire:model="name" class="input input-bordered input-sm w-full rounded-xl">
                                    @error('name') <span class="text-rose-600 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Phone Number</label>
                                    <input type="text" wire:model="phone" class="input input-bordered input-sm w-full rounded-xl" placeholder="+977-98XXXXXXXX">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Date of Birth</label>
                                    <input type="date" wire:model="dob" class="input input-bordered input-sm w-full rounded-xl">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Living Country</label>
                                    <input type="text" wire:model="living_country" class="input input-bordered input-sm w-full rounded-xl">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Current Living City</label>
                                    <input type="text" wire:model="living_city" class="input input-bordered input-sm w-full rounded-xl">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Residency Status</label>
                                    <select wire:model="residency_status" class="select select-bordered select-sm w-full rounded-xl">
                                        <option value="citizen">Citizen</option>
                                        <option value="permanent_resident">Permanent Resident (PR)</option>
                                        <option value="work_permit">Work Permit</option>
                                        <option value="student_visa">Student Visa</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Profile Created By</label>
                                    <select wire:model="profile_created_by" class="select select-bordered select-sm w-full rounded-xl">
                                        <option value="self">Self</option>
                                        <option value="parents">Parents</option>
                                        <option value="sibling">Sibling</option>
                                        <option value="relative">Relative</option>
                                        <option value="friend">Friend</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Marital Status</label>
                                    <select wire:model="marital_status" class="select select-bordered select-sm w-full rounded-xl">
                                        <option value="unmarried">Unmarried</option>
                                        <option value="widow">Widow</option>
                                        <option value="divorced">Divorced</option>
                                        <option value="separated">Separated</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-600 mb-1">About Me (Bio)</label>
                                <textarea wire:model="about_me" rows="4" class="textarea textarea-bordered w-full text-xs rounded-xl" placeholder="Describe your personality, hobbies, background..."></textarea>
                            </div>
                        </div>
                    @endif

                    <!-- Section 2: Cultural & Horoscope -->
                    @if($activeSection === 'cultural')
                        <div class="space-y-5">
                            <h3 class="text-base font-bold text-slate-900 pb-3 border-b border-slate-100 flex items-center gap-2">
                                <i class="fa-solid fa-moon text-indigo-500"></i> Cultural Background & Astrology
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Religion</label>
                                    <select wire:model.live="religion_id" class="select select-bordered select-sm w-full rounded-xl">
                                        <option value="">Select Religion</option>
                                        @foreach($religions as $r)
                                            <option value="{{ $r->id }}">{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Caste / Community</label>
                                    <select wire:model="caste_id" class="select select-bordered select-sm w-full rounded-xl">
                                        <option value="">Select Caste</option>
                                        @foreach($castes as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Sub-Caste</label>
                                    <input type="text" wire:model="sub_caste" class="input input-bordered input-sm w-full rounded-xl">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Mother Tongue</label>
                                    <input type="text" wire:model="mother_tongue" class="input input-bordered input-sm w-full rounded-xl">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Horoscope Rashi</label>
                                    <select wire:model="rashi" class="select select-bordered select-sm w-full rounded-xl">
                                        <option value="">Select Rashi</option>
                                        <option value="Mesha (Aries)">Mesha (Aries)</option>
                                        <option value="Vrishabha (Taurus)">Vrishabha (Taurus)</option>
                                        <option value="Mithuna (Gemini)">Mithuna (Gemini)</option>
                                        <option value="Karka (Cancer)">Karka (Cancer)</option>
                                        <option value="Simha (Leo)">Simha (Leo)</option>
                                        <option value="Kanya (Virgo)">Kanya (Virgo)</option>
                                        <option value="Tula (Libra)">Tula (Libra)</option>
                                        <option value="Vrishchika (Scorpio)">Vrishchika (Scorpio)</option>
                                        <option value="Dhanu (Sagittarius)">Dhanu (Sagittarius)</option>
                                        <option value="Makara (Capricorn)">Makara (Capricorn)</option>
                                        <option value="Kumbha (Aquarius)">Kumbha (Aquarius)</option>
                                        <option value="Meena (Pisces)">Meena (Pisces)</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Gotra</label>
                                    <input type="text" wire:model="gotra" class="input input-bordered input-sm w-full rounded-xl" placeholder="e.g. Kashyap, Garg...">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Manglik Status</label>
                                    <select wire:model="manglik" class="select select-bordered select-sm w-full rounded-xl">
                                        <option value="no">Non-Manglik</option>
                                        <option value="yes">Manglik</option>
                                        <option value="dont_know">Don't Know</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Marital Status</label>
                                    <select wire:model="marital_status" class="select select-bordered select-sm w-full rounded-xl">
                                        <option value="never_married">Never Married</option>
                                        <option value="divorced">Divorced</option>
                                        <option value="widowed">Widowed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Section 3: Lifestyle & Habits -->
                    @if($activeSection === 'lifestyle')
                        <div class="space-y-5">
                            <h3 class="text-base font-bold text-slate-900 pb-3 border-b border-slate-100 flex items-center gap-2">
                                <i class="fa-solid fa-heart-pulse text-pink-500"></i> Lifestyle & Physical Appearance
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Height (cm)</label>
                                    <input type="number" wire:model="height_cm" class="input input-bordered input-sm w-full rounded-xl">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Weight (kg)</label>
                                    <input type="number" wire:model="weight_kg" class="input input-bordered input-sm w-full rounded-xl">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Diet</label>
                                    <select wire:model="diet" class="select select-bordered select-sm w-full rounded-xl">
                                        <option value="non_vegetarian">Non-Vegetarian</option>
                                        <option value="vegetarian">Vegetarian</option>
                                        <option value="eggetarian">Eggetarian</option>
                                        <option value="vegan">Vegan</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Blood Group</label>
                                    <select wire:model="blood_group" class="select select-bordered select-sm w-full rounded-xl">
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Smoking Habit</label>
                                    <select wire:model="smoke_habit" class="select select-bordered select-sm w-full rounded-xl">
                                        <option value="no">Non-Smoker</option>
                                        <option value="occasionally">Occasionally</option>
                                        <option value="regularly">Regularly</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Drinking Habit</label>
                                    <select wire:model="drink_habit" class="select select-bordered select-sm w-full rounded-xl">
                                        <option value="no">Non-Drinker</option>
                                        <option value="occasionally">Socially / Occasionally</option>
                                        <option value="regularly">Regularly</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Section 4: Education & Career -->
                    @if($activeSection === 'career')
                        <div class="space-y-5">
                            <h3 class="text-base font-bold text-slate-900 pb-3 border-b border-slate-100 flex items-center gap-2">
                                <i class="fa-solid fa-graduation-cap text-emerald-500"></i> Education & Career Background
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Highest Education Level</label>
                                    <select wire:model="education_level_id" class="select select-bordered select-sm w-full rounded-xl">
                                        <option value="">Select Level</option>
                                        @foreach($eduLevels as $el)
                                            <option value="{{ $el->id }}">{{ $el->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Field of Study</label>
                                    <select wire:model="education_field_id" class="select select-bordered select-sm w-full rounded-xl">
                                        <option value="">Select Field</option>
                                        @foreach($eduFields as $ef)
                                            <option value="{{ $ef->id }}">{{ $ef->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">College / University Name</label>
                                    <input type="text" wire:model="college_name" class="input input-bordered input-sm w-full rounded-xl">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Occupation Title</label>
                                    <select wire:model="occupation_id" class="select select-bordered select-sm w-full rounded-xl">
                                        <option value="">Select Occupation</option>
                                        @foreach($occupations as $occ)
                                            <option value="{{ $occ->id }}">{{ $occ->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Employment Sector</label>
                                    <select wire:model="employment_sector" class="select select-bordered select-sm w-full rounded-xl">
                                        <option value="private">Private Sector</option>
                                        <option value="government">Government Sector</option>
                                        <option value="business">Business / Entrepreneur</option>
                                        <option value="self_employed">Self Employed</option>
                                        <option value="ngo_ingo">NGO / INGO</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Annual Income Range</label>
                                    <input type="text" wire:model="annual_income_range" class="input input-bordered input-sm w-full rounded-xl" placeholder="e.g. NPR 10 Lakh - 15 Lakh">
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Section 5: Family Details -->
                    @if($activeSection === 'family')
                        <div class="space-y-5">
                            <h3 class="text-base font-bold text-slate-900 pb-3 border-b border-slate-100 flex items-center gap-2">
                                <i class="fa-solid fa-people-roof text-amber-500"></i> Family Background & Lineage
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Father's Profession</label>
                                    <input type="text" wire:model="father_profession" class="input input-bordered input-sm w-full rounded-xl">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Mother's Profession</label>
                                    <input type="text" wire:model="mother_profession" class="input input-bordered input-sm w-full rounded-xl">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Brothers Count</label>
                                    <input type="number" wire:model="brothers_count" class="input input-bordered input-sm w-full rounded-xl">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Sisters Count</label>
                                    <input type="number" wire:model="sisters_count" class="input input-bordered input-sm w-full rounded-xl">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Family Type</label>
                                    <select wire:model="family_type" class="select select-bordered select-sm w-full rounded-xl">
                                        <option value="nuclear">Nuclear Family</option>
                                        <option value="joint">Joint Family</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Family Values</label>
                                    <select wire:model="family_values" class="select select-bordered select-sm w-full rounded-xl">
                                        <option value="traditional">Traditional</option>
                                        <option value="moderate">Moderate</option>
                                        <option value="liberal">Liberal</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Section 6: Partner Preferences -->
                    @if($activeSection === 'preferences')
                        <div class="space-y-5">
                            <h3 class="text-base font-bold text-slate-900 pb-3 border-b border-slate-100 flex items-center gap-2">
                                <i class="fa-solid fa-sliders text-rose-500"></i> Partner Preferences (For Mutual Matching)
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Minimum Partner Age</label>
                                    <input type="number" wire:model="pref_min_age" class="input input-bordered input-sm w-full rounded-xl">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Maximum Partner Age</label>
                                    <input type="number" wire:model="pref_max_age" class="input input-bordered input-sm w-full rounded-xl">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Preferred Diet</label>
                                    <select wire:model="pref_diet" class="select select-bordered select-sm w-full rounded-xl">
                                        <option value="any">Any Diet</option>
                                        <option value="vegetarian">Vegetarian Only</option>
                                        <option value="non_vegetarian">Non-Vegetarian</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Manglik Requirement</label>
                                    <select wire:model="pref_manglik" class="select select-bordered select-sm w-full rounded-xl">
                                        <option value="any">Does Not Matter</option>
                                        <option value="no">Must be Non-Manglik</option>
                                        <option value="yes">Must be Manglik</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="pt-4 border-t border-slate-100 flex justify-end">
                        <button type="submit" class="btn btn-primary rounded-xl text-xs font-bold bg-rose-600 border-none text-white hover:bg-rose-700 shadow-md">
                            <i class="fa-solid fa-floppy-disk"></i> Save Changes
                        </button>
                    </div>

                </form>
            </div>

        </div>

    </div>
</div>
