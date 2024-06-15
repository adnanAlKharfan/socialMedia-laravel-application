<x-admin-master>
    @section('content')
   
    
 
   
   
   
    <h1>All Posts</h1>
    @if (Session::has('message'))
      <div class="alert alert-danger">
        {{Session::get('message')}}
      </div>
    @endif
    <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>title</th>
                <th>body</th>
                <th>created date</th>
                <th>image</th>
                <th>edit</th>
               
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>title</th>
                <th>body</th>
                <th>created date</th>
                <th>image</th>
                <th>edit</th>
              </tr>
            </tfoot>
            <tbody>
                @foreach ($post as $i)
             <tr>
                    <td>{{$i->title}}</td>
                    <td>{{strtok( $i->body,"\n")}}</td>
                    <td>{{$i->created_at}}</td>
                    <td><img  height="40px" src="{{$i->post_image}}" alt=""></td>
                    <td><a href="{{route('edit_post',$i->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                      <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                    </svg> </a></td>
                  </tr>  
                @endforeach
             
             
            </tbody>
          </table>
        </div>
      </div>
      {{$post->links()}}
    @endsection
    @section('script')
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  
    <!-- Page level custom scripts -->

    @endsection
</x-admin-master>   