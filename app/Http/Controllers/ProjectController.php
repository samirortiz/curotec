<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Services\ProjectService;


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
        //
        return view('projects.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

        /**
     * Store a newly created resource in storage.
     */
    public function save(StoreProjectRequest $request)
    {
        try {
            if ($this->projectService->store($request->validated())) {
                $request->session()->flash('status', 'Project created!');
            }
        } catch (\Throwable $th) {
            $request->session()->flash('status', 'Error creating project! '.$th->getMessage());
        }
        return redirect('home');
    }

}
