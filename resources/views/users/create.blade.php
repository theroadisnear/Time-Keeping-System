@extends('layout')

@section('content')

<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap-datetimepicker.min.css">
<script type="text/javascript" src="/bootstrap/js/bootstrap-datetimepicker.min.js"></script>

<div class="container">
	<div class="">
		<h2>Create new user</h2>
		{!!Form::open(array('action' => 'UsersController@index', 'class'=>'form-horizontal', 'files' => true))!!}

			<div class="form-group">
				<div class="row">
					{!! Form::label('usernumber', 'ID Number: ', ['class'=>'col-md-2 control-label']) !!}
					<div class="col-md-3">
						{!! Form::text('usernumber', null, ['class'=>'form-control']) !!}
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
						{!! Form::select('department',array('eUP'=>'eUp', 'ITDC'=>'ITDC', 'SITF'=>'SITF'), 'eUP', ['class'=>'form-control']) !!}
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
						{!! Form::text('firstname', null, ['class'=>'form-control']) !!}
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
						{!! Form::text('middleinitial', null, ['class'=>'form-control']) !!}
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
						{!! Form::text('lastname', null, ['class'=>'form-control']) !!}
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
							{!! Form::text('birthday', null, ['class'=>'form-control']) !!}
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
			<div class="form-group">
				<div class="row">
					{!! Form::label('idpicture', 'ID Picture: ', ['class'=>'control-label col-md-2']) !!}
					<div class="col-md-3">
						{!! Form::file('idpicture', null, ['class'=>'form-control']) !!}
					</div>
					@if ($errors->has('idpicture'))
						<h5 class="col-md-3 text text-danger">
							{{$errors->first('idpicture')}}
						</h5>
					@endif
				</div>	
			</div>

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

			<div class="form-group center">
				{!!Form::submit('Submit', ['class'=>'btn btn-primary'])!!}
			</div>
		{!!Form::close()!!}
	</div>
</div>

@stop