<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaginationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'meta' => [
                'total' => $this->total(),
                'currentPage' => $this->currentPage(),
                'lastPage' => $this->lastPage(),
                'perPage' => $this->perPage(),
            ],
            'links' => [
                'first' => $this->url(1),
                'last' => $this->url($this->lastPage()),
                'previous' => $this->previousPageUrl(),
                'next' => $this->nextPageUrl(),
            ],
        ];
    }
}
