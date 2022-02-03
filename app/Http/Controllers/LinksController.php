<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompressLinkRequest;
use App\Models\Link;
use App\Services\Links\LinksService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class LinksController extends Controller
{
    private LinksService $service;

    public function __construct(LinksService $service)
    {
        $this->service = $service;
    }

    public function compress(CompressLinkRequest $request): JsonResponse
    {
        try {
            return response()->json([
                'status' => true,
                'shortlink' => $this->service->compress($request->input('link'))
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function open($code)
    {
        try {
            $link = Link::whereCode($code)->firstOrFail();
            return Redirect::to($link->url);
        } catch (ModelNotFoundException | \Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            return abort(404);
        }
    }
}
