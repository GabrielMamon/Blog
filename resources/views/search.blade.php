@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')
<div id="body" class="container">

    <div class="row">
        <div class="col-md-8">
            <!-- Search Articles -->
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
        @include('layouts/sidebar')
    </div>
</div>
@endsection
<!-- Scripts -->
@section('cdnscripts')
<script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
@endsection
