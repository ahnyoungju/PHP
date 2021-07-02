<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="IT Consulting" />
    <meta name="description" content="Dalton Consulting" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/dalton.css">
    <title>Dalton Consulting</title>
    <style>

    </style>
    <!-- GEO Chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        // Google MAP API Key Must be here
        'mapsApiKey': 'API-KEY MUST BE here'
      });
      google.charts.setOnLoadCallback(drawMarkersMap);

      function drawMarkersMap() {
        var data = google.visualization.arrayToDataTable([
          ['Branch', 'Projects'],
          ['Melbourne',20],
          ['Sydney', 15]
        ]);

        var options = { region: '053',
                        displayMode: 'markers',  // text
                        colorAxis: {colors: ['#00853f', 'black', '#e31b23']},
                        backgroundColor: '#5C9AE0',
                        datalessRegionColor: '#EADEDB',
                        defaultColor:'#2267B5',
                        legend:{textStyle: {color: 'black', fontSize: 16}},
                        tooltip: {textStyle: {  color: 'black',
                                                fontName: 'Verdana',
                                                fontSize: 13,
                                                bold: false,
                                                italic: false } }
                      };

        var chart = new google.visualization.GeoChart(document.getElementById('branch_geo_div'));

        chart.draw(data, options);
        /* Hide Loader */
        hideLoader();
      }
    </script>
  </head>
  <body>
<?php
    require_once('../bll/getLogin.php');
    global $login;
    /* Check Login */
    if( $login != true )
        require_once('nav_default.inc');
    else
        require_once('nav_login.inc');
?>
<div id="loader"></div>
<article id="cmpInfo" class="animate-bottom">
  <div class="center">
    <!-- <img src="images/australia_960_720.jpg" alt="Australia" stype="width:100%" /> -->
    <div class="jumbo">
      <span id="logo-top">DALTON</span>&nbsp;&nbsp;
      <span id="logo-bottom">CONSULTING</span>
    </div>
    <h2 class="padding2">Dalton Consulting is an Information Technology consulting company in Australia.</h2>
  </div>
  <div id="cmpDetail" class="padding2">
    <h2 class="center">Why choose Dalton Consulting?</h2>
    <p>
    Our team has knowledge and expertise following industry best practice in comprehensively treating every client and scenario.

    In our advisory consulting role, we strive to understand your business, people, needs and expectations, as well as your goals for the future to come up with customized solutions that fit your organization’s requirements.
    </p>
  </div>
</article>
<aside id="indexAside" class="center">
  <h1 id="branch_h" class="padding2">Branches</h1>
  <div id="branch_geo_div" class="center"></div>
</aside>

<style>
#branch_h {
  /* float:left; */
}
#branch_geo_div {
  display:block;
  width: 900px; height: 500px;
}
</style>
<?php
  require('footer.inc');
?>
