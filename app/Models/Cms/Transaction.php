<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'device_repairs';
    protected $guarded = ['id'];
    
    protected $fillable = 
    // every variable in database
    [
        'nota_number',
        'pelanggan_id',
        'email',
        'phone',
        'address',
        'brand',
        'model', 
        'reported_issue',
        'serial_number',
        'technician_note',
        'price',
        'status'
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
