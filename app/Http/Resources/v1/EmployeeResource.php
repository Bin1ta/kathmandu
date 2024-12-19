<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'name' => $this->name ?? '',
            'department' => $this->department ?? '',
            'designation' => $this->designation ?? '',
            'photo' => $this->photo_url ?? '',
            'phone' => $this->phone ?? '',
            'is_employee'=>$this->is_employee ?? ''
        ];
    }
}
