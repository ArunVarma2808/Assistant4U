<?php

namespace Database\Seeders;

use App\Models\AvailableJob;
use App\Models\Region;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserJob;
use App\Models\UserJobLocation;
use Carbon\Carbon;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Storage;
use Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'phone'=> '3427543383',
                'password' => Hash::make('123456'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        $staffs = [
            [
                'name'=> 'Hentry Jack',
                'email'=> 'staff1@gmail.com',
                'phone'=> '2365550198',
                'is_subscribed' => true,
                'subscription_expires_at' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s'),
                'subscribed_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Oliver James',
                'email'=> 'staff2@gmail.com',
                'phone'=> '2045550134',
                'is_subscribed' => true,
                'subscription_expires_at' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s'),
                'subscribed_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'William Evans',
                'email'=> 'staff3@gmail.com',
                'phone'=> '2895550102',
                'is_subscribed' => false,
                'subscription_expires_at' => Carbon::now()->addDays(-20)->format('Y-m-d H:i:s'),
                'subscribed_at' => Carbon::now()->addDays(-50)->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Brown Smith',
                'email'=> 'staff4@gmail.com',
                'phone'=> '3065550176',
                'is_subscribed' => false,
                'subscription_expires_at' => Carbon::now()->addDays(-10)->format('Y-m-d H:i:s'),
                'subscribed_at' => Carbon::now()->addDays(-40)->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Adam Anderson',
                'email'=> 'staff5@gmail.com',
                'phone'=> '3435550145',
                'is_subscribed' => true,
                'subscription_expires_at' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s'),
                'subscribed_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        foreach ($staffs as $key => $staff) {
            $user = User::create([
                'name' => $staff['name'],
                'phone' => $staff['phone'],
                'email' => $staff['email'],
                'password' => Hash::make('123456'),
                'is_subscribed' => $staff['is_subscribed'],
                'subscription_expires_at' => $staff['subscription_expires_at'],
                'role' => 'staff',
            ]);

            $sourcePath = public_path('backend/dummy.pdf'); // absolute path to the file
            $randomName = Str::random(40) . '.pdf'; // random string with .png extension
            $destinationPath = 'job_license/' . $randomName;

            if (file_exists($sourcePath)) {
                Storage::disk('public')->put($destinationPath, file_get_contents($sourcePath));
            }
            
            $job = AvailableJob::inRandomOrder()->first();
            $region = Region::inRandomOrder()->first();

            UserJob::create([
                'user_id' => $user->id,
                'job_id' => $job->id,
                'license' => $destinationPath,
                'service_charge' => mt_rand(25, 90),
            ]);

            UserJobLocation::create([
                'user_id' => $user->id,
                'province_id' => $region->province_id,
                'region_id' => $region->id,
            ]);

            Transaction::create([
                'user_id' => $user->id,
                'amount' => 25,
                'transaction_date' => Carbon::now()
            ]);

            $admin->update([
                'balance' => $admin->balance + 25
            ]);
        }

        User::create([
            'name' => ucwords('John Devies'),
            'phone' => '3422435576',
            'email' => 'customer1@gmail.com',
            'password' => Hash::make('123456'),
        ]);
        
        User::create([
            'name' => ucwords('Salva John'),
            'phone' => '2264338960',
            'email' => 'customer2@gmail.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
