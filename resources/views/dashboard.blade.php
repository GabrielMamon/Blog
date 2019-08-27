@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')
<link href="{{ asset('css/styles2.css') }}" rel="stylesheet">
@section('cdnlink')

@endsection
<div class="container">

    <div id="body" class="row">
        <div class="col-md-12">
            <vue-good-table :columns="columns" :rows="rows" :search-options="{
                        enabled: true,
                        placeholder: 'Search posts',
                      }" :pagination-options="{
                        enabled: true,
                        dropdownAllowAll: false,
                      }" :sort-options="{
                        enabled: true,
                        initialSortBy: {field: 'dateposted', type: 'desc'}
                      }">>
                <template slot="table-row" slot-scope="props">
                    <span v-if="props.column.field == 'banner'">
                        <div class="table-img">
                            <img :src="'/images/'+props.row.banner">
                        </div>
                    </span>
                    <span v-else-if="props.column.field == 'post'">
                        <p class="table-title">@{{props.row.post}}</p>
                        <p class="table-content">@{{ props.row.content }}[...]</p>
                    </span>
                    <span v-else>
                        @{{props.formattedRow[props.column.field]}}
                    </span>
                </template>
            </vue-good-table>
        </div>
    </div>

</div>
@endsection
<!-- Scripts -->
@section('cdnscripts')
<script type="text/javascript" src="{{ asset('js/dashboard.js') }}"></script>
@endsection
