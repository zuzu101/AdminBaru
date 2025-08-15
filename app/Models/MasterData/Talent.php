<?php

namespace App\Models\MasterData;

use App\Models\Ecommerce\Booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Talent extends Authenticatable
{
    use HasFactory;

    public const STATUS_PENDING = 'Pending';
    public const STATUS_REVIEW = 'Review';
    public const STATUS_APPROVED = 'Approved';
    public const STATUS_REJECTED = 'Rejected';

    protected $table = 'talents';

    protected $guarded = ['id'];

    protected $hidden = [
        'password'
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::title($value);
    }

    public function setIntroductionLinkAttribute($value)
    {
        parse_str(parse_url($value, PHP_URL_QUERY), $queryParams);
        $videoId = $queryParams['v'] ?? null;

        if ($videoId) {
            // Generate the embed link
            $embedLink = "https://www.youtube.com/embed/" . $videoId;
        } else {
            $embedLink = null;
        }

        $this->attributes['introduction_link'] = $embedLink;
    }

    public function talentEducation()
    {
        return $this->hasOne(TalentEducation::class);
    }

    public function talentPhotos()
    {
        return $this->hasMany(TalentPhoto::class);
    }

    public function talentPrices()
    {
        return $this->hasMany(TalentPrice::class);
    }

    public function talentSpotlights()
    {
        return $this->hasMany(TalentSpotlight::class);
    }

    public function talentRatings()
    {
        return $this->hasMany(TalentRating::class);
    }

    public function talentArts()
    {
        return $this->belongsToMany(ArtCategory::class, 'talent_art', 'talent_id', 'art_category_id')
                    ->using(TalentArt::class);
    }

    public function talentContents()
    {
        return $this->hasMany(TalentContent::class);
    }

    public function talentProfessionals()
    {
        return $this->belongsToMany(ProfessionalCategory::class,  'talent_professionals', 'talent_id', 'professional_category_id')
                    ->using(TalentProfessional::class);
    }

    public function talentWorkExperiences()
    {
        return $this->hasMany(TalentWorkExperience::class);
    }

    public function talentExperiences()
    {
        return $this->hasMany(TalentExperience::class);
    }

    public function talentPortfolios()
    {
        return $this->hasMany(TalentPortfolio::class);
    }

    public function talentRate()
    {
        return $this->hasOne(TalentRate::class);
    }

    public function ratingCount()
    {
        $ratings = $this->talentRatings->where('status', true)->pluck('rating')->toArray();

        if(empty($ratings)) {
            return 'Belum ada rating';
        }

        $average = array_sum($ratings) / count($ratings);

        return min($average, 5);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_talent');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
