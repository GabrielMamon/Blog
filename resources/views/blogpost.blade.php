@extends('layouts.app')
@section('title')
{{$title}}
@endsection


@section('content')
<div class="container" id="body">
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    @foreach ($post as $item)


                    <h2>{{$item->title}}</h2>
                    <hr>
                    <img src="{{ asset('images/'.$item->imagepath.'') }}" style="max-width: 100%;">
                    <hr>
                    <p>
                        {!!$item->content!!}
                    </p>

                    @endforeach
                </div>
            </div>

            <div class="w-100"></div>
            <div class="row navlink">
                <div class="col-md-6">
                    <a {{ $pageslink[0]->link }}>
                        <b>PREVIOUS</b>
                        <br>
                        {{ $pageslink[0]->title }}
                    </a>
                </div>

                <div class="col-md-6 navlink">
                    <a {{ $pageslink[1]->link }}>
                        <b>NEXT</b>
                        <br>
                        {{ $pageslink[1]->title }}
                    </a>
                </div>
            </div>

            <!-- Comment Section -->

        <p class="section-head c2"><span> @{{commentnum}} comment/s</span></p>
            <div></div>

            <div class="row">

                <comment-card v-bind:comments="sampledata"></comment-card>

                @guest

                @else
                <hr>
                <form @submit="addComment('{{ $title_slug }}','{{ Auth::user()->name }}')" @submit.prevent>
                    <div class="form-group">
                        <textarea class="form-control" name="InputCommentText" rows="2"
                            v-model="commentText"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary px-4" style="float: right;">Post
                        Comment</button>
                </form>
                @endguest


            </div>
        </div>
        @include('sidebar')


    </div>


</div>
@endsection

<!-- Scripts -->
@section('cdnscripts')
<script type="text/javascript" src="{{ asset('js/blogpost.js') }}"></script>
@endsection
