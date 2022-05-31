@extends('app')

@section('content')

<ol class="breadcrumb">
	<li><a href="{{url('principal')}}">Inicio</a></li>
	<li><a class="active">Tráfico Aereo por Aerolínea</a></li>
</ol>
<div class="row" id="box-wrapper">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Filtros</h3>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse">
						<i class="fa fa-minus"></i>
					</button>
				</div><!-- /.box-tools -->
			</div>
            <div class="box-body">
                {!! Form::open(["url" => action('ReporteController@getReporteTraficoAereo'), "method" => "GET", "class"=>"form-inline"]) !!}
                 <label><strong>DESDE: </strong></label>
				<div class="form-group">
					<input type="text" class="form-control" name="diaDesde" value="{{$diaDesde}}" placeholder="Día">
                </div>
                <div class="form-group">
                      {!! Form::select('mesDesde', $meses, $mesDesde, ["class"=> "form-control"]) !!}
                </div>
                <div class="form-group">
                      {!! Form::select('annoDesde', $annos, $annoDesde, ["class"=> "form-control"]) !!}
                </div>
                <label style="margin-left: 20px"><strong>HASTA: </strong></label>
				<div class="form-group">
					<input type="text" class="form-control" name="diaHasta" value="{{$diaHasta}}" placeholder="Día">
                </div>
                <div class="form-group">
                      {!! Form::select('mesHasta', $meses, $mesHasta, ["class"=> "form-control"]) !!}
                </div>
                <div class="form-group">
                      {!! Form::select('annoHasta', $annos, $annoHasta, ["class"=> "form-control"]) !!}
                </div>
                <br>
                <div class="form-group" style="margin-top:20px">
                <label style="width:100px"><strong>PROCEDENCIA: </strong></label>
                	{!! Form::select('procedencia', $puertos, $procedencia, ["class"=> "form-control select-flt"]) !!}               
                </div><br>
                <div class="form-group" style="margin-top:20px">
                <label style="width:100px"><strong>DESTINO: </strong></label>
                	{!! Form::select('destino', $puertos, $destino, ["class"=> "form-control select-flt"]) !!}              
                </div><br>
                <div class="form-group" style="margin-top:20px">
                <label style="width:100px"><strong>CLIENTE: </strong></label>                      
                	{!! Form::select('cliente_id', $clientes, $cliente, ["class"=> "form-control select-flt"]) !!}
                </div>
                <div class="pull-right">
	                <button type="submit" class="btn btn-primary">BUSCAR</button>
	                <a class="btn btn-default" href="{{action('ReporteController@getReporteTraficoAereo')}}">RESET</a>
                </div>
                {!! Form::close() !!}
            </div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-primary">
            <div class="box-header">
                {!! Form::open(["url" => action("ReporteController@postExportReport"), "id" =>"export-form", "target"=>"_blank"]) !!}
                {!! Form::hidden('table') !!}
                {!! Form::hidden('departamento', $departamento) !!}
                {!! Form::hidden('gerencia', $gerencia) !!}
                    <span class="pull-right">
										<input type="checkbox" name="excel"> Excel 
                        <button type="button" class="btn btn-primary" id="export-btn">
                            <span class="glyphicon glyphicon-file"></span> Exportar
                        </button>
                    </span>
                {!! Form::close() !!}
            </div>
			<div class="box-body" >
				<div class="row">
					<div class="col-xs-12">

						<div class="table-responsive">
							<table class="table table-condensed">
								<thead  class="bg-primary">
									<tr>
										<th colspan="3" rowspan="4" style="vertical-align: middle; width: 250px" class="text-center" align="center"> CLIENTE </th>
										<th colspan="13" style="vertical-align: middle" class="text-center" align="center">NACIONALES</th>
										<th colspan="13" style="vertical-align: middle" class="text-center" align="center">INTERNACIONALES</th>
									</tr>
									<tr>
										<th colspan="9" class="text-center" align="center" >PASAJEROS</th>
										<th colspan="2" class="text-center" align="center">CARGA</th>
										<th colspan="2" class="text-center" align="center" style="width: 65px">AERONAVES</th>
										<th colspan="9" class="text-center" align="center">PASAJEROS</th>
										<th colspan="2" class="text-center" align="center">CARGA</th>
										<th colspan="2" class="text-center" align="center" style="width: 65px">AERONÁVES</th>
									</tr>
									<tr>
										<th colspan="3" class="text-center" align="center">Desemb</th>
										<th colspan="3" class="text-center" align="center">Emb</th>
										<th colspan="3" class="text-center" align="center">Trans</th>

										<th colspan="1" class="text-center" align="center" >Desemb</th>
										<th colspan="1" class="text-center" align="center" >Emb</th>

										<th colspan="1" class="text-center" align="center" >Arri</th>
										<th colspan="1" class="text-center" align="center" >Desp</th>

										<th colspan="3" class="text-center" align="center">Desemb</th>
										<th colspan="3" class="text-center" align="center">Emb</th>
										<th colspan="3" class="text-center" align="center">Trans</th>

										<th colspan="1" class="text-center" align="center" >Desemb</th>
										<th colspan="1" class="text-center" align="center" >Emb</th>

										<th colspan="1" class="text-center" align="center" >Arri</th>
										<th colspan="1" class="text-center" align="center" >Desp</th>
									</tr>
									<tr align="center">
										<th class="text-center" align="center" style="width: 30px">ADUL</th>
										<th class="text-center" align="center" style="width: 30px">INF</th>
										<th class="text-center" align="center" style="width: 30px">3ra EDAD</th>
										<th class="text-center" align="center" style="width: 30px">ADUL</th>
										<th class="text-center" align="center" style="width: 30px">INF</th>
										<th class="text-center" align="center" style="width: 30px">3ra EDAD</th>
										<th class="text-center" align="center" style="width: 30px">ADUL</th>
										<th class="text-center" align="center" style="width: 30px">INF</th>
										<th class="text-center" align="center" style="width: 30px" >3ra EDAD</th>

										<th class="text-center" align="center" style="width: 30px">TON</th>
										<th class="text-center" align="center" style="width: 30px">TON</th>

										<th class="text-center" align="center" style="width: 30px">CANT</th>
										<th class="text-center" align="center" style="width: 30px">CANT</th>

										<th class="text-center" align="center" style="width: 30px">ADUL</th>
										<th class="text-center" align="center" style="width: 30px">INF</th>
										<th class="text-center" align="center" style="width: 30px">3ra EDAD</th>
										<th class="text-center" align="center" style="width: 30px">ADUL</th>
										<th class="text-center" align="center" style="width: 30px">INF</th>
										<th class="text-center" align="center" style="width: 30px">3ra EDAD</th>
										<th class="text-center" align="center" style="width: 30px">ADUL</th>
										<th class="text-center" align="center" style="width: 30px">INF</th>
										<th class="text-center" align="center" style="width: 30px">3ra EDAD</th>

										<th class="text-center" align="center" style="width: 30px">TON</th>
										<th class="text-center" align="center" style="width: 30px">TON</th>

										<th class="text-center" align="center" style="width: 30px">CANT</th>
										<th class="text-center" align="center" style="width: 30px">CANT</th>
									</tr>
								</thead>
								<tbody>
									@foreach($datosCliente as $index => $cliente)
									<tr>
										<td colspan="3" align="left" style="width: 250px" >{{$index}}</td>
										<td class="text-center desAdulNac" align="center" style="width: 30px" >{{$cliente['desAdulNac']}}</td>
										<td class="text-center desInfNac" align="center" style="width: 30px" >{{$cliente['desInfNac']}}</td>
										<td class="text-center desTercNac" align="center" style="width: 30px" >{{$cliente['desTercNac']}}</td>
										<td class="text-center EmbAdulNac" align="center" style="width: 30px" >{{$cliente['EmbAdulNac']}}</td>
										<td class="text-center EmbInfNac" align="center" style="width: 30px" >{{$cliente['EmbInfNac']}}</td>
										<td class="text-center EmbTercNac" align="center" style="width: 30px" >{{$cliente['EmbTercNac']}}</td>
										<td class="text-center TranAdulNac" align="center" style="width: 30px" >{{$cliente['TranAdulNac']}}</td>
										<td class="text-center TranInfNac" align="center" style="width: 30px" >{{$cliente['TranInfNac']}}</td>
										<td class="text-center TranTercNac" align="center" style="width: 30px" >{{$cliente['TranTercNac']}}</td>
										<td class="text-center cargaEmbNac" align="center" style="width: 30px" >{{$traductor->format($cliente['cargaEmbNac'])}}</td>
										<td class="text-center cargaDesNac" align="center" style="width: 30px" >{{$traductor->format($cliente['cargaDesNac'])}}</td>
										<td class="text-center aeroAterrizaNac" align="center" style="width: 30px" >{{$cliente['aeroAterrizaNac']}}</td>
										<td class="text-center aeroDespegueNac" align="center" style="width: 30px" >{{$cliente['aeroDespegueNac']}}</td>
										<td class="text-center desAdulInt" align="center" style="width: 30px" >{{$cliente['desAdulInt']}}</td>
										<td class="text-center desInfInt" align="center" style="width: 30px" >{{$cliente['desInfInt']}}</td>
										<td class="text-center desTercInt" align="center" style="width: 30px" >{{$cliente['desTercInt']}}</td>
										<td class="text-center EmbAdulInt" align="center" style="width: 30px" >{{$cliente['EmbAdulInt']}}</td>
										<td class="text-center EmbInfInt" align="center" style="width: 30px" >{{$cliente['EmbInfInt']}}</td>
										<td class="text-center EmbTercInt" align="center" style="width: 30px" >{{$cliente['EmbTercInt']}}</td>
										<td class="text-center TranAdulInt" align="center" style="width: 30px" >{{$cliente['TranAdulInt']}}</td>
										<td class="text-center TranInfInt" align="center" style="width: 30px" >{{$cliente['TranInfInt']}}</td>
										<td class="text-center TranTercInt" align="center" style="width: 30px" >{{$cliente['TranTercInt']}}</td>
										<td class="text-center cargaEmbInt" align="center" style="width: 30px" >{{$traductor->format($cliente['cargaEmbInt'])}}</td>
										<td class="text-center cargaDesInt" align="center" style="width: 30px" >{{$traductor->format($cliente['cargaDesInt'])}}</td>
										<td class="text-center aeroAterrizaInt" align="center" style="width: 30px" >{{$cliente['aeroAterrizaInt']}}</td>
										<td class="text-center aeroDespegueInt" align="center" style="width: 30px" >{{$cliente['aeroDespegueInt']}}</td>
									</tr>
									@endforeach
									<tr class="bg-gray" style="font-weight: bold">
										<td colspan="3" align="left">TOTAL</td>
										<td class="text-center" align="center" style="width: 30px" id="desAdulNac">0</td>
										<td class="text-center" align="center" style="width: 30px" id="desInfNac">0</td>
										<td class="text-center" align="center" style="width: 30px" id="desTercNac">0</td>
										<td class="text-center" align="center" style="width: 30px" id="EmbAdulNac">0</td>
										<td class="text-center" align="center" style="width: 30px" id="EmbInfNac">0</td>
										<td class="text-center" align="center" style="width: 30px" id="EmbTercNac">0</td>
										<td class="text-center" align="center" style="width: 30px" id="TranAdulNac">0</td>
										<td class="text-center" align="center" style="width: 30px" id="TranInfNac">0</td>
										<td class="text-center" align="center" style="width: 30px" id="TranTercNac">0</td>
										<td class="text-center" align="center" style="width: 30px" id="cargaEmbNac">0,00</td>
										<td class="text-center" align="center" style="width: 30px" id="cargaDesNac">0,00</td>
										<td class="text-center" align="center" style="width: 30px" id="aeroAterrizaNac">0</td>
										<td class="text-center" align="center" style="width: 30px" id="aeroDespegueNac">0</td>
										<td class="text-center" align="center" style="width: 30px" id="desAdulInt">0</td>
										<td class="text-center" align="center" style="width: 30px" id="desInfInt">0</td>
										<td class="text-center" align="center" style="width: 30px" id="desTercInt">0</td>
										<td class="text-center" align="center" style="width: 30px" id="EmbAdulInt">0</td>
										<td class="text-center" align="center" style="width: 30px" id="EmbInfInt">0</td>
										<td class="text-center" align="center" style="width: 30px" id="EmbTercInt">0</td>
										<td class="text-center" align="center" style="width: 30px" id="TranAdulInt">0</td>
										<td class="text-center" align="center" style="width: 30px" id="TranInfInt">0</td>
										<td class="text-center" align="center" style="width: 30px" id="TranTercInt">0</td>
										<td class="text-center" align="center" style="width: 30px" id="cargaEmbInt">0,00</td>
										<td class="text-center" align="center" style="width: 30px" id="cargaDesInt">0,00</td>
										<td class="text-center" align="center" style="width: 30px" id="aeroAterrizaInt">0</td>
										<td class="text-center" align="center" style="width: 30px" id="aeroDespegueInt">0</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
	$(function(){

        var desAdulNac=0;
        $('.desAdulNac').each(function(index,value){
            desAdulNac+=commaToNum($(value).text().trim());
        });

        var desInfNac=0;
        $('.desInfNac').each(function(index,value){
            desInfNac+=commaToNum($(value).text().trim());
        });


        var desTercNac=0;
        $('.desTercNac').each(function(index,value){
            desTercNac+=commaToNum($(value).text().trim());
        });

        var EmbAdulNac=0;
        $('.EmbAdulNac').each(function(index,value){
            EmbAdulNac+=commaToNum($(value).text().trim());
        });

        var EmbInfNac=0;
        $('.EmbInfNac').each(function(index,value){
            EmbInfNac+=commaToNum($(value).text().trim());
        });

        var EmbTercNac=0;
        $('.EmbTercNac').each(function(index,value){
            EmbTercNac+=commaToNum($(value).text().trim());
        });

        var TranAdulNac=0;
        $('.TranAdulNac').each(function(index,value){
            TranAdulNac+=commaToNum($(value).text().trim());
        });

        var TranInfNac=0;
        $('.TranInfNac').each(function(index,value){
            TranInfNac+=commaToNum($(value).text().trim());
        });

        var TranTercNac=0;
        $('.TranTercNac').each(function(index,value){
            TranTercNac+=commaToNum($(value).text().trim());
        });


		var cargaEmbNac=0;
        $('.cargaEmbNac').each(function(index,value){
            cargaEmbNac+=commaToNum($(value).text().trim());
        });
        $('#cargaEmbNac').text(numToComma(cargaEmbNac));

		var cargaDesNac=0;
        $('.cargaDesNac').each(function(index,value){
            cargaDesNac+=commaToNum($(value).text().trim());
        });
        $('#cargaDesNac').text(numToComma(cargaDesNac));


        var aeroAterrizaNac=0;
        $('.aeroAterrizaNac').each(function(index,value){
            aeroAterrizaNac+=commaToNum($(value).text().trim());
        });

        var aeroDespegueNac=0;
        $('.aeroDespegueNac').each(function(index,value){
            aeroDespegueNac+=commaToNum($(value).text().trim());
        });
        var desAdulInt=0;
        $('.desAdulInt').each(function(index,value){
            desAdulInt+=commaToNum($(value).text().trim());
        });

        var desInfInt=0;
        $('.desInfInt').each(function(index,value){
            desInfInt+=commaToNum($(value).text().trim());
        });


        var desTercInt=0;
        $('.desTercInt').each(function(index,value){
            desTercInt+=commaToNum($(value).text().trim());
        });

        var EmbAdulInt=0;
        $('.EmbAdulInt').each(function(index,value){
            EmbAdulInt+=commaToNum($(value).text().trim());
        });

        var EmbInfInt=0;
        $('.EmbInfInt').each(function(index,value){
            EmbInfInt+=commaToNum($(value).text().trim());
        });

        var EmbTercInt=0;
        $('.EmbTercInt').each(function(index,value){
            EmbTercInt+=commaToNum($(value).text().trim());
        });

        var TranAdulInt=0;
        $('.TranAdulInt').each(function(index,value){
            TranAdulInt+=commaToNum($(value).text().trim());
        });

        var TranInfInt=0;
        $('.TranInfInt').each(function(index,value){
            TranInfInt+=commaToNum($(value).text().trim());
        });

        var TranTercInt=0;
        $('.TranTercInt').each(function(index,value){
            TranTercInt+=commaToNum($(value).text().trim());
        });

        var cargaEmbInt=0;
        $('.cargaEmbInt').each(function(index,value){
            cargaEmbInt+=commaToNum($(value).text().trim());
        });

		$('#cargaEmbInt').text(numToComma(cargaEmbInt));

        var cargaDesInt=0;
        $('.cargaDesInt').each(function(index,value){
            cargaDesInt+=commaToNum($(value).text().trim());
        });

		$('#cargaDesInt').text(numToComma(cargaDesInt));

        var aeroAterrizaInt=0;
        $('.aeroAterrizaInt').each(function(index,value){
            aeroAterrizaInt+=commaToNum($(value).text().trim());
        });

        var aeroDespegueInt=0;
        $('.aeroDespegueInt').each(function(index,value){
            aeroDespegueInt+=commaToNum($(value).text().trim());
        });

        $('#desAdulNac').text(desAdulNac);
        $('#desInfNac').text(desInfNac);
        $('#desTercNac').text(desTercNac);
        $('#EmbAdulNac').text(EmbAdulNac);
        $('#EmbInfNac').text(EmbInfNac);
        $('#EmbTercNac').text(EmbTercNac);
        $('#TranAdulNac').text(TranAdulNac);
        $('#TranInfNac').text(TranInfNac);
        $('#TranTercNac').text(TranTercNac);
        $('#cargaEmbNac').text(cargaEmbNac);
        $('#cargaDesNac').text(cargaDesNac);
        $('#aeroAterrizaNac').text(aeroAterrizaNac);
        $('#aeroDespegueNac').text(aeroDespegueNac);
        $('#desAdulInt').text(desAdulInt);
        $('#desInfInt').text(desInfInt);
        $('#desTercInt').text(desTercInt);
        $('#EmbAdulInt').text(EmbAdulInt);
        $('#EmbInfInt').text(EmbInfInt);
        $('#EmbTercInt').text(EmbTercInt);
        $('#TranAdulInt').text(TranAdulInt);
        $('#TranInfInt').text(TranInfInt);
        $('#TranTercInt').text(TranTercInt);
        $('#cargaEmbInt').text(cargaEmbInt);
        $('#cargaDesInt').text(cargaDesInt);
        $('#aeroAterrizaInt').text(aeroAterrizaInt);
        $('#aeroDespegueInt').text(aeroDespegueInt);

		$('#export-btn').click(function(e){
			var table=$('table').clone();
			$(table).find('td, th').filter(function() {
				return $(this).css('display') == 'none';
			}).remove();
			$(table).find('tr').filter(function() {
				return $(this).find('td,th').length == 0;
			}).remove();
			$(table).prepend('<thead>\
								<tr>\
									<th colspan="29" style="vertical-align: middle; margin-top:20px" align="center" class="text-center">TRÁFICO AEREO POR AEROLÍNEA\
										</br>\
										AEROPUERTO: {{$aeropuerto->nombre}}\
										</br>\
										CLIENTE: {{($clientes)?"TODOS":$clientes->nombre}}\
										</br>\
										PROCEDENCIA: {{$procedenciaNombre}} - DESTINO: {{$destinoNombre}}\
										</br>\
										DESDE: {{$diaDesde}}/{{$mesDesde}}/{{$annoDesde}} HASTA: {{$diaHasta}}/{{$mesHasta}}/{{$annoHasta}} </th>\
									</th>\
								</tr>\
							</thead>')
			$(table).find('thead, th').css({'border-top':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '1px'})
			$(table).find('th').css({'border-bottom':'1px solid black', 'font-weight': 'bold', 'text-align':"center", 'font-size': '10px'})
			$(table).find('td').css({'font-size': '9px'})
			$(table).find('tr:nth-child(even)').css({'border-bottom':'1px solid black'})

			$(table).find('tr:last td').css({'border-bottom':'1px solid black','border-top':'1px solid black', 'font-weight': 'bold'})
			var tableHtml= $(table)[0].outerHTML;
			$('[name=table]').val(tableHtml);
			$('#export-form').submit();
		});

    $('.select-flt').chosen({width:'400px'});
	});
</script>
@endsection