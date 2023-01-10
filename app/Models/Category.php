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

}