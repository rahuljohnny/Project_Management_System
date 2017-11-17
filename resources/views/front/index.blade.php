@extends('layouts.app')
@section('content')
    <div class="col-md-10 col-lg-10 col-md-offset-2 col-lg-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Projects<a class="pull-right btn btn-primary btn-sm" href="/projects/create">Create Project <i class="fa fa-plus" aria-hidden="true"></i></a>
            </div>
            <div class="panel-body">

                <ul class="list-group">
                    @foreach($projects as $project)
                        <li class="list-group-item">
                            <h3 class="text-success">
                                <a href="projects/{{$project->id}}">
                                    {{$project->name}}
                                </a>
                            </h3>
                            <h4 class="text-danger">{{$project->description}}</h4>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
@endsection