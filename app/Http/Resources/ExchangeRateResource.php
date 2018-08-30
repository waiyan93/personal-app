<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExchangeRateResource extends JsonResource
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
            'info' => $request->info,
            'description' => $request->description,
            'timestamp' => $request->timestamp,
            'rates' => $request->rates
        ];
    }
}
