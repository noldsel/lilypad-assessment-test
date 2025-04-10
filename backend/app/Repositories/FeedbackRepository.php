<?php

namespace App\Repositories;

use App\Models\Feedback;

class FeedbackRepository
{
    /**
     * Get all feedback records.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Feedback::all();
    }

    public function getAllPaginated(int $perPage = 10, int $offset)
    {
        return Feedback::orderBy('created_at', 'desc')
            ->skip($offset)
            ->take($perPage)
            ->get();
    }

    public function getTotalFeedbackCount()
    {
        return Feedback::count();
    }

    /**
     * Create a new feedback record.
     *
     * @param array $data
     * @return Feedback
     */
    public function create(array $data)
    {
        return Feedback::create($data);
    }

    public function getFeedbackStats(): array
    {
        $average = Feedback::avg('rating');

        $counts = Feedback::selectRaw('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->pluck('count', 'rating');

        $ratings = collect(range(1, 5))->mapWithKeys(function ($rating) use ($counts) {
            return [$rating => $counts->get($rating, 0)];
        });

        $totalRatings = Feedback::count();


        return [
            'average_rating' => round($average, 2),
            'ratings_count' => $ratings,
            'total_ratings' => $totalRatings,
        ];
    }
}
