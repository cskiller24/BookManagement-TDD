<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use phpDocumentor\Reflection\Types\Parent_;

class BookResource extends JsonResource
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
            'user' => UserResource::make($this->whenLoaded('user')),
            'genre' => GenreResource::make($this->whenLoaded('genre')),
            'featured_image' => ImageResource::make($this->whenLoaded('featuredImage')),
            'images' => ImageResource::collection($this->whenLoaded('images')),
            $this->merge(Arr::except(parent::toArray($request), [
                'user_id', 'genre_id', 'featured_image_id', 'created_at', 'updated_at', 'deleted_at',
            ]))
        ];
    }
}
