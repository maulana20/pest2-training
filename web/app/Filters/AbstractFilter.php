<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use App\Traits\Methodable;

abstract class AbstractFilter
{
    use Methodable;
    
    public function __construct(
        protected Builder $builder
    ) {}

    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;
        foreach ($this->getFilters() as $name => $value) {
            if (method_exists($this, $name)) {
                $this->$name($value);
            }
        }
        return $this->builder;
    }
}