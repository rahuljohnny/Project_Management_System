@extends('layouts.app')
@section('content')


    <div class="col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Profile of <strong>{{$user->name}}</strong>
            </div>




            <div class="panel-body">




                        <li class="list-group-item">

                            <h4>{{$user->name}}</h4>


                        <li class="list-group-item">
                            <img class="img-responsive" src="{{url('images',$user->image)}}" width="50%">
                        </li>
                    <div class="pull-right">
                        <strong>{{$user->email}}</strong>


            </div>
        </div>
    </div>
@endsection

