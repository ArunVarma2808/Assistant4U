<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvincesAndRegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Alberta' => ['Calgary Region', 'Edmonton Capital Region', 'Central Alberta', 'Northern Alberta', 'Southern Alberta'],
            'British Columbia' => ['Lower Mainland', 'Okanagan', 'Vancouver Island', 'Thompson-Nicola', 'Cariboo'],
            'Manitoba' => ['Winnipeg Capital Region', 'Central Plains', 'Interlake', 'Westman', 'Northern Manitoba'],
            'New Brunswick' => ['Fundy Coast', 'River Valley', 'Acadian Coast', 'Northern New Brunswick'],
            'Newfoundland and Labrador' => ['Avalon Peninsula', 'Labrador', 'Central Newfoundland', 'Western Newfoundland'],
            'Nova Scotia' => ['Cape Breton', 'Halifax Metro', 'South Shore', 'Annapolis Valley'],
            'Ontario' => ['Greater Toronto Area', 'Eastern Ontario', 'Northern Ontario', 'Southwestern Ontario', 'Central Ontario'],
            'Prince Edward Island' => ['Prince County', 'Queens County', 'Kings County'],
            'Quebec' => ['Montreal Region', 'Quebec City Region', 'Estrie', 'Lanaudière', 'Laurentides', 'Outaouais'],
            'Saskatchewan' => ['Regina Region', 'Saskatoon Region', 'Northern Saskatchewan', 'Central Saskatchewan'],
            'Northwest Territories' => ['North Slave Region', 'South Slave Region', 'Dehcho Region', 'Sahtu Region', 'Beaufort Delta Region'],
            'Nunavut' => ['Qikiqtaaluk', 'Kivalliq', 'Kitikmeot'],
            'Yukon' => ['Whitehorse Area', 'Northern Yukon', 'Southern Lakes'],
        ];

        foreach ($data as $provinceName => $regions) {
            $province = Province::create([
                'name' => $provinceName
            ]);

            foreach ($regions as $regionName) {
                $province->regions()->create([
                    'name' => $regionName
                ]);
            }
        }
    }
}
