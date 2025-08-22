<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

use App\Models\Cms\Pelanggan;

// Update existing records to fill no_hp and alamat columns
$pelanggans = Pelanggan::all();

foreach ($pelanggans as $pelanggan) {
    $pelanggan->update([
        'no_hp' => $pelanggan->phone,
        'alamat' => $pelanggan->address
    ]);
}

echo "Updated " . $pelanggans->count() . " pelanggan records\n";
