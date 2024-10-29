<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ListDisasterWithCobradeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $cobrade = $this->cobrade;
        return [
            'id'                    => $this->id,
            'latitude'              => $this->latitude,
            'longitude'             => $this->longitude,
            'cobradeId'             => $cobrade->id,
            'cobradeType'           => $cobrade->type,
            'cobradeDescription'    => $cobrade->description,
            'city'                  => $this->city,
            'state'                 => $this->state
        ];
    }
}
