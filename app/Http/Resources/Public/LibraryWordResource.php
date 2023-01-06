<?php

namespace App\Http\Resources\Public;

use Illuminate\Http\Resources\Json\JsonResource;

class LibraryWordResource extends JsonResource
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
            'word' => $this->word,
            'meaning' => $this->meaning,
        ];
    }
}
