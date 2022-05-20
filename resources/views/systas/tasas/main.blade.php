@extends('app')
@section('content')
    <div class="row" id="box-wrapper">
        <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Servicios</h3>
            </div>
            <div class="box-body text-right">

                <!-- lOGIN -->
                <form action="private/tasas/post.php" method="post" name="form" class="form-horizontal">

                    <div class="form-group">
                        <label class="control-label col-md-2" >Codigo: </label>
                        <div class="col-md-6">
                            <input id="codigo" name="c" type="text" size="24" maxlength="23"  class="form-control"/>
                        </div>
                    </div>
                    <div>

                    <div class="inputBtn">
                        <input type="submit" name="bConsulta" value="Enviar" class="pointer" class="btn btn-default"/>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection