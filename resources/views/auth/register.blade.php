@extends('layout')

@section('content')
<style>
table { 
    border-spacing: 10px;
    border-collapse: separate;
}
.navbar-brand
{
    position: absolute;
    width: 100%;
    left: 0;
    text-align: center;
    margin: auto;
}
</style>
<div>
    <nav class="navbar navbar-default" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>    
  </div>
  <div class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-left">
        <li><a href="/TimeKeepingSystem/public/register">Add</a></li>
        <li><a href="/TimeKeepingSystem/public/list">List</a></li>
        <li><a href="/TimeKeepingSystem/public/acc/deleted">Deleted</a></li>
    </ul>
  </div>
</nav>
</div>
<div>
<table>
<form method="POST" action="register">
    {!! csrf_field() !!}
<tr>
    <div>
        <td>Username
        <td><input type="text" name="username" value="{{ old('username') }}">
            <td><h5 class="col-md-3 text text-danger">
              {{$errors->first('username')}}
            </h5>
    </div>
</tr>
<tr>
    <div>
        <td>Password
        <td><input type="password" name="password">
            <td><h5 class="col-md-3 text text-danger">
              {{$errors->first('password')}}
            </h5>
    </div>
</tr>
<tr>
    <div>
        <td>Confirm Password
        <td><input type="password" name="password_confirmation">
            <td><h5 class="col-md-3 text text-danger">
              {{$errors->first('password_confirmation')}}
            </h5>
    </div>
</tr>
<tr>
    <div>
        <td>User ID
        <td><input type="text" name="usernumber"
                    onkeydown="return ( event.ctrlKey || event.altKey 
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9) 
                    || (event.keyCode>34 && event.keyCode<40) 
                    || (event.keyCode==46) )">
                    <td><h5 class="col-md-3 text text-danger">
              {{$errors->first('username')}}
            </h5>
    </div>
</tr>
<tr>
    <div>
        <td>Role
        <td><select name="role">
            <option value="officer">officer</option>
            <option value="admin">admin</option>
        </select>
    </div>  
</tr>
<table>
    <div>
        <button type="submit">Register</button>
    </div>
</form>
</div>
@stop