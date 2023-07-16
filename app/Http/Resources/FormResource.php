<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Arr;

class FormResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $expires_at  = Arr::get($this->expires_at, 'date');
        return [
            'id' => $this->id ?? 0,
            'user' => new UserResource($this->whenLoaded('user')), // UserResource can control the exposed user data
            'title' => $this->title ?? '',
            'slug' => $this->slug ?? '',
            'submission_limit' => $this->submission_limit ?? 0,
            'allow_notifications' => $this->allow_notifications ?? false,
            'published' => $this->published ?? false,
            'published_at' => $this->published_at ?? '',
            'expires_at' => $expires_at ?? '',
            'elements' => $this->elements ?? [],
        ];
    }
}
