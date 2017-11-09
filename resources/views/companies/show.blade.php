
@extends('layouts.app')
@section('content')

    <div class="jumbotron">
        <h1>{{$comp->name}}</h1>
        <p class="lead">{{$comp->description}}</p>
        {{-- <p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p> --}}
    </div>

    <!-- Example row of columns -->
    <div class="row">
        @foreach($comp->projects as $project)

            <div class="col-lg-4">
                <h2>{{$project->name}}</h2>
                <p class="text-danger">{{$project->description}}</p>
                <p><a class="btn btn-primary" href="/projects/{{$project->id}}" role="button">View details »</a></p>
            </div>

        @endforeach

    </div>

    <!-- Site footer -->
    <footer class="footer">
        <p>© 2016 {{$comp->name}}, Inc.</p>
    </footer>

@endsection
