<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //add this if yoou have added softdeletes in the migration table
    use SoftDeletes;

    protected $fillable = [
        "name",
        "description",
        "quantity",
        "category_id",
        "price",
        "status",
        "image",
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
