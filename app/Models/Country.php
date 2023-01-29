<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    public function users(){
        return $this->HasMany(User::class);
    }
    public function products(){
        return $this->hasManyThrough(
            Product::class,
            User::class,
            'country_id',
            'user_id',
            'id',
            'id'
        );
    }

}