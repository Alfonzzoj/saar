<style>
/*
This is the Material Design theme for FullCalendar Weekly Agenda view
Creation Date: Aug 19th 2015
Author: Jacky Liang
Version: FullCalendar 2.4.0
Tested Using the Following FC Settings:
    editable: false,
    handleWindowResize: true,
    weekends: false, // Hide weekends
    defaultView: 'agendaWeek', // Only show week view
    header: false, // Hide buttons/titles
    minTime: '07:30:00', // Start time for the calendar
    maxTime: '22:00:00', // End time for the calendar
    columnFormat: {
        week: 'ddd' // Only show day of the week names
    },
    displayEventTime: true,
    allDayText: 'Online/TBD'
Note: This has NOT been tested on Monthly or Daily views.
Colors: Use the following - https://www.google.com/design/spec/style/color.html#color-color-palette
        at the 700 level. An opacity of 0.65 is automatically applied to the
        700 level colors to generate a soft and pleasing look.
        Color were applied to each event using the following code:
        events.push({
            title: 'This is a Material Design event!',
            start: 'someStartDate',
            end: 'someEndDate',
            color: '#C2185B'
        });
*/
/* Remove that awful yellow color and border from today in Schedule */
.fc {
    text-align: center !important;
}

.fc-state-highlight {
    opacity: 0;
    border: none;
}

/* Styling for each event from Schedule */
.fc-time-grid-event.fc-v-event.fc-event {
    border-radius: 4px;
    border: none;
    padding: 5px;
    opacity: .65;
    left: 5% !important;
    right: 5% !important;
}

/* Bolds the name of the event and inherits the font size */
.fc-event {
    font-size: inherit !important;
    font-weight: bold !important;
}

/* Remove the header border from Schedule */
.fc td, .fc th {
    border-style: none !important;
    border-width: 1px !important;
    padding: 0 !important;
    vertical-align: middle !important;
}

.fc td .fc-day-top:hover{
	background: #558B2F;
	opacity: 0.8;
	cursor: pointer;
}

.ui-widget-header {
	border-bottom: 3px solid #F44336 !important;

}

/* Inherits background for each event from Schedule. */
.fc-event .fc-bg {
    z-index: 1 !important;
    background: inherit !important;
    opacity: .25 !important;
}

/* Normal font weight for the time in each event */
.fc-time-grid-event .fc-time {
    font-weight: normal !important;
}

/* Apply same opacity to all day events */
.fc-ltr .fc-h-event.fc-not-end, .fc-rtl .fc-h-event.fc-not-start {
    opacity: .65 !important;
    margin-left: 12px !important;
    padding: 5px !important;
}

/* Apply same opacity to all day events */
.fc-day-grid-event.fc-h-event.fc-event.fc-not-start.fc-end {
    opacity: .65 !important;
    margin-left: 12px !important;
    padding: 5px !important;
}

/* Material design button */
.fc-button {
    display: inline-block;
    position: relative;
    cursor: pointer;
    min-height: 36px;
    min-width: 88px;
    line-height: 36px;
    vertical-align: middle;
    -webkit-box-align: center;
    -webkit-align-items: center;
    align-items: center;
    text-align: center;
    border-radius: 2px;
    box-sizing: border-box;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    outline: none;
    border: 0;
    padding: 0 6px;
    margin: 6px 8px;
    letter-spacing: .01em;
    background: transparent;
    color: currentColor;
    white-space: nowrap;
    text-transform: uppercase;
    font-weight: 500;
    font-size: 14px;
    font-style: inherit;
    font-variant: inherit;
    font-family: inherit;
    text-decoration: none;
    overflow: hidden;
    -webkit-transition: box-shadow .4s cubic-bezier(.25,.8,.25,1),background-color .4s cubic-bezier(.25,.8,.25,1);
    transition: box-shadow .4s cubic-bezier(.25,.8,.25,1),background-color .4s cubic-bezier(.25,.8,.25,1);
}

.fc-button:hover {
    background-color: rgba(158,158,158,0.2);
}

.fc-button:focus, .fc-button:hover {
    text-decoration: none;
}

/* The active button box is ugly so the active button will have the same appearance of the hover */
.fc-state-active {
    background-color: rgba(158,158,158,0.2);
}

/* Not raised button */
.fc-state-default {
    box-shadow: None;
}
</style>
<div>
    <div class="row">

        <div id="calendar-enero" class ="col-sm-3">

        </div>

        <div  id="calendar-febrero" class ="col-sm-3">

        </div>

        <div  id="calendar-marzo" class ="col-sm-3">

        </div>

        <div  id="calendar-abril" class ="col-sm-3">

        </div>
    </div>
    <div class="row">
    
        <div  id="calendar-mayo" class ="col-sm-3">

        </div>

        <div  id="calendar-junio" class ="col-sm-3">

        </div>

        <div  id="calendar-julio" class ="col-sm-3">

        </div>

        <div  id="calendar-agosto" class ="col-sm-3">

        </div>
    </div>
    <div>
        <div  id="calendar-septiembre" class ="col-sm-3">

        </div>

        <div  id="calendar-octubre" class ="col-sm-3">

        </div>

        <div  id="calendar-noviembre" class ="col-sm-3">

        </div>

        <div  id="calendar-diciembre" class ="col-sm-3">

        </div>
    </div>
</div>

<div class="modal fade" id="modal" style="display: none;">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
		  	<div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			      <span aria-hidden="true">×</span></button>
			    <h5 class="modal-title"></h5>
		  	</div>
			  	<div class="modal-body">
			  		<div class="form-group">
			  			<div class="row">
	                  		<label for="porcentaje" class="col-sm-3 control-label" style="padding-top: 10px;">Porcentaje: </label>
			                <div class="col-sm-9">
			                	<input type="number" class="form-control" id="porcentaje" name="porcentaje" min="0" style="width: 150px;">
                                <input type="number" class="hidden" id="dia" name="dia">
                                <input type="number" class="hidden" id="mes" name="mes">
			                </div>
		            	</div>
                	</div>
			  	</div>
			  	<div class="modal-footer">
                    <button id="delete-btn" type="button" class="hidden btn btn-sm btn-danger" data-dismiss="modal">Eliminar</button>
			  		<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
			    	<button id="save-btn" type="button" class="btn btn-sm btn-primary">Guardar</button>
				</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>


@section('script')
@parent
<script>
    $(".chosen-select").chosen({width: "95%"}); 

    function post_dia_feriado(){
        $.ajax({
          method: "POST",
          url: "{{action('InformacionController@store_dias_feriados')}}",
          data: { dia: $('#modal .modal-body #dia').text(), mes: $('#modal .modal-body #mes').text() , porcentaje: $('#modal .modal-body #porcentaje').val()}
        })
        .success(function( data ) {
            switch(data.mes)
            {
                case "01":
                    $('#calendar-enero').fullCalendar( 'refetchEvents' );
                    break;
                case "02":
                    $('#calendar-febrero').fullCalendar('refetchEvents');
                    break;
                case "03":
                    $('#calendar-marzo').fullCalendar('refetchEvents');
                    break;
                case "04":
                    $('#calendar-abril').fullCalendar('refetchEvents');
                    break;
                case "05":
                    $('#calendar-mayo').fullCalendar('refetchEvents');
                    break;
                case "06":
                    $('#calendar-junio').fullCalendar('refetchEvents');
                    break;
                case "07":
                    $('#calendar-julio').fullCalendar('refetchEvents');
                    break;
                case "08":
                    $('#calendar-agosto').fullCalendar('refetchEvents');
                    break;
                case "09":
                    $('#calendar-septiembre').fullCalendar('refetchEvents');
                    break;
                case "10":
                    $('#calendar-octubre').fullCalendar('refetchEvents');
                    break;
                case "11":
                    $('#calendar-noviembre').fullCalendar('refetchEvents');
                    break;
                case "12":
                    $('#calendar-diciembre').fullCalendar('refetchEvents');
                    break;

            }
            $('#modal').modal('hide'); 
        });
    }

    function update_dia_feriado(id){
        var identificador = id;
        $.ajax({
          method: "PUT",
          url: "{{action('InformacionController@update_dias_feriados')}}",
          data: { id: identificador, porcentaje: $('#modal .modal-body #porcentaje').val() }
        })
        .success(function( data ) {
            switch(data.mes)
            {
                case "1":
                    $('#calendar-enero').fullCalendar( 'refetchEvents' );
                    break;
                case "2":
                    $('#calendar-febrero').fullCalendar('refetchEvents');
                    break;
                case "3":
                    $('#calendar-marzo').fullCalendar('refetchEvents');
                    break;
                case "4":
                    $('#calendar-abril').fullCalendar('refetchEvents');
                    break;
                case "5":
                    $('#calendar-mayo').fullCalendar('refetchEvents');
                    break;
                case "6":
                    $('#calendar-junio').fullCalendar('refetchEvents');
                    break;
                case "7":
                    $('#calendar-julio').fullCalendar('refetchEvents');
                    break;
                case "8":
                    $('#calendar-agosto').fullCalendar('refetchEvents');
                    break;
                case "9":
                    $('#calendar-septiembre').fullCalendar('refetchEvents');
                    break;
                case "10":
                    $('#calendar-octubre').fullCalendar('refetchEvents');
                    break;
                case "11":
                    $('#calendar-noviembre').fullCalendar('refetchEvents');
                    break;
                case "12":
                    $('#calendar-diciembre').fullCalendar('refetchEvents');
                    break;

            }
            $('#modal').modal('hide'); 
        });
    }

    function pad2(number) {
        return (number < 10 ? '0' : '') + number
    }

    function delete_dia_feriado(id){
        var identificador = id;
        $.ajax({
          method: "DELETE",
          url: "{{action('InformacionController@delete_dias_feriados')}}",
          data: { id: identificador }
        })
        .success(function( data) {
            if(data.operacion == 1)
            {
                var dateString = moment().year() + '-' + pad2(data.feriado.mes) + '-' + pad2(data.feriado.dia);
                console.log(dateString);
                $('.fc-bg .fc-day[data-date=' + dateString + ']').removeAttr( 'style' );
                switch(data.feriado.mes)
                {
                    case "1":
                        $('#calendar-enero').fullCalendar( 'refetchEvents' );
                        break;
                    case "2":
                        $('#calendar-febrero').fullCalendar('refetchEvents');
                        break;
                    case "3":
                        $('#calendar-marzo').fullCalendar('refetchEvents');
                        break;
                    case "4":
                        $('#calendar-abril').fullCalendar('refetchEvents');
                        break;
                    case "5":
                        $('#calendar-mayo').fullCalendar('refetchEvents');
                        break;
                    case "6":
                        $('#calendar-junio').fullCalendar('refetchEvents');
                        break;
                    case "7":
                        $('#calendar-julio').fullCalendar('refetchEvents');
                        break;
                    case "8":
                        $('#calendar-agosto').fullCalendar('refetchEvents');
                        break;
                    case "9":
                        $('#calendar-septiembre').fullCalendar('refetchEvents');
                        break;
                    case "10":
                        $('#calendar-octubre').fullCalendar('refetchEvents');
                        break;
                    case "11":
                        $('#calendar-noviembre').fullCalendar('refetchEvents');
                        break;
                    case "12":
                        $('#calendar-diciembre').fullCalendar('refetchEvents');
                        break;

                }
                $('#modal').modal('hide'); 
            }
        });
    }

	$(document).ready(function() {

		var meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];

        var anho = moment().year();
        var enero = moment(anho + '-01-01');
        var febrero = moment(anho + '-02-01');
        var marzo = moment(anho + '-03-01');
        var abril = moment(anho + '-04-01');
        var mayo = moment(anho + '-05-01');
        var junio = moment(anho + '-06-01');
        var julio = moment(anho + '-07-01');
        var agosto = moment(anho + '-08-01');
        var septiembre = moment(anho + '-09-01');
        var octubre = moment(anho + '-10-01');
        var noviembre = moment(anho + '-11-01');
        var diciembre = moment(anho + '-12-01');

        function modal_show(id, date, porcentaje, metodo){
            $('#modal .modal-title').text(date.format('D') + ' de ' + meses[date.format('MM')-1] + ' de ' +  date.format('YYYY'));
            $('#modal .modal-body #dia').text(date.format('D'));
            $('#modal .modal-body #mes').text(date.format('MM'));
            $('#modal .modal-body #porcentaje').val(porcentaje);

            if(metodo == "POST")
            {
                if(!$('#delete-btn').hasClass('hidden')){ $('#delete-btn').addClass('hidden'); }
                document.getElementById("save-btn").setAttribute("onClick","post_dia_feriado()");
            }else{
                document.getElementById("delete-btn").setAttribute("onClick","delete_dia_feriado(" + id + ")");
                $('#delete-btn').removeClass('hidden');
                document.getElementById("save-btn").setAttribute("onClick","update_dia_feriado(" + id + ")");
            }
            $('#modal').modal('show');  
        }

        $('#calendar-enero').fullCalendar({
            theme: 'jquery-ui',
            header: {
                left: '',
                center: 'title',
                right: ''
            },
            locale: 'es',
            timezone: 'local',
            displayEventTime: false,
            titleFormat: 'MMMM',
            defaultView: 'month',
            defaultDate: enero,
            fixedWeekCount: false,
            showNonCurrentDates: false,
            contentHeight: 'auto',
            dayClick: function(date, jsEvent, view) {
                // Create a string representing just the day/month/year of the date clicked
                dateString = date.format('D') + date.format('MM') + date.format('YYYY');
                // Grab the events for that day using a custom filter function
                events = $('#calendar-enero').fullCalendar('clientEvents', function (event) {
                    eventDate = event.start;
                    eventDateString = eventDate.format('D') + eventDate.format('MM') + eventDate.format('YYYY');
                    return dateString === eventDateString;
                });

                if (events.length) {
                    // Find the first event's element by its class name
                    var $event = $('#calendar-enero').find('.' + events[0]._id);

                    $event.trigger('click');
                }else{
                   modal_show(null, date, 0, "POST");
                }
            },
            eventClick: function(event, jsEvent, view ) {
                date = event.start;
                modal_show(event.id, date, event.title, "UPDATE");
            },
            eventSources: [
                {
                   url: "{{action('InformacionController@dias_feriados')}}",
                   color: '#FF9100',
                   textColor: 'white'
                }
            ],
            eventRender: function (event, element, view) { 
                // event.start is already a moment.js object
                // we can apply .format()
                var dateString = event.start.format("YYYY-MM-DD");
                
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('background-color', '#7CB342');
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('opacity', '0.4');

                $(element).addClass(event._id);
            }
        }) 

        $('#calendar-febrero').fullCalendar({
            theme: 'jquery-ui',
            header: {
                left: '',
                center: 'title',
                right: ''
            },
            locale: 'es',
            timezone: 'local',
            displayEventTime: false,
            titleFormat: 'MMMM',
            defaultView: 'month',
            defaultDate: febrero,
            fixedWeekCount: false,
            showNonCurrentDates: false,
            contentHeight: 'auto',
            dayClick: function(date, jsEvent, view) {
                
                // Create a string representing just the day/month/year of the date clicked
                dateString = date.format('D') + date.format('MM') + date.format('YYYY');

                // Grab the events for that day using a custom filter function
                events = $('#calendar-febrero').fullCalendar('clientEvents', function (event) {
                    eventDate = event.start;
                    eventDateString = eventDate.format('D') + eventDate.format('MM') + eventDate.format('YYYY');

                    return dateString === eventDateString;
                });

                if (events.length) {
                    // Find the first event's element by its class name
                    var $event = $('#calendar-febrero').find('.' + events[0]._id);

                    $event.trigger('click');
                }else{
                    modal_show(null, date, 0, "POST");
                }
            },
            eventClick: function(event, jsEvent, view ) {
                date = event.start;
                modal_show(event.id, date, event.title, "UPDATE");
            },
            eventSources: [
                {
                   url: "{{action('InformacionController@dias_feriados')}}",
                   color: '#FF9100',
                   textColor: 'white'
                }
            ],
            eventRender: function (event, element, view) { 
                // event.start is already a moment.js object
                // we can apply .format()
                var dateString = event.start.format("YYYY-MM-DD");
                
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('background-color', '#7CB342');
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('opacity', '0.4');

                $(element).addClass(event._id);
            }
        })

        $('#calendar-marzo').fullCalendar({
            theme: 'jquery-ui',
            header: {
                left: '',
                center: 'title',
                right: ''
            },
            locale: 'es',
            timezone: 'local',
            displayEventTime: false,
            titleFormat: 'MMMM',
            defaultView: 'month',
            defaultDate: marzo,
            fixedWeekCount: false,
            showNonCurrentDates: false,
            contentHeight: 'auto',
            dayClick: function(date, jsEvent, view) {
                
                // Create a string representing just the day/month/year of the date clicked
                dateString = date.format('D') + date.format('MM') + date.format('YYYY');

                // Grab the events for that day using a custom filter function
                events = $('#calendar-marzo').fullCalendar('clientEvents', function (event) {
                    eventDate = event.start;
                    eventDateString = eventDate.format('D') + eventDate.format('MM') + eventDate.format('YYYY');

                    return dateString === eventDateString;
                });

                if (events.length) {
                    // Find the first event's element by its class name
                    var $event = $('#calendar-marzo').find('.' + events[0]._id);

                    $event.trigger('click');
                }else{
                    modal_show(null, date, 0, "POST");
                }
            },
            eventClick: function(event, jsEvent, view ) {
                date = event.start;
                modal_show(event.id, date, event.title, "UPDATE");
            },
            eventSources: [
                {
                   url: "{{action('InformacionController@dias_feriados')}}",
                   color: '#FF9100',
                   textColor: 'white'
                }
            ],
            eventRender: function (event, element, view) { 
                // event.start is already a moment.js object
                // we can apply .format()
                var dateString = event.start.format("YYYY-MM-DD");
                
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('background-color', '#7CB342');
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('opacity', '0.4');

                $(element).addClass(event._id);
            }
        })

        $('#calendar-abril').fullCalendar({
            theme: 'jquery-ui',
            header: {
                left: '',
                center: 'title',
                right: ''
            },
            locale: 'es',
            timezone: 'local',
            displayEventTime: false,
            titleFormat: 'MMMM',
            defaultView: 'month',
            defaultDate: abril,
            fixedWeekCount: false,
            showNonCurrentDates: false,
            contentHeight: 'auto',
            dayClick: function(date, jsEvent, view) {
                
                // Create a string representing just the day/month/year of the date clicked
                dateString = date.format('D') + date.format('MM') + date.format('YYYY');

                // Grab the events for that day using a custom filter function
                events = $('#calendar-abril').fullCalendar('clientEvents', function (event) {
                    eventDate = event.start;
                    eventDateString = eventDate.format('D') + eventDate.format('MM') + eventDate.format('YYYY');

                    return dateString === eventDateString;
                });

                if (events.length) {
                    // Find the first event's element by its class name
                    var $event = $('#calendar-abril').find('.' + events[0]._id);

                    $event.trigger('click');
                }else{
                    modal_show(null, date, 0, "POST");
                }
            },
            eventClick: function(event, jsEvent, view ) {
                date = event.start;
                modal_show(event.id, date, event.title, "UPDATE");
            },
            eventSources: [
                {
                   url: "{{action('InformacionController@dias_feriados')}}",
                   color: '#FF9100',
                   textColor: 'white'
                }
            ],
            eventRender: function (event, element, view) { 
                // event.start is already a moment.js object
                // we can apply .format()
                var dateString = event.start.format("YYYY-MM-DD");
                
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('background-color', '#7CB342');
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('opacity', '0.4');

                $(element).addClass(event._id);
            }
        })

        $('#calendar-mayo').fullCalendar({
            theme: 'jquery-ui',
            header: {
                left: '',
                center: 'title',
                right: ''
            },
            locale: 'es',
            timezone: 'local',
            displayEventTime: false,
            titleFormat: 'MMMM',
            defaultView: 'month',
            defaultDate: mayo,
            fixedWeekCount: false,
            showNonCurrentDates: false,
            contentHeight: 'auto',
           dayClick: function(date, jsEvent, view) {
                
                // Create a string representing just the day/month/year of the date clicked
                dateString = date.format('D') + date.format('MM') + date.format('YYYY');

                // Grab the events for that day using a custom filter function
                events = $('#calendar-mayo').fullCalendar('clientEvents', function (event) {
                    eventDate = event.start;
                    eventDateString = eventDate.format('D') + eventDate.format('MM') + eventDate.format('YYYY');

                    return dateString === eventDateString;
                });

                if (events.length) {
                    // Find the first event's element by its class name
                    var $event = $('#calendar-mayo').find('.' + events[0]._id);

                    $event.trigger('click');
                }else{
                    modal_show(null, date, 0, "POST");
                }
            },
            eventClick: function(event, jsEvent, view ) {
                date = event.start;
                modal_show(event.id, date, event.title, "UPDATE");
            },
            eventSources: [
                {
                   url: "{{action('InformacionController@dias_feriados')}}",
                   color: '#FF9100',
                   textColor: 'white'
                }
            ],
            eventRender: function (event, element, view) { 
                // event.start is already a moment.js object
                // we can apply .format()
                var dateString = event.start.format("YYYY-MM-DD");
                
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('background-color', '#7CB342');
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('opacity', '0.4');

                $(element).addClass(event._id);
            }
        })

        $('#calendar-junio').fullCalendar({
            theme: 'jquery-ui',
            header: {
                left: '',
                center: 'title',
                right: ''
            },
            locale: 'es',
            timezone: 'local',
            displayEventTime: false,
            titleFormat: 'MMMM',
            defaultView: 'month',
            defaultDate: junio,
            fixedWeekCount: false,
            showNonCurrentDates: false,
            contentHeight: 'auto',
            dayClick: function(date, jsEvent, view) {
                
                // Create a string representing just the day/month/year of the date clicked
                dateString = date.format('D') + date.format('MM') + date.format('YYYY');

                // Grab the events for that day using a custom filter function
                events = $('#calendar-junio').fullCalendar('clientEvents', function (event) {
                    eventDate = event.start;
                    eventDateString = eventDate.format('D') + eventDate.format('MM') + eventDate.format('YYYY');

                    return dateString === eventDateString;
                });

                if (events.length) {
                    // Find the first event's element by its class name
                    var $event = $('#calendar-junio').find('.' + events[0]._id);

                    $event.trigger('click');
                }else{
                    modal_show(null, date, 0, "POST");
                }
            },
            eventClick: function(event, jsEvent, view ) {
                date = event.start;
                modal_show(event.id, date, event.title, "UPDATE");
            },
            eventSources: [
                {
                   url: "{{action('InformacionController@dias_feriados')}}",
                   color: '#FF9100',
                   textColor: 'white'
                }
            ],
            eventRender: function (event, element, view) { 
                // event.start is already a moment.js object
                // we can apply .format()
                var dateString = event.start.format("YYYY-MM-DD");
                
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('background-color', '#7CB342');
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('opacity', '0.4');

                $(element).addClass(event._id);
            }
        })

        $('#calendar-julio').fullCalendar({
            theme: 'jquery-ui',
            header: {
                left: '',
                center: 'title',
                right: ''
            },
            locale: 'es',
            timezone: 'local',
            displayEventTime: false,
            titleFormat: 'MMMM',
            defaultView: 'month',
            defaultDate: julio,
            fixedWeekCount: false,
            showNonCurrentDates: false,
            contentHeight: 'auto',
            dayClick: function(date, jsEvent, view) {
                
                // Create a string representing just the day/month/year of the date clicked
                dateString = date.format('D') + date.format('MM') + date.format('YYYY');

                // Grab the events for that day using a custom filter function
                events = $('#calendar-julio').fullCalendar('clientEvents', function (event) {
                    eventDate = event.start;
                    eventDateString = eventDate.format('D') + eventDate.format('MM') + eventDate.format('YYYY');

                    return dateString === eventDateString;
                });

                if (events.length) {
                    // Find the first event's element by its class name
                    var $event = $('#calendar-julio').find('.' + events[0]._id);

                    $event.trigger('click');
                }else{
                        modal_show(null, date, 0, "POST");
                }
            },
            eventClick: function(event, jsEvent, view ) {
                date = event.start;
                modal_show(event.id, date, event.title, "UPDATE");
            },
            eventSources: [
                {
                   url: "{{action('InformacionController@dias_feriados')}}",
                   color: '#FF9100',
                   textColor: 'white'
                }
            ],
            eventRender: function (event, element, view) { 
                // event.start is already a moment.js object
                // we can apply .format()
                var dateString = event.start.format("YYYY-MM-DD");
                
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('background-color', '#7CB342');
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('opacity', '0.4');

                $(element).addClass(event._id);
            }
        })

        $('#calendar-junio').fullCalendar({
            theme: 'jquery-ui',
            header: {
                left: '',
                center: 'title',
                right: ''
            },
            locale: 'es',
            timezone: 'local',
            displayEventTime: false,
            titleFormat: 'MMMM',
            defaultView: 'month',
            defaultDate: junio,
            fixedWeekCount: false,
            showNonCurrentDates: false,
            contentHeight: 'auto',
            dayClick: function(date, jsEvent, view) {
                
                // Create a string representing just the day/month/year of the date clicked
                dateString = date.format('D') + date.format('MM') + date.format('YYYY');

                // Grab the events for that day using a custom filter function
                events = $('#calendar-junio').fullCalendar('clientEvents', function (event) {
                    eventDate = event.start;
                    eventDateString = eventDate.format('D') + eventDate.format('MM') + eventDate.format('YYYY');

                    return dateString === eventDateString;
                });

                if (events.length) {
                    // Find the first event's element by its class name
                    var $event = $('#calendar-junio').find('.' + events[0]._id);

                    $event.trigger('click');
                }else{
                    modal_show(null, date, 0, "POST");
                }
            },
            eventClick: function(event, jsEvent, view ) {
                date = event.start;
                modal_show(event.id, date, event.title, "UPDATE");
            },
            eventSources: [
                {
                   url: "{{action('InformacionController@dias_feriados')}}",
                   color: '#FF9100',
                   textColor: 'white'
                }
            ],
            eventRender: function (event, element, view) { 
                // event.start is already a moment.js object
                // we can apply .format()
                var dateString = event.start.format("YYYY-MM-DD");
                
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('background-color', '#7CB342');
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('opacity', '0.4');

                $(element).addClass(event._id);
            }
        })

        $('#calendar-agosto').fullCalendar({
            theme: 'jquery-ui',
            header: {
                left: '',
                center: 'title',
                right: ''
            },
            locale: 'es',
            timezone: 'local',
            displayEventTime: false,
            titleFormat: 'MMMM',
            defaultView: 'month',
            defaultDate: agosto,
            fixedWeekCount: false,
            showNonCurrentDates: false,
            contentHeight: 'auto',
            dayClick: function(date, jsEvent, view) {
                
                // Create a string representing just the day/month/year of the date clicked
                dateString = date.format('D') + date.format('MM') + date.format('YYYY');

                // Grab the events for that day using a custom filter function
                events = $('#calendar-agosto').fullCalendar('clientEvents', function (event) {
                    eventDate = event.start;
                    eventDateString = eventDate.format('D') + eventDate.format('MM') + eventDate.format('YYYY');

                    return dateString === eventDateString;
                });

                if (events.length) {
                    // Find the first event's element by its class name
                    var $event = $('#calendar-agosto').find('.' + events[0]._id);

                    $event.trigger('click');
                }else{
                    modal_show(null, date, 0, "POST");
                }
            },
            eventClick: function(event, jsEvent, view ) {
                date = event.start;
                modal_show(event.id, date, event.title, "UPDATE");
            },
            eventSources: [
                {
                   url: "{{action('InformacionController@dias_feriados')}}",
                   color: '#FF9100',
                   textColor: 'white'
                }
            ],
            eventRender: function (event, element, view) { 
                // event.start is already a moment.js object
                // we can apply .format()
                var dateString = event.start.format("YYYY-MM-DD");
                
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('background-color', '#7CB342');
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('opacity', '0.4');

                $(element).addClass(event._id);
            }
        })

        $('#calendar-septiembre').fullCalendar({
            theme: 'jquery-ui',
            header: {
                left: '',
                center: 'title',
                right: ''
            },
            locale: 'es',
            timezone: 'local',
            displayEventTime: false,
            titleFormat: 'MMMM',
            defaultView: 'month',
            defaultDate: septiembre,
            fixedWeekCount: false,
            showNonCurrentDates: false,
            contentHeight: 'auto',
           dayClick: function(date, jsEvent, view) {
                
                // Create a string representing just the day/month/year of the date clicked
                dateString = date.format('D') + date.format('MM') + date.format('YYYY');

                // Grab the events for that day using a custom filter function
                events = $('#calendar-septiembre').fullCalendar('clientEvents', function (event) {
                    eventDate = event.start;
                    eventDateString = eventDate.format('D') + eventDate.format('MM') + eventDate.format('YYYY');

                    return dateString === eventDateString;
                });

                if (events.length) {
                    // Find the first event's element by its class name
                    var $event = $('#calendar-septiembre').find('.' + events[0]._id);

                    $event.trigger('click');
                }else{
                     modal_show(null, date, 0, "POST");
                }
            },
            eventClick: function(event, jsEvent, view ) {
                date = event.start;
                modal_show(event.id, date, event.title, "UPDATE");
            },
            eventSources: [
                {
                   url: "{{action('InformacionController@dias_feriados')}}",
                   color: '#FF9100',
                   textColor: 'white'
                }
            ],
            eventRender: function (event, element, view) { 
                // event.start is already a moment.js object
                // we can apply .format()
                var dateString = event.start.format("YYYY-MM-DD");
                
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('background-color', '#7CB342');
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('opacity', '0.4');

                $(element).addClass(event._id);
            }
        })

        $('#calendar-octubre').fullCalendar({
            theme: 'jquery-ui',
            header: {
                left: '',
                center: 'title',
                right: ''
            },
            locale: 'es',   
            timezone: 'local',
            displayEventTime: false,
            titleFormat: 'MMMM',
            defaultView: 'month',
            defaultDate: octubre,
            fixedWeekCount: false,
            showNonCurrentDates: false,
            contentHeight: 'auto',
            dayClick: function(date, jsEvent, view) {
                
                // Create a string representing just the day/month/year of the date clicked
                dateString = date.format('D') + date.format('MM') + date.format('YYYY');

                // Grab the events for that day using a custom filter function
                events = $('#calendar-octubre').fullCalendar('clientEvents', function (event) {
                    eventDate = event.start;
                    eventDateString = eventDate.format('D') + eventDate.format('MM') + eventDate.format('YYYY');

                    return dateString === eventDateString;
                });

                if (events.length) {
                    // Find the first event's element by its class name
                    var $event = $('#calendar-octubre').find('.' + events[0]._id);

                    $event.trigger('click');
                }else{
                    modal_show(null, date, 0, "POST");
                }
            },
            eventClick: function(event, jsEvent, view ) {
                date = event.start;
                modal_show(event.id, date, event.title, "UPDATE");
            },
            eventSources: [
                {
                   url: "{{action('InformacionController@dias_feriados')}}",
                   color: '#FF9100',
                   textColor: 'white'
                }
            ],
            eventRender: function (event, element, view) { 
                // event.start is already a moment.js object
                // we can apply .format()
                var dateString = event.start.format("YYYY-MM-DD");
                
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('background-color', '#7CB342');
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('opacity', '0.4');

                $(element).addClass(event._id);
            }
        })

        $('#calendar-noviembre').fullCalendar({
            theme: 'jquery-ui',
            header: {
                left: '',
                center: 'title',
                right: ''
            },
            locale: 'es',   
            timezone: 'local',
            displayEventTime: false,
            titleFormat: 'MMMM',
            defaultView: 'month',
            defaultDate: noviembre,
            fixedWeekCount: false,
            showNonCurrentDates: false,
            contentHeight: 'auto',
            dayClick: function(date, jsEvent, view) {
                
                // Create a string representing just the day/month/year of the date clicked
                dateString = date.format('D') + date.format('MM') + date.format('YYYY');

                // Grab the events for that day using a custom filter function
                events = $('#calendar-noviembre').fullCalendar('clientEvents', function (event) {
                    eventDate = event.start;
                    eventDateString = eventDate.format('D') + eventDate.format('MM') + eventDate.format('YYYY');

                    return dateString === eventDateString;
                });

                if (events.length) {
                    // Find the first event's element by its class name
                    var $event = $('#calendar-noviembre').find('.' + events[0]._id);

                    $event.trigger('click');
                }else{
                    modal_show(null, date, 0, "POST");
                }
            },
            eventClick: function(event, jsEvent, view ) {
                date = event.start;
                modal_show(event.id, date, event.title, "UPDATE");
            },
            eventSources: [
                {
                   url: "{{action('InformacionController@dias_feriados')}}",
                   color: '#FF9100',
                   textColor: 'white'
                }
            ],
            eventRender: function (event, element, view) { 
                // event.start is already a moment.js object
                // we can apply .format()
                var dateString = event.start.format("YYYY-MM-DD");
                
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('background-color', '#7CB342');
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('opacity', '0.4');

                $(element).addClass(event._id);
            }
        })

        $('#calendar-diciembre').fullCalendar({
            theme: 'jquery-ui',
            header: {
                left: '',
                center: 'title',
                right: ''
            },
            locale: 'es',
            timezone: 'local',
            displayEventTime: false,
            titleFormat: 'MMMM',
            defaultView: 'month',
            defaultDate: diciembre,
            fixedWeekCount: false,
            showNonCurrentDates: false,
            contentHeight: 'auto',
            dayClick: function(date, jsEvent, view) {
                
                // Create a string representing just the day/month/year of the date clicked
                dateString = date.format('D') + date.format('MM') + date.format('YYYY');

                // Grab the events for that day using a custom filter function
                events = $('#calendar-diciembre').fullCalendar('clientEvents', function (event) {
                    eventDate = event.start;
                    eventDateString = eventDate.format('D') + eventDate.format('MM') + eventDate.format('YYYY');

                    return dateString === eventDateString;
                });

                if (events.length) {
                    // Find the first event's element by its class name
                    var $event = $('#calendar-diciembre').find('.' + events[0]._id);

                    $event.trigger('click');
                }else{
                    modal_show(null, date, 0, "POST");
                }
            },
            eventClick: function(event, jsEvent, view ) {
                date = event.start;
                modal_show(event.id, date, event.title, "UPDATE");
            },
            eventSources: [
                {
                   url: "{{action('InformacionController@dias_feriados')}}",
                   color: '#FF9100',
                   textColor: 'white'
                }
            ],
            eventRender: function (event, element, view) { 
                // event.start is already a moment.js object
                // we can apply .format()
                var dateString = event.start.format("YYYY-MM-DD");
                
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('background-color', '#7CB342');
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('opacity', '0.4');

                $(element).addClass(event._id);
            }
        })

        $('.fc h2').replaceWith(function() {
		    return "<h4>" + $(this).text().toUpperCase() + "</h4>";
		});

       // get_dias_feriados();
})
</script>
@endsection('script')