<?php
session_start();

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Transfer.php");

if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
    //gebruiker niet ingelogd? -> redirect naar login pagina
    header('Location: login.php');
}

$user = new User();
$tokens = new Transfer();
$tokens->setId($_SESSION['user_id']);
//echo $_SESSION['user_id'];
$availableTokens = $tokens->getAvailableTokens();
$allTransfers = Transfer::getAllTransfers();
//var_dump($allTransfers);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welkom</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        row {
            margin: 2em;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
</head>

<body>
    <div class="container mx-auto" id="saldo">
        <div class="container w-50 mt-5">
            <a class="btn btn-outline-secondary float-right" href="../virtualcurrency/logout.php" role="button">Uitloggen</a>
            <h3 class=" mb-5 ">Welkom.</h3>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Huidig saldo:</h5>
                    <p class="card-text"> <?php echo $availableTokens['tokens']; ?> tokens</p>
                </div>
            </div>
        </div>

        <div class="container w-50">
            <ul class="list-group mt-3">
                <h5>Transfers</h5>

                <?php foreach($allTransfers as $message) : ?>

                <li class="list-group-item"><?php echo $message['description'];  ?></li>

                <?php endforeach; ?>
                
                <li class="list-group-item">Dapibus ac facilisis in</li>
                <li class="list-group-item">Morbi leo risus</li>
                <li class="list-group-item">Porta ac consectetur ac</li>
                <li class="list-group-item">Vestibulum at eros</li>
            </ul>
        </div>
        <div class="container w-50 mt-3">
            <a class="btn btn-primary" href="../virtualcurrency/transfer.php" role="button">Maak transfer</a>
        </div>
    </div>
</body>

<script src="pageReload.js"></script>

</html>