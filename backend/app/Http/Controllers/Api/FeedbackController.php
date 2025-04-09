<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFeedbackRequest;
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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $feedback = $this->service->getAllFeedback();

        return response()->json($feedback);
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
