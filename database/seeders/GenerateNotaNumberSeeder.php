<?php

namespace Database\Seeders;

use App\Models\Cms\DeviceRepair;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenerateNotaNumberSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Generate nomor nota untuk data existing yang belum punya nomor nota
        $deviceRepairs = DeviceRepair::whereNull('nota_number')->get();
        
        foreach ($deviceRepairs as $deviceRepair) {
            $notaNumber = 'NOTA-' . date('Ym', strtotime($deviceRepair->created_at)) . '-' . str_pad($deviceRepair->id, 3, '0', STR_PAD_LEFT);
            $deviceRepair->updateQuietly(['nota_number' => $notaNumber]);
        }
        
        $this->command->info('Generated ' . count($deviceRepairs) . ' nota numbers for existing device repairs.');
    }
}
