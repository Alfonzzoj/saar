</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Version</b> 1.0
			</div>
			<strong>Copyright &copy; 2014-2015 - SAAR Bolívar.</strong> Todos los derechos reservados.
</footer>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.3 -->
<script src=" {{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}" type="text/javascript"></script>  
<!-- jQuery validate -->
<script src=" {{ asset('/plugins/jQuery/jquery.validate.min.js') }}" type="text/javascript"></script>  
<!-- jQuery UI 1.11.2 -->
<script src=" {{ asset('/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>  
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.2 JS -->      
<script src=" {{ asset('/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>   
<!-- Morris.js charts -->
<script src="{{ asset('/js/raphael-min.js') }}"></script>

<!--<script src="plugins/morris/morris.min.js" type="text/javascript"></script> -->
<script src=" {{ asset('/plugins/sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>  
<!-- jvectormap -->
<script src=" {{ asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}" type="text/javascript"></script>  
<script src=" {{ asset('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>  
<!-- jQuery Knob Chart -->
<script src=" {{ asset('/plugins/knob/jquery.knob.js') }}" type="text/javascript"></script>  
<!-- daterangepicker -->
<script src=" {{ asset('/plugins/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
<!-- datepicker -->
<script src=" {{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src=" {{ asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}" type="text/javascript"></script>  
<!-- iCheck -->
<script src=" {{ asset('/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>  
<!-- Slimscroll -->
<script src=" {{ asset('/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>  
<!-- FastClick -->
<script src=" {{ asset('/plugins/fastclick/fastclick.min.js') }}" type="text/javascript"></script>  

<script src=" {{ asset('/plugins/chosen/chosen.jquery.min.js') }}" type="text/javascript"></script>

<script src=" {{ asset('/plugins/alertify/lib/alertify.min.js') }}" type="text/javascript"></script>

<script src=" {{ asset('/plugins/multi-select/js/jquery.multi-select.js') }}" type="text/javascript"></script>

<!-- ChartJS 1.0.1 -->
<script src=" {{ asset('/plugins/chartjs/dist/Chart.min.js') }}" type="text/javascript"></script>
<script src=" {{ asset('/plugins/chartjs/dist/Chart.bundle.min.js') }}" type="text/javascript"></script>

<!-- AdminLTE App -->
<script src=" {{ asset('/dist/js/app.min.js') }}" type="text/javascript"></script>

<script src=" {{ asset('/js/shared.js') }}" type="text/javascript"></script>

<script src=" {{ asset('/plugins/input-mask/jquery.inputmask.js') }}" type="text/javascript"></script>
<script src=" {{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js') }}" type="text/javascript"></script>
<script src=" {{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}" type="text/javascript"></script>

<script src=" {{ asset('plugins/fullcalendar/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{ asset('/plugins/fullcalendar/locale-all.js') }}"></script>
<script src="{{ asset('/plugins/fullcalendar/gcal.min.js') }}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src=" {{ asset('/dist/js/pages/dashboard.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
   error: function(data, textStatus, jqXHR) { if(data.status == 498){ location.reload(); }}

});
</script>
</body>
</html>
