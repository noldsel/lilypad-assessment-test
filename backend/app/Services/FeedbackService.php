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
    public function getAllFeedback(array $params)
    {
        $currentPage = $params['page'] ?? 1;
        $perPage = $params['perPage'] ?? 10;

        $offset = ($currentPage - 1) * $perPage;

        $feedbacks =  $this->repository->getAllPaginated( $perPage, $offset);
        $totalFeedbackCount = $this->repository->getTotalFeedbackCount();
        $totalPages = ceil($totalFeedbackCount / $perPage);

        return collect([
            'data' => $feedbacks,
            'current_page' => $currentPage,
            'per_page' => $perPage,
            'total_pages' => $totalPages,
            'total_feedback_count' => $totalFeedbackCount
        ]);
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
