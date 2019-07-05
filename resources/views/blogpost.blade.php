@extends('layouts.app')
@section('title')
    {{$title}}
@endsection


@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-8">
                @foreach ($post as $item)


                <h5>{{$item->title}}</h5>
                <hr>
                  <img src="{{ asset('images/'.$item->imagepath.'') }}">
                <hr>
                <p>
                    {{$item->content}}
                </p>

                @endforeach
            </div>
        </div>
</div>
@endsection
