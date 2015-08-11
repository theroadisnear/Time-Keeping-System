
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
	<h2>Account Logs</h2>
	<div>
		<ul class="nav nav-pills">
			<li>
				<a class="btn btn-default" data-toggle="modal" data-target=".search-account-logs">
					Search
					<span class="glyphicon glyphicon-search"></span>
				</a>
			</li>
		</ul>
	</div>
	<table class="table table-hover table-condensed table-responsive" id="example">
		<thead>
			<tr>
				<th>ID Number</th>
				<th>Username</th>
				<th>Mesage Logs</th>
				<th>Date</th>
			</tr>
		</thead>	
		<tbody>
			@forelse($accountLogs as $accountLog)
				<tr>	
					<th>{{$accountLog->account_id}}</th>
					<th>{{$accountLog->username}}</th>
					<th>{{$accountLog->message_logs}}</th>
					<th>{{$accountLog->al_created_at}}</th>
				</tr>
			@empty
			No Records Found
			@endforelse
		</tbody>
	</table>
	{!! $accountLogs->render()!!}
</div>
<div class="modal fade search-account-logs" tabindex="-1" role="dialog" aria-labelledby="searchAccountLogs">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
				<h4 class="modal-title">Search</h4>
			</div>
			<div class="modal-body">
			{!! Form::open(array('action' => 'ReportsController@accountLogsShow', 'class'=>'form-horizontal'))!!}
				<div class="form-group">
					<div class="">
						{!! Form::label('logs', 'Logs: ', ['class'=>'control-label col-md-2']) !!}
						<div class="col-md-4">
							{!! Form::select('logs',array('all' => 'All', 'Account'=>'Account', 'User'=>'User'), 'All', ['class'=>'form-control']) !!}
							<!--{!! Form::text('logs', null, ['class'=>'form-control']) !!}-->
						</div>
						@if ($errors->has('logs'))
							<h5 class="col-md-4 text text-danger">
								{{$errors->first('logs')}}
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
										format: 'YYYY-MM-DD',
									});
								});
							</script>
						</div>
						@if ($errors->has('start'))
							<h5 class="col-md-3 text text-danger">
								{{$errors->first('start')}}
							</h5>
						@endif
						{!! Form::label('end', 'End: ', ['class'=>'control-label col-md-2']) !!}
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
				<a href="{{action('ReportsController@accountLogsShow')}}">
					<button class="btn btn-primary">Go</button>
				</a>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection