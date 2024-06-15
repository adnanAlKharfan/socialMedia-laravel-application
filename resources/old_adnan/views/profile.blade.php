<x-admin-master>
    @section('content')
    <h1>profile</h1>
    @if (count($errors))
    @if ($errors->has('name'))
    <div class="alert alert-danger" role="alert">
      {{ $errors->first('name')}}
     </div>  
    @endif
    @if ($errors->has('username'))
    <div class="alert alert-danger" role="alert">
      {{ $errors->first('username')}}
     </div>  
    @endif
    @if ($errors->has('password'))
    <div class="alert alert-danger" role="alert">
      {{ $errors->first('password')}}
     </div>  
    @endif
    @if ($errors->has('email'))
    <div class="alert alert-danger" role="alert">
      {{ $errors->first('email')}}
     </div>  
    @endif
    @if ($errors->has('file'))
    <div class="alert alert-danger" role="alert">
      {{ $errors->first('file')}}
     </div>  
    @endif
      
   
     
      @endif
     
      <h1>edit</h1>
      {!! Form::open(['enctype'=>"multipart/form-data",'method'=>'put','action'=>['App\Http\Controllers\AdminController@edit'],'file'=>true]) !!}
      <div class="form-group">
          <label for="name">Name</label>
  {!! Form::text('name', $user->name, ['class'=>'form-control','id'=>'name']) !!}
      </div>
      <div class="form-group">
          <label for="username">Username</label>
  {!! Form::text('username', $user->username, ['class'=>'form-control','id'=>'username']) !!}
  </div>
  <div class="form-group">
    <label for="email">Email</label>
{!! Form::email('email', $user->email, ['class'=>'form-control','id'=>'email']) !!}
</div>
<div class="form-group">
    <label for="password">Password</label>
<input type="password" name="password" class="form-control"id="password"  required autocomplete="new-password">
</div>
<div class="form-group">
    <label for="password_confirmation">Confirm Password</label>
{!! Form::password('password_confirmation',  ['class'=>'form-control','id'=>'confirm-password','required','autocomplete'=>'new-password']) !!}
</div>
  <div class="col-2">
      <label id="file">File</label>
  {!! Form::file('file', ['class'=>'form-control-file','id'=>'file','accept'=>'image/*','value'=>$user->avatar]) !!}
  @if ($user->avatar!=null)
  <img style="display: inline" height="50px"src="{{asset($user->avatar)}}" alt="jj">
  @endif

  </div>
  <br>
  <br>
   {!! Form::submit('update', ['class'=>'btn btn-primary']) !!}
      {!! Form::close() !!}
      {!! Form::open(['enctype'=>"multipart/form-data",'method'=>'delete','action'=>['App\Http\Controllers\AdminController@delete'],'file'=>true]) !!}
  
   {!! Form::submit('delete', ['class'=>'btn btn-danger']) !!}
      {!! Form::close() !!}
    @endsection
</x-admin-master>