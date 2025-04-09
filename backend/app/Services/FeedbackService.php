<?php

namespace App\Services;

use App\Repositories\FeedbackRepository;
use App\Models\Feedback;

class FeedbackService
{

    public function __construct(protected FeedbackRepository $repository)
    {
    }

    /**
     * Get all feedback.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllFeedback()
    {
        return $this->repository->getAll();
    }

    /**
     * Store feedback.
     *
     * @param array $data
     * @return Feedback
     */
    public function storeFeedback(array $data)
    {
        return $this->repository->create($data);
    }

    public function stats()
    {
        return $this->repository->getFeedbackStats();
    }
}
