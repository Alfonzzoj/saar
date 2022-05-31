@extends('app')
@section('content')
<section class="content-header">
	<h1>
		<i class="ion-speedometer"></i> Dashboard
		<small><b><i class="ion ion-android-calendar"></i> {{$today->format('d/m/Y')}}</b></small>
	</h1>
</section>

@include('dashboards.SCV.partials.infoBox') 
@include('dashboards.SCV.partials.aterrizajesPendientesBox') 
@include('dashboards.SCV.partials.resumenCuadreCaja') 
@include('dashboards.SCV.partials.despeguesRecientesBox') 

@endsection
