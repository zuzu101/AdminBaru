<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceRepair extends Model
{
    use HasFactory;

    protected $table = 'device_repairs';
    protected $guarded = ['id'];
    
    protected $fillable = [
        'pelanggan_id',
        'brand',
        'model', 
        'reported_issue',
        'serial_number',
        'technician_note',
        'status',
        'price',
        'complete_in'
    ];

    // Cast attributes to appropriate types
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'complete_in' => 'date',
        'price' => 'decimal:2'
    ];

    // Relationship
    public function pelanggan()
    {
        return $this->belongsTo(\App\Models\Cms\Pelanggan::class, 'pelanggan_id');
    }
}
