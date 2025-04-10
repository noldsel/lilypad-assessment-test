<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackStatsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'average_rating' => round($this['average_rating'], 2),
            'ratings_count' => $this['ratings_count'],
            'total_ratings' => $this['total_ratings'],
        ];
    }
}
