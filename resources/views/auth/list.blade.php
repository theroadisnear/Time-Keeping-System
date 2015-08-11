@extends('layout')
@section('content')
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
    <table class="table table-hover table-condensed table-responsive">
        <tr>
        <td> USERID
        <TD> USERNAME
        <TD> ROLE
        <TD> EDIT
        <TD> DELETE
        </tr>
       @foreach($accounts as $user)
          <tr>
    <td> {{ $user->usernumber}} </td>
    <td> {{ $user->username}} </td>
    <td> {{ $user->role}} </td>
    <td><a href="{{action('RegisterController@edit', [$user->id])}}">
              <button class="btn btn-info" type="button">Go</button>
            </a>
    <td>
      <form method="POST" action="/TimeKeepingSystem/public/acc/del">
      {!! csrf_field() !!}
      <input hidden type="text" name="id" value='{{ $user->id }}' >
      </input><input type="submit" class='btn btn-danger' value="DELETE"></input></td>
      </form>
    </tr>
  </FORM>
        @endforeach
    </table>
</div>
@stop