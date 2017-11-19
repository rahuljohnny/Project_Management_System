@extends('layouts.app')
@section('content')
    @foreach($users as $shirt)
    <div class="row">
        <div class="col-xs-12 col-sm-5">
            <img class="img-responsive" src="{{url('images',$shirt->image)}}" width="20%">
        </div>
        <div class="col-xs-12 col-sm-7">
            <div class="row">
                <div class="col-sm-6">
                    <h4><a href="/users/{{$shirt->id}}">{!!$shirt->name!!}</a></h4>
                </div>
                <div class="col-sm-6">
                    <h5 class="pull-right">
                        {{$shirt->created_at}}
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <hr />
        </div>
    </div>

    @endforeach



    {{--
    <div class="row">
        @forelse($users as $shirt)
            <h3>{{$shirt->name}}</h3>
            <div class="small-3 medium-3 large-3 columns">
                <div class="item-wrapper">
                    <div class="img-wrapper">
                        <img src="{{url('images',$shirt->image)}}" class="pull-left"/>
                    </div>
                    <a href="shirts/{{$shirt->id}}">

                    </a>

                </div>
            </div>

        @empty
            <h3>No shirts</h3>
        @endforelse

    </div>

    --}}
@endsection