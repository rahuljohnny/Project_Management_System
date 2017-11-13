@extends('layouts.app')
@section('content')

    <div class="col-md-8 col-lg-8 col-sm-8">

        <form method="POST" action="{{ route('projects.store') }}">
            {{csrf_field()}}

            <div class="form-group">
                <label for="name">Name</label>
                <input type="name" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter company name">
                <small id="emailHelp" class="form-text text-muted">We'll never share your name with anyone else.</small>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="3" name="description"></textarea>
            </div>

            <div class="form-group">
                <label for="company_id">Select Author Company</label>
                <select class="form-control" id="company_id" name="company_id">
                    @foreach($companies as $user)
                        <option>{{$user->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="days">Days</label>
                <input type="number" name="days" class="form-control" id="days" aria-describedby="emailHelp" placeholder="Days">
                <small id="days" class="form-text text-muted">We'll never share your name with anyone else.</small>
            </div>

            {{--


            <div class="form-group">
                <label for="user_id">Select User ID</label>
                <select class="form-control" id="user_id" name="user_id">
                    @foreach($users as $user)
                        <option>{{$user->id}}</option>
                    @endforeach
                </select>
            </div>

            --}}

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
@endsection