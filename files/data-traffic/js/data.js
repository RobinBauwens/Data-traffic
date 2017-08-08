window.onload= function(){
   var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            defaultSeriesType: 'spline',
            events: {
                load: requestData 	// 1 functie die andere functies aanroept
            }
        },
        title: {
            text: 'Live received bytes'
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
                text: 'Bytes',
                margin: 80
            }
        },
        series: [{
            name: 'RX_Bytes',
            data: []
        },
        {
            name: 'TX_Bytes',
            data: []
        }

        ]
    });

  // chart.addSeries({data: requestDataTX_Bytes});

  function requestData(){
  	requestDataRX_Bytes();
  	requestDataTX_Bytes();
  }

    function requestDataRX_Bytes() {
    	 // 	alert("hey");
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
 
 //https://www.highcharts.com/docs/working-with-data/live-data

//eventueel met knop voor welke interface

};


