<?php

namespace App\Http\Services;

use App\Http\Resources\ProjectCollection;
use App\Models\Project;

class ProjectService {

    public function list(?string $filter, ?string $sortBy = 'id', ?string $sortDirection = 'asc'): ProjectCollection
    {
        $records = Project::query()
            ->when($filter, function($query) use ($filter) {
                $query->where('name', 'like', '%'.$filter.'%')
                    ->orWhere('description', 'like', '%'.$filter.'%');
            })
            ->orderBy($sortBy, $sortDirection)->simplePaginate(10);

        $records->appends(['filter' => $filter, 'sortBy' => $sortBy, 'sortDirection' => $sortDirection]);

        return new ProjectCollection($records);
    }

    public function store(array $projectData): Project
    {

    }

}
