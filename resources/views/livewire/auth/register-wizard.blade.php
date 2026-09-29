<div class="py-12 bg-slate-50 min-h-[80vh]">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if($currentStep <= 5)
        <!-- Wizard Progress Bar Header -->
        <div class="bg-white rounded-3xl p-6 md:p-8 shadow-xs border border-slate-200/80 mb-6">
            <div class="text-center mb-6">
                <span class="text-xs font-bold uppercase tracking-widest text-rose-600 block">Join MeroZodi Free</span>
                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 mt-1">Create Your Matrimonial Profile</h1>
                <p class="text-xs text-slate-500 mt-1">Step {{ $currentStep }} of {{ $totalSteps }}: 
                    @if($currentStep === 1) Basic Account & Living Details
                    @elseif($currentStep === 2) Cultural, Caste & Horoscope
                    @elseif($currentStep === 3) Physical Attributes & Lifestyle
                    @elseif($currentStep === 4) Education & Career Background
                    @elseif($currentStep === 5) Family Lineage & Bio
                    @endif
                </p>
            </div>

            <!-- Steps indicators -->
            <ul class="steps steps-horizontal w-full text-xs font-semibold">
                <li class="step {{ $currentStep >= 1 ? 'step-primary text-rose-600' : 'text-slate-400' }}">Account</li>
                <li class="step {{ $currentStep >= 2 ? 'step-primary text-rose-600' : 'text-slate-400' }}">Cultural</li>
                <li class="step {{ $currentStep >= 3 ? 'step-primary text-rose-600' : 'text-slate-400' }}">Lifestyle</li>
                <li class="step {{ $currentStep >= 4 ? 'step-primary text-rose-600' : 'text-slate-400' }}">Career</li>
                <li class="step {{ $currentStep >= 5 ? 'step-primary text-rose-600' : 'text-slate-400' }}">Family</li>
            </ul>
        </div>

        <!-- Form Card Body -->
        <div class="bg-white rounded-3xl p-6 md:p-10 shadow-lg border border-slate-200/80">
            
            <!-- STEP 1: Basic Account Details -->
            @if($currentStep === 1)
                <div class="space-y-5">
                    <h3 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                        <i class="fa-solid fa-user text-rose-500"></i> Step 1: Personal & Account Credentials
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Profile Created By <span class="text-rose-500">*</span></label>
                            <select wire:model="profile_created_by" class="select select-bordered w-full">
                                <option value="self">Self</option>
                                <option value="parents">Parents</option>
                                <option value="sibling">Sibling</option>
                                <option value="relative">Relative</option>
                                <option value="friend">Friend</option>
                            </select>
                            @error('profile_created_by') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Full Name (as per Citizenship/Passport) <span class="text-rose-500">*</span></label>
                            <input type="text" wire:model="name" class="input input-bordered w-full" placeholder="e.g. Aayush Sharma">
                            @error('name') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Gender</label>
                            <select wire:model="gender" class="select select-bordered w-full">
                                <option value="male">Male (Seeking Bride)</option>
                                <option value="female">Female (Seeking Groom)</option>
                            </select>
                            @error('gender') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Marital Status</label>
                            <select wire:model="marital_status" class="select select-bordered w-full">
                                <option value="unmarried">Unmarried</option>
                                <option value="widow">Widow</option>
                                <option value="divorced">Divorced</option>
                                <option value="separated">Separated</option>
                            </select>
                            @error('marital_status') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Date of Birth</label>
                            <input type="date" wire:model="dob" class="input input-bordered w-full">
                            @error('dob') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Email Address</label>
                            <input type="email" wire:model="email" class="input input-bordered w-full" placeholder="you@example.com">
                            @error('email') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Mobile / WhatsApp Number</label>
                            <input type="text" wire:model="phone" class="input input-bordered w-full" placeholder="+977-98XXXXXXXX">
                            @error('phone') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Living Country</label>
                            <input type="text" wire:model="living_country" class="input input-bordered w-full" placeholder="e.g. Nepal, Australia, USA">
                            @error('living_country') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Living City</label>
                            <input type="text" wire:model="living_city" class="input input-bordered w-full" placeholder="e.g. Kathmandu, Sydney, Dallas">
                            @error('living_city') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Password</label>
                            <input type="password" wire:model="password" class="input input-bordered w-full" placeholder="••••••••">
                            @error('password') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Confirm Password</label>
                            <input type="password" wire:model="password_confirmation" class="input input-bordered w-full" placeholder="••••••••">
                        </div>
                    </div>
                </div>
            @endif

            <!-- STEP 2: Cultural, Caste & Horoscope Details -->
            @if($currentStep === 2)
                <div class="space-y-5">
                    <h3 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                        <i class="fa-solid fa-moon text-indigo-500"></i> Step 2: Cultural & Astrological Background
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Religion</label>
                            <select wire:model.live="religion_id" class="select select-bordered w-full">
                                <option value="">Select Religion</option>
                                @foreach($religions as $r)
                                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                                @endforeach
                            </select>
                            @error('religion_id') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Caste / Community</label>
                            <select wire:model="caste_id" class="select select-bordered w-full">
                                <option value="">Select Caste</option>
                                @foreach($castes as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                            @error('caste_id') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Sub-Caste / Surname</label>
                            <input type="text" wire:model="sub_caste" class="input input-bordered w-full" placeholder="e.g. Pokharel, Shrestha, Ghale">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Mother Tongue</label>
                            <input type="text" wire:model="mother_tongue" class="input input-bordered w-full" placeholder="e.g. Nepali, Newari, Maithili">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Rashi (Zodiac)</label>
                            <select wire:model="rashi" class="select select-bordered w-full">
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
                            <input type="text" wire:model="gotra" class="input input-bordered w-full" placeholder="e.g. Kashyap, Gautam">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Manglik Status</label>
                            <select wire:model="manglik" class="select select-bordered w-full">
                                <option value="no">Non-Manglik</option>
                                <option value="yes">Manglik</option>
                                <option value="dont_know">Don't Know</option>
                            </select>
                        </div>
                    </div>
                </div>
            @endif

            <!-- STEP 3: Physical & Lifestyle -->
            @if($currentStep === 3)
                <div class="space-y-5">
                    <h3 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                        <i class="fa-solid fa-heart-pulse text-rose-500"></i> Step 3: Physical Lifestyle & Habits
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Height (cm)</label>
                            <input type="number" wire:model="height_cm" class="input input-bordered w-full" placeholder="e.g. 175">
                            <span class="text-[10px] text-slate-400">Approx: {{ floor($height_cm / 30.48) }}' {{ round(($height_cm % 30.48) / 2.54) }}"</span>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Weight (kg)</label>
                            <input type="number" wire:model="weight_kg" class="input input-bordered w-full" placeholder="e.g. 68">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Blood Group</label>
                            <select wire:model="blood_group" class="select select-bordered w-full">
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
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Diet Type</label>
                            <select wire:model="diet" class="select select-bordered w-full">
                                <option value="non_vegetarian">Non-Vegetarian</option>
                                <option value="vegetarian">Vegetarian</option>
                                <option value="eggetarian">Eggetarian</option>
                                <option value="vegan">Vegan</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Smoking Habit</label>
                            <select wire:model="smoke_habit" class="select select-bordered w-full">
                                <option value="no">Never</option>
                                <option value="occasionally">Occasionally</option>
                                <option value="regularly">Regularly</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Drinking Habit</label>
                            <select wire:model="drink_habit" class="select select-bordered w-full">
                                <option value="no">Never</option>
                                <option value="occasionally">Socially / Occasionally</option>
                                <option value="regularly">Regularly</option>
                            </select>
                        </div>
                    </div>
                </div>
            @endif

            <!-- STEP 4: Education & Career -->
            @if($currentStep === 4)
                <div class="space-y-5">
                    <h3 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                        <i class="fa-solid fa-graduation-cap text-indigo-500"></i> Step 4: Education & Profession
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Highest Education Level</label>
                            <select wire:model="education_level_id" class="select select-bordered w-full">
                                <option value="">Select Level</option>
                                @foreach($eduLevels as $el)
                                    <option value="{{ $el->id }}">{{ $el->name }}</option>
                                @endforeach
                            </select>
                            @error('education_level_id') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Field / Faculty</label>
                            <select wire:model="education_field_id" class="select select-bordered w-full">
                                <option value="">Select Faculty</option>
                                @foreach($eduFields as $ef)
                                    <option value="{{ $ef->id }}">{{ $ef->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Occupation / Profession</label>
                            <select wire:model="occupation_id" class="select select-bordered w-full">
                                <option value="">Select Occupation</option>
                                @foreach($occupations as $occ)
                                    <option value="{{ $occ->id }}">{{ $occ->name }}</option>
                                @endforeach
                            </select>
                            @error('occupation_id') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Job Designation</label>
                            <input type="text" wire:model="designation" class="input input-bordered w-full" placeholder="e.g. Senior Software Engineer, Resident Doctor">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Annual Income Range</label>
                        <select wire:model="annual_income_range" class="select select-bordered w-full">
                            <option value="Under 5 Lakh NPR">Under 5 Lakh NPR</option>
                            <option value="5 Lakh - 10 Lakh NPR">5 Lakh - 10 Lakh NPR</option>
                            <option value="10 Lakh - 20 Lakh NPR">10 Lakh - 20 Lakh NPR</option>
                            <option value="20 Lakh - 35 Lakh NPR">20 Lakh - 35 Lakh NPR</option>
                            <option value="35 Lakh+ NPR">35 Lakh+ NPR</option>
                            <option value="50,000 - 100,000 USD / AUD / CAD">50,000 - 100,000 USD / AUD / CAD (Abroad)</option>
                            <option value="100,000+ USD / AUD / CAD">100,000+ USD / AUD / CAD (Abroad)</option>
                        </select>
                    </div>
                </div>
            @endif

            <!-- STEP 5: Family Details & Bio -->
            @if($currentStep === 5)
                <div class="space-y-5">
                    <h3 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                        <i class="fa-solid fa-people-roof text-pink-500"></i> Step 5: Family Background & Bio
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Father's Profession</label>
                            <input type="text" wire:model="father_profession" class="input input-bordered w-full" placeholder="e.g. Retired Civil Servant, Business Owner">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Mother's Profession</label>
                            <input type="text" wire:model="mother_profession" class="input input-bordered w-full" placeholder="e.g. Teacher, Homemaker">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Family Type</label>
                            <select wire:model="family_type" class="select select-bordered w-full">
                                <option value="nuclear">Nuclear Family</option>
                                <option value="joint">Joint Family</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Family Values</label>
                            <select wire:model="family_values" class="select select-bordered w-full">
                                <option value="moderate">Moderate</option>
                                <option value="traditional">Traditional</option>
                                <option value="liberal">Liberal</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Brothers & Sisters</label>
                            <div class="flex gap-2">
                                <input type="number" wire:model="brothers_count" class="input input-bordered w-1/2" placeholder="Brothers">
                                <input type="number" wire:model="sisters_count" class="input input-bordered w-1/2" placeholder="Sisters">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">About Myself & Partner Expectations</label>
                        <textarea wire:model="about_me" rows="4" class="textarea textarea-bordered w-full" placeholder="Describe your personality, hobbies, family background, and what you seek in a life partner..."></textarea>
                    </div>
                </div>
            @endif

            <!-- Wizard Navigation Buttons -->
            <div class="mt-8 pt-6 border-t border-slate-100 flex justify-between items-center">
                @if($currentStep > 1)
                    <button type="button" wire:click="previousStep" class="btn btn-ghost text-slate-600 font-bold text-xs flex items-center gap-1.5">
                        <i class="fa-solid fa-arrow-left"></i> Previous Step
                    </button>
                @else
                    <div></div>
                @endif

                @if($currentStep < $totalSteps)
                    <button type="button" wire:click="nextStep" class="btn bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs px-6 rounded-xl flex items-center gap-1.5 shadow-md">
                        Next Step <i class="fa-solid fa-arrow-right"></i>
                    </button>
                @else
                    <button type="button" wire:click="register" class="btn bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 text-white font-bold text-sm px-8 rounded-xl flex items-center gap-2 shadow-lg shadow-rose-200">
                        <i class="fa-solid fa-heart"></i> Complete Registration
                    </button>
                @endif
            </div>

        @else
            <!-- STEP 6: Post-Registration Confirmation & Onboarding Hub -->
            <div class="space-y-6" x-data="{ copied: false }">
                
                <!-- Top Celebration Header Banner -->
                <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-rose-900 via-rose-800 to-amber-900 text-white p-8 sm:p-12 shadow-xl shadow-rose-950/20">
                    <div class="relative z-10 max-w-2xl space-y-3">
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-500/20 backdrop-blur-md border border-emerald-400/30 text-xs font-black uppercase tracking-wider text-emerald-200">
                            <i class="fa-solid fa-circle-check text-emerald-400"></i> Registration Confirmed
                        </span>
                        <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight text-white">
                            Congrats! {{ $registeredUser->name ?? $name }}
                        </h1>
                        <p class="text-sm sm:text-base text-rose-100/90 leading-relaxed font-normal">
                            You have successfully registered with <strong>MeroZodi Matrimonial</strong>. Welcome to Nepal's most trusted matrimonial & matchmaking network!
                        </p>
                    </div>
                    <div class="absolute -right-10 -bottom-10 opacity-10 text-white pointer-events-none text-9xl">
                        <i class="fa-solid fa-heart-circle-check"></i>
                    </div>
                </div>

                <!-- Admin Verification Pending Notice Banner -->
                <div class="bg-amber-50 border border-amber-200/90 rounded-3xl p-6 sm:p-7 shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center text-xl shrink-0 shadow-2xs">
                            <i class="fa-solid fa-user-shield"></i>
                        </div>
                        <div>
                            <span class="inline-flex items-center gap-1 text-[10px] font-black uppercase tracking-wider text-amber-800 bg-amber-200/60 px-2.5 py-0.5 rounded-full mb-1">
                                <i class="fa-solid fa-clock"></i> Verification Pending
                            </span>
                            <h3 class="text-base sm:text-lg font-black text-amber-950">Profile Pending Admin Review & Verification</h3>
                            <p class="text-xs sm:text-sm text-amber-800/90 mt-1 leading-relaxed">
                                To protect our matrimonial community and maintain 100% genuine singles, your profile will be reviewed by our moderation team before appearing in public search results. You can access your Dashboard immediately and submit KYC documents for priority verification!
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Official Login Details & Matrimony ID Box (Amber/Gold Card) -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80">
                    <h3 class="text-xs font-black uppercase tracking-wider text-slate-400 mb-3 flex items-center gap-2">
                        <i class="fa-solid fa-id-badge text-rose-500"></i> Your Login Details on MeroZodi
                    </h3>
                    
                    <div class="bg-amber-50/80 border-2 border-amber-200 rounded-2xl p-5 sm:p-6 mb-4">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div>
                                <span class="text-[11px] font-black uppercase tracking-wider text-amber-800">Your Official Matrimony ID</span>
                                <div class="text-2xl sm:text-3xl font-black text-amber-950 font-mono tracking-wider flex items-center gap-3 mt-1">
                                    <span>{{ $registeredUser?->matrimony_id ?? ('MZ' . str_pad((string)($registeredUserId ?? 1), 6, '0', STR_PAD_LEFT)) }}</span>
                                    <button @click="navigator.clipboard.writeText('{{ $registeredUser?->matrimony_id ?? ('MZ' . str_pad((string)($registeredUserId ?? 1), 6, '0', STR_PAD_LEFT)) }}'); copied = true; setTimeout(() => copied = false, 2500)" class="btn btn-xs bg-amber-200 hover:bg-amber-300 text-amber-900 border-none rounded-lg px-2.5 font-bold transition">
                                        <span x-show="!copied"><i class="fa-regular fa-copy mr-1"></i> Copy ID</span>
                                        <span x-show="copied" class="text-emerald-700 font-bold" style="display:none;"><i class="fa-solid fa-check mr-1"></i> Copied!</span>
                                    </button>
                                </div>
                            </div>
                            <div class="text-xs text-amber-900/80 bg-white/80 backdrop-blur-sm px-3.5 py-2 rounded-xl border border-amber-200">
                                <span class="block font-bold text-amber-950">Registered Email:</span>
                                <span class="font-mono text-slate-700">{{ $registeredUser->email ?? $email }}</span>
                            </div>
                        </div>

                        <p class="text-xs text-amber-950/80 mt-3 pt-3 border-t border-amber-200/60 leading-relaxed">
                            Henceforth please use the above <strong>Matrimony ID ({{ $registeredUser?->matrimony_id ?? ('MZ' . str_pad((string)($registeredUserId ?? 1), 6, '0', STR_PAD_LEFT)) }})</strong> or your registered email to login to your profile at MeroZodi.com. A confirmation mail has been sent to <strong>{{ $registeredUser->email ?? $email }}</strong> on how to use the site efficiently in finding your match.
                        </p>
                    </div>

                    <div class="flex items-center gap-2 pt-1 text-xs text-slate-700">
                        <input type="checkbox" wire:model="keepLoggedIn" id="keep_logged_in" class="checkbox checkbox-xs checkbox-primary" checked>
                        <label for="keep_logged_in" class="cursor-pointer font-bold">
                            Keep me logged in <span class="text-rose-600 font-normal">(Recommended)</span> — Stay logged in always at MeroZodi
                        </label>
                    </div>
                </div>

                <!-- What's Next? Mobile Number Verification Card -->
                <div class="bg-gradient-to-br from-amber-50/40 via-white to-orange-50/30 rounded-3xl p-6 sm:p-8 shadow-sm border border-amber-200/80 relative overflow-hidden">
                    <div class="flex flex-col md:flex-row items-start gap-6">
                        <!-- Phone Clipart / Illustration -->
                        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-gradient-to-br from-rose-500 to-amber-600 text-white flex items-center justify-center text-3xl sm:text-4xl shadow-md shrink-0">
                            <i class="fa-solid fa-mobile-screen-button"></i>
                        </div>

                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="inline-flex items-center gap-1 text-[10px] font-black uppercase tracking-wider text-rose-600 bg-rose-50 px-2 py-0.5 rounded-md">High Credibility Boost</span>
                                @if($phoneVerified)
                                    <span class="inline-flex items-center gap-1 text-[10px] font-black text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded-md">
                                        <i class="fa-solid fa-circle-check"></i> Verified
                                    </span>
                                @endif
                            </div>

                            <h2 class="text-xl font-black text-slate-900 tracking-tight">
                                What's Next? Verify your Mobile Number
                            </h2>
                            <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                                This is the best way to enhance credibility and authenticity of your profile to prospective life partners and their families.
                            </p>

                            @if($phoneVerified)
                                <div class="mt-4 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 flex items-center gap-3">
                                    <i class="fa-solid fa-circle-check text-emerald-600 text-2xl"></i>
                                    <div>
                                        <h4 class="font-extrabold text-sm text-emerald-950">Mobile Number Verified!</h4>
                                        <p class="text-xs text-emerald-700">Your phone number <strong>{{ $registeredUser->phone ?? $phone }}</strong> is now authenticated. Your verified trust badge has been activated.</p>
                                    </div>
                                </div>
                            @else
                                <div class="mt-4 bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-2xs">
                                    <p class="text-xs text-slate-700">
                                        Enter the verification PIN number that has been sent via SMS to <strong class="text-slate-900">{{ $registeredUser->phone ?? $phone }}</strong>
                                    </p>

                                    <div class="flex flex-wrap items-center gap-3 mt-3">
                                        <div class="relative">
                                            <input type="text" wire:model="pinCode" placeholder="Enter PIN (e.g. 1234)" class="input input-bordered input-sm sm:input-md rounded-xl text-xs sm:text-sm font-bold tracking-widest text-center w-48 focus:border-rose-500">
                                        </div>
                                        <button wire:click="verifyPhonePin" class="btn btn-sm sm:btn-md bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl px-5 text-xs sm:text-sm shadow-sm transition">
                                            <i class="fa-solid fa-check"></i> Verify
                                        </button>
                                    </div>
                                    @error('pinCode') <span class="text-rose-600 text-xs mt-1.5 block font-semibold">{{ $message }}</span> @enderror

                                    @if(session('pin_success'))
                                        <div class="mt-3 p-2.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center gap-2">
                                            <i class="fa-solid fa-circle-check text-emerald-600"></i> {{ session('pin_success') }}
                                        </div>
                                    @endif

                                    @if(session('pin_info'))
                                        <div class="mt-3 p-2.5 rounded-xl bg-blue-50 border border-blue-200 text-blue-800 text-xs font-semibold flex items-center gap-2">
                                            <i class="fa-solid fa-info-circle text-blue-600"></i> {{ session('pin_info') }}
                                        </div>
                                    @endif

                                    <p class="text-xs text-slate-500 mt-3">
                                        You will receive an SMS in <strong>10 to 15 seconds</strong>. Yet to receive SMS? 
                                        <button wire:click="resendPin" class="text-rose-600 font-bold hover:underline ml-1">
                                            Click here to resend PIN number
                                        </button>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Profile Booster Checklist & Actions -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80">
                    <h3 class="text-xs font-black uppercase tracking-wider text-slate-400 mb-4">
                        Recommended Next Steps to Maximize Proposals
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                        <!-- 1. Photo Gallery -->
                        <div class="p-4 rounded-2xl bg-rose-50/50 border border-rose-100 flex flex-col justify-between">
                            <div>
                                <div class="w-9 h-9 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center text-sm mb-2.5">
                                    <i class="fa-solid fa-images"></i>
                                </div>
                                <h4 class="text-xs font-black text-slate-900">Add 3+ Profile Photos</h4>
                                <p class="text-[11px] text-slate-500 mt-1">Profiles with photos receive 10x more responses.</p>
                            </div>
                            <a href="{{ route('my-gallery') }}" class="btn btn-xs bg-rose-600 hover:bg-rose-700 text-white rounded-lg mt-3 font-bold">
                                Upload Photos &rarr;
                            </a>
                        </div>

                        <!-- 2. KYC Document Verification -->
                        <div class="p-4 rounded-2xl bg-indigo-50/50 border border-indigo-100 flex flex-col justify-between">
                            <div>
                                <div class="w-9 h-9 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-sm mb-2.5">
                                    <i class="fa-solid fa-id-card"></i>
                                </div>
                                <h4 class="text-xs font-black text-slate-900">100% ID KYC Verification</h4>
                                <p class="text-[11px] text-slate-500 mt-1">Get the official Verified Trust Shield on your profile.</p>
                            </div>
                            <a href="{{ route('my-kyc') }}" class="btn btn-xs bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg mt-3 font-bold">
                                Verify ID &rarr;
                            </a>
                        </div>

                        <!-- 3. Vedic Kundali Matching -->
                        <div class="p-4 rounded-2xl bg-amber-50/50 border border-amber-100 flex flex-col justify-between">
                            <div>
                                <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-sm mb-2.5">
                                    <i class="fa-solid fa-moon"></i>
                                </div>
                                <h4 class="text-xs font-black text-slate-900">Vedic 36 Gun Milan</h4>
                                <p class="text-[11px] text-slate-500 mt-1">Instantly see horoscope compatibility score with matches.</p>
                            </div>
                            <a href="{{ route('my-profile') }}" class="btn btn-xs bg-amber-600 hover:bg-amber-700 text-white rounded-lg mt-3 font-bold">
                                Check Kundali &rarr;
                            </a>
                        </div>
                    </div>

                    <!-- Primary Navigation Actions -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-slate-100">
                        <a href="{{ route('dashboard') }}" class="btn btn-ghost text-xs font-bold text-slate-600 hover:text-slate-900 order-2 sm:order-1">
                            <i class="fa-solid fa-gauge mr-1 text-slate-400"></i> Go to My Dashboard
                        </a>
                        <a href="{{ route('browse') }}" class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 text-white font-black text-xs sm:text-sm rounded-2xl shadow-lg shadow-rose-200 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2 order-1 sm:order-2">
                            <span>Explore Compatible Matches</span>
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>

            </div>
        @endif
    </div>
</div>
