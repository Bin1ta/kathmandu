<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HeaderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title ?? '',
            'font' => $this->font ?? '',
            'font_size' => $this->font_size ?? '',
            'position' => $this->position ?? '',
            'font_color' => $this->font_color ?? '',
        ];
    }
}
