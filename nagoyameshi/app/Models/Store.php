<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Store extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'category_id',
        'store_name',
        'image',
        'store_description',
        'address',
        'postal_code',
        'tel',
        'business_hours',
        'holiday',
        'price',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function favorite_users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function reservation() {
        return $this->hasMany(Reservation::class);
    }
    
}
