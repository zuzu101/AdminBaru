<?php

namespace Database\Seeders;

use App\Models\MasterData\ProfessionalCategory;
use Illuminate\Database\Seeder;

class ProfessionalCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProfessionalCategory::insert([
            ['name' => 'Animator'],
            ['name' => 'Penulis/Kreator Konten'],
            ['name' => 'Sutradara/Produser'],
        ]);
    }
}
