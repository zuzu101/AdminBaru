<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
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
        'technician_note'
    ];

    // Cast attributes to appropriate types
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship
    public function pelanggan()
    {
        return $this->belongsTo(\App\Models\Cms\Pelanggan::class, 'pelanggan_id');
    }
}
