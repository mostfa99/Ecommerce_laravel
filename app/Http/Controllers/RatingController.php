<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{


    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|int|min=1|max=5',
            'id' => 'required|int|exists:products,id',
        ]);

       $rating= Rating::create([
            'reteable_type' => Prodcut::class,
            'reteable_id' => $request->post('id'),
            'rating' => $request->post('rating'),
        ]);
        return $rating;
    }


    public function show($id)
    {
        //
    }

}
