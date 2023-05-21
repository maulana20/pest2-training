<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CustomResourceCollection extends AnonymousResourceCollection
{
    function paginationInformation($request, $paginated, $default)
    {
        return [
            'total'    => $paginated['total'],
            'per_page' => $paginated['per_page'],
            'page'     => $paginated['current_page'],
        ];
    }
}