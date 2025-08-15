<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalentContent extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function talent()
    {
        return $this->belongsTo(Talent::class);
    }
}
