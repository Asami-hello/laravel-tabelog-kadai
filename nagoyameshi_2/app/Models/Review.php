<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Review extends Model
{
    use HasFactory, Sortable;

    public function stores() {
        return $this->belongsTo(Store::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }


}
