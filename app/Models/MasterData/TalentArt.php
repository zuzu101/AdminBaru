<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TalentArt extends Pivot
{
    use HasFactory;

    protected $guarded = ['id'];
}
