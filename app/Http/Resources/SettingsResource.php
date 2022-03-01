<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
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
            'about_description' => $this->aboutDescription(),
            'about_image_url' => $this->imageUrl('about_image'),
            'address' => $this->address(),
            'contact_image_url' => $this->imageUrl('contact_image'),
            'email' => $this->email(),
            'google_map_url' => $this->googleMapUrl(),
            'hero_description' => $this->heroDescription(),
            'hero_image_url' => $this->imageUrl('hero_image'),
            'phone' => $this->phone(),
        ];
    }
}
