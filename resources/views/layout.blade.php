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
		<script src="/data-tables/jquery.dataTables.min.js"></script>
		<script src="/data-tables/dataTables.bootstrap.js"></script>
        
        <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom:0">
                <div class="navbar-header">
                    <img src="{{asset('images/Logo/UPITDC_Logo.png')}}" style="width:170px;height:60px;">
                </div>
                <ul class="nav navbar-nav">
                    <li class=""><a href="/users">Users</a></li>
					@if (Auth::user()->role=="administrator")
						<li class=""><a href="/accounts">Accounts</a></li>
					@endif
                    <li class=""><a href="/reports">Reports</a></li>
                </ul>
                <form class="navbar-form navbar-left" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
                <ul class="nav navbar-default navbar-right ">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">
                            <img class="img-responsive img-circle" src="{{asset('images/defaults/placeholder_avatar.png')}}">
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href=""><i class="glyphicon glyphicon-user"></i> Profile</a></li>
                            <li><a href="/accounts/passedit"><i class="glyphicon glyphicon-cog"></i> Change Password</a></li>
                            <li class="divider"></li>
                            <li>
								<a href="/logout"><i class="glyphicon glyphicon-off"></i>Logout</a>
							</li>
                        </ul>
                    </li>
                </ul>
            </nav>
           @yield('content')
        </div>
    </body>
</html>
    