@include('partials.header')


<body class="skin-blue" style="	background: url('{{asset('/imgs/bg1.jpg')}}') no-repeat center center fixed;
                                -webkit-background-size: cover;
                                -moz-background-size: cover;
                                -o-background-size: cover;
                                background-size: cover;">

    <div class="container" id="alineacion">
        <small>
            <div class="pull-left" style="margin-top: 10px;" >
                <img src="{{asset('/imgs/gobernacion.png')}}"  width="200px"/>
            </div>
            <div class="pull-right" style="margin-top: 11px; margin-right: 200px" >
                <img src="{{asset('/imgs/LOGO-Alpha.png')}}"  width="100%"/>
            </div>
        </small>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-7">
                <div class="panel panel-default" style="opacity: 0.9; margin-top:30px;">
                    <div class="panel-heading" align="center">
                    <span class="glyphicon glyphicon-lock"></span>
                    INICIAR SESIÓN
                    </div>
                    <div class="panel-body">
                    @include('partials.errors')
                        {!! Form::open( ["url" => "login", "method" => "POST", "class"=>"form-horizontal"]) !!}
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label for="inputUser" class="col-sm-3 control-label">
                                    Usuario
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="userName" class="form-control"  placeholder="Nombre de Usuario" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label">
                                    Contraseña
                                </label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" class="form-control"  placeholder="Contraseña" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="aeropuerto_id" class="col-sm-3 control-label">
                                    Aeropuerto
                                </label>
                                <div class="col-sm-9">
                            {!! Form::select('aeropuerto_id', $aeropuertos, null, [ 'class'=>"form-control"]) !!}                                </div>
                            </div>
                            <div class="form-group last" style="margin-bottom:0px;">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-primary btn-sm"> Ingresa </button>
                                    <button type="reset" class="btn btn-default btn-sm">
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                         {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="pull-right" style="margin-top: 350px" >
        <img src="{{asset('/imgs/logos.png')}}" width= "350px" />
    </div>
    <div class="pull-right col-md-4" style="margin-top: 350px" >
        <h5 style="color:#0066FF; text-align: right"><strong>Sistema de Control de Recaudación y Operaciones Aeronáuticas</strong></h5>
    </div>
</body>