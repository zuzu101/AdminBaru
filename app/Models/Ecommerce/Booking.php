<?php

namespace App\Models\Ecommerce;

use App\Models\MasterData\Talent;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'prices' => 'array',
        'is_paid' => 'boolean',
        'has_content' => 'boolean'
    ];

    protected static function booted()
    {
        static::creating(function ($booking) {
            $latestId = self::max('id') ?? 0;
            $nextNumber = str_pad($latestId + 1, 4, '0', STR_PAD_LEFT);
            $booking->code = 'BT-' . now()->format('dmY') . '-' . $nextNumber;
        });
    }

    public function getCreatedAtFormatAttribute()
    {
        return Carbon::parse($this->created_at)->format('d / m / Y');
    }

    public function getDateFormatAttribute()
    {
        return Carbon::parse($this->date)->format('d / m / Y');
    }

    public function getTimeFormatAttribute()
    {
        return Carbon::parse($this->time)->format('H:i');
    }

    public function getDurationTotalAttribute()
    {
        return $this->duration . ' Jam';
    }

    public function getTotalPaymentFormatAttribute()
    {
        return number_format($this->total_payment, 0, ',', '.');
    }

    public function getIsPaidLabelAttribute()
    {
        return $this->is_paid ?
        '<div class="badge badge-success" style="font-size:16px">Lunas</div>' :
        '<div class="badge badge-danger" style="font-size:16px">Belum Lunas</div>';
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['prices'] = $value->toJson();
    }

    public function talent()
    {
        return $this->belongsTo(Talent::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function bookingContact()
    {
        return $this->hasOne(BookingContact::class);
    }

    public function bookingInformation()
    {
        return $this->hasOne(BookingInformation::class);
    }
}
