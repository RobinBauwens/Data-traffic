<?php

$path    = '/sys/class/net';
$files = scandir($path);
$files = array_diff(scandir($path), array('.', '..'));

echo "<select id='myselect'>";
foreach ($files as $value) {
    echo "<option value=$value>$value</option>";
}
echo "</select>";


//https://stackoverflow.com/questions/15774669/list-all-files-in-one-directory-php
?>

<html>

<head>
 <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 <link rel="stylesheet" type="text/css" href="css/layout.css" />
 <title>Dataverkeer</title>
</head>

<body>
 <div>
  <h2 class="text-center">GEMETEN NETWERKVERKEER</h2>
  <hr>
  <h4 class="text-right" id="copyright">
   <a href="https://github.com/RobinBauwens/Data-traffic" target="_blank">Copyright &copy;   Robin Bauwens 2017</a>
  </h4>
 </div>

 <div id="containers" class="center-block">
  <div id="container" style="width:100%; height:400px;"></div>
  <br>
  <div id="container2" style="width:100%; height:400px;"></div>
  </div>
</body>
 <script src="js/data.js"></script>
 <script src="http://code.highcharts.com/highcharts.js"></script>
 <script src="http://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</html>
<!-- https://github.com/RobinBauwens/Raspberry-Pi-weather -->
