<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    public function price($price): Builder
    {
        list($min, $max) = explode(",", $price);
        return $this->builder->where('price', '>=', $min)
            ->where('price', '<=', $max);
    }

    public function category($categorySlug): Builder
    {
        return $this->builder->whereHas('category', function ($query) use ($categorySlug) {
            $query->where('slug', $categorySlug);
        });
    }

    public function brand($brandSlug): Builder
    {
        return $this->builder->whereHas('brand', function ($query) use ($brandSlug) {
            $query->where('slug', $brandSlug);
        });
    }
}