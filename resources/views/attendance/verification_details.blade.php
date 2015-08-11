<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Time Keeping System</title>
        <script src="/bootstrap/js/jquery.min.js"></script>
        <script type="text/javascript" src="/bootstrap/js/moment.js"></script>
        <script src="/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/bootstrap/js/moment.js"></script>
        
        <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom:0">
                <div class="navbar-header">
                   <img src="{{asset('images/Logo/UPITDC_Logo.png')}}" style="width:170px;height:60px;">
                </div>
                <ul class="nav navbar-nav">
                </ul>
				@if(Auth::check())
					<div id="colaps" class="navbar-right collapse">
						<a href="/logoutc"><i class="glyphicon glyphicon-off"></i> Logout</a>
						</div>
				@else
					<div id="colaps" class="collapse">
				<form method="POST" action="/auth/login" name="action" class="form-signin navbar-form navbar-right">
							<div class="form-group">
							{!! csrf_field() !!}
									<div class="col-md-3">
										{!! Form::text('username', null, ['class'=>'form-control', 'placeholder' => 'username']) !!}
									</div>
										
							</div>
							<div class="form-group">
									<div class="col-md-3">
										{!! Form::password('password', ['class'=>'form-control', 'placeholder' => 'password']) !!}
									</div>
									
							</div>
							{!!Form::submit('Log In', ['class'=>'btn btn-primary'])!!}
						</form>
					</div>
				@endif
                {!!Form::close()!!}
            </nav>
										<h5 class="col-md-3 text text-danger">
											{{$errors->first('password')}}
										</h5>
										<h5 class="col-md-3 text text-danger">
											{{$errors->first('username')}}
										</h5>
<meta http-equiv="refresh" content="5;url=/attendance/index"/>
<div class="container">
	<div class="row">
	<div class="col-md-6 col-md-offset-5">
			@if($attendanceLog->date_time_out)
			<h1>Good Bye!</h1>
			@else
			<h1>Welcome!</h1>
			@endif
			</div>
		<div class="col-md-4 col-md-offset-4">
			<img class="img-responsive img-circle" src="{{$image->idpicture}}">
		</div>
		<div class="col-md-6 col-md-offset-4">
			<h1>ID No. {{$user->usernumber}}</h1>
			<h1>{{$user->lastname}}, {{$user->firstname}}</h1>
		</div>
	</div>
</div>
