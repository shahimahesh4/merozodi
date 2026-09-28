<?php

namespace App\Livewire;

use App\Models\Caste;
use App\Models\City;
use App\Models\EducationField;
use App\Models\EducationLevel;
use App\Models\Occupation;
use App\Models\Religion;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class MyProfile extends Component
{
    use WithFileUploads;

    public $activeSection = 'basic'; // 'basic', 'cultural', 'lifestyle', 'career', 'family', 'preferences'

    // Basic & Profile
    public $profile_created_by = 'self';
    public $name;
    public $phone;
    public $dob;
    public $about_me;
    public $about_partner;
    public $living_country;
    public $living_city;
    public $citizenship_country;
    public $residency_status;

    // Cultural & Horoscope
    public $religion_id;
    public $caste_id;
    public $sub_caste;
    public $mother_tongue;
    public $marital_status;
    public $rashi;
    public $gotra;
    public $manglik;
    public $nadi;
    public $gana;
    public $birth_time;
    public $birth_place;
    public $is_photo_blurred = false;

    // Physical & Lifestyle
    public $height_cm;
    public $weight_kg;
    public $body_type;
    public $complexion;
    public $blood_group;
    public $diet;
    public $smoke_habit;
    public $drink_habit;

    // Education & Career
    public $education_level_id;
    public $education_field_id;
    public $college_name;
    public $occupation_id;
    public $designation;
    public $company_name;
    public $employment_sector;
    public $annual_income_range;

    // Family
    public $father_name;
    public $father_profession;
    public $mother_name;
    public $mother_profession;
    public $brothers_count = 0;
    public $married_brothers_count = 0;
    public $sisters_count = 0;
    public $married_sisters_count = 0;
    public $family_type = 'nuclear';
    public $family_values = 'moderate';
    public $family_status = 'middle_class';
    public $family_location;

    // Partner Preferences
    public $pref_min_age = 18;
    public $pref_max_age = 40;
    public $pref_diet = 'any';
    public $pref_manglik = 'any';

    public function mount()
    {
        $user = Auth::user()->load(['profile', 'physical', 'education', 'family', 'preferences']);

        // Basic
        $this->profile_created_by = $user->profile_created_by ?? $user->profile?->profile_created_by ?? 'self';
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->dob = $user->dob ? $user->dob->format('Y-m-d') : null;
        $this->about_me = $user->profile?->about_me;
        $this->about_partner = $user->profile?->about_partner;
        $this->living_country = $user->profile?->living_country ?? 'Nepal';
        $this->living_city = $user->profile?->living_city ?? 'Kathmandu';
        $this->citizenship_country = $user->profile?->citizenship_country ?? 'Nepal';
        $this->residency_status = $user->profile?->residency_status ?? 'citizen';

        // Cultural
        $this->religion_id = $user->profile?->religion_id;
        $this->caste_id = $user->profile?->caste_id;
        $this->sub_caste = $user->profile?->sub_caste;
        $this->mother_tongue = $user->profile?->mother_tongue ?? 'Nepali';
        $this->marital_status = $user->profile?->marital_status ?? 'never_married';
        $this->rashi = $user->profile?->rashi;
        $this->gotra = $user->profile?->gotra;
        $this->manglik = $user->profile?->manglik ?? 'dont_know';
        $this->nadi = $user->profile?->nadi ?? 'Adi';
        $this->gana = $user->profile?->gana ?? 'Deva';
        $this->birth_time = $user->profile?->birth_time;
        $this->birth_place = $user->profile?->birth_place;
        $this->is_photo_blurred = (bool) ($user->profile?->is_photo_blurred ?? false);

        // Physical
        $this->height_cm = $user->physical?->height_cm ?? 170;
        $this->weight_kg = $user->physical?->weight_kg ?? 65;
        $this->body_type = $user->physical?->body_type ?? 'average';
        $this->complexion = $user->physical?->complexion ?? 'fair';
        $this->blood_group = $user->physical?->blood_group ?? 'O+';
        $this->diet = $user->physical?->diet ?? 'non_vegetarian';
        $this->smoke_habit = $user->physical?->smoke_habit ?? 'no';
        $this->drink_habit = $user->physical?->drink_habit ?? 'no';

        // Career
        $this->education_level_id = $user->education?->education_level_id;
        $this->education_field_id = $user->education?->education_field_id;
        $this->college_name = $user->education?->college_name;
        $this->occupation_id = $user->education?->occupation_id;
        $this->designation = $user->education?->designation;
        $this->company_name = $user->education?->company_name;
        $this->employment_sector = $user->education?->employment_sector ?? 'private';
        $this->annual_income_range = $user->education?->annual_income_range;

        // Family
        $this->father_name = $user->family?->father_name;
        $this->father_profession = $user->family?->father_profession;
        $this->mother_name = $user->family?->mother_name;
        $this->mother_profession = $user->family?->mother_profession;
        $this->brothers_count = $user->family?->brothers_count ?? 0;
        $this->married_brothers_count = $user->family?->married_brothers_count ?? 0;
        $this->sisters_count = $user->family?->sisters_count ?? 0;
        $this->married_sisters_count = $user->family?->married_sisters_count ?? 0;
        $this->family_type = $user->family?->family_type ?? 'nuclear';
        $this->family_values = $user->family?->family_values ?? 'moderate';
        $this->family_status = $user->family?->family_status ?? 'middle_class';
        $this->family_location = $user->family?->family_location;

        // Preferences
        $this->pref_min_age = $user->preferences?->min_age ?? 18;
        $this->pref_max_age = $user->preferences?->max_age ?? 45;
        $this->pref_diet = $user->preferences?->preferred_diet ?? 'any';
        $this->pref_manglik = $user->preferences?->preferred_manglik ?? 'any';
    }

    public function saveProfile()
    {
        $user = Auth::user();

        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'profile_created_by' => 'required|in:self,parents,sibling,relative,friend',
        ]);

        $user->update([
            'profile_created_by' => $this->profile_created_by,
            'name' => $this->name,
            'phone' => $this->phone,
            'dob' => $this->dob,
            'marital_status' => $this->marital_status,
        ]);

        $user->profile()->updateOrCreate(['user_id' => $user->id], [
            'profile_created_by' => $this->profile_created_by,
            'religion_id' => $this->religion_id,
            'caste_id' => $this->caste_id,
            'sub_caste' => $this->sub_caste,
            'mother_tongue' => $this->mother_tongue,
            'marital_status' => $this->marital_status,
            'rashi' => $this->rashi,
            'gotra' => $this->gotra,
            'manglik' => $this->manglik,
            'nadi' => $this->nadi,
            'gana' => $this->gana,
            'birth_time' => $this->birth_time,
            'birth_place' => $this->birth_place,
            'is_photo_blurred' => $this->is_photo_blurred,
            'living_country' => $this->living_country,
            'living_city' => $this->living_city,
            'citizenship_country' => $this->citizenship_country,
            'residency_status' => $this->residency_status,
            'about_me' => $this->about_me,
            'about_partner' => $this->about_partner,
        ]);

        $user->physical()->updateOrCreate(['user_id' => $user->id], [
            'height_cm' => $this->height_cm,
            'weight_kg' => $this->weight_kg,
            'body_type' => $this->body_type,
            'complexion' => $this->complexion,
            'blood_group' => $this->blood_group,
            'diet' => $this->diet,
            'smoke_habit' => $this->smoke_habit,
            'drink_habit' => $this->drink_habit,
        ]);

        $user->education()->updateOrCreate(['user_id' => $user->id], [
            'education_level_id' => $this->education_level_id,
            'education_field_id' => $this->education_field_id,
            'college_name' => $this->college_name,
            'occupation_id' => $this->occupation_id,
            'designation' => $this->designation,
            'company_name' => $this->company_name,
            'employment_sector' => $this->employment_sector,
            'annual_income_range' => $this->annual_income_range,
        ]);

        $user->family()->updateOrCreate(['user_id' => $user->id], [
            'father_name' => $this->father_name,
            'father_profession' => $this->father_profession,
            'mother_name' => $this->mother_name,
            'mother_profession' => $this->mother_profession,
            'brothers_count' => $this->brothers_count,
            'married_brothers_count' => $this->married_brothers_count,
            'sisters_count' => $this->sisters_count,
            'married_sisters_count' => $this->married_sisters_count,
            'family_type' => $this->family_type,
            'family_values' => $this->family_values,
            'family_status' => $this->family_status,
            'family_location' => $this->family_location,
        ]);

        $user->preferences()->updateOrCreate(['user_id' => $user->id], [
            'min_age' => $this->pref_min_age,
            'max_age' => $this->pref_max_age,
            'preferred_diet' => $this->pref_diet,
            'preferred_manglik' => $this->pref_manglik,
        ]);

        session()->flash('success', 'Profile details updated successfully! ✨');
    }

    public function render()
    {
        $religions = Religion::all();
        $castes = $this->religion_id ? Caste::where('religion_id', $this->religion_id)->get() : Caste::all();
        $eduLevels = EducationLevel::all();
        $eduFields = EducationField::all();
        $occupations = Occupation::all();
        $cities = City::all();

        return view('livewire.my-profile', [
            'religions' => $religions,
            'castes' => $castes,
            'eduLevels' => $eduLevels,
            'eduFields' => $eduFields,
            'occupations' => $occupations,
            'cities' => $cities,
        ])->layout('components.layouts.app', ['title' => 'Edit My Matrimonial Profile - MeroZodi']);
    }
}
