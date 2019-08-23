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
        <div class="col-md-12">

            <agile>
                <div class="slide" v-for="n in 6" :key="n" :class="`slide--${n}`">
                    <h3>@{{ n }}</h3>
                </div>
                <template slot="prevButton"><i class="fa fa-chevron-left"></i></template>
                <template slot="nextButton"><i class="fa fa-chevron-right"></i></template>
            </agile>
        </div>

    </div>



    <div class="row">
        <div class="col-md-8">
            <!-- Featured Articles -->


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
