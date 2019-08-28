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
                    <span v-if="props.column.field == 'imagepath'">
                        <div class="table-img">
                            <img :src="'/images/'+props.row.imagepath">
                        </div>
                    </span>
                    <span v-else-if="props.column.field == 'title'">
                        <p class="table-title">@{{props.row.title}}</p>
                        <p class="table-content">@{{ props.row.content }}- <a :href="'/post/'+props.row.title_slugged">See more</a></p>
                    </span>
                    <span v-else-if="props.column.field == 'featured'">
                        <div class="custom-control custom-switch" v-if="props.row.featured == 0">
                            <input type="checkbox" class="custom-control-input" :id="'customSwitch'+props.index" @click="updateFeature(props.row.title_slugged)">
                            <label class="custom-control-label" :for="'customSwitch'+props.index">No</label>
                        </div>

                        <div class="custom-control custom-switch" v-else>
                            <input type="checkbox" class="custom-control-input" :id="'customSwitch'+props.index" @click="updateFeature(props.row.title_slugged)" checked>
                        <label class="custom-control-label" :for="'customSwitch'+props.index">Yes</label>
                        </div>
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
