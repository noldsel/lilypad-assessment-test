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
}
