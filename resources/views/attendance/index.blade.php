@extends('attendance_layout')

@section('content')
<link rel="stylesheet" href="/FlipClock-master/compiled/flipclock.css">

<script src="/FlipClock-master/compiled/flipclock.js"></script>

<script type="text/javascript">
			var clock;
			
			$(document).ready(function() {
				clock = $('.clock').FlipClock({
					clockFace: 'TwelveHourClock'
				});
			});
</script>

<div class="container" >
	<!--<div>
		<button class="btn btn-primary" data-toggle="collapse" href="#startAttendance" aria-expanded="false" 
		aria-controls="startAttendance" onclick=display_ct();>Start</button>
			{!!Form::open(array('action' => 'AttendanceController@stop', 'class' => 'form-horizontal'))!!}
			{!!Form::submit('Stop', ['class' => 'btn btn-danger'])!!}
			{!!Form::close()!!}
		<span id='ct' ></span>
	</div>-->
	<script>
		var dateObj = new Date();
		var month = dateObj.getUTCMonth() + 1; //months from 1-12
		if (month == 1)
			month = 'Jan';
		else if (month == 2)
			month = 'Feb';
		else if (month == 3)
			month = 'March';
		else if (month == 4)
			month = 'April';
		else if (month == 5)
			month = 'May';
		else if (month == 6)
			month = 'June';
		else if (month == 7)
			month = 'July';
		else if (month == 8)
			month = 'Aug';
		else if (month == 9)
			month = 'Sept';
		else if (month == 10)
			month = 'Oct';
		else if (month == 11)
			month = 'Nov';
		else 
			month = 'Dec';
		var day = dateObj.getUTCDate();
		var year = dateObj.getUTCFullYear();
		var d = new Date();
var weekday = new Array(7);
weekday[0]=  "Sunday";
weekday[1] = "Monday";
weekday[2] = "Tuesday";
weekday[3] = "Wednesday";
weekday[4] = "Thursday";
weekday[5] = "Friday";
weekday[6] = "Saturday";

var n = weekday[d.getDay()];
	</script>
	<div class="col-xs-24 col-sm-12 col-md-12 col-lg-10 col-xs-offset-0 col-sm-offset-1 col-md-offset-2 col-lg-offset-1">
		<h1 align="center" >
			<script>
				document.write(n + "<br>");
			</script>   
			<script>
			document.write(day + " " + month + " " + year);
			</script>
		</h1>
	</div>
	<div class="col-xs-32 col-sm-12 col-md-12 col-lg-12 col-xs-offset-0 col-sm-offset-1 col-md-offset-2 col-lg-offset-3">
		<div class="flip-counter clock" style="margin:2em;"></div>
	</div>
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xs-offset-4 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
		{!!Form::open(array('action' => 'AttendanceController@show', 'class' => 'form-horizontal'))!!}
			<div class="form-group">
				
					<!--ken-->
					@if(Auth::check())
						<div class="row">
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
								{!! Form::text('usernumber', null, ['class'=>'form-control', 'placeholder'=>'ID Number', 'style'=> 'font-size: 44pt; height: 90px; width: 350px;', 'autofocus'=> 'autofocus']) !!}
							</div>
							</div>
							<div class="row">
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-15">
							{!!Form::submit('Submit', ['class'=>'btn btn-primary'])!!}
							</div>
							</div>
					@else
						<div class="row">
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
							</div>
							</div>
					@endif
						
				
				@if ($errors->has('usernumber'))
						<h5 class="col-md-6 text text-danger">
							{{$errors->first('usernumber')}}
						</h5>
				@endif
			</div>
		{!!Form::close()!!}
	</div>
	
</div>


@stop