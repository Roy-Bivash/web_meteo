<?php
error_reporting(0);
session_start();
$ville = $_SESSION["ville"];
if($ville == null){
    $ville = "Paris";
}



$url = "http://api.openweathermap.org/data/2.5/weather?q=$ville&lang=fr&units=metric&appid=";

//recuperer le contenue de l'API :
$raw = file_get_contents($url);

$json = json_decode($raw);
//recuperer la ville :
$ville = $json->name;
//recuperer le temps qu'il fait :
$desc = $json->weather[0]->description;
//une description plus simple :
$descSimple = $json->weather[0]->main;
//recuperer la temperature : 
$temperature = $json->main->temp;
//recuperer la temperature resenti
$temp_rensenti = $json->main->feels_like;
//recuperer les valeur du vend : 
$ventSpeed = $json->wind->speed;
$ventDeg = $json->wind->deg;
//recuperer l'humidité : 
$humidite = $json->main->humidity;
//recuperer la pression :
$pression = $json->main->pressure;
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La meteo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container marge">
    <h1 class="text-center fw-lighter" style="text-transform: uppercase;">La meteo du jour à <strong> <?php echo $ville; ?></strong></h1>
    <hr id="hr1">
    <br>

    <div class="shadow-sm p-3 mb-5 rounded" style="background-color: #2E4053;">
        <div class="container">
            <P style="text-align:center"><?php echo date('l j F Y H:i') ?></P>
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <br>
                    <div class="imgPosition">
                        <?php
                            switch($descSimple){
                                case 'Thunderstorm':
                                    ?>
                                    <img class="imgDesc" src="img/orrage.png" alt="" srcset="">
                                    <?php
                                    break;
                                case 'Drizzle':
                                    ?>
                                    <img class="imgDesc" src="img/bruine.png" alt="" srcset="">
                                    <?php
                                    break;
                                case 'Rain':
                                    ?>
                                    <img class="imgDesc" src="img/pluis.png" alt="" srcset="">
                                    <?php
                                    break;
                                case 'Snow': 
                                    ?>
                                    <img class="imgDesc" src="img/neige.png" alt="" srcset="">
                                    <?php
                                    break;
                                case 'Clouds':
                                    ?>
                                    <img class="imgDesc" src="img/nuageux.png" alt="" srcset="">
                                    <?php
                                    break;
                                case 'Clear':
                                    ?>
                                    <img class="imgDesc" src="img/soleil.png" alt="" srcset="">
                                    <?php
                                    break;
                            }
                        ?>
                    </div>
                    <br>
                    <h4 style="text-transform:uppercase;margin-left: 48%;;"><?php echo $desc; ?></h4>
                </div>
                <div class="col-sm-6">
                    <br>
                    <h1 class="fw-lighter"><?php echo round($temperature); ?> °C</h1>
                    <hr style="width:40%">
                    <p>
                        <small>Avec un ressenti de <?php echo round($temp_rensenti); ?> °C</small>
                        <br>
                        Humidité de : <?php echo $humidite ?> %
                        <br>
                        Pression : <?php echo $pression ?> hPa
                    </p>
                    

                </div>
            </div>
        </div>
        <br>
        <div style="text-align:end">
            <a class="link" href="ville.php">Une autre ville ? →</a>
        </div>
    </div>
</div>












<!-- JS -->
<script src="script.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
