@extends('layout')

@section('content')

<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap-datetimepicker.min.css">
<script type="text/javascript" src="/bootstrap/js/bootstrap-datetimepicker.min.js"></script>

<div class="container">
	<div class="row">
		<a href="{{action('AccountsController@index')}}">
		Back to List
		</a>
	</div>
	<div class="well well-md col-md-6">
		<div class="">
			<ul class="nav navbar-nav pull-right">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<span class="glyphicon glyphicon-option-vertical"></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="#" data-toggle="modal" data-target=".reset-password">
								Reset Password
							</a>
						</li>
						<li>
							<a href="{{action('AccountsController@delete', [$account->id, $account->username])}}"  data-toggle="modal" data-target=".bs-example-modal-sm">
								Delete
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="">
					{!! Form::label('accountIdLabel', 'Account Id: ', ['class'=>'control-label']) !!}
					{!! Form::label('accountId', $account->id, ['class'=>'control-label']) !!}
				</div>
				<div class="">
					{!! Form::label('usernameLabel', 'Username: ', ['class'=>'control-label']) !!}
					{!! Form::label('username', $account->username, ['class'=>'control-label']) !!}
				</div>
				@if($account->usernumber)
				<div class="">
					{!! Form::label('usernumberLabel', 'ID Number: ', ['class'=>'control-label']) !!}
					{!! Form::label('usernumber', $user->usernumber, ['class'=>'control-label']) !!}
				</div>
				<div class="">
					{!! Form::label('nameLabel', 'Name: ', ['class'=>'control-label']) !!}
					{!! Form::label('name', $user->lastname.', '.$user->firstname.' '.$user->middleinitial.'.', ['class'=>'control-label']) !!}
				</div>
				<div class="">
					{!! Form::label('birthdayLabel', 'Birthday: ', ['class'=>'control-label']) !!}
					{!! Form::label('birthday', $user->birthday, ['class'=>'control-label']) !!}
				</div>
				<div class="">
					{!! Form::label('timeinoutLabel', 'Shift: ', ['class'=>'control-label']) !!}
					{!! Form::label('timeinout', $shift->official_time_in.' - '.$shift->official_time_out, ['class'=>'control-label']) !!}
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
<div class="modal fade reset-password" tabindex="-1" role="dialog" aria-labelledby="resetPassword">
	<div class="modal-dialog">
		<div class="modal-content">
			{!!Form::open(array('action' => array('AccountsController@resetUpdate', $account->id)))!!}
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
				<h4 class="modal-title">Reset Password</h4>
			</div>
			<div class="modal-body">
				<div class="container">
			ID Number: {{$account->id}}<br>
			Name: {{$account->username}}<br>
			<input type="password" hidden name="password" value="{!! $newpass = substr(str_shuffle(MD5(microtime())), 0, 10); !!}">
			New Password : {!! $newpass !!}
				</div>
			</div>
			<div class="modal-footer">
				<input type="text" name="id" value="{{$account->id}}" hidden>
				{!!Form::submit('Yes',['class'=>'btn btn-primary'])!!}
				<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
			</div>
			{!!Form::close()!!}
		</div>
	</div>
</div>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="confirmDelete">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
				<h4 class="modal-title">Delete Confirmation</h4>
			</div>
			<div class="modal-body">
				<div class="container">
				Are you sure to delete this user?<br>
			ID Number: {{$account->id}}<br>
			Name: {{$account->username}}
				</div>
			</div>
			<div class="modal-footer">
				{!!Form::open(array('action' => array('AccountsController@delete', $account->id)))!!}
				{!!Form::hidden('id', $account->id)!!}
				{!!Form::submit('Yes',['class'=>'btn btn-primary'])!!}
				<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
				{!!Form::close()!!}
			</div>
		</div>
	</div>
</div>
@stop