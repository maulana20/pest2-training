<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class ProductResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'     => $this->category,
            'slug'     => $this->slug,
            'category' => $this->category,
            'brand'    => $this->brand
        ];
    }
}
