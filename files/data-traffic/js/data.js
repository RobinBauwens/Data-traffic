window.onload= function(){
   var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            type: 'area',
            events: {
                load: requestBytes 	// 1 functie die andere functies aanroept
            }
        },
        title: {
            text: 'Live netwerkverkeer'
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150,
            maxZoom: 20 * 1000
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: {
                text: 'Grootte bytes',
                margin: 80
            }
        },
        series: [{
            name: 'Ontvangen bytes',
            data: []
        },
        {
            name: 'Verstuurde bytes',
            data: []
        }

        ]
    });

   var chart2 = new Highcharts.Chart({
        chart: {
            renderTo: 'container2',
            type: 'spline',
            events: {
                load: requestPackets 	// 1 functie die andere functies aanroept
            }
        },
        title: {
            text: 'Live netwerkverkeer'
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150,
            maxZoom: 20 * 1000
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: {
                text: 'Aantal packets',
                margin: 80
            }
        },
        series: [{
            name: 'Ontvangen packets',
            data: []
        },
        {
            name: 'Verstuurde packets',
            data: []
        }

        ]
    });


  function requestPackets(){
  	requestDataRX_Packets();
  	requestDataTX_Packets();
  }

  function requestBytes(){
  	requestDataRX_Bytes();
  	requestDataTX_Bytes();
  }

    function requestDataRX_Bytes() {
    $.ajax({
        url: 'live-rx_bytes.php',
        success: function(point) {
            var series = chart.series[0],
                shift = series.data.length > 20; // shift if the series is 
                                                 // longer than 20
            // add the point
            chart.series[0].addPoint(point, true, shift);
            
            // call it again after one second
            setTimeout(requestDataRX_Bytes, 1000);    
        },
        cache: false
    });
}

  function requestDataTX_Bytes() {
    $.ajax({
        url: 'live-tx_bytes.php',
        success: function(point) {
            var series = chart.series[1],
                shift = series.data.length > 20; // shift if the series is 
                                                 // longer than 20

            // add the point
            chart.series[1].addPoint(point, true, shift);
            
            // call it again after one second
            setTimeout(requestDataTX_Bytes, 1000);    
        },
        cache: false
    });
}



    function requestDataRX_Packets() {
    $.ajax({
        url: 'live-rx_packets.php',
        success: function(point) {
            var series = chart.series[0],
                shift = series.data.length > 20; // shift if the series is 
                                                 // longer than 20
            // add the point
            chart2.series[0].addPoint(point, true, shift); // Opgelet: chart2 ipv chart
            
            // call it again after one second
            setTimeout(requestDataRX_Packets, 1000);    
        },
        cache: false
    });
}

  function requestDataTX_Packets() {
    $.ajax({
        url: 'live-tx_packets.php',
        success: function(point) {
            var series = chart.series[1],
                shift = series.data.length > 20; // shift if the series is 
                                                 // longer than 20

            // add the point
            chart2.series[1].addPoint(point, true, shift);
            
            // call it again after one second
            setTimeout(requestDataTX_Packets, 1000);    
        },
        cache: false
    });
}

$('#myselect').on('change', function() {
  alert( this.value );
})
 


// Toe te voegen bij Bronnen.md

//https://www.highcharts.com/docs/working-with-data/live-data
//https://www.packtpub.com/mapt/book/web_development/9781783559688/1/ch01lvl1sec11/including-multiple-series-in-one-chart
//https://stackoverflow.com/questions/19149166/call-php-function-from-javascript-and-send-parameter
//https://www.highcharts.com/docs/chart-and-series-types/chart-types
//https://stackoverflow.com/questions/11179406/jquery-get-value-of-select-onchange
//https://unix.stackexchange.com/questions/125400/how-can-i-find-available-network-interfaces

// Lay-out aanpassen
};


