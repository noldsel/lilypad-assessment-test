<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\GetFeedbackRequest;

use App\Services\FeedbackService;
use App\Http\Resources\FeedbackStatsResource;

class FeedbackController extends Controller
{
    public function __construct(protected FeedbackService $service)
    {
        $this->service = $service;
    }

    /**
     * Get all feedback.
     *
     * @param GetFeedbackRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(GetFeedbackRequest $request)
    {
        $feedbacks = $this->service->getAllFeedback($request->validated());

        return response()->json($feedbacks);
    }

    /**
     * Store feedback.
     *
     * @param  StoreFeedbackRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFeedbackRequest $request)
    {

        $feedback = $this->service->storeFeedback($request->validated());

        return response()->json($feedback, Response::HTTP_CREATED);
    }

    public function stats()
    {
        $stats = $this->service->stats();
        return new FeedbackStatsResource($stats);
    }


}
