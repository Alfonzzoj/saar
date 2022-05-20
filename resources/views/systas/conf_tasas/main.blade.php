@extends('app')
@section('content')
    <div class="row" id="box-wrapper">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Configuración de tipos de tasa</h3>
                </div>
            <div class="box-body text-right">
                <form action="private/printTasa/rpt01.php" method="post" name="form" target="_blank" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-2">Fecha: </label>
                        <div class="col-md-6">
                            <input type="text" name="f" value="<?= date ("d/m/Y")?>" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Serie: </label>
                        <div class="col-md-6">
                            <select name="s" class="form-control">
                                <option value="">Seleccione la Serie</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="T">Tercera Edad</option>
                                <option value="I">Infante</option>
                                <option value="D">Discapacitado</option>
                            </select>
                        </div>
                    </div>

                <div class="form-group">
                    <label class="control-label col-md-2">Tipo de Tasa: </label>
                    <div class="col-md-6">
                        <select name="tTasa" class="form-control" onchange="document.form.m.value=this.value">
                        <option value="">Seleccion tipo de Tasa</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2">Monto </label>
                    <div class="col-md-6">
                        <input type="text" name="m" value="" size="15" maxlength="40" class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2">Cantidad: </label>
                    <div class="col-md-6">
                        <input type="text" name="cTasa" value="" size="6" maxlength="30" class="form-control"/>
                    </div>
                </div>
                <!-- Botones de Accion -->
                <div class="inputBtn">
                    <input type="submit" name="bConsulta" value="Enviar" class="pointer" class="btn btn-default"/>
                </div>

                </form>
            </div>
        </div>
    </div>

 @endsection