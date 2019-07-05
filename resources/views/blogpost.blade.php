@extends('layouts.app')
@section('title')
    {{$title}}
@endsection


@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-10">
                @foreach ($post as $item)


                <h2>{{$item->title}}</h2>
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
