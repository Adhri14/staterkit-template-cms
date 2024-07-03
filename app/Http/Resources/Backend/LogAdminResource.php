<?php

namespace App\Http\Resources\Backend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LogAdminResource extends JsonResource
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
            'admin' => AdministratorResource::make($this->admin),
            'ip_address' => $this->ip_address,
            'module' => $this->module,
            'action' => $this->action,
            'subject' => $this->subject,
            'method' => $this->method,
            'module_changes' => $this->module_changes,
            'url' => $this->url,
            'agent' => $this->agent,
            'login_at' => $this->login_at ? Carbon::parse($this->login_at)->format('d/m/Y H:i:s') : null,
            'logout_at' => $this->logout_at ? Carbon::parse($this->logout_at)->format('d/m/Y H:i:s') : null,
            'created_at' => $this->created_at ? Carbon::parse($this->created_at)->format('d/m/Y H:i:s') : null,
      ];
    }
}
