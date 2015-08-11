@extends('layout')

@section('content')
<script>
$(document).ready(function() {
    $('#example').dataTable( {
        "paging":   false,
        "info":     false
    } );
} );
</script>
<div class="container">
	<div>
		<h2>Users Index</h2>
		<table id="example" class="table table-hover table-condensed table-responsive">
			<thead>
				<tr>
					<th>ID Number</th>
					<th>Last Name</th>
					<th>First Name</th>
					<th>Middle Initial</th>
					<th>Birthday</th>
					<th>Department</th>
					<th>View</th>
				</tr>
			</thead>	
			<tbody>
				@forelse($users as $user)
					<tr>	
						<th>{{$user->usernumber}}</th>
						<th>{{$user->lastname}}</th>
						<th>{{$user->firstname}}</th>
						<th>{{$user->middleinitial}}</th>
						<th>{{$user->birthday}}</th>
						<th>{{$user->department}}</th>
						<th><a href="{{action('UsersController@show', [$user->id, $user->usernumber])}}">
							<button class="btn btn-info" type="button">View</button>
						</a></th>
					</tr>
				@empty
				<p class="text-warning">No Users</p>
				@endforelse
			</tbody>
			{!! $users->render() !!}
		</table>
		<a href="{{action('UsersController@create')}}">
			<button type="button" class="btn btn-primary" type="button">Create</button>
		</a>
	</div>
</div>
@stop