<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
}
