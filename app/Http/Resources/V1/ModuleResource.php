<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResource extends JsonResource
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
            'title' => $this->module,
            'status' => $this->is_available ? 'available' : 'unavailable',
            'enrollment_stats' => [
                'current_students' => $this->active_students_count ?? 0,
                'capacity' => 10, // Hardcoded as per model constant, ideally fetched from config/model
                'spots_remaining' => 10 - ($this->active_students_count ?? 0),
            ],
            'teacher_count' => $this->teachers_count ?? 0,
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}
