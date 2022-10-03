<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class BookRecommendationResource extends JsonResource
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
            'images' => ImageResource::collection($this->whenLoaded('images')),
            $this->merge(Arr::except(parent::toArray($request), [
                'user_id', 'genre_id', 'featured_image_id', 'created_at', 'updated_at', 'deleted_at',
            ]))
        ];
    }
}
