@extends('layouts.app')
@section('content')

    <div class="col-md-8 col-lg-8 col-sm-8 pull-left">
        <!-- Example row of columns -->
        <div class="row col-md-12 col-lg-12 col-sm-12" style="background: rgba(179,226,232,0.58);  margin: 10px; padding: 15px">

            <form method="post" action="{{route('companies.update',[$comp->id])}}">
                {{csrf_field()}}

                {{--<form method="POST" action="/register">  : this is to create--}}

                <input type="hidden" name="_method" value="put">

                <div class="form-group">
                    <label for="company-name">
                        Name
                        <span class="required">*</span>
                    </label>
                    <input type="text" class="form-control" id="company-name" name="name"
                           placeholder="Enter name"
                    value="{{$comp->name}}" required>
                </div>

                <div class="form-group">

                    <label for="company-content">
                        Description
                        <span class="required">*</span>
                    </label>

                    <input type="text" class="form-control autosize-target text-left" rows="5" spellcheck="false"
                           id="company-content" name="description" {{--To get access in controller
                           the "name" should be same as described in DB --}}
                           placeholder="Enter Description"
                           style="resize: vertical" rows="5"
                           value="{{$comp->description}}" required >

                </div>


                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input">
                        I hereby declare...
                    </label>
                </div>

                <button type="submit" class="btn btn-primary" value="Submit">Submit</button>
            </form>

        </div>
    </div>

    <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
        <div class="sidebar-module">
            <h4>Action</h4>
            <ol class="list-unstyled">
                <li><a href="/companies/{{$comp->id}}">View Companies</a></li>
                <li><a href="/companies">All Companies</a></li>
            </ol>
        </div>
    </div>
    <!-- Site footer -->
    <br><hr>
    <footer class="footer col-md-12 col-lg-12 col-sm-12">
        <p>© 2016 {{$comp->name}}, Inc.</p>
    </footer>

@endsection
