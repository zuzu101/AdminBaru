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
            // Create more realistic pelanggan
            $customerNames = [
                'Ahmad Wijaya', 'Siti Nurhaliza', 'Budi Santoso', 'Dewi Lestari', 'Eko Prasetyo',
                'Fitri Handayani', 'Gunawan Setiawan', 'Hani Permata', 'Indra Kusuma', 'Joko Widodo',
                'Kartini Sari', 'Lestari Wati', 'Muhammad Rizki', 'Nur Aini', 'Oka Pradana'
            ];
            
            foreach ($customerNames as $name) {
                \App\Models\Cms\Pelanggan::create([
                    'name' => $name,
                    'email' => strtolower(str_replace(' ', '.', $name)) . '@email.com',
                    'phone' => '08' . $faker->numerify('##########'),
                    'address' => $faker->streetAddress() . ', ' . $faker->city(),
                    'birth_date' => $faker->date(),
                    'gender' => $faker->randomElement(['male', 'female']),
                    'status' => 1
                ]);
            }
            $pelangganIds = \App\Models\Cms\Pelanggan::pluck('id')->toArray();
        }
        
        $brands = ['iPhone', 'Samsung', 'Xiaomi', 'Oppo', 'Vivo', 'Realme', 'Huawei', 'OnePlus'];
        $models = [
            'iPhone' => ['iPhone 13', 'iPhone 12', 'iPhone 11', 'iPhone SE', 'iPhone XR'],
            'Samsung' => ['Galaxy S23', 'Galaxy A54', 'Galaxy S22', 'Galaxy A34', 'Galaxy M54'],
            'Xiaomi' => ['Redmi Note 12', 'Mi 13', 'Redmi 12', 'POCO X5', 'Mi 12'],
            'Oppo' => ['A57', 'Reno8', 'A77', 'Find X5', 'A17'],
            'Vivo' => ['Y22', 'V25', 'Y35', 'X80', 'Y16'],
        ];
        
        $commonIssues = [
            'Layar pecah/retak',
            'Baterai cepat habis', 
            'Tidak bisa charging',
            'Speaker tidak bunyi',
            'Kamera tidak berfungsi',
            'Tombol power rusak',
            'Touchscreen tidak responsif',
            'Mati total',
            'Overheat/panas berlebih',
            'Sinyal lemah',
            'Wifi tidak connect',
            'Bluetooth error',
            'Hang/freeze sering',
            'Bootloop',
            'Water damage/kena air'
        ];

        $statuses = ['Perangkat Baru Masuk', 'Sedang Diperbaiki', 'Selesai'];
        $prices = [150000, 200000, 250000, 300000, 350000, 400000, 500000, 750000, 1000000, 1200000, 1500000];

        // Create repair data for last 3 months
        for ($i = 1; $i <= 120; $i++) {
            $brand = $faker->randomElement($brands);
            $model = isset($models[$brand]) ? $faker->randomElement($models[$brand]) : $brand . ' Model';
            $issue = $faker->randomElement($commonIssues);
            $status = $faker->randomElement($statuses);
            $createdAt = $faker->dateTimeBetween('-3 months', 'now');
            
            $repair = [
                'pelanggan_id' => $faker->randomElement($pelangganIds),
                'brand' => $brand,
                'model' => $model,
                'serial_number' => 'SN' . $faker->numerify('#######'),
                'reported_issue' => $issue,
                'technician_note' => $faker->boolean(80) ? 'Pengecekan ' . strtolower($issue) . '. ' . 
                    ($status == 'Selesai' ? 'Sudah diperbaiki dan berfungsi normal.' : 'Sedang dalam proses perbaikan.') : null,
                'status' => $status,
                'price' => $status == 'Selesai' ? $faker->randomElement($prices) : null,
                'complete_in' => $status == 'Selesai' ? $faker->dateTimeBetween($createdAt, 'now') : null,
                'nota_number' => 'NOTA-' . $createdAt->format('Ymd') . '-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
            
            DeviceRepair::create($repair);
        }
    }
}
