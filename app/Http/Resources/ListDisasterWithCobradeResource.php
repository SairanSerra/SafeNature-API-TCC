<?php

namespace App\Http\Resources;

use App\Utils\CalculateDistanceByLatLong;
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
        $calculateDistance = new CalculateDistanceByLatLong();
        $cobrade = $this->cobrade;
        return [
            'id'                    => $this->id,
            'latitude'              => $this->latitude,
            'longitude'             => $this->longitude,
            'cobradeId'             => $cobrade->cobrade,
            'cobradeType'           => $cobrade->type,
            'cobradeDescription'    => $cobrade->description,
            'city'                  => $this->city,
            'state'                 => $this->state,
            'distance'              => $request->latitude && $request->longitude ?
                                       $calculateDistance->index($request->latitude, $request->longitude, $this->latitude,  $this->longitude)
                                       : 'Localização não informado'
        ];
    }
}
