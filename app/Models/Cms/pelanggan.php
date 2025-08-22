<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';
    protected $guarded = ['id'];
    
    // Tambahkan fillable untuk field bahasa Inggris dan Indonesia
    protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'no_hp',
        'address', 
        'alamat',
        'status'
    ];

    // Relationship - hasOne device repair
    public function deviceRepair()
    {
        return $this->hasOne(\App\Models\Cms\DeviceRepair::class, 'pelanggan_id');
    }
}
