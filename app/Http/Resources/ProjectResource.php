<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->project_id,
            'name' => $this->name,
            'tagline' => $this->tagline,
            'is_featured' => (bool)$this->is_featured,
            'description' => $this->short_description ?? $this->description,
            'tech_stack' => $this->tech_stack,
            'details' => $this->details,
            'urls' => [
                'live' => $this->live_url,
                'repository' => $this->repo_url,
            ]
        ];
    }
}
