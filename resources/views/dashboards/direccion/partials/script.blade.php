$( document ).ready(function() {


    var ctx = document.getElementById('myChart').getContext('2d');

    Chart.plugins.register({
   afterDatasetsDraw: function(chart) {
      if (chart.tooltip._active && chart.tooltip._active.length) {
         var activePoint = chart.tooltip._active[0],
            ctx = chart.ctx,
            y_axis = chart.scales['y-axis-0'],
            x = activePoint.tooltipPosition().x,
            topY = y_axis.top,
            bottomY = y_axis.bottom;
         // draw line
         ctx.save();
         ctx.beginPath();
         ctx.moveTo(x, topY);
         ctx.lineTo(x, bottomY);
         ctx.lineWidth = 2;
         ctx.strokeStyle = 'black';
         ctx.stroke();
         ctx.restore();
      }
   }
});

    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            datasets: [
            {
                fill:  false,
                label: "Facturado",
                backgroundColor: '#00C853',
                borderColor: '#00C853',
                data: [{{ $montosMeses["ENERO"]["facturado"] }}, {{ $montosMeses["FEBRERO"]["facturado"] }}, {{ $montosMeses["MARZO"]["facturado"] }}, {{ $montosMeses["ABRIL"]["facturado"] }}, {{ $montosMeses["MAYO"]["facturado"] }}, {{ $montosMeses["JUNIO"]["facturado"] }}, {{ $montosMeses["JULIO"]["facturado"] }}, {{ $montosMeses["AGOSTO"]["facturado"] }}, {{ $montosMeses["SEPTIEMBRE"]["facturado"] }}, {{ $montosMeses["OCTUBRE"]["facturado"] }}, {{ $montosMeses["NOVIEMBRE"]["facturado"] }}, {{ $montosMeses["DICIEMBRE"]["facturado"] }}],
                pointBackgroundColor: '#64DD17'
            },
            {
                fill: false,
                label: "Recaudado",
                backgroundColor: '#0D47A1',
                borderColor: '#0D47A1',
                data: [{{ $montosMeses["ENERO"]["cobrado"] }}, {{ $montosMeses["FEBRERO"]["cobrado"] }}, {{ $montosMeses["MARZO"]["cobrado"] }}, {{ $montosMeses["ABRIL"]["cobrado"] }}, {{ $montosMeses["MAYO"]["cobrado"] }}, {{ $montosMeses["JUNIO"]["cobrado"] }}, {{ $montosMeses["JULIO"]["cobrado"] }}, {{ $montosMeses["AGOSTO"]["cobrado"] }}, {{ $montosMeses["SEPTIEMBRE"]["cobrado"] }}, {{ $montosMeses["OCTUBRE"]["cobrado"] }}, {{ $montosMeses["NOVIEMBRE"]["cobrado"] }}, {{ $montosMeses["DICIEMBRE"]["cobrado"] }}],
                pointBackgroundColor: '#0D47A1'
            },
            {
                fill: false,
                label: "Morosidad",
                backgroundColor: '#F44336',
                borderColor: '#F44336',
                data: [{{ $montosMeses["ENERO"]["porCobrar"] }}, {{ $montosMeses["FEBRERO"]["porCobrar"] }}, {{ $montosMeses["MARZO"]["porCobrar"] }}, {{ $montosMeses["ABRIL"]["porCobrar"] }}, {{ $montosMeses["MAYO"]["porCobrar"] }}, {{ $montosMeses["JUNIO"]["porCobrar"] }}, {{ $montosMeses["JULIO"]["porCobrar"] }}, {{ $montosMeses["AGOSTO"]["porCobrar"] }}, {{ $montosMeses["SEPTIEMBRE"]["porCobrar"] }}, {{ $montosMeses["OCTUBRE"]["porCobrar"] }}, {{ $montosMeses["NOVIEMBRE"]["porCobrar"] }}, {{ $montosMeses["DICIEMBRE"]["porCobrar"] }}],
                pointBackgroundColor: '#C62828'
            },
            {
                lineTension: 0,
                fill: true,
                label: "Meta",
                backgroundColor: '#CFD8DC',
                borderColor: '#CFD8DC',
                data: [{{ isset($metas[1])? $metas[1] : 0}}, {{ isset($metas[2])? $metas[2] : 0}}, {{ isset($metas[3])? $metas[3] : 0}}, {{ isset($metas[4])? $metas[4] : 0}}, {{ isset($metas[5])? $metas[5] : 0}}, {{ isset($metas[6])? $metas[6] : 0}}, {{ isset($metas[7])? $metas[7] : 0}}, {{ isset($metas[8])? $metas[8] : 0}}, {{ isset($metas[9])? $metas[9] : 0}}, {{ isset($metas[10])? $metas[10] : 0}}, {{ isset($metas[11])? $metas[11] : 0}}, {{ isset($metas[12])? $metas[12] : 0}}],
                pointBackgroundColor: '#CFD8DC'
            }]
        },
        // Configuration options go here
        options: {
            responsive: true,
            usePointStyle: true,
            legend: {
                position: 'bottom',
                display: true,
                labels: {
                    usePointStyle: true
                }
            },
            customLine: {
                color: 'black'
            }, 
            hover: {
                mode: 'nearest',
                intersect: true
            },
            tooltips: {
                mode: 'index',
                bodySpacing: 5,
                intersect: false,
                callbacks: {
                    label: function(tooltipItem, data) {
                        var label = 'Bs.';

                        if (label) {
                            label += ' ';
                        }
                        label += numToComma(tooltipItem.yLabel);
                        return label;
                    },
                    title: function(tooltipItem, data) {
                        return '';
                    }
                }
            },
            scales: {
                xAxes: [{
                    gridLines: {
                      display: false
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false
                    },
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Bs.F'
                    },
                    ticks: {
                        fontSize: 8,
                        display: true,
                        beginAtZero: true,
                        min: 0,
                        userCallback: function(value, index, values) {
                            value = value.toString();
                            value = numToComma(value);
                            return value;
                        }
                    }
                }]
            }
        },
        plugins: {
            filler: {
                propagate: true
            }
        }
    });


    $('#prev-year').click(function(){
        var ahno = $('#anno').val() - 1;
        if(ahno < 2016){ alertify.error("Limite de año"); return; }
        var url = "{{action('DashboardController@indexDireccion')}}" + "?anno=" + ahno;
        window.location.href = url;
    });
    
    $('#next-year').click(function(){
        var ahno = Number($('#anno').val()) + 1;
        if(ahno > {{$today->format('Y')}}){ alertify.error("Limite de año"); return; }
        var url = "{{action('DashboardController@indexDireccion')}}" + "?anno=" + ahno;
        window.location.href = url;
    });
});