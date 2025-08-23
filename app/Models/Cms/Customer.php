<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the device repairs for this customer
     */
    public function deviceRepairs()
    {
        return $this->hasMany(DeviceRepair::class, 'customer_id');
    }
}
