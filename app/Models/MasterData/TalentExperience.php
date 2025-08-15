<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalentExperience extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function talent()
    {
        return $this->belongsTo(Talent::class);
    }

    public function setLinkAttribute($value)
    {
        parse_str(parse_url($value, PHP_URL_QUERY), $queryParams);
        $videoId = $queryParams['v'] ?? null;

        if ($videoId) {
            // Generate the embed link
            $embedLink = "https://www.youtube.com/embed/" . $videoId;
        } else {
            $embedLink = '-';
        }

        $this->attributes['link'] = $embedLink;
    }
}
