<?php
session_start();
//var_dump($_GET);
$url = 'https://fly.sportsdata.io/v3/nba/scores/json/Stadiums';

$headers = array(
    "Ocp-Apim-Subscription-Key: f4919f8fba53445da9b8f86fb10da176"
);

$opts = array(
    'http' => array(
        'header' => $headers,
        'method' => 'GET'
    )
);

$context = stream_context_create($opts);
$result = json_decode(file_get_contents($url, false, $context));

$id = $_GET['id'] - 1;
$rows = '';
$rows .= '<h1>'.$result[$id]->Name.'</h1>';
$rows .= '<p>'.'Address: '.$result[$id]->Address.' '.$result[$id]->City.' '.$result[$id]->State.' '.$result[$id]->Zip.' '.$result[$id]->Country.'</p>';

$lat = $result[$id]->GeoLat;
$long = $result[$id]->GeoLong;



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>API Project</title>
    <link rel="stylesheet" type="text/css" href="CSS/map.css"/>
    <link rel="stylesheet" type="text/css" href="CSS/Stadiums.css"/>
    <!--jQuery to be used in class-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!--    <script src="js/map.js"></script>-->
    <script>
        function initMap() {
            let stadiumMap, marker;
            var latphp = <?php echo $lat ?>;
            var longphp = <?php echo $long ?>;
            let arena = { lat: latphp, lng: longphp };

            stadiumMap = new google.maps.Map(
                document.getElementById("map"),
                {
                    center: arena,
                    zoom: 14,
                }
            );
            marker = new google.maps.Marker({
                position: arena,
                map: stadiumMap,
            });
        }
    </script>
</head>
<body>
<div class="header">
    <a href="#default" class="logo">NBA Stadium Finder</a>
    <div class="header-right">
        <a class="active" href="index.php">Home</a>
    </div>
</div>

<div id="map"></div>
<div class="container">
    <p>
        <?php print $rows; ?>
    </p>
</div>

<!--replace YOUR_API_KEY with your own API key-->
<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDe95P4O-zZ5cFqH72sa5UnwO3LiPfm8xk&callback=initMap&libraries=&v=weekly"
        defer
></script>
</body>
</html>