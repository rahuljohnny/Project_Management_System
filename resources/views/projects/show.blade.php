@extends('layouts.app')
@section('content')

    <div class="col-md-9 col-lg-9 col-sm-9 pull-left">

        <div class="well well-lg well-sm">
            <h1>{{$project->name}}</h1>
            <p class="lead">{{$project->description}}</p>
            <h2>Days:<strong>{{$project->days}}</strong></h2>

            <p class="pull-right"><a class="btn btn-primary" href="/projects/create" role="button">Create New <i class="fa fa-plus" aria-hidden="true"></i> </a></p>

            {{-- <p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p> --}}
        </div>

        {{--Comment section--}}

        <div class="row container-fluid">

            <form method="POST" action="{{ route('comments.store') }}">
                {{csrf_field()}}

                <input type="hidden" name="commentable_type" value="App\Project">
                <input type="hidden" name="commentable_id" value="{{$project->id}}">

                {{--

                <div class="form-group">
                    <label for="comment-content">Proof of work done</label>
                    <textarea placeholder="Enter Url or screenshots"
                              style="resize: vertical"
                              id="comment-content"
                              name="url"
                              rows="3" spellcheck="false"
                              class="form-control autosize-target text-left">

                    </textarea>
                </div>

                --}}

                <div class="form-group">
                    <label for="comment-content">Comment</label>
                    <textarea placeholder="Enter description"
                              style="resize: vertical"
                              id="comment-content"
                              name="body"
                              rows="5" spellcheck="false"
                              class="form-control autosize-target text-left">
                    </textarea>

                    <textarea placeholder="Enter Url or screenshots"
                              style="resize: horizontal"
                              id="comment-content"
                              name="url"
                              rows="2"  spellcheck="false"
                              class="form-control autosize-target text-left">

                    </textarea>
                </div>






                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

            {{--Uploaded Comments--}}

            @if($comments->first())
                @include('partials.comments')
            @endif


        </div>


        <!-- Example row of columns -->
        {{--
                <div class="row col-md-12 col-lg-12 col-sm-12" style="background: wheat;  margin: 10px; padding: 15px ">


                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p class="text-danger">{{$project->description}}</p>
                    <p><a class="btn btn-primary" href="/projects/{{$project->id}}" role="button">View details »</a></p>
                </div>

            <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2>Days</h2>
                <p class="text-danger"><strong>{{$project->days}}</strong></p>
            </div>

        </div>

        --}}

    </div>




    <div class="col-sm-3 col-md-3 col-lg-3 pull-right" style="background: rgba(179,226,232,0.58)">

        @if ($project->user_id == Auth::user()->id)
            <div class="sidebar-module">
                <h4>Actions</h4><hr>
                <ol class="list-unstyled">
                    <li><a href="/projects/{{$project->id}}/edit">Edit Project</a></li>
                    <li><a href="/projects/create">Add New Project</a></li>
                    <li><a href="/companies">List of Companies</a></li>
                    <li><a href="/projects">List of Projects</a></li>
                    <li><a href="/companies/create">Add new Company</a></li>


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
                        >
                            Delete
                        </a>

                        <form id="delete-form" action="{{ route('projects.destroy',[$project->id]) }}"
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
