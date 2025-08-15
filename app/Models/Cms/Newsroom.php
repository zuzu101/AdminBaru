<?php

namespace App\Models\Cms;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Newsroom extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getDateCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->format('d / m / Y');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }
}
