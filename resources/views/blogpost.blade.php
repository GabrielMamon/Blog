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
                {!!$item->content!!}
            </p>

            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">

            <div class="row">
                <div class="col-md-12">
                    @guest

                    @else
                    <hr>
                    <form method="POST" action="{{ action('CommentController@postComment') }}">
                            @csrf
                        <div class="form-group">
                        <input type="hidden" value="{{ $title_slug }}" name="InputPostID">
                            <textarea class="form-control" name="InputCommentText" rows="2"></textarea>
                        </div>

                            <button type="submit" class="btn btn-primary px-4" style="float: right;">Post Comment</button>


                    </form>
                    @endguest
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    @foreach ($comments as $comment)
                    <hr>
                        <div class="card border-0">
                            <div class="card-body">
                                <p class="card-title" style="font-size: 14px"><b>{!! $comment->name !!} - </b> <span class="text-muted">{!! $comment->created !!}</span></p>
                                <p class="card-text">{!! $comment->comment !!}</p>
                            </div>
                        </div>
                        <br>
                    @endforeach

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
