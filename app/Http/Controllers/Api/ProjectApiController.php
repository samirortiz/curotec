<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Http\Services\ProjectService;
use Illuminate\Http\Request;


class ProjectApiController extends Controller
{

    public function __construct(private ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(FilterProjectRequest $request)
    {
        try {
            return ProjectResource::collection($this->projectService->list($request->filter, $request->sortBy, $request->sortDirection));
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 422);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        try {
            return new ProjectResource($this->projectService->store($request->validated()));
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
