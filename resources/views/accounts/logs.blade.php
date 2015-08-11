@extends('layout')

@section('content')
<div class="container">
	<div>
		<h2>Logs Index</h2>
		<table class="table table-hover table-condensed table-responsive">
			<thead>
				<tr>
					<th>ID Number</th>
					<th>Action</th>
					<th>Time In</th>
					<th>Time Out</th>
				</tr>
			</thead>	
			<tbody>
				@forelse($logs as $user)
					<tr>	
						<th>{{$user->user_id}}</th>
						<th>{{$user->message_logs}}</th>
						<th>{{$user->date_time_in}}</th>
						<th>{{$user->date_time_out}}</th>
					</tr>
				@empty
				<p class="text-warning">No Logs</p>
				@endforelse
			</tbody>
		</table>
		<a href="{{action('UsersController@create')}}">
			<button type="button" class="btn btn-primary" type="button">Create</button>
		</a>
	</div>
</div>
@stop