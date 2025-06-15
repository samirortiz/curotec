<?php

namespace App\Http\Services;

use App\Models\Project;
use Exception;
use Illuminate\Support\Facades\Log;

class ProjectService {

    /* List projects */
    public function list(?string $filter, ?string $sortBy, ?string $sortDirection)
    {
        try {
            $query = Project::query()
                ->when($filter, function($query) use ($filter) {
                    $query->where('name', 'like', '%'.$filter.'%')
                        ->orWhere('description', 'like', '%'.$filter.'%');
                })
                ->orderBy($sortBy, $sortDirection);

                // Remove pagination when using filter
                if ($filter) {
                    $records = $query->get();
                 } else {
                    $records = $query->simplePaginate(10);
                    $records->appends(['sortBy' => $sortBy, 'sortDirection' => $sortDirection]);
                 }
            return $records;
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
            throw new Exception($th->getMessage(), 422);
        }
    }

    /* Store project */
    public function store(array $projectData): Project
    {
        try {
            return Project::create($projectData);
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
            return $project->delete($project);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), 422);
        }
    }

}
