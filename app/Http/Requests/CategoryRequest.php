<?php

namespace App\Http\Requests;

use App\Rules\Filter;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // to can user يستدعي  this request reules
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            // Method 1
            //'name' => 'required|string|max:255|min:3',

    // Method 2 for use custome rules
                'name'=> [
                'required',
                'string',
                'max:255',
               ' min:3',
    // Metho 1 for define rules but specifeic rule
            // function ($attribute , $value ,$fail ){
            //     if(stripos($value ,'god' ) !== false ){
            //         $fail('you cant use "god" word in your input');
            //     }
            // }
            ],
                'parent_id' => 'required|int|exists:categories,id',//nullable
                'descraption' => [
                'min:5',
                'nullable',
    // we can call Metho #2 in Rule like this
                new Filter(['php','Laravel','xxx']),
            ],//nullable|min:5
                'status' => 'required|in:active,draft',
                'image' => 'image|max:521000|dimensions:min_width=300,min_height=300',
        ];
    }
    public function messages()
    {
// custome massage for wrong rules
        return [

            'required'=> 'هذا :attribute مطلوب',

        ];
    }
}
