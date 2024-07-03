<?php

namespace App\Http\Resources\Backend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LogUserResource extends JsonResource
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
            'user' => UserResource::make($this->user),
            'ip_address' => $this->ip_address,
            'module' => $this->module,
            'action' => $this->action,
            'activity' => $this->activity,
            'method' => $this->method,
            'module_changes' => $this->module_changes,
            'url' => $this->url,
            'agent' => $this->agent,
            'created_at' => $this->created_at ? Carbon::parse($this->created_at)->format('d/m/Y H:i:s') : null,
        ];
    }
}
