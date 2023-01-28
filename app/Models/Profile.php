<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profiles';

    // Relation 1  to 1
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
