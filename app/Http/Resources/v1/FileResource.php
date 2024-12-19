<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'file_name' => $this->file_name ?? '',
            'file' => $this->file_url ?? '',
            'extension' => $this->extension ?? ''
        ];
    }
}
