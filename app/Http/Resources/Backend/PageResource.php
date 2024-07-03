<?php

namespace App\Http\Resources\Backend;

use App\Http\Resources\BaseResource;
use Illuminate\Support\Carbon;

class PageResource extends BaseResource
{
   /**
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array
    */
   public function toArray($request)
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
      ];
   }
}
