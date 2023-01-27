<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use NumberFormatter;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    const STATUS_ACTIVE ='active';
    const STATUS_DRAFT ='draft';

    protected $cats =[
        'price'=>'float',
        'quantity' => 'int',
        'creatd_at'=>'datetime',
    ];

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
                'image_path' => 'nullable|image|dimensions:min_width=300,min_height=300',
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

    // Accessors
    public function getImageUrlAttribute()
    {
        if(!$this->image_path){
            return asset('images/placeholder.png');
        }
        if(stripos($this->image_path,'http') === 0){
            return $this->image_path;
        }
            return asset('uploads/' . $this->image_path);
    }
    // Moutators
    public function setNameAttribute($value){
        $this->attributes['name'] = Str::title($value);
    }

    public function getFormattedPriceAttribute(){

        $formatter = new NumberFormatter(App::getLocale(), NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->price, 'USD');

    }
    public function category(){
        return $this->belongsTo(Category::class, 'category_id','id');
    }

}