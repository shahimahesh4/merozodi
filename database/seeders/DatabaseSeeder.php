<?php

namespace Database\Seeders;

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
use App\Models\SubscriptionPlan;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Religions
        $religions = [
            'Hindu', 'Buddhist', 'Christian', 'Muslim', 'Kirat', 'Jain', 'Sikh'
        ];
        $religionModels = [];
        foreach ($religions as $r) {
            $religionModels[$r] = Religion::firstOrCreate([
                'name' => $r,
                'slug' => Str::slug($r),
            ]);
        }

        // 2. Seed Castes
        $castesData = [
            'Hindu' => ['Brahmin (Hill)', 'Chhetri', 'Newar', 'Thakuri', 'Brahmin (Terai)', 'Yadav', 'Marwadi', 'Shah', 'Rana', 'Joshi', 'Giri/Puri'],
            'Buddhist' => ['Gurung', 'Tamang', 'Magar', 'Sherpa', 'Newar (Buddhist)', 'Lama', 'Thakali'],
            'Kirat' => ['Rai', 'Limbu', 'Sunuwar', 'Yakkha'],
            'Christian' => ['Christian (General)'],
            'Muslim' => ['Muslim (General)', 'Ansari', 'Sheikh'],
            'Jain' => ['Jain (General)'],
            'Sikh' => ['Sikh (General)'],
        ];

        $casteModels = [];
        foreach ($castesData as $rel => $cList) {
            $relModel = $religionModels[$rel] ?? null;
            foreach ($cList as $c) {
                $casteModels[$c] = Caste::firstOrCreate([
                    'name' => $c,
                    'slug' => Str::slug($c),
                    'religion_id' => $relModel ? $relModel->id : null,
                ]);
            }
        }

        // 3. Seed Cities
        $cities = [
            ['name' => 'Kathmandu', 'state' => 'Bagmati Province', 'country' => 'Nepal'],
            ['name' => 'Lalitpur', 'state' => 'Bagmati Province', 'country' => 'Nepal'],
            ['name' => 'Bhaktapur', 'state' => 'Bagmati Province', 'country' => 'Nepal'],
            ['name' => 'Pokhara', 'state' => 'Gandaki Province', 'country' => 'Nepal'],
            ['name' => 'Biratnagar', 'state' => 'Koshi Province', 'country' => 'Nepal'],
            ['name' => 'Dharan', 'state' => 'Koshi Province', 'country' => 'Nepal'],
            ['name' => 'Chitwan', 'state' => 'Bagmati Province', 'country' => 'Nepal'],
            ['name' => 'Butwal', 'state' => 'Lumbini Province', 'country' => 'Nepal'],
            ['name' => 'Nepalgunj', 'state' => 'Lumbini Province', 'country' => 'Nepal'],
            ['name' => 'Dhangadhi', 'state' => 'Sudurpashchim Province', 'country' => 'Nepal'],
            ['name' => 'Sydney', 'state' => 'NSW', 'country' => 'Australia'],
            ['name' => 'Melbourne', 'state' => 'VIC', 'country' => 'Australia'],
            ['name' => 'Dallas', 'state' => 'Texas', 'country' => 'USA'],
            ['name' => 'London', 'state' => 'England', 'country' => 'UK'],
            ['name' => 'Toronto', 'state' => 'Ontario', 'country' => 'Canada'],
        ];

        foreach ($cities as $ct) {
            City::firstOrCreate([
                'name' => $ct['name'],
                'slug' => Str::slug($ct['name'] . '-' . $ct['country']),
            ], [
                'state' => $ct['state'],
                'country' => $ct['country'],
            ]);
        }

        // 4. Seed Education Levels
        $eduLevels = ['Doctorate / PhD', "Master's Degree", "Bachelor's Degree", 'Diploma', 'High School (+2)'];
        $eduLevelModels = [];
        foreach ($eduLevels as $el) {
            $eduLevelModels[$el] = EducationLevel::firstOrCreate(['name' => $el]);
        }

        // 5. Seed Education Fields
        $eduFields = [
            'Computer Science & IT', 'Medicine & Surgery (MBBS/MD)', 'Civil Engineering',
            'Business Administration (MBA/BBA)', 'Chartered Accountancy (CA)',
            'Nursing & Healthcare', 'Public Health', 'Hospitality & Tourism Management', 'General Arts & Humanities'
        ];
        $eduFieldModels = [];
        foreach ($eduFields as $ef) {
            $eduFieldModels[$ef] = EducationField::firstOrCreate(['name' => $ef]);
        }

        // 6. Seed Occupations
        $occupations = [
            'Software Engineer', 'Medical Doctor', 'Civil Engineer', 'Registered Nurse',
            'Bank Manager / Officer', 'Chartered Accountant', 'Business Owner / Entrepreneur',
            'University Lecturer', 'Government Officer (Civil Service)', 'Architect'
        ];
        $occupationModels = [];
        foreach ($occupations as $occ) {
            $occupationModels[$occ] = Occupation::firstOrCreate(['name' => $occ]);
        }

        // 7. Seed Subscription Plans
        SubscriptionPlan::firstOrCreate(['slug' => 'free'], [
            'name' => 'Free Plan',
            'description' => 'Basic profile creation and matching',
            'duration_months' => 1,
            'price_npr' => 0.00,
            'price_usd' => 0.00,
            'features_json' => ['Create profile', 'Browse matches', 'Receive connection requests'],
            'allows_video_calling' => false,
            'allows_direct_messaging' => false,
            'allows_contact_view' => false,
            'is_popular' => false,
            'is_active' => true,
        ]);

        SubscriptionPlan::firstOrCreate(['slug' => 'standard-3m'], [
            'name' => 'Standard Package (3 Months)',
            'description' => 'Unlock direct messaging and contact numbers',
            'duration_months' => 3,
            'price_npr' => 4500.00,
            'price_usd' => 35.00,
            'features_json' => ['Direct Messaging', 'View 25 Phone Numbers', 'Send Unlimited Connects'],
            'allows_video_calling' => false,
            'allows_direct_messaging' => true,
            'allows_contact_view' => true,
            'is_popular' => false,
            'is_active' => true,
        ]);

        SubscriptionPlan::firstOrCreate(['slug' => 'premium-6m'], [
            'name' => 'Premium Package (6 Months)',
            'description' => 'Full access with video calling & profile boost',
            'duration_months' => 6,
            'price_npr' => 8500.00,
            'price_usd' => 65.00,
            'features_json' => ['1-on-1 Video Calling', 'Unlimited Direct Messages', 'View Profile Visitors', 'Verified Badge', 'Profile Boost'],
            'allows_video_calling' => true,
            'allows_direct_messaging' => true,
            'allows_contact_view' => true,
            'is_popular' => true,
            'is_active' => true,
        ]);

        // 8. Create Super Admin, Operations Admin, and Staff Support Users
        $superAdmin = User::updateOrCreate(['email' => 'shahimahesh4@gmail.com'], [
            'name' => 'MeroZodi Super Administrator',
            'password' => Hash::make('Mahesh@9843##'),
            'gender' => 'male',
            'phone' => '+977-9800000000',
            'dob' => '1990-01-01',
            'role' => 'super_admin',
            'avatar' => 'images/avatars/avatar_m1.jpg',
            'is_verified' => true,
            'is_premium' => true,
            'status' => 'active',
            'last_active_at' => now(),
        ]);
        $admin = $superAdmin;

        $adminUser = User::updateOrCreate(['email' => 'manager@merozodi.com'], [
            'name' => 'Suman Adhikari (Operations Admin)',
            'password' => Hash::make('password'),
            'gender' => 'male',
            'phone' => '+977-9801111111',
            'dob' => '1992-04-15',
            'role' => 'admin',
            'avatar' => 'images/avatars/avatar_m2.jpg',
            'is_verified' => true,
            'is_premium' => true,
            'status' => 'active',
            'last_active_at' => now(),
        ]);

        $staffUser = User::updateOrCreate(['email' => 'staff@merozodi.com'], [
            'name' => 'Pooja Thapa (KYC & Support Staff)',
            'password' => Hash::make('password'),
            'gender' => 'female',
            'phone' => '+977-9802222222',
            'dob' => '1996-08-20',
            'role' => 'staff',
            'avatar' => 'images/avatars/avatar_f1.jpg',
            'is_verified' => true,
            'is_premium' => true,
            'status' => 'active',
            'last_active_at' => now(),
        ]);

        // 9. Seed Sample Matrimonial Profiles (34 Complete Profiles with Authentic Nepali Portraits & Names)
        $sampleProfiles = [
            [
                'name' => 'Aayush Sharma',
                'gender' => 'male',
                'email' => 'aayush@example.com',
                'dob' => '1995-05-14',
                'religion' => 'Hindu',
                'caste' => 'Brahmin (Hill)',
                'rashi' => 'Mesha (Aries)',
                'gotra' => 'Kashyap',
                'manglik' => 'no',
                'height_cm' => 178,
                'weight_kg' => 72,
                'diet' => 'vegetarian',
                'edu_level' => "Master's Degree",
                'edu_field' => 'Computer Science & IT',
                'occupation' => 'Software Engineer',
                'income' => '15 Lakh - 25 Lakh NPR',
                'city' => 'Kathmandu',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_m1.jpg',
                'bio' => 'Passionate tech professional based in Kathmandu. Looking for an educated, understanding partner with traditional yet open-minded family values.'
            ],
            [
                'name' => 'Prashant Gurung',
                'gender' => 'male',
                'email' => 'prashant@example.com',
                'dob' => '1993-08-20',
                'religion' => 'Buddhist',
                'caste' => 'Gurung',
                'rashi' => 'Simha (Leo)',
                'gotra' => 'Kaundinya',
                'manglik' => 'no',
                'height_cm' => 175,
                'weight_kg' => 70,
                'diet' => 'non_vegetarian',
                'edu_level' => "Bachelor's Degree",
                'edu_field' => 'Civil Engineering',
                'occupation' => 'Civil Engineer',
                'income' => '80,000 - 120,000 AUD',
                'city' => 'Sydney',
                'country' => 'Australia',
                'avatar' => 'images/avatars/avatar_m2.jpg',
                'bio' => 'Civil Engineer currently living in Sydney, Australia (Permanent Resident). Seeking a friendly partner who is willing to relocate or is already in Australia.'
            ],
            [
                'name' => 'Anjali Shrestha',
                'gender' => 'female',
                'email' => 'anjali@example.com',
                'dob' => '1997-03-12',
                'religion' => 'Hindu',
                'caste' => 'Newar',
                'rashi' => 'Kanya (Virgo)',
                'gotra' => 'Gautam',
                'manglik' => 'no',
                'height_cm' => 163,
                'weight_kg' => 54,
                'diet' => 'non_vegetarian',
                'edu_level' => "Master's Degree",
                'edu_field' => 'Business Administration (MBA/BBA)',
                'occupation' => 'Bank Manager / Officer',
                'income' => '8 Lakh - 12 Lakh NPR',
                'city' => 'Lalitpur',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_f3.jpg',
                'bio' => 'Working as an Assistant Manager at a commercial bank in Lalitpur. Enjoy traveling, cultural festivals, and photography.'
            ],
            [
                'name' => 'Dr. Pooja Adhikari',
                'gender' => 'female',
                'email' => 'pooja@example.com',
                'dob' => '1996-11-28',
                'religion' => 'Hindu',
                'caste' => 'Brahmin (Hill)',
                'rashi' => 'Dhanu (Sagittarius)',
                'gotra' => 'Bharadwaj',
                'manglik' => 'no',
                'height_cm' => 165,
                'weight_kg' => 56,
                'diet' => 'vegetarian',
                'edu_level' => 'Doctorate / PhD',
                'edu_field' => 'Medicine & Surgery (MBBS/MD)',
                'occupation' => 'Medical Doctor',
                'income' => '12 Lakh - 18 Lakh NPR',
                'city' => 'Pokhara',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_f5.jpg',
                'bio' => 'Doctor (MBBS) practicing in Pokhara. Looking for a supportive and well-educated life partner who respects family and career.'
            ],
            [
                'name' => 'Bikram Thapa',
                'gender' => 'male',
                'email' => 'bikram@example.com',
                'dob' => '1994-01-15',
                'religion' => 'Hindu',
                'caste' => 'Chhetri',
                'rashi' => 'Makara (Capricorn)',
                'gotra' => 'Vatsa',
                'manglik' => 'no',
                'height_cm' => 180,
                'weight_kg' => 76,
                'diet' => 'non_vegetarian',
                'edu_level' => "Master's Degree",
                'edu_field' => 'Chartered Accountancy (CA)',
                'occupation' => 'Chartered Accountant',
                'income' => '18 Lakh - 25 Lakh NPR',
                'city' => 'Kathmandu',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_m6.jpg',
                'bio' => 'Chartered Accountant working with multinational audits. Seeking a smart, respectful, and family-oriented partner.'
            ],
            [
                'name' => 'Sunita Rai',
                'gender' => 'female',
                'email' => 'sunita@example.com',
                'dob' => '1998-07-09',
                'religion' => 'Kirat',
                'caste' => 'Rai',
                'rashi' => 'Karka (Cancer)',
                'gotra' => 'Rai',
                'manglik' => 'no',
                'height_cm' => 160,
                'weight_kg' => 52,
                'diet' => 'non_vegetarian',
                'edu_level' => "Bachelor's Degree",
                'edu_field' => 'Nursing & Healthcare',
                'occupation' => 'Registered Nurse',
                'income' => '70,000 - 90,000 CAD',
                'city' => 'Toronto',
                'country' => 'Canada',
                'avatar' => 'images/avatars/avatar_f4.jpg',
                'bio' => 'Registered Nurse in Toronto, Canada. Looking for an understanding partner who values family traditions and good companionship.'
            ],
            [
                'name' => 'Rohan Basnet',
                'gender' => 'male',
                'email' => 'rohan@example.com',
                'dob' => '1993-09-22',
                'religion' => 'Hindu',
                'caste' => 'Chhetri',
                'rashi' => 'Tula (Libra)',
                'gotra' => 'Sandilya',
                'manglik' => 'no',
                'height_cm' => 181,
                'weight_kg' => 75,
                'diet' => 'non_vegetarian',
                'edu_level' => "Master's Degree",
                'edu_field' => 'Business Administration (MBA/BBA)',
                'occupation' => 'Business Owner / Entrepreneur',
                'income' => '25 Lakh - 40 Lakh NPR',
                'city' => 'Kathmandu',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_m5.jpg',
                'bio' => 'Entrepreneur managing an import-export hospitality venture in Kathmandu. Looking for an ambitious, supportive, and kind-hearted life partner.'
            ],
            [
                'name' => 'Samikshya Tamang',
                'gender' => 'female',
                'email' => 'samikshya@example.com',
                'dob' => '1996-12-05',
                'religion' => 'Buddhist',
                'caste' => 'Tamang',
                'rashi' => 'Vrishabha (Taurus)',
                'gotra' => 'Tamang',
                'manglik' => 'no',
                'height_cm' => 164,
                'weight_kg' => 55,
                'diet' => 'non_vegetarian',
                'edu_level' => "Bachelor's Degree",
                'edu_field' => 'Computer Science & IT',
                'occupation' => 'Software Engineer',
                'income' => '75,000 - 100,000 AUD',
                'city' => 'Melbourne',
                'country' => 'Australia',
                'avatar' => 'images/avatars/avatar_f2.jpg',
                'bio' => 'Frontend UI/UX engineer based in Melbourne, Australia. Passionate about art, weekend hikes, and building a loving, respectful family.'
            ],
            [
                'name' => 'Kritika Karki',
                'gender' => 'female',
                'email' => 'kritika.karki@example.com',
                'dob' => '1997-04-18',
                'religion' => 'Hindu',
                'caste' => 'Chhetri',
                'rashi' => 'Mithuna (Gemini)',
                'gotra' => 'Bharadwaj',
                'manglik' => 'no',
                'height_cm' => 162,
                'weight_kg' => 53,
                'diet' => 'vegetarian',
                'edu_level' => "Master's Degree",
                'edu_field' => 'Business Administration (MBA/BBA)',
                'occupation' => 'Bank Manager / Officer',
                'income' => '10 Lakh - 15 Lakh NPR',
                'city' => 'Chitwan',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_f6.jpg',
                'bio' => 'Branch operations officer in Chitwan. Value simplicity, spiritual mindfulness, family harmony, and continuous self-growth.'
            ],
            [
                'name' => 'Sujan Maharjan',
                'gender' => 'male',
                'email' => 'sujan.m@example.com',
                'dob' => '1992-06-30',
                'religion' => 'Hindu',
                'caste' => 'Newar',
                'rashi' => 'Karka (Cancer)',
                'gotra' => 'Kashyap',
                'manglik' => 'no',
                'height_cm' => 176,
                'weight_kg' => 71,
                'diet' => 'non_vegetarian',
                'edu_level' => "Master's Degree",
                'edu_field' => 'Computer Science & IT',
                'occupation' => 'Software Engineer',
                'income' => '20 Lakh - 30 Lakh NPR',
                'city' => 'Bhaktapur',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_m3.jpg',
                'bio' => 'Senior Cloud Architect at an international fintech firm. Warm-hearted Newari boy looking for an understanding, modern yet culturally rooted partner.'
            ],
            [
                'name' => 'Saraswati Neupane',
                'gender' => 'female',
                'email' => 'saraswati.n@example.com',
                'dob' => '1995-09-14',
                'religion' => 'Hindu',
                'caste' => 'Brahmin (Hill)',
                'rashi' => 'Kanya (Virgo)',
                'gotra' => 'Upamanyu',
                'manglik' => 'no',
                'height_cm' => 159,
                'weight_kg' => 50,
                'diet' => 'vegetarian',
                'edu_level' => "Master's Degree",
                'edu_field' => 'General Arts & Humanities',
                'occupation' => 'University Lecturer',
                'income' => '8 Lakh - 12 Lakh NPR',
                'city' => 'Kathmandu',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_f1.jpg',
                'bio' => 'English Literature lecturer at Tribhuvan University. Book enthusiast, classical music lover, and someone who treasures honest conversation.'
            ],
            [
                'name' => 'Dipendra Rawal',
                'gender' => 'male',
                'email' => 'dipendra.rawal@example.com',
                'dob' => '1991-10-25',
                'religion' => 'Hindu',
                'caste' => 'Thakuri',
                'rashi' => 'Vrischika (Scorpio)',
                'gotra' => 'Vatsa',
                'manglik' => 'no',
                'height_cm' => 183,
                'weight_kg' => 78,
                'diet' => 'non_vegetarian',
                'edu_level' => "Bachelor's Degree",
                'edu_field' => 'Civil Engineering',
                'occupation' => 'Civil Engineer',
                'income' => '12 Lakh - 18 Lakh NPR',
                'city' => 'Nepalgunj',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_m7.jpg',
                'bio' => 'Structural Engineer leading infrastructure projects in Western Nepal. Seeking a caring, cultured partner for life’s rewarding journey.'
            ],
            [
                'name' => 'Ashmita Magar',
                'gender' => 'female',
                'email' => 'ashmita.magar@example.com',
                'dob' => '1996-02-14',
                'religion' => 'Buddhist',
                'caste' => 'Magar',
                'rashi' => 'Kumbha (Aquarius)',
                'gotra' => 'Magar',
                'manglik' => 'no',
                'height_cm' => 161,
                'weight_kg' => 54,
                'diet' => 'non_vegetarian',
                'edu_level' => "Bachelor's Degree",
                'edu_field' => 'Hospitality & Tourism Management',
                'occupation' => 'Business Owner / Entrepreneur',
                'income' => '15 Lakh - 20 Lakh NPR',
                'city' => 'Pokhara',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_f2.jpg',
                'bio' => 'Co-founder of a lakeside boutique resort in Pokhara. Enthusiastic traveler, nature enthusiast, seeking a fun, optimistic companion.'
            ],
            [
                'name' => 'Dr. Manish Regmi',
                'gender' => 'male',
                'email' => 'manish.regmi@example.com',
                'dob' => '1992-12-01',
                'religion' => 'Hindu',
                'caste' => 'Brahmin (Hill)',
                'rashi' => 'Dhanu (Sagittarius)',
                'gotra' => 'Garga',
                'manglik' => 'no',
                'height_cm' => 179,
                'weight_kg' => 74,
                'diet' => 'vegetarian',
                'edu_level' => 'Doctorate / PhD',
                'edu_field' => 'Medicine & Surgery (MBBS/MD)',
                'occupation' => 'Medical Doctor',
                'income' => '22 Lakh - 35 Lakh NPR',
                'city' => 'Kathmandu',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_m4.jpg',
                'bio' => 'Orthopedic surgeon practicing at a premier Kathmandu hospital. Value humility, intellectual depth, mutual respect, and close family bonds.'
            ],
            [
                'name' => 'Shristi Poudel',
                'gender' => 'female',
                'email' => 'shristi.poudel@example.com',
                'dob' => '1998-05-20',
                'religion' => 'Hindu',
                'caste' => 'Brahmin (Hill)',
                'rashi' => 'Mesha (Aries)',
                'gotra' => 'Sandilya',
                'manglik' => 'no',
                'height_cm' => 165,
                'weight_kg' => 55,
                'diet' => 'vegetarian',
                'edu_level' => "Bachelor's Degree",
                'edu_field' => 'Chartered Accountancy (CA)',
                'occupation' => 'Chartered Accountant',
                'income' => '10 Lakh - 16 Lakh NPR',
                'city' => 'Butwal',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_f6.jpg',
                'bio' => 'Chartered Accountant managing financial advisory in Butwal. Love cooking, festive celebrations, and exploring Nepal’s tranquil trails.'
            ],
            [
                'name' => 'Kiran Shrestha',
                'gender' => 'male',
                'email' => 'kiran.shrestha@example.com',
                'dob' => '1994-08-11',
                'religion' => 'Hindu',
                'caste' => 'Newar',
                'rashi' => 'Simha (Leo)',
                'gotra' => 'Kashyap',
                'manglik' => 'no',
                'height_cm' => 177,
                'weight_kg' => 73,
                'diet' => 'non_vegetarian',
                'edu_level' => "Master's Degree",
                'edu_field' => 'Computer Science & IT',
                'occupation' => 'Software Engineer',
                'income' => '90,000 - 130,000 USD',
                'city' => 'Dallas',
                'country' => 'USA',
                'avatar' => 'images/avatars/avatar_m3.jpg',
                'bio' => 'Senior DevOps Engineer living in Dallas, Texas (H-1B / Green Card track). Looking for an ambitious, culturally connected partner.'
            ],
            [
                'name' => 'Niroj Limbu',
                'gender' => 'male',
                'email' => 'niroj.limbu@example.com',
                'dob' => '1993-03-19',
                'religion' => 'Kirat',
                'caste' => 'Limbu',
                'rashi' => 'Meena (Pisces)',
                'gotra' => 'Limbu',
                'manglik' => 'no',
                'height_cm' => 174,
                'weight_kg' => 69,
                'diet' => 'non_vegetarian',
                'edu_level' => "Master's Degree",
                'edu_field' => 'Public Health',
                'occupation' => 'University Lecturer',
                'income' => '12 Lakh - 18 Lakh NPR',
                'city' => 'Dharan',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_m2.jpg',
                'bio' => 'Public Health specialist and university lecturer in Dharan. Seeking a compassionate partner who values community, health, and mutual goals.'
            ],
            [
                'name' => 'Prakriti Bhandari',
                'gender' => 'female',
                'email' => 'prakriti.b@example.com',
                'dob' => '1997-10-08',
                'religion' => 'Hindu',
                'caste' => 'Chhetri',
                'rashi' => 'Tula (Libra)',
                'gotra' => 'Kaundinya',
                'manglik' => 'no',
                'height_cm' => 166,
                'weight_kg' => 57,
                'diet' => 'non_vegetarian',
                'edu_level' => "Master's Degree",
                'edu_field' => 'Computer Science & IT',
                'occupation' => 'Software Engineer',
                'income' => '65,000 - 85,000 GBP',
                'city' => 'London',
                'country' => 'UK',
                'avatar' => 'images/avatars/avatar_f2.jpg',
                'bio' => 'Data Scientist working in London, UK. Passionate about art museums, theatre, and staying deeply connected to Nepali traditions.'
            ],
            [
                'name' => 'Suman Giri',
                'gender' => 'male',
                'email' => 'suman.giri@example.com',
                'dob' => '1990-07-17',
                'religion' => 'Hindu',
                'caste' => 'Giri/Puri',
                'rashi' => 'Karka (Cancer)',
                'gotra' => 'Gautam',
                'manglik' => 'no',
                'height_cm' => 176,
                'weight_kg' => 74,
                'diet' => 'vegetarian',
                'edu_level' => "Master's Degree",
                'edu_field' => 'Business Administration (MBA/BBA)',
                'occupation' => 'Government Officer (Civil Service)',
                'income' => '9 Lakh - 14 Lakh NPR',
                'city' => 'Kathmandu',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_m1.jpg',
                'bio' => 'Section Officer (Nijamati Sewa) in Ministry of Finance, Kathmandu. Stable career, ethical outlook, looking for an educated partner.'
            ],
            [
                'name' => 'Rachana Sherpa',
                'gender' => 'female',
                'email' => 'rachana.sherpa@example.com',
                'dob' => '1995-01-29',
                'religion' => 'Buddhist',
                'caste' => 'Sherpa',
                'rashi' => 'Makara (Capricorn)',
                'gotra' => 'Sherpa',
                'manglik' => 'no',
                'height_cm' => 163,
                'weight_kg' => 56,
                'diet' => 'non_vegetarian',
                'edu_level' => "Bachelor's Degree",
                'edu_field' => 'Hospitality & Tourism Management',
                'occupation' => 'Business Owner / Entrepreneur',
                'income' => '18 Lakh - 25 Lakh NPR',
                'city' => 'Kathmandu',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_f3.jpg',
                'bio' => 'Managing an adventure travel and eco-lodge enterprise in Kathmandu. Love high-altitude photography, peace, and soulful companionship.'
            ],
            [
                'name' => 'Roshan Acharya',
                'gender' => 'male',
                'email' => 'roshan.acharya@example.com',
                'dob' => '1994-04-03',
                'religion' => 'Hindu',
                'caste' => 'Brahmin (Hill)',
                'rashi' => 'Mesha (Aries)',
                'gotra' => 'Bharadwaj',
                'manglik' => 'no',
                'height_cm' => 179,
                'weight_kg' => 75,
                'diet' => 'vegetarian',
                'edu_level' => "Master's Degree",
                'edu_field' => 'Computer Science & IT',
                'occupation' => 'Software Engineer',
                'income' => '85,000 - 115,000 CAD',
                'city' => 'Toronto',
                'country' => 'Canada',
                'avatar' => 'images/avatars/avatar_m3.jpg',
                'bio' => 'Full-Stack Developer in Toronto, Canada (Permanent Resident). Enjoy ice-skating, road trips, and building a happy family home.'
            ],
            [
                'name' => 'Alisha Joshi',
                'gender' => 'female',
                'email' => 'alisha.joshi@example.com',
                'dob' => '1996-08-16',
                'religion' => 'Hindu',
                'caste' => 'Joshi',
                'rashi' => 'Simha (Leo)',
                'gotra' => 'Vatsa',
                'manglik' => 'no',
                'height_cm' => 162,
                'weight_kg' => 53,
                'diet' => 'vegetarian',
                'edu_level' => "Master's Degree",
                'edu_field' => 'Business Administration (MBA/BBA)',
                'occupation' => 'Bank Manager / Officer',
                'income' => '11 Lakh - 16 Lakh NPR',
                'city' => 'Biratnagar',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_f1.jpg',
                'bio' => 'Senior credit officer at Nabil Bank, Biratnagar. Looking for an authentic partner with good humour and grounded values.'
            ],
            [
                'name' => 'Dipak Subedi',
                'gender' => 'male',
                'email' => 'dipak.subedi@example.com',
                'dob' => '1993-11-12',
                'religion' => 'Hindu',
                'caste' => 'Brahmin (Hill)',
                'rashi' => 'Vrischika (Scorpio)',
                'gotra' => 'Kaundinya',
                'manglik' => 'no',
                'height_cm' => 176,
                'weight_kg' => 70,
                'diet' => 'vegetarian',
                'edu_level' => "Bachelor's Degree",
                'edu_field' => 'Civil Engineering',
                'occupation' => 'Civil Engineer',
                'income' => '14 Lakh - 20 Lakh NPR',
                'city' => 'Pokhara',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_m7.jpg',
                'bio' => 'Project Engineer handling hydropower projects near Pokhara. Seeking an optimistic, family-centered life partner.'
            ],
            [
                'name' => 'Menuka Dahal',
                'gender' => 'female',
                'email' => 'menuka.dahal@example.com',
                'dob' => '1997-09-03',
                'religion' => 'Hindu',
                'caste' => 'Brahmin (Hill)',
                'rashi' => 'Kanya (Virgo)',
                'gotra' => 'Kashyap',
                'manglik' => 'no',
                'height_cm' => 160,
                'weight_kg' => 52,
                'diet' => 'vegetarian',
                'edu_level' => "Bachelor's Degree",
                'edu_field' => 'Nursing & Healthcare',
                'occupation' => 'Registered Nurse',
                'income' => '70,000 - 95,000 AUD',
                'city' => 'Sydney',
                'country' => 'Australia',
                'avatar' => 'images/avatars/avatar_f4.jpg',
                'bio' => 'Registered nurse at a Sydney public hospital. Seeking a gentle, caring partner living in or willing to settle in Australia.'
            ],
            [
                'name' => 'Bibek KC',
                'gender' => 'male',
                'email' => 'bibek.kc@example.com',
                'dob' => '1992-05-18',
                'religion' => 'Hindu',
                'caste' => 'Chhetri',
                'rashi' => 'Vrishabha (Taurus)',
                'gotra' => 'Sandilya',
                'manglik' => 'no',
                'height_cm' => 180,
                'weight_kg' => 77,
                'diet' => 'non_vegetarian',
                'edu_level' => "Master's Degree",
                'edu_field' => 'Business Administration (MBA/BBA)',
                'occupation' => 'Business Owner / Entrepreneur',
                'income' => '20 Lakh - 35 Lakh NPR',
                'city' => 'Dhangadhi',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_m5.jpg',
                'bio' => 'Managing family agro-trading business in Dhangadhi. Ambitious, supportive, seeking a thoughtful partner who values family unity.'
            ],
            [
                'name' => 'Sneha Yadav',
                'gender' => 'female',
                'email' => 'sneha.yadav@example.com',
                'dob' => '1996-06-25',
                'religion' => 'Hindu',
                'caste' => 'Yadav',
                'rashi' => 'Mithuna (Gemini)',
                'gotra' => 'Kashyap',
                'manglik' => 'no',
                'height_cm' => 164,
                'weight_kg' => 55,
                'diet' => 'vegetarian',
                'edu_level' => "Master's Degree",
                'edu_field' => 'Computer Science & IT',
                'occupation' => 'Software Engineer',
                'income' => '12 Lakh - 18 Lakh NPR',
                'city' => 'Biratnagar',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_f6.jpg',
                'bio' => 'Software consultant based in Biratnagar. Respectful, modern, grounded in family values, looking for a compatible companion.'
            ],
            [
                'name' => 'Nabin Khadka',
                'gender' => 'male',
                'email' => 'nabin.khadka@example.com',
                'dob' => '1991-03-08',
                'religion' => 'Hindu',
                'caste' => 'Chhetri',
                'rashi' => 'Meena (Pisces)',
                'gotra' => 'Upamanyu',
                'manglik' => 'no',
                'height_cm' => 175,
                'weight_kg' => 71,
                'diet' => 'non_vegetarian',
                'edu_level' => "Master's Degree",
                'edu_field' => 'General Arts & Humanities',
                'occupation' => 'Government Officer (Civil Service)',
                'income' => '10 Lakh - 15 Lakh NPR',
                'city' => 'Lalitpur',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_m6.jpg',
                'bio' => 'Under-Secretary level civil service officer in Lalitpur. Honest, composed, and seeking a loving partner for a balanced life.'
            ],
            [
                'name' => 'Sweta Pradhan',
                'gender' => 'female',
                'email' => 'sweta.pradhan@example.com',
                'dob' => '1998-01-19',
                'religion' => 'Hindu',
                'caste' => 'Newar',
                'rashi' => 'Makara (Capricorn)',
                'gotra' => 'Gautam',
                'manglik' => 'no',
                'height_cm' => 161,
                'weight_kg' => 52,
                'diet' => 'non_vegetarian',
                'edu_level' => "Bachelor's Degree",
                'edu_field' => 'Business Administration (MBA/BBA)',
                'occupation' => 'Bank Manager / Officer',
                'income' => '8 Lakh - 12 Lakh NPR',
                'city' => 'Kathmandu',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_f3.jpg',
                'bio' => 'Customer relationship officer in Kathmandu. Outgoing, artistic, and looking for a sincere, family-minded gentleman.'
            ],
            [
                'name' => 'Dr. Saurav Bhattarai',
                'gender' => 'male',
                'email' => 'saurav.b@example.com',
                'dob' => '1993-07-27',
                'religion' => 'Hindu',
                'caste' => 'Brahmin (Hill)',
                'rashi' => 'Karka (Cancer)',
                'gotra' => 'Bharadwaj',
                'manglik' => 'no',
                'height_cm' => 182,
                'weight_kg' => 78,
                'diet' => 'vegetarian',
                'edu_level' => 'Doctorate / PhD',
                'edu_field' => 'Medicine & Surgery (MBBS/MD)',
                'occupation' => 'Medical Doctor',
                'income' => '20 Lakh - 30 Lakh NPR',
                'city' => 'Chitwan',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_m4.jpg',
                'bio' => 'Pediatrician at Chitwan Medical College. Warm, thoughtful, family-loving, and looking for an educated partner.'
            ],
            [
                'name' => 'Binita Lama',
                'gender' => 'female',
                'email' => 'binita.lama@example.com',
                'dob' => '1995-10-31',
                'religion' => 'Buddhist',
                'caste' => 'Lama',
                'rashi' => 'Vrischika (Scorpio)',
                'gotra' => 'Lama',
                'manglik' => 'no',
                'height_cm' => 163,
                'weight_kg' => 54,
                'diet' => 'non_vegetarian',
                'edu_level' => "Bachelor's Degree",
                'edu_field' => 'Nursing & Healthcare',
                'occupation' => 'Registered Nurse',
                'income' => '10 Lakh - 15 Lakh NPR',
                'city' => 'Lalitpur',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_f4.jpg',
                'bio' => 'Critical Care Nurse in Lalitpur. Gentle, spiritually conscious Buddhist girl seeking an honest and kind-hearted life partner.'
            ],
            [
                'name' => 'Amit Shah',
                'gender' => 'male',
                'email' => 'amit.shah@example.com',
                'dob' => '1990-12-15',
                'religion' => 'Hindu',
                'caste' => 'Shah',
                'rashi' => 'Dhanu (Sagittarius)',
                'gotra' => 'Vatsa',
                'manglik' => 'no',
                'height_cm' => 180,
                'weight_kg' => 76,
                'diet' => 'vegetarian',
                'edu_level' => "Master's Degree",
                'edu_field' => 'Chartered Accountancy (CA)',
                'occupation' => 'Chartered Accountant',
                'income' => '100,000 - 140,000 USD',
                'city' => 'Dallas',
                'country' => 'USA',
                'avatar' => 'images/avatars/avatar_m6.jpg',
                'bio' => 'Financial Risk Consultant in Dallas, TX. Enjoys tennis, hiking, and seeking an educated, loving partner.'
            ],
            [
                'name' => 'Prativa Ghimire',
                'gender' => 'female',
                'email' => 'prativa.ghimire@example.com',
                'dob' => '1997-12-22',
                'religion' => 'Hindu',
                'caste' => 'Brahmin (Hill)',
                'rashi' => 'Dhanu (Sagittarius)',
                'gotra' => 'Kashyap',
                'manglik' => 'no',
                'height_cm' => 165,
                'weight_kg' => 56,
                'diet' => 'vegetarian',
                'edu_level' => "Master's Degree",
                'edu_field' => 'Computer Science & IT',
                'occupation' => 'Software Engineer',
                'income' => '14 Lakh - 22 Lakh NPR',
                'city' => 'Kathmandu',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_f2.jpg',
                'bio' => 'AI/ML engineer working at an international tech hub in Kathmandu. Looking for a progressive, family-loving partner.'
            ],
            [
                'name' => 'Ramesh Marasini',
                'gender' => 'male',
                'email' => 'ramesh.marasini@example.com',
                'dob' => '1994-02-17',
                'religion' => 'Hindu',
                'caste' => 'Brahmin (Hill)',
                'rashi' => 'Kumbha (Aquarius)',
                'gotra' => 'Sandilya',
                'manglik' => 'no',
                'height_cm' => 177,
                'weight_kg' => 72,
                'diet' => 'vegetarian',
                'edu_level' => "Bachelor's Degree",
                'edu_field' => 'Civil Engineering',
                'occupation' => 'Civil Engineer',
                'income' => '11 Lakh - 17 Lakh NPR',
                'city' => 'Butwal',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_m1.jpg',
                'bio' => 'Consulting engineer in Butwal. Loves reading, exploring hill trails, and seeking a life partner with sweet disposition.'
            ],
            [
                'name' => 'Kabita Karki',
                'gender' => 'female',
                'email' => 'kabita.karki@example.com',
                'dob' => '1996-04-09',
                'religion' => 'Hindu',
                'caste' => 'Chhetri',
                'rashi' => 'Mesha (Aries)',
                'gotra' => 'Bharadwaj',
                'manglik' => 'no',
                'height_cm' => 162,
                'weight_kg' => 54,
                'diet' => 'non_vegetarian',
                'edu_level' => "Master's Degree",
                'edu_field' => 'Business Administration (MBA/BBA)',
                'occupation' => 'University Lecturer',
                'income' => '9 Lakh - 14 Lakh NPR',
                'city' => 'Pokhara',
                'country' => 'Nepal',
                'avatar' => 'images/avatars/avatar_f1.jpg',
                'bio' => 'Lecturer in Management Studies in Pokhara. Seeking an ambitious and caring life partner who respects individuality and family.'
            ],
        ];

        $createdByOptions = ['self', 'parents', 'sibling', 'relative', 'friend'];
        $profileIndex = 0;
        foreach ($sampleProfiles as $p) {
            $maritalStatus = $p['marital_status'] ?? 'unmarried';
            $createdBy = $p['profile_created_by'] ?? $createdByOptions[$profileIndex % count($createdByOptions)];
            $profileIndex++;

            $user = User::updateOrCreate(['email' => $p['email']], [
                'profile_created_by' => $createdBy,
                'name' => $p['name'],
                'password' => Hash::make('password'),
                'gender' => $p['gender'],
                'marital_status' => $maritalStatus,
                'dob' => $p['dob'],
                'phone' => '+977-98' . rand(10000000, 99999999),
                'avatar' => $p['avatar'],
                'role' => 'user',
                'is_verified' => true,
                'is_premium' => rand(0, 1) === 1,
                'status' => 'active',
                'last_active_at' => now()->subMinutes(rand(1, 120)),
            ]);

            $relId = $religionModels[$p['religion']]->id ?? null;
            $casteId = $casteModels[$p['caste']]->id ?? null;
            $eduLevId = $eduLevelModels[$p['edu_level']]->id ?? null;
            $eduFldId = $eduFieldModels[$p['edu_field']]->id ?? null;
            $occId = $occupationModels[$p['occupation']]->id ?? null;

            UserProfile::updateOrCreate(['user_id' => $user->id], [
                'profile_created_by' => $createdBy,
                'religion_id' => $relId,
                'caste_id' => $casteId,
                'sub_caste' => $p['caste'],
                'mother_tongue' => 'Nepali',
                'marital_status' => $maritalStatus,
                'rashi' => $p['rashi'],
                'gotra' => $p['gotra'],
                'manglik' => $p['manglik'],
                'living_country' => $p['country'],
                'living_city' => $p['city'],
                'permanent_address' => $p['city'] . ', ' . $p['country'],
                'about_me' => $p['bio'],
                'profile_visibility' => 'public',
            ]);

            PhysicalLifestyle::updateOrCreate(['user_id' => $user->id], [
                'height_cm' => $p['height_cm'],
                'weight_kg' => $p['weight_kg'],
                'body_type' => 'average',
                'complexion' => 'fair',
                'diet' => $p['diet'],
                'smoke_habit' => 'no',
                'drink_habit' => 'no',
            ]);

            EducationProfession::updateOrCreate(['user_id' => $user->id], [
                'education_level_id' => $eduLevId,
                'education_field_id' => $eduFldId,
                'college_name' => 'Tribhuvan University',
                'occupation_id' => $occId,
                'designation' => $p['occupation'],
                'company_name' => 'Leading Organization',
                'annual_income_range' => $p['income'],
            ]);

            $nameParts = explode(' ', trim($p['name']));
            $lastName = end($nameParts);

            FamilyDetail::updateOrCreate(['user_id' => $user->id], [
                'father_name' => 'Mr. ' . $lastName,
                'father_profession' => 'Retired Civil Servant',
                'mother_name' => 'Mrs. ' . $lastName,
                'mother_profession' => 'Homemaker',
                'brothers_count' => 1,
                'sisters_count' => 1,
                'family_type' => 'nuclear',
                'family_values' => 'moderate',
                'family_status' => 'middle_class',
            ]);

            PartnerPreference::updateOrCreate(['user_id' => $user->id], [
                'min_age' => 20,
                'max_age' => 35,
                'min_height_cm' => 150,
                'max_height_cm' => 190,
                'preferred_religions' => [$relId],
                'preferred_castes' => [$casteId],
                'preferred_diet' => 'any',
                'preferred_manglik' => 'any',
            ]);

            // Seed User Gallery Photos from Authentic Nepali Portraits Collection
            $femaleGalleryPool = [
                'images/avatars/nepali_female_kurti_1790651353472.jpg',
                'images/avatars/nepali_female_newari_1790651388036.jpg',
                'images/avatars/nepali_female_nurse_1790651424619.jpg',
                'images/avatars/nepali_female_saree_1790651315705.jpg',
                'images/avatars/nepali_female_yellow_kurti_1790651463511.jpg',
                'images/avatars/nepali_female_doctor_1790651504108.jpg',
                'images/avatars/avatar_f1.jpg',
                'images/avatars/avatar_f2.jpg',
                'images/avatars/avatar_f3.jpg',
                'images/avatars/avatar_f4.jpg',
                'images/avatars/avatar_f5.jpg',
                'images/avatars/avatar_f6.jpg',
            ];

            $maleGalleryPool = [
                'images/avatars/nepali_male_daura_suruwal_1790651444182.jpg',
                'images/avatars/nepali_male_dhaka_topi_1790651298242.jpg',
                'images/avatars/nepali_male_doctor_1790651405829.jpg',
                'images/avatars/nepali_male_engineer_1790651334595.jpg',
                'images/avatars/nepali_male_gurung_1790651370553.jpg',
                'images/avatars/nepali_male_modern_suit_1790651481536.jpg',
                'images/avatars/nepali_male_tamang_1790651524585.jpg',
                'images/avatars/avatar_m1.jpg',
                'images/avatars/avatar_m2.jpg',
                'images/avatars/avatar_m3.jpg',
                'images/avatars/avatar_m4.jpg',
                'images/avatars/avatar_m5.jpg',
                'images/avatars/avatar_m6.jpg',
                'images/avatars/avatar_m7.jpg',
            ];

            $pool = $p['gender'] === 'female' ? $femaleGalleryPool : $maleGalleryPool;
            $selectedGalleries = [
                $pool[($profileIndex * 2) % count($pool)],
                $pool[($profileIndex * 2 + 1) % count($pool)],
                $pool[($profileIndex * 2 + 2) % count($pool)],
            ];

            foreach ($selectedGalleries as $gIdx => $gPath) {
                \App\Models\UserGallery::firstOrCreate([
                    'user_id' => $user->id,
                    'image_path' => $gPath,
                ], [
                    'is_profile' => $gIdx === 0,
                    'is_cover' => false,
                    'is_private' => false,
                    'is_approved' => true,
                ]);
            }
        }

        // 10. Seed Matrimonial Events
        $eventsData = [
            [
                'title' => 'Kathmandu Premium Singles Mixer & Speed Dating',
                'slug' => 'kathmandu-premium-singles-mixer-speed-dating',
                'description' => 'An exclusive curated evening for verified professional singles in the Kathmandu Valley. Enjoy ice-breaker activities, high tea, 1-on-1 5-minute rotation chats, and personal matchmaking guidance.',
                'banner_image' => 'images/nepali-wedding-banner.png',
                'type' => 'physical',
                'event_datetime' => now()->addDays(14)->setTime(16, 0),
                'location_venue' => 'Hotel Yak & Yeti, Durbar Marg, Kathmandu',
                'entry_fee_npr' => 1500.00,
                'max_participants' => 50,
                'is_active' => true,
                'faqs' => [
                    ['question' => 'Who is eligible to attend?', 'answer' => 'Verified singles aged 22-38 with a completed MeroZodi profile and KYC verification.'],
                    ['question' => 'Is confidentiality guaranteed?', 'answer' => 'Yes, our event operates under strict privacy guidelines with no unauthorized photography.'],
                    ['question' => 'What is included in the entry fee?', 'answer' => 'Gourmet high tea, refreshment drinks, matchmaking workbook, and post-event mutual match contact exchange.']
                ]
            ],
            [
                'title' => 'Global Nepali NRI Virtual Matchmaking Meet',
                'slug' => 'global-nepali-nri-virtual-matchmaking-meet',
                'description' => 'Connect live with verified Nepali doctors, engineers, IT professionals, and researchers residing across Australia, USA, Canada, UK, and Europe in secure private breakout rooms.',
                'banner_image' => 'images/contact-us-banner.png',
                'type' => 'virtual_meet',
                'event_datetime' => now()->addDays(21)->setTime(20, 0),
                'location_venue' => 'MeroZodi Private Encrypted Video Breakout Rooms',
                'entry_fee_npr' => 0.00,
                'max_participants' => 100,
                'is_active' => true,
                'faqs' => [
                    ['question' => 'How will I receive the link?', 'answer' => 'Registered attendees will receive direct video room links 2 hours before the start time.'],
                    ['question' => 'How do the breakout rooms work?', 'answer' => 'Participants are placed in 1-on-1 private rooms for 7-minute introductory chats before rotating.']
                ]
            ],
            [
                'title' => 'Sydney & Melbourne Nepali Professionals Brunch',
                'slug' => 'sydney-melbourne-nepali-professionals-brunch',
                'description' => 'A relaxed Saturday morning brunch in Sydney for Nepali Permanent Residents and Citizens looking for life partners with compatible lifestyles and cultural harmony.',
                'banner_image' => 'images/terms-conditions-banner.png',
                'type' => 'physical',
                'event_datetime' => now()->addDays(28)->setTime(11, 0),
                'location_venue' => 'Grand Ballroom, Rockdale, Sydney NSW',
                'entry_fee_npr' => 3500.00,
                'max_participants' => 40,
                'is_active' => true,
                'faqs' => [
                    ['question' => 'Can parents attend?', 'answer' => 'The first 2 hours are exclusive to prospective brides and grooms, followed by a dedicated family networking session.']
                ]
            ]
        ];

        foreach ($eventsData as $ed) {
            $faqs = $ed['faqs'] ?? [];
            unset($ed['faqs']);

            $event = \App\Models\MatrimonyEvent::updateOrCreate(
                ['slug' => $ed['slug']],
                $ed
            );

            foreach ($faqs as $idx => $faq) {
                \App\Models\EventFaq::firstOrCreate(
                    [
                        'matrimony_event_id' => $event->id,
                        'question' => $faq['question']
                    ],
                    [
                        'answer' => $faq['answer'],
                        'sort_order' => $idx + 1
                    ]
                );
            }
        }

        // 11. Seed Matrimonial Blogs
        $blogsData = [
            [
                'title' => 'Kundali Matching & Gun Milan: What Astrological Compatibility Means in Modern Nepali Marriages',
                'slug' => 'kundali-matching-gun-milan-modern-nepali-marriages',
                'summary' => 'Understand the traditional science of 36 Gun Milan, Manglik Dosha, and how modern couples balance astrological harmony with practical emotional and lifestyle compatibility.',
                'featured_image' => 'images/blogs/blog-kundali-matching.jpg',
                'content' => <<<MARKDOWN
In Nepali Hindu matrimonial culture, horoscope matching (*Kundali Milan*) has been practiced for generations to assess the spiritual, physiological, and psychological harmony between two prospective life partners.

---

### The 8 Kutas (Ashtakoota) of Vedic Gun Milan
Gun Milan calculates compatibility across 8 distinct celestial parameters adding up to 36 total points:

1. **Varna (1 Point):** Work temperament, spiritual ego, and social compatibility.
2. **Vashya (2 Points):** Mutual attraction, power balance, and mutual respect.
3. **Tara (3 Points):** Health, prosperity, destiny, and longevity of the bond.
4. **Yoni (4 Points):** Physical attraction, intimacy, and biological compatibility.
5. **Graha Maitri (5 Points):** Planetary friendship, mental outlook, and daily communication.
6. **Gana (6 Points):** Core temperament (*Deva* - gentle, *Manushya* - pragmatic, *Rakshasa* - assertive).
7. **Bhakoot (7 Points):** Emotional bonding, family prosperity, and mutual fortune.
8. **Nadi (8 Points):** Genetic compatibility, nervous system balance, and progeny health.

---

### Interpreting Gun Milan Scores in Modern Matrimony
- **28 to 36 Points (Excellent):** Exceptional astrological harmony with strong spiritual and emotional resonance.
- **18 to 27 Points (Good / Favorable):** Solid compatibility suitable for marriage when values and communication align.
- **Below 18 Points:** Requires deeper astrological analysis (*Dosha Nivaran*) alongside practical mutual understanding.

---

### Balancing Astrological Insights with Contemporary Compatibility
While ancient Vedic Kundali Milan provides valuable cultural reassurance, at MeroZodi we believe that true marital bliss requires combining astrological compatibility with:

- **Emotional Empathy & Active Listening:** The willingness to communicate openly during difficult times.
- **Shared Life Values & Goals:** Mutual agreement on family lifestyle, career aspirations, and financial ethics.
- **Verified Authenticity:** Ensuring both prospective partners are genuine, verified, and transparent about their past.
MARKDOWN
                ,
                'is_published' => true,
                'published_at' => now()->subDays(5)
            ],
            [
                'title' => 'Balancing Tradition and Modern Expectations: A Guide for 21st Century Nepali Couples',
                'slug' => 'balancing-tradition-and-modern-expectations-nepali-couples',
                'summary' => 'How to navigate joint family dynamics, career aspirations, and cultural rituals with mutual respect and healthy communication in modern Nepali matrimony.',
                'featured_image' => 'images/blogs/blog-tradition-modernity.jpg',
                'content' => <<<MARKDOWN
Today's Nepali matchmaking landscape represents a harmonious blend between age-old cultural traditions and contemporary personal autonomy. As educated Nepali singles pursue global careers, higher education, and independent milestones, traditional matchmaking has evolved into a dignified, collaborative dialogue.

Modern Nepali marriage is no longer an arrangement dictated solely by elders, nor is it completely detached from family roots—it is a sacred partnership where two individuals and their families build a shared future grounded in mutual respect, cultural identity, and emotional equality.

---

### 1. Transparent Dialogue on Career Ambitions & Relocation
One of the most essential conversations for modern Nepali couples centers on professional goals and living arrangements.

- **Career Priorities:** Openly discuss how both partners view work-life balance, career growth, and potential relocations across Nepal or abroad (such as Australia, Canada, the USA, or the UK).
- **Relocation Feasibility:** If one partner is based in Kathmandu and the other is settled overseas, clarify visa expectations, licensing recognition, and long-term residency plans well in advance.
- **Mutual Support:** A healthy modern marriage celebrates both partners' aspirations without requiring one person to sacrifice their identity.

---

### 2. Navigating Joint Family Dynamics & Personal Space
In Nepali culture, marriage deeply unites two families. Balancing traditional filial duties with modern independence is vital for long-term marital harmony.

- **Living Arrangements:** Discuss whether you plan to live in a traditional joint family household, establish a semi-independent nearby home, or live independently as a nuclear family.
- **Mutual Respect for In-Laws:** Honoring family traditions, festivals (Dashain, Tihar, Teej, Chhath, Lhosar), and elders while establishing clear, healthy boundaries for your marital privacy.
- **Collaborative Problem-Solving:** Resolve disagreements privately as a unified couple before bringing matters to extended family members.

---

### 3. Financial Openness & Shared Life Goals
Financial compatibility is a cornerstone of modern relationship stability. Transparent conversations eliminate misunderstandings before marriage.

- **Household Budgeting:** Decide how daily living expenses, household contributions, and savings will be managed.
- **Supporting Extended Family:** Candidly discuss financial responsibilities toward parents or siblings to ensure complete transparency.
- **Long-Term Investments:** Align on milestones such as purchasing a home, investing in mutual funds, or building emergency savings funds.

---

### 4. Vedic Astrological Harmony & Emotional Compatibility
While authentic Vedic horoscope matching (*Ashtakoota 36 Gun Milan*) provides spiritual and cultural comfort for families, modern couples recognize that emotional maturity, kindness, and intellectual synergy are equally essential.

- **Astrological Guidance:** Use Kundali compatibility as a thoughtful guideline for understanding temperaments and potential Manglik considerations.
- **Emotional Maturity:** Empathy, active listening, and a willingness to forgive form the real foundation of enduring marital bliss.

---

### Conclusion: Building a Sacred, Empowered Future Together
Balancing traditional Nepali values with modern realities is not a conflict—it is an opportunity to cultivate a richer, more meaningful partnership. By combining honest communication, cultural pride, and mutual respect, modern Nepali couples can build marriages that honor both their heritage and their individual dreams.
MARKDOWN
                ,
                'is_published' => true,
                'published_at' => now()->subDays(10)
            ],
            [
                'title' => 'Long Distance NRI Matrimony: How to Connect Across Borders from Sydney to Kathmandu',
                'slug' => 'long-distance-nri-matrimony-connect-across-borders',
                'summary' => 'A practical checklist for Non-Resident Nepalis (NRIs) dating across timezones, covering video calling etiquette, immigration expectations, and visiting family.',
                'featured_image' => 'images/blogs/blog-nri-matrimony.jpg',
                'content' => <<<MARKDOWN
For the Nepali diaspora living across Australia, North America, the UK, Europe, and Japan, finding a life partner who shares cultural roots, mother tongue, and family traditions is deeply fulfilling.

Cross-border matrimonial matchmaking comes with unique geographical and logistical challenges. Here is a practical roadmap to building deep connection across continents.

---

### 1. Establishing Consistent Communication Routines
Overcoming timezone differences requires intentional scheduling and clear expectations.

- **Scheduled 1-on-1 Video Dates:** Take advantage of MeroZodi's private encrypted video dating rooms to have regular, focused conversations without distractions.
- **Daily Check-Ins:** Simple morning and evening messages build emotional consistency across busy work shifts.
- **Interactive Activities:** Cook the same traditional Nepali dish together on video call, or watch Nepali cultural shows simultaneously.

---

### 2. Involving Families with Warmth & Transparency
Because long-distance relationships cannot rely on frequent in-person gatherings, virtual family meetings create early trust.

- **Virtual Family Introductions:** Schedule structured group calls between parents to discuss cultural customs, wedding preferences, and family backgrounds.
- **Honest Discussions on Life Abroad:** Share realistic details about cost of living, weather conditions, career licensing, and community networks in your host country.

---

### 3. Clear Roadmap for Visas & Immigration
Immigration timelines can take months or years. Being transparent from the first conversation prevents unexpected stress.

- **Visa Categories:** Discuss whether you will be applying for Partner Visas (Subclass 309/100, CR1, UK Spouse Visa) and who will coordinate document preparation.
- **Career Recognition:** Explore credential evaluations and professional conversion pathways so the relocating partner feels empowered.

---

### Conclusion: Love Knows No Geographic Boundaries
With honesty, cultural alignment, and modern matchmaking tools, thousands of Nepali singles successfully bridge continents to begin joyful marital journeys every year.
MARKDOWN
                ,
                'is_published' => true,
                'published_at' => now()->subDays(15)
            ]
        ];

        foreach ($blogsData as $bd) {
            \App\Models\Blog::updateOrCreate(
                ['slug' => $bd['slug']],
                array_merge($bd, ['author_id' => $admin->id])
            );
        }

        // 12. Seed Dynamic CMS Pages (Privacy, Terms, About, Contact)
        $this->call(PageSeeder::class);

        // 13. Seed Coupons and Global Site Settings
        $this->call(EnhancementSeeder::class);
    }
}
