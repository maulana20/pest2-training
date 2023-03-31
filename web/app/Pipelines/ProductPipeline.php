<?php

namespace App\Pipelines;

use Illuminate\Database\Eloquent\Builder;

class ProductPipeline extends AbstractPipeline
{
    public function price($builder, $next): Builder
    {
        list($min, $max) = explode(",", request()->price);
        $builder->where('price', '>=', $min)
            ->where('price', '<=', $max);
        return $next($builder);
    }

    public function category($builder, $next): Builder
    {
        $categorySlug = request()->category;
        $builder->whereHas('category', function ($builder) use ($categorySlug) {
            $builder->where('slug', $categorySlug);
        });
        return $next($builder);
    }

    public function brand($builder, $next): Builder
    {
        $brandSlug = request()->brand;
        $builder->whereHas('brand', function ($query) use ($brandSlug) {
            $query->where('slug', $brandSlug);
        });
        return $next($builder);
    }
}