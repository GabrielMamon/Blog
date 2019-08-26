@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')
<div id="body" class="container">
    @if (session('msgtitle'))
    <div id="logalert" class="alert {{ session('msgtype') }} alert-dismissible fade show align-items-center">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <strong>{{ session('msgtitle') }}</strong> {{ session('msgcontent') }}
    </div>
    @endif
    <div class="modal fade" id="deletePop">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <a class="delete btn btn-primary">Confirm</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel -->

    <div class="row">
        <div class="col-md-8 col-sm-12">
             <!-- Featured Articles -->
            <p class="section-head c1"><span>Featured Articles</span></p>
            <div></div>
            <agile :dots="false" :speed="800" :autoplay-speed="5000">
                <div class="slide-card">
                    <img class="slide" src="https://images.unsplash.com/photo-1506260408121-e353d10b87c7?ixlib=rb-1.2.1&amp;q=85&amp;fm=jpg&amp;crop=entropy&amp;cs=srgb&amp;w=1600&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjE0NTg5fQ"/>
                    <div>
                        <h4>Caption Title of Post</h4>
                        <h6>Author - Jul 9 2010</h6>
                    </div>
                </div>
                <template slot="prevButton"><i class="fa fa-chevron-left"></i></template>
                <template slot="nextButton"><i class="fa fa-chevron-right"></i></template>
            </agile>
        </div>
        <div class="col-md-4 col-sm-12">
            <p class="section-head c5"><span>Trending Articles</span></p>
            <div></div>
            <side-card v-bind:items="{{ $items }}"></side-card>
        </div>

    </div>



    <div class="row cont-main">
        <div class="col-md-8 col-sm-12">
            <!-- Latest Articles -->
            <div>
            <p class="section-head c2"><span>Latest Articles</span></p>
            <div></div>
            </div>

            @if(count($posts) > 0)

            <div class="row justify-content-center">
                <post-items v-bind:posts="{{ collect($posts->items())->toJson() }}"></post-items>
            </div>
            <div class="row">
                {{ $posts->render() }}
            </div>
            @else

            <h4>Nothing is posted here...</h4>
            @endif
        </div>

        @include('sidebar')
    </div>
</div>
@endsection
<!-- Scripts -->
@section('cdnscripts')
<script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
@endsection
