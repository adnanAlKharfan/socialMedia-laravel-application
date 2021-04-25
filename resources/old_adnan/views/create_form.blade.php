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
   
    <h1>create</h1>
    {!! Form::open(['enctype'=>"multipart/form-data",'method'=>'post','action'=>'App\Http\Controllers\PostController@store','file'=>true]) !!}
    <div class="form-group">
        <label for="title">Title</label>
{!! Form::text('title', null, ['class'=>'form-control','id'=>'title']) !!}
    </div>
    <div class="form-group">
        <label for="body">Body</label>
{!! Form::textarea('body', null, ['class'=>'form-control','id'=>'body']) !!}
</div>
<div class="form-control">
    <label id="file">File</label>
{!! Form::file('file', ['class'=>'form-control-file','id'=>'file','accept'=>'image/*']) !!}
</div>
<br>
<br>
 {!! Form::submit('submit', ['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
    @endsection
</x-admin-master>   