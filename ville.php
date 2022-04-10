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
    <h1 class="fw-lighter">CHOISIR UNE VILLE</h1><br>
    <form action="" method="GET">
        <div class="input-group mb-3">
            <input name="nomVille" type="text" class="form-control" placeholder="Entrez le nom de votre ville ici" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Valider</button>
        </div>
    </form>
</div>

<?php
error_reporting(0);
if(isset($_GET["nomVille"])){
    $nomVille = $_GET['nomVille'];
    $url = "http://api.openweathermap.org/data/2.5/weather?q=$nomVille&lang=fr&units=metric&appid=2609b3c27b0ab273198602368dd0ead6";
    $raw = file_get_contents($url);
    $json = json_decode($raw);

    // var_dump($json);
    if($json == null){
        ?>
        <h1 style="color:red;text-align:center;">Cette ville n'existe pas !!!</h1>

        <?php
    }else{
        session_start();
        $_SESSION["ville"] = $nomVille;

        header('location:index.php');
    }



}

?>



<!-- JS -->
<script src="script.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>