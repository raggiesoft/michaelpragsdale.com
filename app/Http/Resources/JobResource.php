<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'company' => $this->company,
            'location' => $this->location,
            'period' => $this->period,
            'roles' => $this->roles,
            'categories' => explode(' ', $this->categories),
        ];
    }
}
