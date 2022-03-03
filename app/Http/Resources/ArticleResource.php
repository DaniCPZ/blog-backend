<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
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
            $this->mergeWhen($this->description, function () {
                return [
                    'description' => $this->description,
                    'small_description' => Str::limit(strip_tags($this->description), 80),
                ];
            }),
            'id' => $this->id,
            'image_url' => $this->imageUrl(),
            'slug' => $this->when($this->slug, $this->slug),
            'title' => $this->title,
            $this->mergeWhen($this->created_at, function () {
                return [
                    'created_at_for_human' => $this->created_at->diffForHumans(),
                    'created_date' => $this->created_at->format('M d, Y'),
                ];
            }),
        ];
    }
}
