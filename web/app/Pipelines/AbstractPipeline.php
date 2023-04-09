<?php

namespace App\Pipelines;

use App\Traits\Methodable;
use App\Contracts\PipelineProcessInterface;

abstract class AbstractPipeline
{
    use Methodable;
    
    public function __construct(
        protected PipelineProcessInterface $process,
        protected $tasks = [])
    {
        collect($this->getFilters())->each(function ($value, $name) {
            if (method_exists($this, $name)) array_push($this->tasks, [$this, $name]);
        });
    }

    public function handle($builder)
    {
        return $this->process->handle(
            builder: $builder,
            tasks: $this->tasks
        );
    }
}