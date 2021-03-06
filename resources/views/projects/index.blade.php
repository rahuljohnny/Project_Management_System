@extends('layouts.app')
@section('content')
    <div class="col-md-10 col-lg-10 col-sm-10 col-md-offset-2 col-lg-offset-2">
        <div class="panel panel-primary">

            <div class="panel-heading">
                Projects<a class="pull-right btn btn-primary btn-sm" href="/projects/create"> Create new Project <i class="fa fa-plus" aria-hidden="true"></i></a>
            </div>

            <div class="panel-body">

                <ul class="list-group">
                    @foreach($projects as $project)

                        @php
                            $companyN = App\Company::find($project->company_id);
                        @endphp

                        <li class="list-group-item">
                            <a href="projects/{{$project->id}}"><i class="fa fa-eye pull-right" aria-hidden="true" a href="projects/{{$project->id}}"></i>
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