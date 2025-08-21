<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Check pelanggan data
$pelanggan = App\Models\Cms\Pelanggan::first();
if ($pelanggan) {
    echo "Pelanggan columns:\n";
    print_r($pelanggan->getAttributes());
    echo "\n\nPelanggan table columns:\n";
    $columns = DB::select('SHOW COLUMNS FROM pelanggan');
    foreach($columns as $column) {
        echo $column->Field . "\n";
    }
}

// Check device repair with pelanggan
$deviceRepair = App\Models\Cms\DeviceRepair::with('pelanggan')->first();
if ($deviceRepair && $deviceRepair->pelanggan) {
    echo "\n\nDevice Repair with Pelanggan:\n";
    echo "Device ID: " . $deviceRepair->id . "\n";
    echo "Pelanggan Name: " . $deviceRepair->pelanggan->name . "\n";
    print_r($deviceRepair->pelanggan->getAttributes());
}
