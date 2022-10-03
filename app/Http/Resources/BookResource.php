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
            'featured_image' => ImageResource::make($this->whenLoaded('featuredImage'))->resource !== null
                                ? ImageResource::make($this->whenLoaded('featuredImage'))
                                : ImageResource::make($this->whenLoaded('images', $this->images->first())),
            'images' => ImageResource::collection($this->whenLoaded('images')),
            'reviews' => ReviewResource::collection($this->whenLoaded('reviews')),
            'recommendation' => $this->when($this->recommendation !== null, BookRecommendationResource::make($this->recommendation)),
            'average_review' => $this->when($this->average_review !== null, $this->roundToQuarters($this->average_review)),
            $this->merge(Arr::except(parent::toArray($request), [
                'user_id', 'genre_id', 'featured_image_id', 'created_at', 'updated_at', 'deleted_at',
            ]))
        ];
    }

    protected function addException($array)
    {
        return Arr::except($array, [
            'user_id', 'genre_id', 'featured_image_id', 'created_at', 'updated_at', 'deleted_at',
        ]);
    }

    protected function roundToQuarters($number)
    {
        $toReturn = $number * 4;
        $toReturn = floor($toReturn);
        return $toReturn / 4;
    }
}
