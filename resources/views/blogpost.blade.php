@extends('layouts.app')
@section('title')
{{$title}}
@endsection


@section('content')
<div class="container" id="body">
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
                    <form @submit="addComment('{{ $title_slug }}','{{ Auth::user()->name }}')" @submit.prevent >
                        <div class="form-group">
                            <textarea class="form-control" name="InputCommentText" rows="2" v-model="commentText"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary px-4" style="float: right;">Post Comment</button>
                    </form>
                    @endguest
                </div>
            </div>
            <div class="row">

                <comment-card v-bind:comments="sampledata"></comment-card>
            </div>

        </div>
    </div>


</div>
@endsection

<!-- Scripts -->
@section('cdnscripts')
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.js"></script> -->
    <script type="text/javascript" src="{{ asset('js/moment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/blogpost.js') }}"></script>
@endsection
