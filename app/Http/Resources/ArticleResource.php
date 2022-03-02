<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'category_id' => $this->when($this->category_id, $this->category_id),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'description' => $this->when($this->description, $this->description),
            'id' => $this->id,
            'image_url' => $this->imageUrl(),
            'slug' => $this->when($this->slug, $this->slug),
            'title' => $this->title,
            'created_at_for_human' => $this->when($this->created_at, function () {
                return $this->created_at->diffForHumans();
            }),
        ];
    }
}
