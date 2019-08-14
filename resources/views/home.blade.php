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

    <div class="row">
        <div class="col-md-8">
            <div class="row justify-content-center">

                @if(count($posts) > 0)


                <post-items v-bind:posts="{{ collect($posts->items())->toJson() }}"></post-items>
                {{ $posts->render() }}

                @else

                <h4>Nothing is posted here...</h4>
                @endif


            </div>
        </div>
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




