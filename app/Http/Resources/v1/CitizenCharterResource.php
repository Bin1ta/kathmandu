<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CitizenCharterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'service' => $this->service ?? '',
            'required_document' => $this->required_document ?? '',
            'amount' => $this->amount ?? '',
            'time' => $this->time ?? '',
            'responsible_person' => $this->responsible_person ?? '',


        ];
    }
}
