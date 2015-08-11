@extends('layout')

@section('content')
<div>
<form method="POST" action="/accounts/resetpass/{{$Accounts->id}}">
    {!! csrf_field() !!}
    <p>Reset Password for: {{$Accounts->username}} ({{ $Accounts->usernumber }})
<input type="text" name="id" value="{{$Accounts->id}}" hidden>
<input type="password" hidden name="password" value="{!! $newpass = substr(str_shuffle(MD5(microtime())), 0, 10); !!}">
<p> New Password: {!! $newpass !!}<p>
    <div>
        <button type="submit">Change</button>
    </div>
</form>
</div>
@stop