@extends('layouts.app')
@section('title')
    {{$title}}
@endsection
@section('content')
<div class="container">
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
                @php
                   $p = 0;
                @endphp
                @foreach ($posts as $object)
                <div class="card my-1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                            <a href="/post/{{$object->title_slugged}}" class="post-title">{{ $object->title }}</a>
                            </div>

                            <div class="col-md-3">

                                <h6 class="post-categorydate text-muted" style="text-align: right;">
                                    {{ $object->category }} / {{ $object->created }}
                                </h6>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4 col-sm-6 d-flex flex-wrap align-items-center">
                                <img src="{{ asset('images/'.$object->imagepath.'') }}"
                                    style="max-width: 75%;">
                            </div>

                            <div class="col-md-8 col-sm-6 ">
                                <div id="content-{{$p}}" class="row px-1">
                                <p class="card-text card-content" style="margin-top:10px">
                                        {!! $object->content !!}
                                </p>
                                </div>
                                <div class="row pt-3">

                                    <div class="col-md-6">
                                            <a href="/post/{{$object->title_slugged}}" class="card-link">Read More</a>
                                    </div>

                                    @if (Auth::id()==1)
                                    <div class="col-md-6 " style="text-align: right;">
                                            <a class="btn btn-primary" href="/edit/{{$object->title_slugged}}"><i class="fa fa-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletePop" data-title="{{$object->title}}" data-slug="{{$object->title_slugged}}"><i class="fa fa-trash"></i>
                                            </button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                @php
                    $p++;
                @endphp
                @endforeach
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
                <div class="recent">
                <h5>Recent Post/s</h5>
                <hr>
                @foreach ($recent as $object)
                    @if (strlen($object->title)>20)
                        {!! substr($object->title,0,20) !!} [...] - {{ $object->created }} <br>
                    @else
                        {!! $object->title !!} - {{ $object->created }} <br>
                    @endif
                @endforeach
                </div>
            @endif

        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        let count = {{ count($posts) }};
        for (let index = 0; index < count; index++) {
            const text = $('#content-'+index).text();

            $('#content-'+index).html(text.substring(0,300)+"[...]");

        }

    });
    $(function () {
                $('#deletePop').on('show.bs.modal', function (event) {
                    let button = $(event.relatedTarget);
                    let title = button.data('title');
                    let slug = button.data('slug');

                    let modal = $(this);
                    modal.find('.modal-body').text('Are you sure to delete '+title+'?');
                    modal.find('.delete').attr('href','/delete/'+slug)
                });

    });

</script>
@endsection
