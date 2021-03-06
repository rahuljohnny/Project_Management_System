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

        @if ($comp->user_id == Auth::user()->id)
            <div class="sidebar-module">
            <h4>Action</h4><hr>
            <ol class="list-unstyled">
                <li><a href="/companies/{{$comp->id}}/edit"><i class="fa fa-briefcase" aria-hidden="true"></i> Edit</a></li>
                <li><a href="/companies"><i class="fa fa-users" aria-hidden="true"></i> Companies</a></li>
                <li><a href="/companies/create"><i class="fa fa-plus" aria-hidden="true"></i> Add new Company</a></li>

                <br>
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
                    ><i class="fa fa-times" aria-hidden="true"></i> Delete</a>

                    <form id="delete-form" action="{{ route('companies.destroy',[$comp->id]) }}"
                          method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
                    </form>

                </li>



            </ol>
        </div>
        @endif

    </div>
    <!-- Site footer -->
    <br><hr>
    <footer class="footer col-md-12 col-lg-12 col-sm-12">
        <p>© 2016 {{$comp->name}}, Inc.</p>
    </footer>

@endsection
