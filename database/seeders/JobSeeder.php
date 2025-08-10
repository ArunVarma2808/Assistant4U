<?php

namespace Database\Seeders;

use App\Models\AvailableJob;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = [
            'Carpenter',
            'Electrician',
            'Plumber',
            'Painter',
            'Mechanic',
            'Baby Sitter',
        ];

        foreach ($jobs as $key => $job) {
            AvailableJob::create([
                'name' => $job
            ]);
        }
    }
}
