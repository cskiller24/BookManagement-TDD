<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GenreResource extends JsonResource
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
            'image' => ImageResource::make($this->whenLoaded('image')),
            'books' => BookResource::collection($this->when($this->books, $this->books)),
            $this->merge(parent::toArray($request)),
        ];
    }
}
