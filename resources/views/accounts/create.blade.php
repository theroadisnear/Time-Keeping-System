@extends('layout')

@section('content')

<div class="container">
	<div class="">
		<h2>Create New Account</h2>
		{!!Form::open(array('action' => 'AccountsController@store', 'class'=>'form-horizontal', 'files' => false))!!}
			<div class="form-group">
				<div class="row">
					{!! Form::label('username', 'Username: ', ['class'=>'col-md-2 control-label']) !!}
					<div class="col-md-3">
						{!! Form::text('username', null, ['class'=>'form-control']) !!}
					</div>
					@if ($errors->has('username'))
						<h5 class="col-md-3 text text-danger">
							{{$errors->first('username')}}
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
					{!! Form::label('role', 'Role: ', ['class'=>'control-label col-md-2']) !!}
					<div class="col-md-3">
						{!! Form::select('role', array('guard'=>'Guard', 'officer'=>'Officer', 'administrator'=>'Administrator'), null, ['class'=>'form-control']) !!}
						<!--{!! Form::text('role', null, ['class'=>'form-control']) !!}-->
					</div>
					@if ($errors->has('role'))
						<h5 class="col-md-3 text text-danger">
							{{$errors->first('role')}}
						</h5>
					@endif
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					{!! Form::label('usernumber', 'User number: ', ['class'=>'col-md-2 control-label']) !!}
					<div class="col-md-3">
						{!! Form::text('usernumber', null, ['class'=>'form-control', 'placeholder' => '(optional)']) !!}
					</div>
					@if ($errors->has('usernumber'))
						<h5 class="col-md-3 text text-danger">
							{{$errors->first('usernumber')}}
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