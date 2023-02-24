<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken as sanctumPersonalAccessToken;

class PersonalAccessToken extends sanctumPersonalAccessToken
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'token',
        'abilities',
        'ip',
        'expires_at',
    ];

    protected static function booted()
    {
        parent::booted();

        static::creating(function ($model) {
            $model->ip = request()->ip();
        });
    }
}
