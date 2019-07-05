@extends('layouts.app')
@section('title')
    {{$title}}
@endsection


@section('content')
<div class="container">

        <div class="row">
            <div class="col-md-8">
                <h5>Edit post</h5>
                <hr>
                @foreach ($postdata as $item)
                    <form method="POST" action="{{ action('PostController@Edit') }}"  enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="InputPostSlug" id="InputPostSlug" value="{{$item->title_slugged}}">
                    <input type="text" class="form-control" name="InputPostTitle" id="InputPostTitle" maxlength="80" disabled value="{{$item->title}}">
                        <br>
                    <input type="text" class="form-control" name="InputPostCategory" id="InputPostCategory" maxlength="15" value="{{$item->category}}" required>
                        <br>
                        <textarea name="InputPostContent" class="form-control" required>{{$item->content}}</textarea>
                        <br>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                @endforeach
            </div>
        </div>
</div>
@endsection


