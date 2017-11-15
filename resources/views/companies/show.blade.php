
@extends('layouts.app')
@section('content')

    <div class="col-md-9 col-lg-9 col-sm-9 pull-left">

        <div class="jumbotron">
            <h1>{{$comp->name}}</h1>
            <p class="lead">{{$comp->description}}</p>

            {{-- <p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p> --}}
        </div>

        <!-- Example row of columns -->
        <div class="row col-md-12 col-lg-12 col-sm-12" style="background: wheat;  margin: 10px; ">
            @foreach($comp->projects as $project)

                <div class="col-lg-4 col-md-4 col-sm-4">
                    <h2>{{$project->name}}</h2>
                    <p class="text-danger">{{$project->description}}</p>
                    <p><a class="btn btn-primary" href="/projects/{{$project->id}}" role="button">View details »</a></p>
                </div>

            @endforeach

        </div>

    </div>




    <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
        {{--
        <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
        </div>
        --}}

        @if ($comp->user_id == Auth::user()->id)
            <div class="sidebar-module">
            <h4>Action</h4>
            <ol class="list-unstyled">
                <li><a href="/companies/{{$comp->id}}/edit">Edit</a></li>
                <li><a href="/projects/create">Add Project</a></li>
                <li><a href="/companies">List of Companies</a></li>
                <li><a href="/companies/create">Add new Company</a></li>


                <li>


                    <a
                    href="#"
                    onclick="
                    var result = confirm('Are you sure you wish to delete this Company?');
                      if( result ){
                              event.preventDefault();
                              document.getElementById('delete-form').submit();

                      }
                    "
                    >

                    Delete

                    </a>

                    <form id="delete-form" action="{{ route('companies.destroy',[$comp->id]) }}"
                          method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
                    </form>

                </li>



            </ol>
        </div>
        @endif

        {{--
        <div class="sidebar-module">
            <h4>Member Companies</h4>
            <ol class="list-unstyled">
                <li><a href="#">GitHub</a></li>
            </ol>
        </div>

        --}}
    </div>
    <!-- Site footer -->
    <br><hr>
    <footer class="footer col-md-12 col-lg-12 col-sm-12">
        <p>© 2016 {{$comp->name}}, Inc.</p>
    </footer>

@endsection
