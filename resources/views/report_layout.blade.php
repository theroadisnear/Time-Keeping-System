@extends('layout')

@section('content')
<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap-datetimepicker.min.css">
<script type="text/javascript" src="/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
<div class="container">
	<h2>Reports </h2>
	<div class="row">
		<div class="col-md-2">
			<ul class="nav nav-pills nav-stacked">
				<li>
					<a href={{@action('ReportsController@userLogs')}}>
						Reports
					</a>
				</li>
				<li class="">
					<a href={{@action('ReportsController@accountLogs')}}>
						Account
					</a>
				</li>
			</ul>
		</div>
		<div class="col-md-10">
			@yield('report_content')
		</div>
	</div>
</div>
@stop
