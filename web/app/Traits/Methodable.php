<?php

namespace App\Traits;

use Illuminate\Support\Arr;
use ReflectionClass;
use ReflectionException;

trait Methodable
{
    protected function getFilterMethods(): array
    {
        $class = new ReflectionClass(static::class);

        return collect($class->getMethods())->filter(function ($method) use ($class) {
            return $method->class === $class->getName();
        })->map(function ($method) {
            return $method->name;
        })->filter()->all();
    }

    protected function getFilters(): array
    {
        return array_filter(Arr::only(request()->all(), $this->getFilterMethods()), function ($value) {
            return isset($value);
        });
    }
}