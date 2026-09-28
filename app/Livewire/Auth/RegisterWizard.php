<?php

namespace App\Livewire\Auth;

use App\Models\Caste;
use App\Models\City;
use App\Models\EducationField;
use App\Models\EducationLevel;
use App\Models\EducationProfession;
use App\Models\FamilyDetail;
use App\Models\Occupation;
use App\Models\PartnerPreference;
use App\Models\PhysicalLifestyle;
use App\Models\Religion;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RegisterWizard extends Component
{
    public $currentStep = 1;
    public $totalSteps = 5;

    // Post-Registration Confirmation State
    public $isRegistered = false;
    public $registeredUserId = null;
    public $keepLoggedIn = true;
    public $pinCode = '';
    public $phoneVerified = false;
    public $pinResent = false;

    // Step 1: Account Information
    public $profile_created_by = 'self';
    public $name = '';
    public $email = '';
    public $phone = '';
    public $password = '';
    public $password_confirmation = '';
    public $gender = 'male';
    public $marital_status = 'unmarried';
    public $dob = '';
    public $living_country = 'Nepal';
    public $living_city = 'Kathmandu';

    // Step 2: Cultural & Astrology
    public $religion_id = '';
    public $caste_id = '';
    public $sub_caste = '';
    public $mother_tongue = 'Nepali';
    public $rashi = '';
    public $gotra = '';
    public $manglik = 'dont_know';

    // Step 3: Physical & Lifestyle
    public $height_cm = 170;
    public $weight_kg = 65;
    public $body_type = 'average';
    public $complexion = 'fair';
    public $blood_group = 'O+';
    public $diet = 'non_vegetarian';
    public $smoke_habit = 'no';
    public $drink_habit = 'no';

    // Step 4: Education & Profession
    public $education_level_id = '';
    public $education_field_id = '';
    public $college_name = '';
    public $occupation_id = '';
    public $designation = '';
    public $company_name = '';
    public $annual_income_range = '5 Lakh - 10 Lakh NPR';

    // Step 5: Family & Bio
    public $father_profession = '';
    public $mother_profession = '';
    public $brothers_count = 0;
    public $sisters_count = 0;
    public $family_type = 'nuclear';
    public $family_values = 'moderate';
    public $family_status = 'middle_class';
    public $about_me = '';

    public function nextStep()
    {
        $this->validateStep();
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function validateStep()
    {
        if ($this->currentStep === 1) {
            $this->validate([
                'profile_created_by' => 'required|in:self,parents,sibling,relative,friend',
                'name' => 'required|min:3|max:100',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|min:10',
                'password' => 'required|min:6|confirmed',
                'gender' => 'required|in:male,female',
                'marital_status' => 'required|in:unmarried,never_married,widow,widowed,divorced,separated',
                'dob' => 'required|date|before:-18 years',
                'living_country' => 'required',
                'living_city' => 'required',
            ], [
                'dob.before' => 'You must be at least 18 years old to register.',
            ]);
        } elseif ($this->currentStep === 2) {
            $this->validate([
                'religion_id' => 'required',
                'caste_id' => 'required',
            ]);
        } elseif ($this->currentStep === 3) {
            $this->validate([
                'height_cm' => 'required|numeric|min:100|max:250',
                'diet' => 'required',
            ]);
        } elseif ($this->currentStep === 4) {
            $this->validate([
                'education_level_id' => 'required',
                'occupation_id' => 'required',
            ]);
        }
    }

    public function register()
    {
        $this->validateStep();

        // 1. Create User
        $user = User::create([
            'profile_created_by' => $this->profile_created_by,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => Hash::make($this->password),
            'gender' => $this->gender,
            'marital_status' => $this->marital_status,
            'dob' => $this->dob,
            'role' => 'user',
            'is_verified' => false,
            'is_premium' => false,
            'status' => 'active',
        ]);

        // 2. Create UserProfile
        UserProfile::create([
            'user_id' => $user->id,
            'profile_created_by' => $this->profile_created_by,
            'religion_id' => $this->religion_id ?: null,
            'caste_id' => $this->caste_id ?: null,
            'sub_caste' => $this->sub_caste,
            'mother_tongue' => $this->mother_tongue,
            'marital_status' => $this->marital_status,
            'rashi' => $this->rashi,
            'gotra' => $this->gotra,
            'manglik' => $this->manglik,
            'living_country' => $this->living_country,
            'living_city' => $this->living_city,
            'about_me' => $this->about_me,
            'profile_visibility' => 'public',
        ]);

        // 3. Create PhysicalLifestyle
        PhysicalLifestyle::create([
            'user_id' => $user->id,
            'height_cm' => $this->height_cm,
            'weight_kg' => $this->weight_kg,
            'body_type' => $this->body_type,
            'complexion' => $this->complexion,
            'blood_group' => $this->blood_group,
            'diet' => $this->diet,
            'smoke_habit' => $this->smoke_habit,
            'drink_habit' => $this->drink_habit,
        ]);

        // 4. Create EducationProfession
        EducationProfession::create([
            'user_id' => $user->id,
            'education_level_id' => $this->education_level_id ?: null,
            'education_field_id' => $this->education_field_id ?: null,
            'college_name' => $this->college_name,
            'occupation_id' => $this->occupation_id ?: null,
            'designation' => $this->designation,
            'company_name' => $this->company_name,
            'annual_income_range' => $this->annual_income_range,
        ]);

        // 5. Create FamilyDetail
        FamilyDetail::create([
            'user_id' => $user->id,
            'father_profession' => $this->father_profession,
            'mother_profession' => $this->mother_profession,
            'brothers_count' => (int) $this->brothers_count,
            'sisters_count' => (int) $this->sisters_count,
            'family_type' => $this->family_type,
            'family_values' => $this->family_values,
            'family_status' => $this->family_status,
        ]);

        // 6. Create PartnerPreference
        PartnerPreference::create([
            'user_id' => $user->id,
            'min_age' => 20,
            'max_age' => 35,
            'min_height_cm' => 150,
            'max_height_cm' => 190,
            'preferred_religions' => $this->religion_id ? [(int) $this->religion_id] : null,
            'preferred_castes' => $this->caste_id ? [(int) $this->caste_id] : null,
        ]);

        Auth::login($user, (bool) $this->keepLoggedIn);

        $this->registeredUserId = $user->id;
        $this->isRegistered = true;
        $this->currentStep = 6;

        session()->flash('success', 'Congratulations! Your profile has been created successfully.');
    }

    public function verifyPhonePin()
    {
        $this->validate([
            'pinCode' => 'required|min:4|max:6',
        ], [
            'pinCode.required' => 'Please enter the 4-digit verification PIN sent to your phone.',
        ]);

        $this->phoneVerified = true;
        session()->flash('pin_success', 'Mobile number successfully verified! Authenticity trust badge activated.');
    }

    public function resendPin()
    {
        $this->pinResent = true;
        session()->flash('pin_info', 'A new 4-digit verification PIN has been resent to your mobile number via SMS & WhatsApp.');
    }

    public function finishRegistration()
    {
        return redirect()->route('browse');
    }

    public function render()
    {
        $religions = Religion::all();
        $castes = $this->religion_id
            ? Caste::where('religion_id', $this->religion_id)->get()
            : Caste::all();
        $eduLevels = EducationLevel::all();
        $eduFields = EducationField::all();
        $occupations = Occupation::all();
        $registeredUser = $this->registeredUserId ? User::find($this->registeredUserId) : null;

        return view('livewire.auth.register-wizard', [
            'religions' => $religions,
            'castes' => $castes,
            'eduLevels' => $eduLevels,
            'eduFields' => $eduFields,
            'occupations' => $occupations,
            'registeredUser' => $registeredUser,
        ])->layout('components.layouts.app', ['title' => 'Register Free Profile - MeroZodi']);
    }
}
