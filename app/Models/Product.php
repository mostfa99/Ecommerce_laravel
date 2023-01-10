<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    const STATUS_ACTIVE ='active';
    const STATUS_DRAFT ='draft';

    protected $fillable =[
        'name','slug','image_path','descraption','status','price','sale_price',
        'quantity','weight','hight','length','width','category_id',
    ];
    public static function validateRules()
    {
        return [
                'name'=> 'required|max:255',
                'category_id' => 'required|int|exists:categories,id',
                'descraption' => 'min:5|nullable',
                'image' => 'nullable|image|dimensions:min_width=300,min_height=300',
                'price' => 'nullable|numeric|min:0',
                'sale_price' => 'nullable|numeric|min:0',
                'quantity' => 'nullable|numeric|min:0',
                'sku' => 'nullable|unique:products,sku',
                'weight' => 'nullable|numeric|min:0',
                'hight' => 'nullable|numeric|min:0',
                'length' => 'nullable|numeric|min:0',
                'width' => 'nullable|numeric|min:0',
                'status' => 'in:' .self::STATUS_ACTIVE .','.self::STATUS_DRAFT,

        ];

    }

}
