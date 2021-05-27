<?php

$key = $_GET['id'];

//var_dump($_GET);

$url = 'https://fly.sportsdata.io/v3/nba/stats/json/Players/'.$key;

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

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>API Project</title>
    <link rel="stylesheet" type="text/css" href="CSS/Players.css"/>
</head>
<body>
<div class="header">
    <a href="#default" class="logo">NBA Stadium Finder</a>
    <div class="header-right">
        <a class="active" href="index.php">Home</a>
    </div>
</div>

<div class="row">
    <?php foreach ($result as $r) { ?>
    <div class="column">
        <div class="card">
            <img src="<?= $r->PhotoUrl; ?>" alt="Player Pictures" class="Player">
            <h4><?= $r->FirstName; ?> <?= $r->LastName; ?></h4>
            <p>Jersey: <?= $r->Jersey; ?></p>
            <p>Position: <?= $r->Position; ?></p>
        </div>
    </div>
    <?php } ?>
</div>

</body>
</html>


