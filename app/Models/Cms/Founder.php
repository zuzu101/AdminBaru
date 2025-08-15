<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Founder extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::title($value);
    }

    public function setPositionAttribute($value)
    {
        $this->attributes['position'] = Str::title($value);
    }
}
