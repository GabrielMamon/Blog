@extends('layouts.app')
@section('title')
    {{$title}}
@endsection
@section('content')
<div id="body" class="container">
        @if (session('msgtitle'))
        <div id="logalert" class="alert {{ session('msgtype') }} alert-dismissible fade show align-items-center">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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

        <div class="wrapper">
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
            <p class="section-head"><span>Latest Articles</span></p><div></div>


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

        <!-- Sidebar -->
        <div class="col-md-4 col-md-auto d-flex flex-column">
            @if (Auth::id()==1)
                <a href="create" class="btn btn-primary">CREATE POST</a>
            @endif

            @if(count($posts) > 0)
            <div class="card my-1">
                <div class="card-body">
                    <h5>Recent</h5>
                    <hr>
                    @foreach ($recent as $object)
                        @if (strlen($object->title)>20)
                            {!! substr($object->title,0,20) !!} [...] - {{ $object->created }} <br>
                        @else
                            {!! $object->title !!} - {{ $object->created }} <br>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
<!-- Scripts -->
@section('cdnscripts')
    <script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
@endsection




