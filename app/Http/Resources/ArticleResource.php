<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'source' => $this->source,
            'source_id' => $this->source_id,
            'section' => $this->section,
            'published_at' => $this->published_at,
            'title' => $this->title,
            'web_url' => $this->web_url,
            'api_url' => $this->api_url,
        ];

    }
}
