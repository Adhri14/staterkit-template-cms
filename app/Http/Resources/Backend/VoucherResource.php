<?php
namespace App\Http\Resources\Backend;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class VoucherResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'code' => $this->code,
            'type' => $this->type,
            'summary' => $this->summary,
            'value' => $this->value,
            'qty' => $this->qty,
            'published_at'=> $this->published_at ? Carbon::parse($this->published_at)->format('Y-m-d H:i') : null,
            'started_at'=> $this->started_at ? Carbon::parse($this->started_at)->format('Y-m-d H:i') : null,
            'ended_at'=> $this->ended_at ? Carbon::parse($this->ended_at)->format('Y-m-d H:i') : null,
      ];
    }
}
