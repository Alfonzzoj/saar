<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>SAAR | Recaudación</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <meta name="_token" content="{!! csrf_token() !!}"/>
  <meta http-equiv="cache-control" content="max-age=0" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="cache-control" content="no-store" />
  <meta http-equiv="cache-control" content="must-revalidate" />
  <meta http-equiv="expires" content="0" />
  <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
  <meta http-equiv="pragma" content="no-cache" />
  <!-- Bootstrap 3.3.2 -->  

  <link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- FontAwesome 4.3.0 -->
  <link href="{{ asset('/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- Ionicons 2.0.0 -->
  <link href="{{ asset('/css/ionicons/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- Theme style -->


    <link href="{{ asset('/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/general.css') }}" rel="stylesheet">
  <!-- AdminLTE Skins. Choose a skin from the css/skins 
  folder instead of downloading all of them to reduce the load. -->
      <link href="{{ asset('/dist/css/skins/_all-skins.min.css') }}" rel="stylesheet">
  <!-- iCheck -->
      <link href="{{ asset('/plugins/iCheck/flat/blue.css') }}" rel="stylesheet">
  <!-- Morris chart -->
      <link href="{{ asset('/plugins/morris/morris.css') }}" rel="stylesheet">
  <!-- jvectormap -->
      <link href="{{ asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">
  <!-- Date Picker -->
      <link href="{{ asset('/plugins/datepicker/datepicker3.css') }}" rel="stylesheet">
  <!-- Daterange picker -->
      <link href="{{ asset('/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet">
  <!-- bootstrap wysihtml5 - text editor -->
      <link href="{{ asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet">

      <link href="{{ asset('/plugins/chosen/chosen.min.css') }}" rel="stylesheet">

      <link href="{{ asset('/plugins/alertify/themes/alertify.core.css') }}" rel="stylesheet">

      <link href="{{ asset('/plugins/alertify/themes/alertify.bootstrap.css') }}" rel="stylesheet">

      <link href="{{ asset('/plugins/multi-select/css/multi-select.css') }}" rel="stylesheet">

      <link href="{{ asset('/plugins/fullcalendar/fullcalendar.css') }}" rel="stylesheet">
      <link href="{{ asset('/plugins/fullcalendar/fullcalendar.print.css') }}" media="print" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="{{ asset('/js/html5shiv.js') }}"></script>
      <script src="{{ asset('/js/respond.min.js') }}"></script>
      <![endif]-->
    </head>

