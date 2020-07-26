<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
    //gebruiker niet ingelogd? -> redirect naar login pagina
    header('Location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welkom</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        row{
            margin: 2em;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <h1>Welcome! You are now logged in.</h1>
        </div>
        <div class="row">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Huidig saldo:</h5>
                    <p class="card-text">10 tokens</p>
                </div>
            </div>
        </div>
        <div class="row">

            <ul class="list-group">
                <h5>Transfers</h5>
                <li class="list-group-item">[naam] [transfer]</li>
                <li class="list-group-item">Dapibus ac facilisis in</li>
                <li class="list-group-item">Morbi leo risus</li>
                <li class="list-group-item">Porta ac consectetur ac</li>
                <li class="list-group-item">Vestibulum at eros</li>
            </ul>
        </div>
        <div class="row">
            <input type="submit" class="btn btn-primary" value="Maak transfer">
        </div>
    </div>
</body>

</html>