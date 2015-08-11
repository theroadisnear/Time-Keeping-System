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
                   <a data-toggle="collapse" data-target="#colaps" href="#colaps"><img src="{{asset('images/Logo/UPITDC_Logo.png')}}" style="width:170px;height:60px;"></a>
                </div>
                <ul class="nav navbar-nav">
                </ul>
				@if(Auth::check())
					<div id="colaps" class="navbar-right collapse">
						<ul class="nav navbar-default navbar-right ">
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown">
									<img class="img-responsive img-circle" src="{{asset('images/defaults/placeholder_avatar.png')}}">
								</a>
								<ul class="dropdown-menu">
									<li><a href=""><i class="glyphicon glyphicon-user"></i> Profile</a></li>
									<li><a href="#change-password" data-toggle="modal" data-target=".change-password"><i class="glyphicon glyphicon-cog"></i> Change Password</a></li>
									<li class="divider"></li>
									<li><a href="/logoutc"><i class="glyphicon glyphicon-off"></i>Logout</a></li>
								</ul>
							</li>
						</ul>
					</div>
					</div>
					<div class="modal fade change-password" tabindex="-1" role="dialog" aria-labelledby="changePassword">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true"></span>
								</button>
								<h4 class="modal-title">Change Password</h4>
							</div>
							<div class="modal-body">
							{!!Form::open(array('action' => array('AccountsController@changePass', $Accounts->id), 'class'=>'form-horizontal', 'files' => false))!!}
							<input type="text" name="id" value="{{$Accounts->id}}" hidden>
								<div class="form-group">
									<div class="row">
										{!! Form::label('password_old', 'Old Password: ', ['class'=>'col-md-2 control-label']) !!}
										<div class="col-md-3">
											{!! Form::password('password_old', ['class'=>'form-control']) !!}
										</div>
										@if ($errors->has('password_old'))
											<h5 class="col-md-3 text text-danger">
												{{$errors->first('password_old')}}
											</h5>
										@endif
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										{!! Form::label('password', 'Password: ', ['class'=>'col-md-2 control-label']) !!}
										<div class="col-md-3">
											{!! Form::password('password', ['class'=>'form-control']) !!}
										</div>
										@if ($errors->has('password'))
											<h5 class="col-md-3 text text-danger">
												{{$errors->first('password')}}
											</h5>
										@endif
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										{!! Form::label('password_confirmation', 'Confirm password: ', ['class'=>'col-md-2 control-label']) !!}
										<div class="col-md-3">
											{!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
										</div>
										@if ($errors->has('password_confirmation'))
											<h5 class="col-md-3 text text-danger">
												{{$errors->first('password_confirmation')}}
											</h5>
										@endif
									</div>
								</div>
							</div>
							<div class="modal-footer">
								{!!Form::submit('Submit', ['class'=>'btn btn-primary'])!!}
							</div>
							{!! Form::close() !!}
						</div>
					</div>
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
            <div class="">
                
                @yield('content')
            </div>
        </div>
    </body>
</html>
