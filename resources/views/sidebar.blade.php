<!-- Sidebar -->
<div class="col-md-4 col-sm-12 col-md-auto d-flex flex-column">
        <div class="side-card">
        <form method="POST" action="{{ action('HomeController@prosSearch') }}">
             @csrf
                 <div class="input-group">

                     @if(isset($searchval))
                     @php $searchv = $searchval; @endphp
                     @else
                     @php $searchv = ""; @endphp

                     @endif



                    <input type="text" class="form-control" name="InputSearch" placeholder="Search" value="{{ $searchv }}">
                     <div class="input-group-append">
                         <button class="btn btn-primary" type="submit">
                             <i class="fas fa-search"></i>
                         </button>
                     </div>
                 </div>
             </form>
        </div>

        <div class="side-card">
             <p class="section-head c4"><span>Categories</span></p>
             <div></div>
             @if(count($categories) > 0)
                @foreach ($categories as $category)
        <div class="list-item"><i class="fas fa-angle-right"></i><a href="/category/{{$category->category}}">{{$category->category}}</a></div>
                @endforeach

            @endif
        </div>

         {{-- @if(count($posts) > 0)
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
         @endif --}}

     </div>
