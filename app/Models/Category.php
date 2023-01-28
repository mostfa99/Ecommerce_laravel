<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    const CREATED_AT ='created_at';
    const UPDATED_AT ='updated_at';

    protected $connection ='mysql';
    protected $table ='categories';
    protected $primaryKey ='id';
    protected $keyType ='int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable =[
        'name','parent_id','descraption','status','slug',
    ];

    // Accessors
    //Exitsit Attribute get(AttributeName)Attribute
    // $model->name
    Public function getNameAttribute($value){
        if ($this->trashed()){
            return $value . '(deleted)';
        }
        return $value;

    }
    // non exists Attribute
    // $model->original_name
    public function getOriginalNameAttribute()
    {
        return $this->attributes['name'];
    }

// Relation 1 to many
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id','id');
    }
// Relation many to many
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id','id');
    }

// Relation many to many
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id','id')->withDefault([
            'name' => 'Not Parent',
        ]);
    }



}