<?php

namespace App\Models\MasterData;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalentRating extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function talent()
    {
        return $this->belongsTo(Talent::class);
    }

    public function getTimeAgoAttribute()
    {
        if($this->created_at) {
            return $this->created_at->diffForHumans();
        } else {
            return '';
        }
    }

    public function getStarsAttribute()
    {
        $stars = $this->rating;

        $labelStars = '';
        for ($i=0; $i < $stars; $i++) {
            $labelStars .= '<i class="fas fa-star mr-1 color-primary"></i>';
        }

        return $labelStars;
    }

    public function getStatusBadgeAttribute()
    {
        $status = $this->status;

        $labelStatus = '';
        if($status) {
            $labelStatus = '<span class="badge badge-success">Aktif</span>';
        } else {
            $labelStatus = '<span class="badge badge-danger">Tidak Aktif</span>';
        }

        return $labelStatus;
    }
}
