<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Time Keeping System</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script type="text/javascript" src="/bootstrap/js/moment.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    </head>
    <body>
    {{ $errors->first('username') }}
    {{ $errors->first('password') }}
		@if(Auth::check())
			<div class="col-md-4 col-md-offset-4">
				<a href="/users"><i class="glyphicon glyphicon-off"></i> Continue to Administrator View</a>
			</div>
		@else
		<div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please log in</h2>
                    </div>
                    <div class="panel-body">
                            <fieldset>
                            {!!Form::open(array('url' => '/login', 'class' => 'form-horizontal', 'method' => 'post'))!!}
                            <div class="form-group">
                                {!! Form::text('username', '', ['class'=>'form-control',  'placeholder'=>'username']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::password('password', ['class'=>'form-control', 'placeholder' => 'password']) !!}
                            </div>
                            <div class="form-group">
                                <label>
                                    {!! Form::checkbox('rememberme', '', ['class'=>'form-control', 'value'=>'Remember Me']) !!}
                                    Remember Me
                                </label>
                            </div>
                            <div class="form-group right">
                                {!!Form::submit('Login', ['class'=>'btn btn-primary'])!!}
                            </div>
                        {!!Form::close()!!}
                        </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
		@endif