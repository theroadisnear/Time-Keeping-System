@extends('layout')

@section('content')
<div class="container">
	<div class="">
		<h2>Change Password</h2>
		{!!Form::open(array('action' => array('AccountsController@changePass', $Accounts->id), 'class'=>'form-horizontal', 'files' => false))!!}
		<input type="text" name="id" value="{{$Accounts->id}}" hidden>
			<div class="form-group">
				<div class="row">
					{!! Form::label('password_old', 'Old Password: ', ['class'=>'col-md-2 control-label']) !!}
					<div class="col-md-3">
						{!! Form::password('password_old', ['class'=>'form-control']) !!}
					</div>
					@if ($errors->has('password_old'))
						<h5 class="col-md-3 text text-danger">
							{{$errors->first('password_old')}}
						</h5>
					@endif
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					{!! Form::label('password', 'Password: ', ['class'=>'col-md-2 control-label']) !!}
					<div class="col-md-3">
						{!! Form::password('password', ['class'=>'form-control']) !!}
					</div>
					@if ($errors->has('password'))
						<h5 class="col-md-3 text text-danger">
							{{$errors->first('password')}}
						</h5>
					@endif
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					{!! Form::label('password_confirmation', 'Confirm password: ', ['class'=>'col-md-2 control-label']) !!}
					<div class="col-md-3">
						{!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
					</div>
					@if ($errors->has('password_confirmation'))
						<h5 class="col-md-3 text text-danger">
							{{$errors->first('password_confirmation')}}
						</h5>
					@endif
				</div>
			</div>
			
			<div class="form-group">
					<div class="row">
						<div class="col-md-offset-4">
							{!!Form::submit('Submit', ['class'=>'btn btn-primary'])!!}
						</div>
					</div>
			</div>
		{!!Form::close()!!}
	</div>
</div>

@stop