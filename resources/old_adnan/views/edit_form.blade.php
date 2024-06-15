<x-admin-master>
    @section('content')
    @if (count($errors))
  @if ($errors->has('title'))
  <div class="alert alert-danger" role="alert">
    {{ $errors->first('title')}}
   </div>  
  @endif
  @if ($errors->has('body'))
  <div class="alert alert-danger" role="alert">
    {{ $errors->first('body')}}
   </div>  
  @endif
  @if ($errors->has('file'))
  <div class="alert alert-danger" role="alert">
    {{ $errors->first('file')}}
   </div>  
  @endif
    
 
   
    @endif
   
    <h1>edit</h1>
    {!! Form::open(['enctype'=>"multipart/form-data",'method'=>'put','action'=>['App\Http\Controllers\PostController@edit',$post->id],'file'=>true]) !!}
    <div class="form-group">
        <label for="title">Title</label>
{!! Form::text('title', $post->title, ['class'=>'form-control','id'=>'title']) !!}
    </div>
    <div class="form-group">
        <label for="body">Body</label>
{!! Form::textarea('body', $post->body, ['class'=>'form-control','id'=>'body']) !!}
</div>
<div class="col-2">
    <label id="file">File</label>
{!! Form::file('file', ['class'=>'form-control-file','id'=>'file','accept'=>'image/*','value'=>$post->post_image]) !!}
<img style="display: inline" height="50px"src="{{asset($post->post_image)}}" alt="jj">
</div>
<br>
<br>
 {!! Form::submit('update', ['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
    {!! Form::open(['enctype'=>"multipart/form-data",'method'=>'delete','action'=>['App\Http\Controllers\PostController@delete',$post->id],'file'=>true]) !!}

 {!! Form::submit('delete', ['class'=>'btn btn-danger']) !!}
    {!! Form::close() !!}
    @endsection
</x-admin-master>   