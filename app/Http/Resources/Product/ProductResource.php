<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->detail,
            'totalPrice' => $this->price,
            'discountPrice' => round((1 - ($this->discount/100)) * $this->price, 2),
            'stock' => $this->stock == 0 ? 'Out of Stock' : $this->stock,
            'discount' => $this->discount,
            'rating' => $this->review->count() > 0 ? round($this->review->sum('star')/$this->review->count(), 2) : 'No Rating Yet',
            'href' => [
                'reviews' => route('reviews.index', $this->id)
            ]
        ];
    }
}
