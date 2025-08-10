<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'currency_symbol', 'description' => 'Symbol used for the currency (e.g., $, €, ₹)','value' => 'C$'],
            ['key' => 'currency_code', 'description' => 'Three-letter ISO code for the currency (e.g., USD, EUR, INR)','value' => 'CAD'],
            ['key' => 'subscription_amount', 'description' => 'Default amount charged for a subscription','value' => '25'],
            ['key' => 'subscription_period', 'description' => 'Subscription duration in days','value' => '30'],
            ['key' => 'country_dialing_code', 'description' => 'Default country dialing code for phone numbers','value' => '+1'],
        ];

        foreach ($settings as $key => $value) {
            Setting::create($value);
        }
    }
}
