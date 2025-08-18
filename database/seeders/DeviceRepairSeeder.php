<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cms\DeviceRepair;
use Faker\Factory as Faker;

class DeviceRepairSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        // Get existing pelanggan IDs
        $pelangganIds = \App\Models\Cms\Pelanggan::pluck('id')->toArray();
        
        if (empty($pelangganIds)) {
            $this->command->info('No pelanggan found. Creating some pelanggan first...');
            // Create some pelanggan if none exist
            for ($i = 1; $i <= 10; $i++) {
                \App\Models\Cms\Pelanggan::create([
                    'name' => $faker->name(),
                    'email' => $faker->unique()->safeEmail(),
                    'phone' => $faker->phoneNumber(),
                    'address' => $faker->address(),
                    'birth_date' => $faker->date(),
                    'gender' => $faker->randomElement(['male', 'female']),
                    'status' => $faker->randomElement(['active', 'inactive'])
                ]);
            }
            $pelangganIds = \App\Models\Cms\Pelanggan::pluck('id')->toArray();
        }
        
        $brands = ['Asus', 'Acer', 'Lenovo', 'Dell', 'HP', 'MSI', 'Toshiba', 'Samsung', 'Apple'];
        $commonIssues = [
            'Screen not turning on',
            'Laptop overheating',
            'Battery not charging',
            'Keyboard keys not working',
            'Blue screen error',
            'Hard drive failure',
            'RAM issues',
            'Fan noise too loud',
            'WiFi connection problems',
            'USB ports not working',
            'Audio not working',
            'Slow performance',
            'Power button not responding',
            'Touchpad not working',
            'Display flickering'
        ];

        for ($i = 1; $i <= 50; $i++) {
            $brand = $faker->randomElement($brands);
            DeviceRepair::create([
                'pelanggan_id' => $faker->randomElement($pelangganIds),
                'brand' => $brand,
                'model' => $brand . ' ' . $faker->randomElement(['Inspiron', 'Pavilion', 'ThinkPad', 'VivoBook', 'Aspire']) . ' ' . $faker->numberBetween(3000, 9000),
                'reported_issue' => $faker->randomElement($commonIssues),
                'serial_number' => strtoupper($faker->bothify('??######')),
                'technician_note' => $faker->boolean(70) ? $faker->sentence(10) : null,
                'status' => 'Perangkat Baru Masuk',
                'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'updated_at' => $faker->dateTimeBetween('-6 months', 'now'),
            ]);
        }
    }
}
