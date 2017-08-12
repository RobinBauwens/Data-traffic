window.onload = function () {
 var chart = new Highcharts.Chart({ // Maak sowieso al 2 grafieken, deze bevatten de data van de eerste netwerkinterface
  chart: {
   renderTo: 'container',
   type: 'area',
   events: {
    load: requestBytes // 1 functie die andere functies aanroept
   }
  },
  title: {
   text: 'Live netwerkverkeer eerste netwerkinterface'
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
    load: requestPackets // 1 functie die andere functies aanroept
   }
  },
  title: {
   text: 'Live netwerkverkeer eerste netwerkinterface'
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

 



 function requestPackets() {
  requestDataRX_Packets();
  requestDataTX_Packets();
 }

 function requestBytes() {
  requestDataRX_Bytes();
  requestDataTX_Bytes();
 }


 function requestDataRX_Bytes() {
  $.ajax({
   url: 'live-rx_bytes.php',
   success: function (point) {
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
   success: function (point) {
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
   success: function (point) {
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
   success: function (point) {
    var series = chart.series[1], //geen chart2.series[1]
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




// Eerste .php moet sowieso van array[0], anders ga je rare getallen krijgen zelfs als zijn ze correct bij maar 1 interface
// In orde
/*
var myElem = document.getElementById('extraContainers'); // werkt niet?
  if (myElem === null) {
*/
// Indien div met id "extraContainers" bestaat, maak dan opnieuw 2 grafieken aan

 var chart3 = new Highcharts.Chart({ // Maak sowieso al 2 grafieken, deze bevatten de data van de eerste netwerkinterface
  chart: {
   renderTo: 'extraContainer',
   type: 'area',
   events: {
    load: requestBytesExtra // 1 functie die andere functies aanroept
   }
  },
  title: {
   text: 'Live netwerkverkeer tweede netwerkinterface'
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

 var chart4 = new Highcharts.Chart({
  chart: {
   renderTo: 'extraContainer2',
   type: 'spline',
   events: {
    load: requestPacketsExtra // 1 functie die andere functies aanroept
   }
  },
  title: {
   text: 'Live netwerkverkeer tweede netwerkinterface'
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




function requestPacketsExtra() {
  requestDataRX_PacketsExtra();
  requestDataTX_PacketsExtra();
 }

 function requestBytesExtra() {
  requestDataRX_BytesExtra();
  requestDataTX_BytesExtra();
 }


 function requestDataRX_BytesExtra() {
  $.ajax({
   url: 'live-rx_bytes_extra.php',
   success: function (point) {
    var series = chart.series[0],
     shift = series.data.length > 20; // shift if the series is 
    // longer than 20
    // add the point
    chart3.series[0].addPoint(point, true, shift);

    // call it again after one second
    setTimeout(requestDataRX_BytesExtra, 1000);
   },
   cache: false
  });
 }

 function requestDataTX_BytesExtra() {
  $.ajax({
   url: 'live-tx_bytes_extra.php',
   success: function (point) {
    var series = chart.series[1],
     shift = series.data.length > 20; // shift if the series is 
    // longer than 20

    // add the point
    chart3.series[1].addPoint(point, true, shift);

    // call it again after one second
    setTimeout(requestDataTX_BytesExtra, 1000);
   },
   cache: false
  });
 }



 function requestDataRX_PacketsExtra() {
  $.ajax({
   url: 'live-rx_packets_extra.php',
   success: function (point) {
    var series = chart.series[0],
     shift = series.data.length > 20; // shift if the series is 
    // longer than 20
    // add the point
    chart4.series[0].addPoint(point, true, shift); // Opgelet: chart2 ipv chart

    // call it again after one second
    setTimeout(requestDataRX_PacketsExtra, 1000);
   },
   cache: false
  });
 }

 function requestDataTX_PacketsExtra() {
  $.ajax({
   url: 'live-tx_packets_extra.php',
   success: function (point) {
    var series = chart.series[1],
     shift = series.data.length > 20; // shift if the series is 
    // longer than 20

    // add the point
    chart4.series[1].addPoint(point, true, shift);

    // call it again after one second
    setTimeout(requestDataTX_PacketsExtra, 1000);
   },
   cache: false
  });
 }

   // einde if normaal extra hier







};
