<?php

namespace App\Traits;

trait Paginatable
{
    private $limit = 100;

    public function getPerPage()
    {
        return min(request('per_page', $this->perPage), $this->limit);
    }
}