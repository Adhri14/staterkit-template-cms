<?php

namespace App\Http\Resources\Backend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'order_code' => $this->order_code,
            'transaction_detail' => json_decode($this->transaction_detail),
            'type_transaction' => $this->type_transaction,
            'grand_total' => $this->grand_total,
            'cash' => $this->cash,
            'refund' => $this->refund,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}