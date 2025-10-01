<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'store_id',
        'reservation_id',
        'reservation_date',
        'reservation_time',
        'number_of_people',
        'note',
    ];

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getFormattedDateAttribute() {
        return \Carbon\Carbon::parse($this->reservation_date)->format('Y年n月j日');
    }

    public function getFormattedTimeAttribute() {
        return \Carbon\Carbon::parse($this->reservation_time)->format('G時i分');
    }

}
