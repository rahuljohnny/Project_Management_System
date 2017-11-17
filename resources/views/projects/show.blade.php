@extends('layouts.app')
@section('content')

    <div class="col-md-9 col-lg-9 col-sm-9 pull-left ">

        <div class="well well-lg well-sm ">
            <h1 class="text-success">{{$project->name}}</h1>
            <p class="lead text-danger">{{$project->description}}</p>
            <h4 class="text-warning">Days:<strong>{{$project->days}}</strong></h4>
        </div>

        {{--Comment Form section##################################################################################--}}

        @include('partials.commentFormForProject')

    </div>



    {{--section: Sidebar--}}

    <div class="col-sm-3 col-md-3 col-lg-3 pull-right" style="background: rgba(179,226,232,0.58)">

        @if ($project->user_id == Auth::user()->id || Auth::user()->role_id == 1)

            <div class="sidebar-module">
                <h4>Actions</h4><hr>
                <ol class="list-unstyled">
                    <li><a href="/projects/{{$project->id}}/edit"><i class="fa fa-users" aria-hidden="true"></i> Edit Project</a></li>
                    <li><a href="/projects/create"><i class="fa fa-users" aria-hidden="true"></i> Create Project</a></li>
                    <li><a href="/projects"><i class="fa fa-briefcase" aria-hidden="true"></i> My Projects</a></li>
                    <br>

                    <li>

                        <a
                                href="#"
                                onclick="
                        var result = confirm('Are you sure you wish to delete this Project?');
                          if( result ){
                                  event.preventDefault();
                                  document.getElementById('delete-form').submit();
                          }
                    "
                        ><i class="fa fa-times" aria-hidden="true"></i></i>
                            Delete
                        </a>

                        <form id="delete-form" action="{{ route('projects.destroy',[$project->id]) }}"
                              method="POST" style="display: none;">

                            <input type="hidden" name="_method" value="delete">
                            {{ csrf_field() }}
                        </form>

                    </li>
                </ol>
                {{--Add new member of a project--}}
                <hr/>
                <h4>Add Members</h4>
                <br>
                <div class="row">

                    <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12">


                        <form id="add-user" action="{{ route('projects.addUser',[$project->id]) }}"
                              method="POST" style="background: whitesmoke;">
                            {{csrf_field()}}

                            <div class="input-group">
                                <input class="form-control" value="{{$project->id}}" type="hidden" name="projectID">
                                <input type="email" class="form-control" placeholder="Email of the member" name="email">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">Add!</button>
                                </span>
                            </div><!-- /input-group -->
                        </form>
                    </div><!-- /.col-lg-6 -->

                </div><!-- /.row -->
                <h4><strong>Team Members</strong></h4>

                <div class="row">

                    <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12">
                        <ol class="list-unstyled">
                            @foreach($project->users as $user)
                                <li><a href="#">{{$user->email}}</a></li>
                            @endforeach
                        </ol>
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </div>
        @endif


    </div>

    <!-- End of sidebar -->
    <!-- Section: footer -->
    <br><hr>
    <footer class="footer col-md-12 col-lg-12 col-sm-12">
        <p>© 2016 {{$comp->name}}, Inc.</p>
    </footer>

@endsection
