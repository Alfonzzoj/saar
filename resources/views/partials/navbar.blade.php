    <body class="skin-blue">
    	<div class="wrapper">

    		<header class="main-header">
    			<!-- Logo -->
    			<a href={{action($url)}} class="logo"><b>ALPHA</b></a>

    			<nav class="navbar navbar-static-top" role="navigation">

    				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    					<span class="sr-only">Toggle navigation</span>
    				</a>

    				<ul class="nav navbar-nav hidden-xs">
    					<li>
    						<a href="#">
    							{{session("aeropuerto")->nombre}}
    						</a>
    					</li>
    				</ul>

    				<div class="navbar-custom-menu">
    					<ul class="nav navbar-nav">
    						<!-- Cuenta de usuario -->
    						<li class="dropdown user user-menu">
    							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    								<img src="{{asset('imgs/user-icon.png')}}" class="user-image" alt=""/>
    								<span class="hidden-xs">{{$userName}}</span>
    							</a>
    							<ul class="dropdown-menu">
    								<!-- Imagen de Usuario -->
    								<li class="user-header">
    									<img src="{{asset('imgs/user-icon.png')}}" class="img-circle" alt="" />
    									<p>
    										{{$userName}}
    										<small>Miembro desde {{$createdAt}}</small>
    									</p>
    								</li>

    								<!-- Menu Footer-->
    								<li class="user-footer">
    									<div class="pull-left">
    										<a href="#" class="btn btn-default btn-flat">Perfil</a>
    									</div>
    									<div class="pull-right">
    										<a href="{{action('Auth\AuthController@getLogout')}}" class="btn btn-default btn-flat">Cerrar Sesión</a>
    									</div>
    								</li>
    							</ul>
    						</li>
    					</ul>
    				</div>
    			</nav>
    		</header>