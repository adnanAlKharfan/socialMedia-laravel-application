<x-home-2-master>
@section('title')
  <title>adnan homepage</title>
@endsection
@section('catgory')
  <br>
  <div class="card" style="width: 18rem;">
    <div class="card-header">
      category
    </div>
  
        <ul class="list-group list-group-flush">

   
    @foreach ($cat as $t)

    <li class="list-group-item"><a href="{{route('category',$t->id)}}">{{$t->name}}</a>
    </li>

    @endforeach
         

    </ul>
    </div>
   
  @endsection
@section('content')
    <h1 class="my-4">HOME

    </h1>
  @foreach ($posts as $i )
  <div class="card mb-4">
    <img class="card-img-top" src="{{$i->photo->file}}" alt="Card">
    <div class="card-body">
      <h2 class="card-title">{{$i->title}}</h2>
      <p class="card-text">{{strtok($i->body,"\n")}}</p>
      <a href="{{route('show',$i->id)}}" class="btn btn-primary">Read More &rarr;</a>
    </div>
    <div class="card-footer text-muted">
      {{$i->created_at->diffForHumans()}}
    
    </div>
  </div>
  @endforeach
    <!-- Blog Post -->
  
  
    <!-- Blog Post -->
    
  
    <!-- Pagination -->
    
    {{$posts->links()}}
  @endsection
  @section('script')
  <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  
  <!-- Page level custom scripts -->
  <!-- <script src="{{asset('js/demo/datatables-demo.js')}}"></script>-->
  @endsection
</x-home-2-master>