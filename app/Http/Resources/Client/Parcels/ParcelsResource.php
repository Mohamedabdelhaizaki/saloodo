<?php

namespace App\Http\Resources\Client\Parcels;

use Illuminate\Http\Resources\Json\JsonResource;

class ParcelsResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'address_from' => (strlen($this->address_from) > 20) ? substr($this->address_from, 0, 20) . ' ...' : $this->address_from,
            'address_to' => (strlen($this->address_to) > 20) ? substr($this->address_to, 0, 20) . ' ...' : $this->address_to,
            'picked_at' => $this->picked_at,
            'delivered_at' => $this->delivered_at,
            'status' => $this->status,
            'show_route' => route('client.parcels.show', $this->id),
            'edit_route' => route('client.parcels.edit', $this->id),
            'created_at' => $this->created_at,
        ];
    }
}
