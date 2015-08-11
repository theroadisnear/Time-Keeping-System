@extends('layout')

@section('content')
<div class="container">
	<div>
		<h2>Accounts Index</h2>
		<table class="table table-hover table-condensed table-responsive">
			<thead>
				<tr>
					<th>Username</th>
					<th>Role</th>
					<th>View</th>
				</tr>
			</thead>	
			<tbody>
				@forelse($accounts as $account)
					<tr>	
						<th>{{$account->username}}</th>
						<th>{{$account->role}}</th>
						<th><a href="{{action('AccountsController@show', [$account->id, $account->username])}}">
							<button class="btn btn-info" type="button">Go</button>
						</a></th>
					</tr>
				@empty
				<p class="text-warning">No Accounts</p>
				@endforelse
			</tbody>
		</table>
		{!! $accounts->render() !!}
		<a href="{{action('AccountsController@create')}}">
			<button type="button" class="btn btn-primary" type="button">Create</button>
		</a>
	</div>
</div>
@stop