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
                        <form action="{{ route('update-project', [$project->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="projectId">Project ID</label>
                                <span class="form-control" id="projectId">{{ $project->id }}</span>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="projectName">Project name</label>
                                <input type="text" class="form-control" id="projectName" placeholder="Enter project name" name="name" value="{{ $project->name }}">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="projectDescription">Project description</label>
                                <textarea class="form-control" id="projectDescription" placeholder="Enter project description" name="description">{{ $project->description }}</textarea>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="projectPriority">Project priority</label>
                                <input type="number" class="form-control" id="projectPriority" placeholder="Enter project priority" name="priority" value="{{ $project->priority }}">
                            </div>
                            <br>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="projectStatus1" value="1" {{ $project->status == 'Active' ? 'checked' : ''}}>
                                <label class="form-check-label" for="projectStatus1">
                                    Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="projectStatus2" value="0" {{ $project->status == 'Inactive'  ? 'checked' : ''}}>
                                <label class="form-check-label" for="projectStatus2">
                                    Inactive
                                </label>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
