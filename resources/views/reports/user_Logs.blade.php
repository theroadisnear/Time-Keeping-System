
@extends('report_layout')

@section('report_content')
<script>
$(document).ready(function() {
    $('#example').dataTable( {
        "paging":   false,
        "info":     false
    } );
} );
</script>

<div class="well well-sm">
	<h2>User Logs</h2>
	<div>
		<ul class="nav nav-pills">
			<li>
				<a class="btn btn-default" data-toggle="modal" data-target=".employee-number">
					ID No.
					<span class="glyphicon glyphicon-user"></span>
				</a>
			</li>
			<li>
				<a class="btn btn-default" data-toggle="modal" data-target=".name">
					Name
					<span class="glyphicon glyphicon-user"></span>
				</a>
			</li>
			<li>
				<a class="btn btn-default" data-toggle="modal" data-target=".between-dates">
					Search
					<span class="glyphicon glyphicon-calendar"></span>
				</a>
			</li>
		</ul>
	</div>
	<table class="table table-hover table-condensed table-responsive" id="example">
			<thead>
				<tr>
					<th>ID Number</th>
					<th>Name</th>
					<th>Department</th>
					<th>Time In</th>
					<th>Time Out</th>
				</tr>
			</thead>	
			<tbody>
				@forelse($attendanceLogs as $attendanceLog)
					<tr>	
						<th>{{$attendanceLog->usernumber}}</th>
						<th>{{$attendanceLog->lastname}}, {{$attendanceLog->firstname}} {{$attendanceLog->middleinitial}}</th>
						<th>{{$attendanceLog->department}}</th>
						<th>{{$attendanceLog->date_time_in}}</th>
						<th>{{$attendanceLog->date_time_out}}</th>
					</tr>
				@empty
				No Records Found
				@endforelse
			</tbody>
		</table>
		
		{!! $attendanceLogs->appends(array('q' => $attendanceLogs))->render()!!}
</div>
<div class="modal fade between-dates" tabindex="-1" role="dialog" aria-labelledby="betweenDates">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
				<h4 class="modal-title">Search</h4>
			</div>
			<div class="modal-body">
			{!! Form::open(array('action' => 'ReportsController@userLogsShowDate', 'method' => 'get','class'=>'form-horizontal'))!!}
				<div class="form-group">
					<div class="">
						{!! Form::label('department', 'Department: ', ['class'=>'control-label col-md-2']) !!}
						<div class="col-md-4">
							{!! Form::select('department',array('all' => 'All', 'eUP'=>'eUp', 'ITDC'=>'ITDC', 'SITF'=>'SITF'), 'All', ['class'=>'form-control']) !!}
							<!--{!! Form::text('department', null, ['class'=>'form-control']) !!}-->
						</div>
						@if ($errors->has('department'))
							<h5 class="col-md-4 text text-danger">
								{{$errors->first('department')}}
							</h5>
						@endif
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						{!! Form::label('start', 'Start: ', ['class'=>'control-label col-md-2']) !!}
						<div class="col-md-4">
							<div class="input-group date" id="datetimepicker10">
								{!! Form::text('start', null, ['class'=>'form-control']) !!}
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
						@if ($errors->has('start'))
							<h5 class="col-md-3 text text-danger">
								{{$errors->first('start')}}
							</h5>
						@endif
						{!! Form::label('end', 'End: ', ['class'=>'control-label col-md-1']) !!}
						<div class="col-md-4">
							<div class="input-group date" id="datetimepicker11">
								{!! Form::text('end', null, ['class'=>'form-control']) !!}
	      						<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
                				</span>
	  						</div>
							<script type="text/javascript">
								$(function () {
									$('#datetimepicker11').datetimepicker({
										viewMode: 'days',
										format: 'YYYY-MM-DD'
									});
									$("#datetimepicker10").on("dp.change", function (e) {
									$('#datetimepicker11').data("DateTimePicker").minDate(e.date);
								});
								});
							</script>
						</div>
						@if ($errors->has('end'))
							<h5 class="col-md-3 text text-danger">
								{{$errors->first('end')}}
							</h5>
						@endif
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary">Go</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
<div class="modal fade employee-number" tabindex="-1" role="dialog" aria-labelledby="employeeNumber">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
				<h4 class="modal-title">Search by ID Number</h4>
			</div>
			<div class="modal-body">
			{!! Form::open(array('action' => 'ReportsController@userLogsShowEmployeeNumber', 'method' => 'get', 'class'=>'form-horizontal'))!!}
				<div class="form-group">
					<div class="">
						{!! Form::label('department', 'Department: ', ['class'=>'control-label col-md-3']) !!}
						<div class="col-md-4">
							{!! Form::select('department',array('all' => 'All', 'eUP'=>'eUp', 'ITDC'=>'ITDC', 'SITF'=>'SITF'), 'All', ['class'=>'form-control']) !!}
							<!--{!! Form::text('department', null, ['class'=>'form-control']) !!}-->
						</div>
						@if ($errors->has('department'))
							<h5 class="col-md-4 text text-danger">
								{{$errors->first('department')}}
							</h5>
						@endif
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						{!! Form::label('usernumber', 'ID Number: ', ['class'=>'control-label col-md-3']) !!}
						<div class="col-md-4">
							{!! Form::text('usernumber', null, ['class'=>'form-control']) !!}
						</div>
						@if ($errors->has('usernumber'))
							<h5 class="col-md-3 text text-danger">
								{{$errors->first('usernumber')}}
							</h5>
						@endif
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary">Go</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
<div class="modal fade name" tabindex="-1" role="dialog" aria-labelledby="name">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
				<h4 class="modal-title">Search by Name</h4>
			</div>
			<div class="modal-body">
			{!! Form::open(array('action' => 'ReportsController@userLogsShowName', 'method' => 'get', 'class'=>'form-horizontal'))!!}
				<div class="form-group">
					<div class="">
						{!! Form::label('department', 'Department: ', ['class'=>'control-label col-md-2']) !!}
						<div class="col-md-4">
							{!! Form::select('department',array('all' => 'All', 'eUP'=>'eUp', 'ITDC'=>'ITDC', 'SITF'=>'SITF'), 'All', ['class'=>'form-control']) !!}
							<!--{!! Form::text('department', null, ['class'=>'form-control']) !!}-->
						</div>
						@if ($errors->has('department'))
							<h5 class="col-md-4 text text-danger">
								{{$errors->first('department')}}
							</h5>
						@endif
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						{!! Form::label('name', 'Name: ', ['class'=>'control-label col-md-2']) !!}
						<div class="col-md-4">
							{!! Form::text('lastname', null, ['class'=>'form-control', 'placeholder' => 'Lastname']) !!}
						</div>
						@if ($errors->has('lastname'))
							<h5 class="col-md-3 text text-danger">
								{{$errors->first('lastname')}}
							</h5>
						@endif
						<div class="col-md-4">
							{!! Form::text('firstname', null, ['class'=>'form-control', 'placeholder' => 'Firstname']) !!}
						</div>
						@if ($errors->has('firstname'))
							<h5 class="col-md-3 text text-danger">
								{{$errors->first('firstname')}}
							</h5>
						@endif
					</div>
				</div>
			</div>
			<div class="modal-footer">
				{!!Form::submit('Go', ['class'=>'btn btn-primary'])!!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection