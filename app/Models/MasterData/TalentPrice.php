<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TalentPrice extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function talent()
    {
        return $this->belongsTo(Talent::class);
    }

    public function getFormatPriceAttribute()
    {
        return number_format($this->price, 0, ',', '.');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::title($value);
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = str_replace('.', '', $value);
    }
}
