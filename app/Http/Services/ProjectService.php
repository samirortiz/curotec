<?php

namespace App\Http\Services;

use App\Models\Project;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ProjectService {

    /* List projects */
    public function list(?string $filter, ?string $sortBy, ?string $sortDirection)
    {
        try {
            // Cache key composition
            $cacheKey = Project::CACHE_KEY.':page:'.request()->page.':filter:'.request()->filter.':sortBy:'.request()->sortBy.':sortDirection:'.request()->sortDirection;

            return Cache::remember($cacheKey, env('CACHE_TTL'), function() use ($filter, $sortBy, $sortDirection) {
                $query = Project::query()
                    ->when($filter, function($query) use ($filter) {
                        $query->where('name', 'like', '%'.$filter.'%')
                            ->orWhere('description', 'like', '%'.$filter.'%');
                    })
                    ->orderBy($sortBy, $sortDirection);

                // Don't use pagination when using filter by name or description
                if ($filter) {
                    $records = $query->get();
                 } else {
                    $records = $query->simplePaginate(10);
                    $records->appends(['sortBy' => $sortBy, 'sortDirection' => $sortDirection]);
                 }
                 return $records;
            });
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
            throw new Exception($th->getMessage(), 422);
        }
    }

    /* Store project */
    public function store(array $projectData): Project
    {
        try {
            $project= Project::create($projectData);
            Cache::flush();
            return $project;
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), 422);
        }
    }

    /* Update project */
    public function update(array $projectData, string $id): Project
    {
        try {
            $project = Project::find($id);
            $project->update($projectData);
            Cache:flush();
            return $project;
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), 422);
        }
    }

    /* Delete project */
    public function destroy(string $id): bool
    {
        try {
            $project = Project::find($id);
            Cache::flush();
            return $project->delete($project);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), 422);
        }
    }

    /* Show project */
    public function show(string $id): Project
    {
        try {
            return Project::find($id);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), 422);
        }
    }

}
