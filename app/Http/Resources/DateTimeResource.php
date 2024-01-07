<?php

namespace App\Http\Resources;

use Carbon\CarbonInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DateTimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'human' => $this->diffForHumans(),
            'date_time' => $this->toDateTimeString(),
            'human_short' => $this->diffForHumans(now(), CarbonInterface::DIFF_RELATIVE_TO_NOW, true),
        ];
    }
}
