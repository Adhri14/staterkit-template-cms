<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
         'parent_id' => $this->parent_id,
         'title' => $this->title,
         'subtitle' => $this->subtitle,
         'slug' => $this->slug,
         'summary' => $this->summary,
         'description' => $this->description,
         'banners'=> $this->banners,
         'buttons'=> $this->buttons,
         'contents'=> $this->contents,
         'options'=> $this->options,
         'sections'=> $this->sections,
         'meta'=> $this->meta ?? [
             'title' => null,
             'image' => null,
             'description' => null,
          ],
         'images' => $this->images ,
         'type' => $this->type,
         'position' => $this->position,
         'template' => $this->template,
         'featured'=> $this->featured ,
         'created_at'=> $this->created_at ? $this->created_at->format('d/m/Y H:i:s') : null ,
         'updated_at'=> $this->updated_at ? $this->updated_at->format('d/m/Y H:i:s') : null,
         'published_at'=> $this->published_at ? Carbon::parse($this->published_at)->format('m/d/Y H:i:s') : null,
        ]
    }
}
