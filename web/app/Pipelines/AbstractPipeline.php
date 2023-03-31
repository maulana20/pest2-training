<?php

namespace App\Pipelines;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Pipeline;
use App\Traits\Methodable;

abstract class AbstractPipeline
{
    use Methodable;

    public function getMethods(): array
    {
        $methods = [];
        foreach ($this->getFilters() as $name => $value) {
            if (method_exists($this, $name)) {
                array_push($methods, [$this, $name]);
            }
        }
        return $methods;
    }

    public function handle(Builder $builder): mixed
    {
        return Pipeline::send($builder)
            ->through($this->getMethods())
            ->thenReturn();
    }
}