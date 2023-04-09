<?php

namespace App\Services;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Pipeline;
use App\Contracts\PipelineProcessInterface;

class PipelineProcessService implements PipelineProcessInterface
{
    public function handle(Builder $builder, Array $tasks)
    {
        return Pipeline::send($builder)
            ->through($tasks)
            ->thenReturn();
    }
}