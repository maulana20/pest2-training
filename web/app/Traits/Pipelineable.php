<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Pipelineable
{
	public function scopePipeline(Builder $query, $pipeline): Builder
    {
    	return $pipeline->handle($query);
    }    
}