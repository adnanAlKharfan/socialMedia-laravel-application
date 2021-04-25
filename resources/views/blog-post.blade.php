<x-home-2-master>
  @section('title')
  <title>post of {{$post->User->name}}</title>
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
    <div class="col-lg-8">

        <!-- Title -->
        <h1 class="mt-4">{{$post->title}}</h1>

        <!-- Author -->
        <p class="lead">
          by
         {{$post->User->name}}
        </p>

        <hr>

        <!-- Date/Time -->
        <p>{{$post->created_at->diffforhumans()}}</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="{{$post->photo->file}}" alt="">

        <hr>

        <!-- Post Content -->
        <p>{{$post->body}}</p>
       
        <hr>

        <!-- Comments Form -->
        <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
           {!! Form::open(['action'=>["App\Http\Controllers\PostCommentsController@store2",$post->id],'method'=>'post']) !!}
              @csrf
              <div class="form-group">
                <textarea name="body" class="form-control" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
           {!! Form::close() !!}
          </div>
        </div>

        <!-- Single Comment -->
@foreach ( $comments as $i )
<div class="media mb-4">
  <img height="20px" width="20px" class="d-flex mr-3 rounded-circle" src="{{$i->photo=='http://placehold.it/400x400'?'http://placehold.it/400x400':$i->photo}}" alt="">
  <div class="media-body">
    <h5 class="mt-0">{{$i->author}}</h5>
    {{$i->body}}
     </div>
</div>

@endforeach
      
        <!-- Comment with nested comments -->
        <!--<div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0">Commenter Name</h5>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

            <div class="media mt-4">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
              <div class="media-body">
                <h5 class="mt-0">Commenter Name</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
              </div>
            </div>

            <div class="media mt-4">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
              <div class="media-body">
                <h5 class="mt-0">Commenter Name</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
              </div>
            </div>

          </div>
        </div>-->

      </div>
    @endsection
</x-home-2-master>   