<?php

namespace App\Contracts;
use Illuminate\Database\Eloquent\Builder;

interface PipelineProcessInterface
{
    public function handle(Builder $builder, Array $task);
}