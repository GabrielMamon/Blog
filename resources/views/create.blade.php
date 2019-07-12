@extends('layouts.app')
@section('title')
    {{$title}}
@endsection
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
@section('cdnlink')

@endsection

@section('content')
<div class="container">
        @if (session('msgtitle'))
        <div id="logalert" class="alert {{ session('msgtype') }} alert-dismissible fade show align-items-center">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{ session('msgtitle') }}</strong> {{ session('msgcontent') }}
        </div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <h5>Create new post</h5>
                <hr>
                    <form method="POST" action="{{ action('PostController@Create') }}"  enctype="multipart/form-data">
                        @csrf
                        <input type="file" accept="image/*" name="InputPostImage" required<br><br>
                        <input type="text" class="form-control" name="InputPostTitle" id="InputPostTitle" placeholder="Title" maxlength="80" required>
                        <br>
                        <input type="text" class="form-control" name="InputPostCategory" id="InputPostCategory" placeholder="Category" maxlength="15" required>
                        <br>
                        <textarea id="textContent" name="InputPostContent" class="form-control" required></textarea>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
            </div>
        </div>
</div>
@endsection
@section('cdnscripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
<script>
$(document).ready(function() {
    $('#textContent').summernote({
        height: 300,   //set editable area's height
    });
});
</script>
@endsection


