@extends('layout')

@section('content')
<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap-datetimepicker.min.css">
<script type="text/javascript" src="/bootstrap/js/bootstrap-datetimepicker.min.js"></script>

<div class="container">
	<h2>Edit User</h2>
	<div class="">
		<button class="btn btn-default">
			<a href={{action('UsersController@show', [$user->id, $user->usernumber])}}>Back</a>
		</button>
		<div class="row">
			<div class="col-md-2 col-md-offset-4"  data-toggle="tooltip" data-placement="right" title="Change image">
				<label for="inputFile">
					<img class="img-responsive img-circle" src="{{$image->idpicture}}">
				</label>
			</div>
			@if ($errors->has('idpicture'))
				<h5 class="col-md-3 text text-danger">
					{{$errors->first('idpicture')}}
				</h5>
			@endif
		</div>
		<br>
		<div class="col-md-offset-3">
			{!!Form::open(array('action' => array('UsersController@update', $user->id, $user->usernumber), 'class'=>'form-horizontal', 'files' => true))!!}
			{!!Form::hidden('id', $user->id)!!}
			{!! Form::file('idpicture', ['class'=>'', 'id' => 'inputFile', 'style' => 'display:none'], null) !!}
				<div class="form-group">
					<div class="row">
						{!! Form::label('usernumber', 'ID Number: ', ['class'=>'col-md-2 control-label']) !!}
						<div class="col-md-3">
							{!! Form::text('usernumber', $user->usernumber, ['class'=>'form-control']) !!}
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
						{!! Form::label('department', 'Department: ', ['class'=>'control-label col-md-2']) !!}
						<div class="col-md-3">
							{!! Form::select('department',array('eUP'=>'eUp', 'ITDC'=>'ITDC', 'SITF'=>'SITF'), $user->department, ['class'=>'form-control']) !!}
							<!--{!! Form::text('department', null, ['class'=>'form-control']) !!}-->
						</div>
						@if ($errors->has('department'))
							<h5 class="col-md-3 text text-danger">
								{{$errors->first('department')}}
							</h5>
						@endif
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						{!! Form::label('firstname', 'First Name: ', ['class'=>'control-label col-md-2']) !!}
						<div class="col-md-3">
							{!! Form::text('firstname', $user->firstname, ['class'=>'form-control']) !!}
						</div>
						@if ($errors->has('firstname'))
							<h5 class="col-md-3 text text-danger">
								{{$errors->first('firstname')}}
							</h5>
						@endif
					</div>	
				</div>	
				<div class="form-group">
					<div class="row">
						{!! Form::label('middleinitial', 'Middle Initial: ', ['class'=>'control-label col-md-2']) !!}
						<div class="col-md-3">
							{!! Form::text('middleinitial', $user->middleinitial, ['class'=>'form-control']) !!}
						</div>
						@if ($errors->has('middleinitial'))
							<h5 class="col-md-3 text text-danger">
								{{$errors->first('middleinitial')}}
							</h5>
						@endif
					</div>	
				</div>
				<div class="form-group">
					<div class="row">
						{!! Form::label('lastname', 'Last Name: ', ['class'=>'control-label col-md-2']) !!}
						<div class="col-md-3">
							{!! Form::text('lastname', $user->lastname, ['class'=>'form-control']) !!}
						</div>
						@if ($errors->has('lastname'))
							<h5 class="col-md-3 text text-danger">
								{{$errors->first('lastname')}}
							</h5>
						@endif
					</div>	
				</div>
				<div class="form-group">
					<div class="row">
						{!! Form::label('birthday', 'Birthday: ', ['class'=>'control-label col-md-2']) !!}
						<div class="col-md-3">
							<div class="input-group date" id="datetimepicker10">
								{!! Form::text('birthday', $user->birthday, ['class'=>'form-control']) !!}
		      					<span class="input-group-addon">
	                    		<span class="glyphicon glyphicon-calendar"></span>
	                			</span>
		  					</div>
							<script type="text/javascript">
						        $(function () {
						            $('#datetimepicker10').datetimepicker({
						                viewMode: 'days',
						                format: 'YYYY-MM-DD'
						            });
						        });
						    </script>
						</div>
						@if ($errors->has('birthday'))
							<h5 class="col-md-3 text text-danger">
								{{$errors->first('birthday')}}
							</h5>
						@endif
					</div>
				</div>
				@if($shift != null)
					<div class="form-group">
					<div class="row">
						{!! Form::label('official_time_in', 'Time In: ', ['class'=>'control-label col-md-2']) !!}
						<div class="col-md-3">
							<div class="input-group date" id="datetimepicker3">
								{!! Form::text('official_time_in', $shift->official_time_in, ['class'=>'form-control']) !!}
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
								{!! Form::text('official_time_out', $shift->official_time_out, ['class'=>'form-control']) !!}
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
				@else
				<div class="form-group">
					<div class="row">
					</div>
				</div>
				@endif
				<div class="form-group center col-md-offset-4">
					{!!Form::button('Update',['class'=>'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '.bs-example-modal-sm'])!!}		
				</div>
				<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="confirmDelete">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true"></span>
								</button>
								<h4 class="modal-title">Update Confirmation</h4>
							</div>
							<div class="modal-body">
								<div class="container">
								Are you sure to save the changes?
								</div>
							</div>
							<div class="modal-footer">
								{!!Form::submit('Yes',['class'=>'btn btn-primary'])!!}
								<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
							</div>
						</div>
					</div>
				</div>
			{!!Form::close()!!}
		</div>
	</div>
</div>

@stop