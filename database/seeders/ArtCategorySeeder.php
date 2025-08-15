<?php

namespace Database\Seeders;

use App\Models\MasterData\ArtCategory;
use Illuminate\Database\Seeder;

class ArtCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ArtCategory::insert([
            ['name' => 'Penyanyi'],
            ['name' => 'Penari'],
            ['name' => 'Aktor/Aktris'],
            ['name' => 'Komedian'],
            ['name' => 'Model'],
            ['name' => 'Mc/Host'],
            ['name' => 'Musisi'],
        ]);
    }
}
