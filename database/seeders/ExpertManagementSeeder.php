<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExpertCategory;
use App\Models\Expert;
use App\Models\HealthTip;

class ExpertManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Seed Categories
        $categories = [
            [
                'name' => 'Dietician',
                'code' => 'MD',
                'badge_style' => 'success',
                'icon' => '🥦',
            ],
            [
                'name' => 'Naturopathy',
                'code' => 'Naturopathy',
                'badge_style' => 'info',
                'icon' => '🌿',
            ],
            [
                'name' => 'Doctor',
                'code' => 'General',
                'badge_style' => 'warning',
                'icon' => '🩺',
            ],
            [
                'name' => 'Dentist',
                'code' => 'Dentist',
                'badge_style' => 'danger',
                'icon' => '🦷',
            ]
        ];

        $catModels = [];
        foreach ($categories as $cat) {
            $catModels[$cat['code']] = ExpertCategory::updateOrCreate(
                ['code' => $cat['code']],
                $cat
            );
        }

        // 2. Seed Experts
        $experts = [
            [
                'expert_category_id' => $catModels['MD']->id,
                'name' => 'Dr. Sophia Adams',
                'initials' => 'SA',
                'specialty_description' => 'Expert on customized student meal prepping, dietary constraints, healthy eating, and budget plans.',
                'availability_schedule' => json_encode(['days' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'], 'start_time' => '14:00', 'end_time' => '17:00']),
                'whatsapp_number' => '233240000000',
                'whatsapp_message' => 'Hi Dr. Sophia, I am chatting via Smart Groceries to consult about healthy eating.',
                'avatar_bg_color' => '#e6f7ef',
                'avatar_text_color' => '#2e8b5e',
                'is_active' => true,
            ],
            [
                'expert_category_id' => $catModels['Naturopathy']->id,
                'name' => 'Dr. Ryan Cole',
                'initials' => 'RC',
                'specialty_description' => 'Holistic wellness consults, herbal remedies, sleep regulation, and study stress management.',
                'availability_schedule' => json_encode(['days' => ['Tue', 'Thu'], 'start_time' => '10:00', 'end_time' => '12:00']),
                'whatsapp_number' => '233240000000',
                'whatsapp_message' => 'Hi Dr. Ryan Cole, I am chatting via Smart Groceries regarding natural stress management.',
                'avatar_bg_color' => '#e6f6f7',
                'avatar_text_color' => '#2e888b',
                'is_active' => true,
            ],
            [
                'expert_category_id' => $catModels['General']->id,
                'name' => 'Dr. Lisa Evans',
                'initials' => 'LE',
                'specialty_description' => 'Everyday medical checkups, health concerns, fatigue reviews, and clinical referrals.',
                'availability_schedule' => json_encode(['days' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'], 'start_time' => '09:00', 'end_time' => '16:00']),
                'whatsapp_number' => '233240000000',
                'whatsapp_message' => 'Hi Dr. Lisa Evans, I am chatting via Smart Groceries regarding general health concerns.',
                'avatar_bg_color' => '#eef2f6',
                'avatar_text_color' => '#4a5568',
                'is_active' => true,
            ],
            [
                'expert_category_id' => $catModels['Dentist']->id,
                'name' => 'Dr. Marcus Vance',
                'initials' => 'MV',
                'specialty_description' => 'Oral hygiene advice, sensitivity reviews, whitening tips, and dental checkups.',
                'availability_schedule' => json_encode(['days' => ['Wed'], 'start_time' => '13:00', 'end_time' => '16:00']),
                'whatsapp_number' => '233240000000',
                'whatsapp_message' => 'Hi Dr. Marcus Vance, I am chatting via Smart Groceries regarding dental hygiene.',
                'avatar_bg_color' => '#ebf4ff',
                'avatar_text_color' => '#2b6cb0',
                'is_active' => true,
            ]
        ];

        foreach ($experts as $expert) {
            Expert::updateOrCreate(
                ['name' => $expert['name']],
                $expert
            );
        }

        // 3. Seed Health Tips
        $tips = [
            [
                'title' => 'Balanced College Diet Hacks',
                'type_slug' => 'nutrition',
                'icon' => '🥗',
                'content' => '<p style="font-weight: 700; color: #2d3748; margin-bottom: 8px;">Eating healthy on campus does not need to cost a fortune. Here are quick medical dietician tips:</p>
<ul style="margin: 0; padding-left: 18px; list-style-type: disc; display: flex; flex-direction: column; gap: 8px;">
    <li><strong>Start with Oats:</strong> High fiber, very cheap, keeps you full for hours. Perfect breakfast.</li>
    <li><strong>Include Local Legumes:</strong> Beans and cowpeas are cheap but excellent protein sources.</li>
    <li><strong>Frozen is Fine:</strong> Frozen vegetables retain vitamins and do not rot, reducing food waste in hostel mini-fridges.</li>
    <li><strong>Hydrate:</strong> Fatigue is often dehydration. Keep a reusable bottle.</li>
</ul>'
            ],
            [
                'title' => 'Exam Stress Management Tips',
                'type_slug' => 'stress',
                'icon' => '🧠',
                'content' => '<p style="font-weight: 700; color: #2d3748; margin-bottom: 8px;">Our Naturopathy Experts recommend natural lifestyle adaptogens to reduce anxiety:</p>
<ul style="margin: 0; padding-left: 18px; list-style-type: disc; display: flex; flex-direction: column; gap: 8px;">
    <li><strong>Herbal Infusions:</strong> Drink chamomile or peppermint tea before bed to improve sleep depth.</li>
    <li><strong>Box Breathing:</strong> Breathe in for 4 seconds, hold for 4, breathe out for 4, hold for 4. Repeat 5 times during studies.</li>
    <li><strong>Physical Grounding:</strong> Take a 10-minute walk on grass without shoes or simply sit in green spaces to reduce cortisol levels.</li>
    <li><strong>Avoid Late Caffeine:</strong> Coffee after 4 PM disrupts sleep cycles, raising next-day exam anxiety.</li>
</ul>'
            ]
        ];

        foreach ($tips as $tip) {
            HealthTip::updateOrCreate(
                ['type_slug' => $tip['type_slug']],
                $tip
            );
        }
    }
}
