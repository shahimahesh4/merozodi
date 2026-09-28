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

        // 8. Create Admin User
        $admin = User::firstOrCreate(['email' => 'admin@merozodi.com'], [
            'name' => 'MeroZodi Administrator',
            'password' => Hash::make('password'),
            'gender' => 'male',
            'phone' => '+977-9800000000',
            'dob' => '1990-01-01',
            'role' => 'admin',
            'is_verified' => true,
            'is_premium' => true,
            'status' => 'active',
            'last_active_at' => now(),
        ]);

        // 9. Seed Sample Matrimonial Profiles
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
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop&crop=faces',
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
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&h=400&fit=crop&crop=faces',
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
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&h=400&fit=crop&crop=faces',
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
                'avatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&h=400&fit=crop&crop=faces',
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
                'avatar' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400&h=400&fit=crop&crop=faces',
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
                'avatar' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=400&h=400&fit=crop&crop=faces',
                'bio' => 'Registered Nurse in Toronto, Canada. Looking for an understanding partner who values family traditions and good companionship.'
            ]
        ];

        $createdByOptions = ['self', 'parents', 'sibling', 'relative', 'friend'];
        $profileIndex = 0;
        foreach ($sampleProfiles as $p) {
            $maritalStatus = $p['marital_status'] ?? 'unmarried';
            $createdBy = $p['profile_created_by'] ?? $createdByOptions[$profileIndex % count($createdByOptions)];
            $profileIndex++;

            $user = User::firstOrCreate(['email' => $p['email']], [
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

            FamilyDetail::updateOrCreate(['user_id' => $user->id], [
                'father_name' => 'Mr. ' . explode(' ', $p['name'])[1],
                'father_profession' => 'Retired Civil Servant',
                'mother_name' => 'Mrs. ' . explode(' ', $p['name'])[1],
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
        }

        // 10. Seed Matrimonial Events
        $eventsData = [
            [
                'title' => 'Kathmandu Premium Singles Mixer & Speed Dating',
                'slug' => 'kathmandu-premium-singles-mixer-speed-dating',
                'description' => 'An exclusive curated evening for verified professional singles in the Kathmandu Valley. Enjoy ice-breaker activities, high tea, 1-on-1 5-minute rotation chats, and personal matchmaking guidance.',
                'banner_image' => 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=1200&h=600&fit=crop',
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
                'banner_image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&h=600&fit=crop',
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
                'banner_image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1200&h=600&fit=crop',
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

            $event = \App\Models\MatrimonyEvent::firstOrCreate(
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
                'featured_image' => 'https://images.unsplash.com/photo-1606800052052-a08af7148866?w=1200&h=600&fit=crop',
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
                'featured_image' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=1200&h=600&fit=crop',
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
                'featured_image' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=1200&h=600&fit=crop',
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
