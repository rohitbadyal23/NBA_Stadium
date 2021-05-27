<?php
session_start();
$url = 'https://fly.sportsdata.io/v3/nba/scores/json/teams';

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


$rows ='';

foreach ($result as $r){
    $rows .= '<tr>';
    $sid = $r->StadiumID;
    $id = $r->Key;
    $rows .= '<td>'.'<a href="Stadiums.php?id='.$sid.'">'.$r->City.' '.$r->Name.'</a>'.'</td>';
    $rows .= '<td>'.'<a href="Players.php?id='.$id.'">'.$r->Key.'</a>'.'</td>';
    $rows .= '</tr>';
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>API Project</title>
    <link rel="stylesheet" type="text/css" href="CSS/NBA.css"/>
</head>
<body>
<div class="header">
    <a href="#default" class="logo">NBA Stadium Finder</a>
    <div class="header-right">
        <a class="active" href="index.php">Home</a>
    </div>
</div>
<div id="table">
    <table>
        <thead>
        <tr>
            <th>Team</th>
            <th>Players</th>
        </tr>
        </thead>
        <tbody>
        <?php print $rows; ?>
        </tbody>
    </table>
</div>

</body>
</html>
