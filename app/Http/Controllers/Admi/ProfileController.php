<?php

namespace App\Http\Controllers\Admi;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function show( Profile $profile)
    {

        // SELECT * FROM rating WHERE rateable_id = ? 5 AND rateable_type = 'App\Models\Profile'
        return $profile->ratings;


    }
}