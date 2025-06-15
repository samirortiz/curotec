@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Edit project') }}
                        <button style="float: right" type="button" class="btn btn-danger" onclick="location.href='{{ route('home') }}'">Back</button>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="projectId">Project ID</label>
                            <span class="form-control" id="projectId">{{ $project->id }}</span>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="projectName">Project name</label>
                            <span class="form-control" id="projectName">{{ $project->name }}</span>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="projectDescription">Project description</label>
                            <span class="form-control" id="projectDescription">{{ $project->description }}</span>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="projectPriority">Project priority</label>
                            <span class="form-control" id="projectPriority">{{ $project->priority }}</span>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="projectStatus">Project status</label>
                            <span class="form-control" id="projectStatus">{{ $project->status }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
