@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}
                    </div>
                </div>
            </div>
        </div>
        <br> --}}
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="card">
                    <div class="card-header">{{ __('Projects') }}
                        <button onclick="window.location.href='{{ route('projects.create') }}'" class="btn btn-primary" style="float: right;">
                            Create project
                        </button>
                    </div>
                    <div class="card-header">
                        <label for="filter">Filter by name or description</label>
                        <input type="text" name="filter" id="filter"/>
                    </div>

                    <div class="card-body">
                        <table class="table" id="projects-table">
                            <thead>
                                <tr id="sortable">
                                    <th scope="col"><i class="bi"></i><a href="#">#</a></th>
                                    <th scope="col"><i class="bi"></i><a href="#">Name</a></th>
                                    <th scope="col"><i class="bi"></i><a href="#">Description</a></th>
                                    <th scope="col" width="100"><i class="bi"></i><a href="#">Status</a></th>
                                    <th scope="col" width="100"><i class="bi"></i><a href="#">Priority</a></th>
                                    <th scope="col">Actions</a>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projects as $project)
                                    <tr>
                                        <th scope="row">{{$project->id}}</th>
                                        <td>{{$project->name}}</td>
                                        <td>{{$project->description}}</td>
                                        <td>{{$project->status}}</td>
                                        <td>{{$project->priority}}</td>
                                        <td>
                                            <a href="#"><i class="bi bi-pencil"></i></a>
                                            &nbsp;
                                            <a href="#"><i class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    Nothing to show here...
                                @endforelse

                            </tbody>
                        </table>
                        {{ $projects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#sortable a').on('click', function() {
                $(this).parent().parent().find('i:first').removeClass('bi-caret-up');
                $(this).parent().parent().find('i:first').removeClass('bi-caret-down');
                let sortField = $(this).html().toLowerCase();
                if ($(this).attr('class') == '' || $(this).attr('class') == 'asc') {
                    $(this).attr('class', 'desc');
                    $(this).parent().parent().find('i').removeClass('bi-caret-up');
                    $(this).parent().find('i').addClass('bi-caret-down');
                } else {
                    $(this).attr('class', 'asc');
                    $(this).parent().parent().find('i').removeClass('bi-caret-down');
                    $(this).parent().find('i').addClass('bi-caret-up');
                }
                let sortDirection = $(this).attr('class');
                if(sortField == '#') sortField = 'id';

                $.ajax({
                    url: '/api/projects', //
                    type: 'GET',
                    data:
                        {
                            sortBy: sortField,
                            sortDirection: sortDirection,
                            filter: $('#filter').val()

                        },
                    success: function(data) {
                        html = '';
                        data.data.forEach(item => {
                            let row =
                                    '<tr>' +
                                        '<th scope="row">'+item.id+'</th>' +
                                        '<td>'+item.name+'</td>' +
                                        '<td>'+item.description+'</td>' +
                                        '<td>'+item.status+'</td>' +
                                        '<td>'+item.priority+'</td>' +
                                        '<td>' +
                                            '<a href="#"><i class="bi bi-pencil"></i></a>' +
                                            '&nbsp;' +
                                            '<a href="#"><i class="bi bi-trash"></i></a>' +
                                        '</td>' +
                                    '</tr>';
                            html = html + row;
                        });
                        $('#projects-table tbody').empty().html(html);
                    }
                });
            });

            let html;
            $('#filter').on('keyup', function() {
                $('#projects-table').find('i').removeClass('bi-caret-down')
                $('#projects-table').find('i').removeClass('bi-caret-up')
                $('#projects-table').find('i:first').addClass('bi-caret-up')

                $(this).val() != '' ? $('nav[role="navigation"]').fadeOut() : $('nav[role="navigation"]').fadeIn();

                let filter = $(this).val();
                $.ajax({
                    url: '/api/projects', //
                    type: 'GET',
                    data: {
                        filter: filter,
                        sortBy: 'id',
                        sortDirection: 'asc'
                    },
                    success: function(data) {
                        html = '';
                        data.data.forEach(item => {
                            let row =
                                    '<tr>' +
                                        '<th scope="row">'+item.id+'</th>' +
                                        '<td>'+item.name+'</td>' +
                                        '<td>'+item.description+'</td>' +
                                        '<td>'+item.status+'</td>' +
                                        '<td>'+item.priority+'</td>' +
                                        '<td>' +
                                            '<a href="#"><i class="bi bi-pencil"></i></a>' +
                                            '&nbsp;' +
                                            '<a href="#"><i class="bi bi-trash"></i></a>' +
                                        '</td>' +
                                    '</tr>';
                            html = html + row;
                        });
                        $('#projects-table tbody').empty().html(html);
                    }
                });
            });
        });

    </script>
@endsection
