@extends('layouts.admin')




@section('content')





    @if(count($comments) > 0)

        <h1>Comments</h1>


    <table class="table">
       <thead>
         <tr>
            <th>id</th>
            <th>Author</th>
            <th>Email</th>
             <th>Body</th>
          </tr>
        </thead>
        <tbody>

        @foreach($comments as $comment)


          <tr>
              <td>{{$comment->id}}</td>
              <td>{{$comment->author}}</td>
              <td>{{$comment->email}}</td>
              <td>{{$comment->body}}</td>
            <td><a href="{{route('show',$comment->post->id)}}">View Post</a></td>
     

              

              <td>


                  {!! Form::open(['method'=>'DELETE', 'action'=> ['App\Http\Controllers\PostCommentsController@destroy', $comment->id]]) !!}


                  <div class="form-group">
                      {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                  </div>
                  {!! Form::close() !!}



              </td>


          </tr>


            @endforeach

       </tbody>
     </table>



        @else


        <h1 class="text-center">No Comments</h1>



    @endif


@stop