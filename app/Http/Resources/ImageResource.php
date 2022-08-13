<?php

namespace App\Http\Resources;

use App\Models\Image;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ImageResource extends JsonResource
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
            'path' => config('app.test_domain', 'api.book-management.test:8000').'/storage/images/'.$this->path,
            $this->merge(Arr::except(parent::toArray($request), [
                'created_at', 'updated_at', 'resource_type', 'resource_id'
            ]))
        ];
    }
}
