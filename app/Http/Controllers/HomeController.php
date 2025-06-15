<?php

namespace App\Http\Controllers;

use App\Http\Services\ProjectService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(ProjectService $projectService)
    {
        return view('home', ['projects' => $projectService->list('', 'id', 'desc')]);
    }
}
