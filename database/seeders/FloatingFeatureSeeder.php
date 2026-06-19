<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FloatingFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Generate referral codes for existing users
        $users = User::all();
        foreach ($users as $user) {
            if (empty($user->referral_code)) {
                $user->referral_code = User::generateReferralCode($user->username ?? $user->name);
                // Also give them some mock starting earnings/referral count to make the dashboard look populated and premium!
                if ($user->role === 'user') {
                    $user->referral_balance = 120.00;
                }
                $user->save();
            }
        }

        // 2. Seed blog posts
        $blogs = [
            [
                'title' => '5 Smart Grocery Hacks for College Students',
                'slug' => '5-smart-grocery-hacks-for-college-students',
                'category' => 'Student Life',
                'author' => 'Grace Mensah (Nutritionist)',
                'image' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=600&q=80',
                'content' => '
<p class="mb-4">Living on campus comes with a lot of freedom, but it also means managing your own meals and budget. For many students, grocery shopping can quickly drain their wallets. Here are 5 smart grocery hacks to shop smart, eat healthy, and save money using Smart Groceries (SG).</p>

<h3 class="text-xl font-bold mt-6 mb-2 text-brand">1. Plan Your Meals Around Weekly Sales</h3>
<p class="mb-4">Never go grocery shopping unprepared. Check the SG home page for ongoing banners, active discounts, and brand deals before making your shopping list. Planning meals around discounted vegetables and staples like rice, beans, or oats can save you up to 30% weekly.</p>

<h3 class="text-xl font-bold mt-6 mb-2 text-brand">2. Buy House Brands and Staples in Bulk</h3>
<p class="mb-4">Basic dry ingredients like rice, pasta, oats, and flour have an extremely long shelf life. Pooling money with roommates to buy these in bulk on Smart Groceries is much cheaper than buying individual small packs every week.</p>

<h3 class="text-xl font-bold mt-6 mb-2 text-brand">3. Never Shop Hungry</h3>
<p class="mb-4">It is a scientific fact: shopping on an empty stomach leads to impulse buys of snacks and soft drinks. Shop on the SG app right after lunch so you stick to your list of essentials.</p>

<h3 class="text-xl font-bold mt-6 mb-2 text-brand">4. Opt for Frozen Vegetables</h3>
<p class="mb-4">Fresh veggies can spoil quickly if you get busy with lectures and exams. Frozen spinach, peas, and mixed veggies preserve all their nutrients and last for months in your dorm fridge, reducing waste.</p>

<h3 class="text-xl font-bold mt-6 mb-2 text-brand">5. Use the SG Affiliate Program to Earn Back</h3>
<p class="mb-4">Did you know you can earn by sharing Smart Groceries with friends? Send your unique referral link to classmates. When they place their first order, you earn commissions that you can withdraw directly or use to pay for your next batch of groceries!</p>
                '
            ],
            [
                'title' => 'A Student\'s Guide to Healthy Eating on a Budget',
                'slug' => 'students-guide-to-healthy-eating-on-a-budget',
                'category' => 'Health & Wellness',
                'author' => 'Dr. Sophia Adams (MD)',
                'image' => 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?auto=format&fit=crop&w=600&q=80',
                'content' => '
<p class="mb-4">Juggling assignments, exams, and social life can make eating healthy a major challenge. Many college students default to instant noodles and fast food, which leads to energy crashes and the infamous "freshman fifteen." Eating nutritious, balanced meals does not have to be expensive.</p>

<h3 class="text-xl font-bold mt-6 mb-2 text-brand">Understanding the Campus Plate</h3>
<p class="mb-4">A healthy student diet should balance three core components: complex carbohydrates (for steady brain energy), lean proteins (for muscle and cell repair), and plenty of vitamins from fresh fruits and vegetables.</p>

<h3 class="text-xl font-bold mt-6 mb-2 text-brand">Affordable Protein Sources</h3>
<ul class="list-disc pl-6 mb-4 space-y-2">
    <li><strong>Eggs:</strong> The ultimate budget protein. Versatile, quick to cook, and packed with vitamins.</li>
    <li><strong>Canned Beans & Chickpeas:</strong> Long-lasting, high in fiber, and perfect for salads or rice bowls.</li>
    <li><strong>Greek Yogurt:</strong> Great for breakfast or snacks, aiding digestion and gut health.</li>
</ul>

<h3 class="text-xl font-bold mt-6 mb-2 text-brand">Meal Prep Tips for Exam Week</h3>
<p class="mb-4">Do not cook every single day. Dedicate 2 hours on Sunday to prep containers of brown rice, grilled chicken breast or tofu, and roasted vegetables. Store them in the fridge, and you will have healthy, instant meals ready to microwave during busy lecture days.</p>

<p class="mb-4">If you ever need personalized advice on nutrition, meal planning, or campus wellness, click the <strong>Connect to an Expert</strong> tab in our sidebar and book a session with our registered dieticians!</p>
                '
            ],
            [
                'title' => 'Earning on Campus: How the SG Affiliate Program Works',
                'slug' => 'earning-on-campus-sg-affiliate-program',
                'category' => 'Finance',
                'author' => 'Smart Groceries Marketing',
                'image' => 'https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?auto=format&fit=crop&w=600&q=80',
                'content' => '
<p class="mb-4">Looking for a side hustle that fits around your classes? The Smart Groceries (SG) Affiliate Program is designed specifically for students to earn extra cash by promoting a service every student needs: grocery delivery!</p>

<h3 class="text-xl font-bold mt-6 mb-2 text-brand">How It Works (3 Easy Steps)</h3>
<ol class="list-decimal pl-6 mb-4 space-y-2">
    <li><strong>Get Your Link:</strong> Open the SG floating panel, navigate to the Affiliate tab, and copy your unique referral link.</li>
    <li><strong>Share:</strong> Share your link with friends, roommates, and department WhatsApp groups. You can also place it in your social media bios.</li>
    <li><strong>Get Paid:</strong> When someone registers using your link and completes their first grocery purchase, a commission is instantly credited to your affiliate wallet!</li>
</ol>

<h3 class="text-xl font-bold mt-6 mb-2 text-brand">Withdrawals Made Simple</h3>
<p class="mb-4">Once your balance reaches a minimum of Gh 50.00, you can request a cashout directly from the affiliate panel. We support instant withdrawals via Mobile Money (MoMo) and bank transfer. Payouts are reviewed and sent out every Friday.</p>

<h3 class="text-xl font-bold mt-6 mb-2 text-brand">Top Promotion Tips for Students</h3>
<ul class="list-disc pl-6 mb-4 space-y-2">
    <li><strong>Host a Cooking Session:</strong> Cook a meal prep batch with friends, show them the fresh ingredients, and tell them you got it all on SG using a referral code.</li>
    <li><strong>Share Banner Graphics:</strong> Use our ready-made promotion banners in your WhatsApp statuses.</li>
    <li><strong>Target Freshers:</strong> New students moving to campus are always looking for easy ways to stock their dorms. Let them know they get fast delivery right to their hostels!</li>
</ul>
                '
            ],
        ];

        foreach ($blogs as $blog) {
            BlogPost::updateOrCreate(
                ['slug' => $blog['slug']],
                $blog
            );
        }
    }
}
