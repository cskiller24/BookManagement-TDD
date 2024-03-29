<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

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
            'path' => sprintf('http://%s:%s/storage/images/%s',
                config('app.test_domain', 'api.book-management.test'),
                config('app.test_port', 8000),
                $this->path
            ),
            $this->merge(Arr::except(parent::toArray($request), [
                'created_at', 'updated_at', 'resource_type', 'resource_id'
            ]))
        ];
    }
}
