@extends('layout')

@section('content')

<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap-datetimepicker.min.css">
<script type="text/javascript" src="/bootstrap/js/bootstrap-datetimepicker.min.js"></script>

<div class="container">
	<div class="row">
		<a href="{{action('UsersController@index')}}">
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
							<a href="{{action('UsersController@edit', [$user->id, $user->usernumber])}}">
								Edit
							</a>
						</li>
						@if($shift == null)
						<li>
							<a href=""  data-toggle="modal" data-target=".shift">
								Add Shift
							</a>
						</li>
						@endif
						@if($user->activate == 0)
						<li>
							<a href="{{action('UsersController@deactivate', [$user->id, $user->usernumber])}}"  data-toggle="modal" data-target=".activate">
								Activate
							</a>
						</li>
						@elseif($user->activate == 1)
						<li>
							<a href="{{action('UsersController@activate', [$user->id, $user->usernumber])}}"  data-toggle="modal" data-target=".deactivate">
								Deactivate
							</a>
						</li>
						@endif
						<li>
							<a href="{{action('UsersController@delete', [$user->id, $user->usernumber])}}"  data-toggle="modal" data-target=".delete">
								Delete
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-4"  data-toggle="tooltip" data-placement="right">
			<img class="img-responsive img-circle" src="{{$image->idpicture}}">
			</div>
			<div class="col-md-6">
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
				@if($shift == null)
				<div class="">
					{!! Form::label('timeinoutLabel', 'Shift: ', ['class'=>'control-label']) !!}
					{!! Form::label('timeinout', 'None', ['class'=>'control-label']) !!}
				</div>
				@else
				<div class="">
					{!! Form::label('timeinoutLabel', 'Shift: ', ['class'=>'control-label']) !!}
					{!! Form::label('timeinout', $shift->official_time_in.' - '.$shift->official_time_out, ['class'=>'control-label']) !!}
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
<div class="modal fade activate" tabindex="-1" role="dialog" aria-labelledby="confirmActivate">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
				<h4 class="modal-title">Activate Confirmation</h4>
			</div>
			<div class="modal-body">
				<div class="container">
				Are you sure to activate this user?<br>
			ID Number: {{$user->usernumber}}<br>
			Name: {{$user->lastname}}, {{$user->firstname}}
				</div>
			</div>
			<div class="modal-footer">
				{!!Form::open(array('action' => array('UsersController@activate', $user->id)))!!}
				{!!Form::hidden('id', $user->id)!!}
				{!!Form::submit('Yes',['class'=>'btn btn-primary'])!!}
				<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
				{!!Form::close()!!}
			</div>
		</div>
	</div>
</div>
<div class="modal fade deactivate" tabindex="-1" role="dialog" aria-labelledby="confirmDeactivate">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
				<h4 class="modal-title">Deactivate Confirmation</h4>
			</div>
			<div class="modal-body">
				<div class="container">
				Are you sure to deactivate this user?<br>
			ID Number: {{$user->usernumber}}<br>
			Name: {{$user->lastname}}, {{$user->firstname}}
				</div>
			</div>
			<div class="modal-footer">
				{!!Form::open(array('action' => array('UsersController@deactivate', $user->id)))!!}
				{!!Form::hidden('id', $user->id)!!}
				{!!Form::submit('Yes',['class'=>'btn btn-primary'])!!}
				<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
				{!!Form::close()!!}
			</div>
		</div>
	</div>
</div>
<div class="modal fade delete" tabindex="-1" role="dialog" aria-labelledby="confirmDelete">
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
			ID Number: {{$user->usernumber}}<br>
			Name: {{$user->lastname}}, {{$user->firstname}}
				</div>
			</div>
			<div class="modal-footer">
				{!!Form::open(array('action' => array('UsersController@delete', $user->id)))!!}
				{!!Form::hidden('id', $user->id)!!}
				{!!Form::submit('Yes',['class'=>'btn btn-primary'])!!}
				<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
				{!!Form::close()!!}
			</div>
		</div>
	</div>
</div>
<div class="modal fade shift" tabindex="-1" role="dialog" aria-labelledby="newShift">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
				<h4 class="modal-title">New Shift</h4>
			</div>
			<div class="modal-body">
			{!!Form::open(array('action' => array('UsersController@newShift', $user->id, $user->usernumber), 'class'=>'form-horizontal'))!!}
				<div class="container">
					<div class="form-group">
						<div class="row">
							{!! Form::label('official_time_in', 'Time In: ', ['class'=>'control-label col-md-2']) !!}
							<div class="col-md-3">
								<div class="input-group date" id="datetimepicker3">
									{!! Form::text('official_time_in', null, ['class'=>'form-control']) !!}
	      							<span class="input-group-addon">
                        				<span class="glyphicon glyphicon-time"></span>
                    				</span>
	  							</div>
								<script type="text/javascript">
									$(function () {
										$('#datetimepicker3').datetimepicker({
											format: 'LT',
										});
									});
        						</script>
							</div>
							@if ($errors->has('official_time_in'))
								<h5 class="col-md-3 text text-danger">
									{{$errors->first('official_time_in')}}
								</h5>
							@endif
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							{!! Form::label('official_time_out', 'Time Out: ', ['class'=>'control-label col-md-2']) !!}
							<div class="col-md-3">
								<div class="input-group date" id="datetimepicker4">
									{!! Form::text('official_time_out', null, ['class'=>'form-control']) !!}
	      							<span class="input-group-addon">
                        				<span class="glyphicon glyphicon-time"></span>
                    				</span>
	  							</div>
								<script type="text/javascript">
									$(function () {
										$('#datetimepicker4').datetimepicker({
											format: 'LT',
										});
									});
        						</script>
							</div>
							@if ($errors->has('official_time_out'))
								<h5 class="col-md-3 text text-danger">
									{{$errors->first('official_time_out')}}
								</h5>
							@endif
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				{!!Form::submit('Yes',['class'=>'btn btn-primary'])!!}
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				{!!Form::close()!!}
			</div>
		</div>
	</div>
</div>
@stop