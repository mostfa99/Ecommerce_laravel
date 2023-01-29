<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    // Relation 1  to 1
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
    public function ratings()
    {
        // relationships with rating
        return $this->morphMany(Rating::class , 'rateable','rateable_type','rateable_id','id');
    }
}