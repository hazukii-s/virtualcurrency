<?php
session_start();

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Transfer.php");

if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
    //gebruiker niet ingelogd? -> redirect naar login pagina
    header('Location: login.php');
}


$tokens = new Transfer();
$tokens->setId($_SESSION['user_id']);
//echo $_SESSION['user_id'];
$availableTokens = $tokens->getAvailableTokens();
$incomingTransfers = Transfer::getIncomingTransfers();
$outgoingTransfers = Transfer::getOutgoingTransfers();
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
            <a class="btn btn-outline-secondary float-right" href="logout.php" role="button">Uitloggen</a>
            <h3 class=" mb-5 ">Welkom, <?php echo htmlspecialchars($_SESSION['firstname']); ?>.</h3>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Huidig saldo:</h5>
                    <p class="card-text"> <?php echo htmlspecialchars($availableTokens['tokens']); ?> tokens</p>
                </div>
            </div>
        </div>

        <div class="container w-50">
            <ul class="list-group mt-3">
                <h5>Transfers</h5>

                <?php foreach ($incomingTransfers as $transfer) : ?>
                    <?php if ($transfer['tokens'] > 1) : ?>
                        <a href="transfer-detail.php?id=<?php echo $transfer['id'] ?>" class="list-group-item list-group-item-action"> <?php echo htmlspecialchars($transfer['firstname']); ?> <?php echo htmlspecialchars($transfer['lastname']); ?> stuurde je <?php echo htmlspecialchars($transfer['tokens']); ?> tokens.</a>
                    <?php else : ?>
                        <a href="transfer-detail.php?id=<?php echo $transfer['id'] ?>" class="list-group-item list-group-item-action"> <?php echo htmlspecialchars($transfer['firstname']); ?> <?php echo htmlspecialchars($transfer['lastname']); ?> stuurde je <?php echo htmlspecialchars($transfer['tokens']); ?> token.</a>

                    <?php endif; ?>
                <?php endforeach; ?>

                <?php foreach ($outgoingTransfers as $transfer) : ?>
                    <?php if ($transfer['tokens'] > 1) :  ?>
                        <a href="transfer-detail.php?id=<?php echo $transfer['id'] ?>" class="list-group-item list-group-item-action"> Je stuurde <?php echo htmlspecialchars($transfer['tokens']); ?> tokens naar <?php echo htmlspecialchars($transfer['firstname']); ?> <?php echo htmlspecialchars($transfer['lastname']); ?>.</a>
                    <?php else :  ?>
                        <a href="transfer-detail.php?id=<?php echo $transfer['id'] ?>" class="list-group-item list-group-item-action"> Je stuurde <?php echo htmlspecialchars($transfer['tokens']); ?> token naar <?php echo htmlspecialchars($transfer['firstname']); ?> <?php echo htmlspecialchars($transfer['lastname']); ?>.</a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="container w-50 mt-3">
            <a class="btn btn-primary" href="transfer.php" role="button">Maak transfer</a>
        </div>
    </div>
</body>

<script src="pageReload.js"></script>

</html>