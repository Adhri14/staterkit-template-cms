<?php

namespace App\Http\Resources\Backend;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'discount' => $this->discount,
            'stock' => $this->stock,
            'created_at'=> $this->created_at ? $this->created_at->format('d/m/Y H:i:s') : null ,
            'updated_at'=> $this->updated_at ? $this->updated_at->format('d/m/Y H:i:s') : null,
        ];
    }
}
