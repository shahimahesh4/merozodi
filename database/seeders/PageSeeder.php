<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'subtitle' => "Connecting Nepali hearts worldwide through trust, cultural harmony, and modern matchmaking.",
                'banner_image' => 'images/about-us-banner.png',
                'meta_title' => 'About MeroZodi - Nepal’s Leading Matrimonial Platform',
                'meta_description' => 'Discover how MeroZodi is transforming Nepali matrimony with 100% verified profiles, Vedic Kundali matching, and encrypted video dates.',
                'is_published' => true,
                'contact_email' => 'contact@merozodi.com',
                'contact_phone' => '+977-1-4567890',
                'contact_address' => 'Lazimpat, Kathmandu, Nepal',
                'content' => <<<HTML
<h2>Welcome to MeroZodi Matrimonial</h2>
<p>MeroZodi is Nepal’s premier matrimonial and matchmaking platform, created specifically for modern Nepali singles, Non-Resident Nepalis (NRIs), and families worldwide who value cultural harmony, genuine compatibility, and verified authenticity.</p>

<h3>Our Vision & Purpose</h3>
<p>In Nepali culture, marriage is not merely the union of two individuals—it is the sacred communion of two families, shared traditions, and lifelong companionship. As our generation embraces global careers, higher education, and independent values, the traditional methods of finding a life partner required a contemporary, dignified, and secure evolution.</p>
<p>MeroZodi bridges age-old Nepali matrimonial traditions with state-of-the-art technological security, authentic identity verification, and Vedic astrological compatibility (Ashtakoota Gun Milan).</p>

<div class="my-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="p-6 bg-rose-50 rounded-2xl border border-rose-100">
        <h4 class="font-bold text-rose-800 text-lg mb-2">100% ID Verified Members</h4>
        <p class="text-sm text-slate-600">Every single profile undergoes rigorous Government Citizenship / Passport / National ID verification and manual photo moderation before gaining certified trust status.</p>
    </div>
    <div class="p-6 bg-indigo-50 rounded-2xl border border-indigo-100">
        <h4 class="font-bold text-indigo-800 text-lg mb-2">Authentic Kundali Matching</h4>
        <p class="text-sm text-slate-600">Automated 36 Gun Milan, Rashi, Gotra, and Manglik Dosha calculations honor sacred astrological compatibility alongside personal lifestyle preferences.</p>
    </div>
    <div class="p-6 bg-pink-50 rounded-2xl border border-pink-100">
        <h4 class="font-bold text-pink-800 text-lg mb-2">Global Nepali Diaspora</h4>
        <p class="text-sm text-slate-600">Empowering thousands of Nepali professionals across Kathmandu, Pokhara, Sydney, Melbourne, Dallas, London, Toronto, and Tokyo to find lifelong partners.</p>
    </div>
</div>

<h3>Why Thousands of Nepali Families Trust MeroZodi</h3>
<ul>
    <li><strong>Uncompromised Privacy:</strong> Control who views your phone number, photos, and horoscope. No unwanted calls or public exposure.</li>
    <li><strong>End-to-End Encrypted Video Dating:</strong> Get to know your match in private, high-definition 1-on-1 virtual date rooms from the comfort of your home.</li>
    <li><strong>Zero Fake Profiles Policy:</strong> Dedicated moderation team reviewing user reports 24/7 with instant suspension of misleading accounts.</li>
    <li><strong>Transparent Nepali Pricing:</strong> Seamlessly upgrade membership via official local gateways including eSewa, Khalti, Fonepay, and ConnectIPS.</li>
</ul>

<h3>Our Commitment to Your Sacred Journey</h3>
<p>Whether you are seeking a partner within your community or an open-minded companion who shares your worldview, MeroZodi provides a respectful, empowering environment to start your happily-ever-after.</p>
HTML
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact-us',
                'subtitle' => "Have questions or need matchmaking assistance? Our dedicated relationship team is here for you.",
                'banner_image' => 'images/contact-us-banner.png',
                'meta_title' => 'Contact MeroZodi - Member Support & Office Helpdesk',
                'meta_description' => 'Get in touch with MeroZodi customer support, relationship managers, and office helpdesk in Kathmandu, Nepal.',
                'is_published' => true,
                'contact_email' => 'support@merozodi.com',
                'contact_phone' => '+977-1-4567890',
                'contact_address' => 'Lazimpat, Kathmandu, Nepal',
                'content' => <<<HTML
<h2>Get in Touch with Our Team</h2>
<p>Whether you need help completing your KYC verification, have billing inquiries regarding subscription plans, or need personalized matchmaking guidance, our dedicated relationship managers are ready to assist you.</p>

<h3>Support Channels & Working Hours</h3>
<div class="my-6 grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200">
        <h4 class="font-bold text-slate-900 mb-2">Kathmandu Head Office</h4>
        <p class="text-sm text-slate-600">Lazimpat, Kathmandu, Nepal</p>
        <p class="text-sm text-slate-600 mt-2"><strong>Helpline:</strong> +977-1-4567890 / +977-9801234567<br><strong>Email:</strong> support@merozodi.com</p>
    </div>
    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200">
        <h4 class="font-bold text-slate-900 mb-2">Member Support Timings</h4>
        <p class="text-sm text-slate-600"><strong>Sunday – Friday:</strong> 9:00 AM – 6:00 PM (NPT)<br><strong>Saturday:</strong> Emergency Ticket Support Only</p>
        <p class="text-sm text-slate-600 mt-2"><strong>WhatsApp VIP Desk:</strong> +977-9801234567<br><strong>Response Time:</strong> Within 2–4 hours</p>
    </div>
</div>

<h3>Grievance & Privacy Inquiries</h3>
<p>If you encounter any suspicious activity, harassment, or profile impersonation, please immediately reach out to our Chief Grievance Officer at <code>grievance@merozodi.com</code> or use the in-app "Report Member" button for prioritized 1-hour investigation.</p>
HTML
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'subtitle' => "Your privacy, biodata, and personal communications are protected under strict security standards.",
                'banner_image' => 'images/privacy-policy-banner.png',
                'meta_title' => 'Privacy Policy & Data Security - MeroZodi',
                'meta_description' => 'Read how MeroZodi safeguards your personal profile, biodata, photographs, KYC documents, and chat messages.',
                'is_published' => true,
                'contact_email' => 'privacy@merozodi.com',
                'contact_phone' => '+977-1-4567890',
                'contact_address' => 'Lazimpat, Kathmandu, Nepal',
                'content' => <<<HTML
<div class="legal-section" id="introduction">
    <h2>1. Introduction & Scope</h2>
    <p>At MeroZodi (accessible at https://merozodi.com), we respect and protect the privacy of every individual who registers on our platform. This Privacy Policy details how we collect, use, store, and safeguard your personal information, matrimonial biodata, horoscope details, and communications.</p>
    <p>By accessing MeroZodi, creating a member profile, or utilizing any of our matchmaking features, you consent to the data collection and processing practices described in this document.</p>
</div>

<div class="legal-section" id="data-collected">
    <h2>2. Categories of Information We Collect</h2>
    <p>To provide a tailored, authentic matchmaking experience and safeguard our community from fraudulent actors, we collect the following categories of data:</p>
    <ul>
        <li><strong>Account Authentication Details:</strong> Full legal name, verified email address, mobile phone number, date of birth, gender, and cryptographic password hashes.</li>
        <li><strong>Matrimonial Biodata & Cultural Details:</strong> Religion, caste, sub-caste, mother tongue (Nepali, Newari, Maithili, etc.), height, weight, marital history, education qualifications, occupation, annual income brackets, current residential location, and family background details.</li>
        <li><strong>Astrological Parameters (Kundali & Gun Milan):</strong> Rashi (Moon Sign), Gotra, Manglik Dosha status, exact birth time, and birth coordinates. These are processed strictly to compute Vedic Ashtakoota compatibility scores.</li>
        <li><strong>Government Identity Documents (KYC):</strong> Scanned copies of citizenship certificate, passport, or national identity card submitted exclusively for verified badge authentication. KYC documents are stored in isolated encrypted vaults and are never exposed publicly or shared with other members.</li>
        <li><strong>In-App Interactions & Communications:</strong> Encrypted chat messages, photo attachments, voice/video call session timestamps, saved profile bookmarks, and connection request histories.</li>
    </ul>
</div>

<div class="legal-section" id="data-usage">
    <h2>3. How We Use Your Information</h2>
    <p>We process your data strictly for legitimate matrimonial matchmaking purposes, including:</p>
    <ul>
        <li>Generating intelligent partner compatibility recommendations based on mutual lifestyle, cultural, and astrological criteria.</li>
        <li>Verifying member identity to maintain a 100% genuine and safe matrimonial community.</li>
        <li>Processing secure subscription upgrades via licensed digital wallet payment gateways (eSewa, Khalti, Fonepay, ConnectIPS).</li>
        <li>Delivering real-time communication alerts, connection requests, and profile activity updates.</li>
        <li>Investigating member reports, policy violations, and unauthorized account access.</li>
    </ul>

    <div class="info-box">
        <p><strong>Zero Advertising Data Sales:</strong> MeroZodi does NOT sell, rent, trade, or monetize your personal profile, contact information, or matrimonial biodata to third-party advertisers or commercial brokers under any circumstances.</p>
    </div>
</div>

<div class="legal-section" id="privacy-controls">
    <h2>4. Member Privacy & Visibility Controls</h2>
    <p>We believe every member should have absolute sovereignty over their personal visibility:</p>
    <ul>
        <li><strong>Phone Number Masking:</strong> Your mobile number is hidden by default and is only revealed to connected members who have sent a request that you have explicitly accepted.</li>
        <li><strong>Photo Gallery Privacy:</strong> You can configure your photo gallery visibility to "Public to all members", "Verified members only", or "Upon accepted request only".</li>
        <li><strong>Profile Hide & Incognito:</strong> You may pause, hide, or deactivate your profile temporarily from the Dashboard whenever you wish to pause matchmaking.</li>
    </ul>
</div>

<div class="legal-section" id="security-measures">
    <h2>5. Data Security & Storage Architecture</h2>
    <p>We implement bank-grade security protocols to protect your sensitive records:</p>
    <ul>
        <li>End-to-end 256-bit Transport Layer Security (TLS/SSL) encryption across all web and mobile API requests.</li>
        <li>Industry-standard Bcrypt password hashing and multi-layer database encryption for sensitive KYC data.</li>
        <li>Automated security monitoring for suspicious login anomalies and rate-limited API protection.</li>
    </ul>
</div>

<div class="legal-section" id="account-deletion">
    <h2>6. Right to Erasure & Account Deletion</h2>
    <p>You have the absolute right to delete your profile and request permanent erasure of your personal data at any time:</p>
    <p>You can initiate account termination directly from your <strong>Dashboard &gt; Settings</strong> or by emailing our Data Protection Officer at <code>privacy@merozodi.com</code>. Upon verification, all your profile details, KYC documents, uploaded photographs, and chat archives will be permanently purged from our primary database within 48 hours.</p>
</div>

<div class="legal-section" id="contact-dpo">
    <h2>7. Data Protection Officer & Grievance Contact</h2>
    <p>If you have any questions, grievances, or inquiries regarding your data rights or this Privacy Policy, please contact our legal desk:</p>
    <ul>
        <li><strong>Email:</strong> <code>privacy@merozodi.com</code></li>
        <li><strong>Helpline:</strong> +977-1-4567890 / +977-9801234567</li>
        <li><strong>Physical Address:</strong> MeroZodi Legal Desk, Lazimpat, Kathmandu, Nepal</li>
    </ul>
</div>
HTML
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => 'terms-and-conditions',
                'subtitle' => "Please review the terms and community standards governing the use of MeroZodi matrimonial services.",
                'banner_image' => 'images/terms-conditions-banner.png',
                'meta_title' => 'Terms & Conditions of Service - MeroZodi',
                'meta_description' => 'Review the official Terms of Service, member eligibility requirements, and code of conduct for MeroZodi.',
                'is_published' => true,
                'contact_email' => 'legal@merozodi.com',
                'contact_phone' => '+977-1-4567890',
                'contact_address' => 'Lazimpat, Kathmandu, Nepal',
                'content' => <<<HTML
<div class="legal-section" id="acceptance">
    <h2>1. Acceptance of Agreement</h2>
    <p>Welcome to MeroZodi. This document constitutes a legally binding agreement between you ("Member", "User", or "You") and MeroZodi Matrimonial Services ("MeroZodi", "We", "Our", or "Us").</p>
    <p>By creating an account, browsing profiles, submitting KYC documents, or purchasing premium subscriptions on MeroZodi, you acknowledge that you have read, understood, and agreed to be bound by these Terms & Conditions in their entirety.</p>
</div>

<div class="legal-section" id="eligibility">
    <h2>2. Eligibility & Registration Criteria</h2>
    <p>To register as a member of MeroZodi or use our matchmaking services, you must satisfy all of the following statutory and policy requirements:</p>
    <ul>
        <li><strong>Legal Marriageable Age:</strong> You must be of legal marriageable age according to the laws of Nepal and your country of residence (minimum 20 years of age for men and women in Nepal under the National Civil Code Act 2074, or 18+ where legally applicable internationally).</li>
        <li><strong>Marital Status:</strong> You must be legally single, divorced, widowed, or legally separated. Individuals who are currently married under active marital contracts are strictly prohibited from creating accounts.</li>
        <li><strong>Authentic Matrimonial Intent:</strong> MeroZodi is strictly dedicated to genuine matchmaking and long-term marital alliances. The platform may NOT be used for casual dating, commercial escort services, unsolicited advertising, or financial solicitation.</li>
        <li><strong>Single Profile Policy:</strong> Each individual is permitted to maintain only one active profile. Multiple duplicate accounts created by the same person will be suspended immediately.</li>
    </ul>

    <div class="highlight-box">
        <p><strong>Strict Verification Notice:</strong> Creating a fake profile, using another individual's photographs without written consent, or falsifying your marital status constitutes fraud and will result in immediate permanent banning and potential referral to cyber law enforcement agencies.</p>
    </div>
</div>

<div class="legal-section" id="conduct">
    <h2>3. Member Code of Conduct & Zero Harassment Policy</h2>
    <p>MeroZodi is founded on mutual dignity, cultural respect, and safety. All members agree to uphold the following community standards:</p>
    <ul>
        <li><strong>Respectful Communication:</strong> You must treat every member with courtesy and respect. Any transmission of offensive, sexually explicit, abusive, threatening, or defamatory text, voice messages, or imagery is strictly prohibited.</li>
        <li><strong>No Financial Solicitation:</strong> You must never request loans, money transfers, cryptocurrency payments, or commercial investments from any member on the platform.</li>
        <li><strong>Privacy Protection:</strong> You must not screenshot, screen-record, copy, or distribute another member's photographs, biodata, chat transcripts, or video call sessions to external websites or social media platforms without express written consent.</li>
        <li><strong>Reporting Violations:</strong> Members are encouraged to use the in-app "Report Profile" feature to flag suspicious or disrespectful behavior. Our safety team investigates every report within 2–4 hours.</li>
    </ul>
</div>

<div class="legal-section" id="kyc">
    <h2>4. KYC Verification & Profile Authenticity</h2>
    <p>To maintain a trusted community, MeroZodi operates a comprehensive identity auditing framework:</p>
    <ul>
        <li>MeroZodi reserves the right to request proof of identity, age, address, and single marital status at any time via government-issued documents (Citizenship Certificate, Passport, Voter ID, or National ID Card).</li>
        <li>Verified badges (<span class="text-rose-600 font-bold"><i class="fa-solid fa-circle-check"></i> Verified Member</span>) are granted solely after manual review by our security compliance officers.</li>
        <li>Failure to provide requested verification documentation or submitting forged records will lead to immediate account termination without refund.</li>
    </ul>
</div>

<div class="legal-section" id="subscriptions">
    <h2>5. Membership Subscriptions, Payments & Digital Refunds</h2>
    <p>MeroZodi offers both free registration and premium paid subscription tiers (Silver, Gold, Platinum):</p>
    <ul>
        <li><strong>Feature Activation:</strong> Paid memberships unlock advanced features including direct contact phone number access, unlimited encrypted chat, video call dating rooms, Kundali Gun Milan deep-dive reports, and prioritized profile listing.</li>
        <li><strong>Official Payment Gateways:</strong> Membership fees in Nepalese Rupees (NPR) are processed securely through licensed digital wallets and banking switches including <strong>eSewa ePay</strong>, <strong>Khalti</strong>, <strong>Fonepay</strong>, and <strong>ConnectIPS</strong>.</li>
        <li><strong>Instant Activation & Non-Refundable Policy:</strong> Because premium memberships grant immediate, full digital access to matchmaking contact directories and communication tools, subscription fees are <strong>strictly non-refundable</strong> once the plan has been activated, except in cases of verified duplicate billing errors.</li>
    </ul>

    <div class="info-box">
        <p><strong>Digital Wallet Security:</strong> MeroZodi does not store your wallet PINs, bank passwords, or debit card CVVs. All transactions are securely handled directly on the encrypted portals of eSewa, Khalti, Fonepay, or ConnectIPS.</p>
    </div>
</div>

<div class="legal-section" id="disclaimer">
    <h2>6. Matchmaking Disclaimer & User Due Diligence</h2>
    <p>While MeroZodi exercises diligence in moderating profiles and conducting KYC identity checks, members understand and agree to the following:</p>
    <ul>
        <li><strong>No Outcome Guarantee:</strong> Matrimony is a personal, mutual life decision. MeroZodi provides a platform to discover and connect with prospective partners but does not guarantee marriage results, compatibility success, or partner availability.</li>
        <li><strong>Independent Verification Required:</strong> MeroZodi cannot verify the complete moral character, family history, medical background, or financial standing of individual users. Members and their families are strongly urged to conduct independent due diligence, family background inquiries, and face-to-face meetings in safe, public environments before finalizing matrimonial alliances.</li>
    </ul>
</div>

<div class="legal-section" id="termination">
    <h2>7. Account Suspension & Termination</h2>
    <p>MeroZodi reserves the right, in its sole discretion, to suspend, deactivate, or permanently terminate any member account without prior notice if:</p>
    <ul>
        <li>You breach any provision of these Terms & Conditions or our Privacy Policy.</li>
        <li>Multiple credible complaints or abuse reports are submitted against your profile.</li>
        <li>You engage in fraudulent, defamatory, or unlawful activities on or off the platform.</li>
    </ul>
</div>

<div class="legal-section" id="jurisdiction">
    <h2>8. Governing Law & Dispute Resolution</h2>
    <p>These Terms shall be governed by, interpreted, and enforced in accordance with the laws of <strong>Nepal</strong>, including the Electronic Transactions Act 2063 and the National Civil Code Act 2074.</p>
    <p>Any dispute, claim, or legal action arising out of or in connection with the use of MeroZodi shall be submitted to the exclusive jurisdiction of the competent courts located in <strong>Kathmandu, Nepal</strong>.</p>
</div>

<div class="legal-section" id="contact-legal">
    <h2>9. Legal Inquiries & Official Notices</h2>
    <p>For any formal legal notices, questions regarding this agreement, or policy clarifications, please reach out to our Legal Affairs Department:</p>
    <ul>
        <li><strong>Legal Counsel Email:</strong> <code>legal@merozodi.com</code></li>
        <li><strong>Support Desk:</strong> <code>support@merozodi.com</code></li>
        <li><strong>Helpline:</strong> +977-1-4567890 / +977-9801234567 (Sun–Fri, 9:00 AM – 6:00 PM NPT)</li>
        <li><strong>Office Address:</strong> MeroZodi Matrimony, Lazimpat, Kathmandu, Nepal</li>
    </ul>
</div>
HTML
            ],
        ];

        foreach ($pages as $p) {
            Page::updateOrCreate(
                ['slug' => $p['slug']],
                $p
            );
        }
    }
}
