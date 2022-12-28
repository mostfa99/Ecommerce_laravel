<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Filter implements Rule
{
    //    Metho 2 for define rules but general rule
    protected $words;
    protected $filtered=[];// To define array words
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($words)
    {
        $this->words = $words;

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */

    public function passes($attribute, $value)
    {
    foreach ($this->words as $word){
        if (stripos($value , $word) !== false ){
            $this->filtered[] = $word;// To put all word in array
         // return fasle ;
        }
    }
         // return true;
            return empty($this->filtered) ;
        }

    /**
     * Get the validation error message.
     *
     * @return <string></string>
     */
    public function message()
    {
        // custome massage for wrong specific words
        return 'you cant use"'. implode(',', $this->filtered). '" word in your input.';// To display all words wrong in 'st1,st2,...etc'
    }
}