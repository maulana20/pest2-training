<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
use App\Traits\Pipelineable;

class Product extends Model
{
    use HasFactory, Filterable, Pipelineable;

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }
}
