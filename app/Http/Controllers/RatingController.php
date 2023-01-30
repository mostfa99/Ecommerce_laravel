<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Profile;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{


    public function store(Request $request ,$type)
    {
        $request->validate([
            'rating' => 'required|int|min:1|max:5',
            // to maunal
            // 'id' => 'required|int|exists:products,id',
            'id' => 'required|int',
        ]);

        // add autamaticly to store data & i will add path class in database

        if ($type == 'product') {
            $mdoel = Product::find($request->post('id'));
        } else if($type == 'profile')
        {
            $mdoel = Profile::find($request->post('id'));
        }else {
            abort(404);
        }

        $rating = $mdoel->ratings()->create([
            'rating' => $request->post('rating'),
        ]);

        // add maunal to store data & i will add path class in database

        /* $rating= Rating::create([
            //'rateable_type' => Product::class,
            'rateable_type' => Profile::class,
            'rateable_id' => $request->post('id'),
            'rating' => $request->post('rating'),
        ]);*/

        return $rating;
    }


    public function show($id)
    {
        //
    }

}