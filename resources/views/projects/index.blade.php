@extends('layouts.app')
@section('content')
    <div class="col-md-10 col-lg-10 col-sm-10 col-md-offset-2 col-lg-offset-2">
        <div class="panel panel-primary">

            <div class="panel-heading">
                Projects<a class="pull-right btn btn-primary btn-sm" href="/projects/create"> Create new Project</a>
            </div>

            <div class="panel-body">

                <ul class="list-group">
                    @foreach($projects as $project)

                        @php
                            $companyN = App\Company::find($project->company_id);
                        @endphp

                        <li class="list-group-item">
                            <a href="projects/{{$project->id}}">
                                {{$project->name}}
                            </a>
                            by <a href="companies/{{$project->company_id}}">
                                {{$companyN->name}}
                            </a>
                        </li>
                    @endforeach


                </ul>

            </div>
        </div>
    </div>
@endsection