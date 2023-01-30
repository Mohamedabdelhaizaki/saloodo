<?php

namespace App\Http\Resources\Api;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ParcelResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'address_from' =>  $this->address_from,
            'address_to' => $this->address_to,
            'picked_at' => $this->picked_at,
            'delivered_at' => $this->delivered_at,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
