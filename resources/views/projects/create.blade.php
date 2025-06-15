@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Create project') }}
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
                        <form action="{{ route('projects.save') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="projectName">Project name</label>
                                <input type="text" class="form-control" id="projectName" aria-describedby="emailHelp" placeholder="Enter project name" name="name" value="{{ old('name') }}">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="projectDescription">Project description</label>
                                <textarea class="form-control" id="projectDescription" placeholder="Enter project description" name="description">{{ old('description') }}</textarea>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="projectPriority">Project priority</label>
                                <input type="number" class="form-control" id="projectPriority" placeholder="Enter project priority" name="priority" value="{{ old('priority') }}">
                            </div>
                            <br>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="projectStatus1" value="1" {{ old('status') == 1 ? 'checked' : ''}}>
                                <label class="form-check-label" for="projectStatus1">
                                    Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="projectStatus2" value="0" {{ old('status') == 0  ? 'checked' : ''}}>
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
