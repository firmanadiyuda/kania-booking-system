<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    use HasFactory;

    public function booking_lists(): HasMany
    {
        return $this->hasMany(BookingList::class);
    }

    public function kuitansis(): HasMany
    {
        return $this->hasMany(Kuitansi::class);
    }
}
