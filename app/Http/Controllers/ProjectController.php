<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Services\ProjectService;
use App\Models\Project;

class ProjectController extends Controller
{

    public function __construct(private ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('projects.show', ['project' => Project::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::find($id);
        return view('projects.edit', ['project' => $project]);
    }

        /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        try {
            if ($this->projectService->store($request->validated())) {
                $request->session()->flash('status', 'Project created!');
            }
        } catch (\Throwable $th) {
            $request->session()->flash('error', 'Error creating project! '.$th->getMessage());
        }
        return redirect('home');
    }

    /**
     * Update a resource in storage.
     */
    public function update(StoreProjectRequest $request, string $id)
    {
        try {
            if ($this->projectService->update($request->validated(), $id)) {
                $request->session()->flash('status', 'Project updated!');
            }
        } catch (\Throwable $th) {
            $request->session()->flash('error', 'Error updating project! '.$th->getMessage());
        }
        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            if ($this->projectService->destroy($id)) {
                request()->session()->flash('status', 'Project deleted!');
            }
        } catch (\Throwable $th) {
            request()->session()->flash('error', 'Error deleting project! '.$th->getMessage());
        }
        return redirect('home');
    }

}
