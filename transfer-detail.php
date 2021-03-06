<?php
include_once(__DIR__ . "/classes/Transfer.php");
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

//echo $id;

$transferDetail = Transfer::showTransferDetail();
//var_dump($transferDetail);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer detail</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>
    <div class="container mx-auto">
        <div class="container w-50 mt-5">
            <a class="btn btn-outline-secondary float-right" href="index.php" role="button">Terug</a>
            <h3 class=" mb-5 ">Transfer details.</h3>

            <?php if ($_SESSION['firstname'] == $transferDetail['senderFN']) : ?>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Je stuurde</h5>
                        <?php if ($transferDetail['tokens'] > 1) : ?>
                            <p class="card-text"> <?php echo htmlspecialchars($transferDetail['tokens']); ?> tokens</p>
                        <?php else : ?>
                            <p class="card-text"> <?php echo htmlspecialchars($transferDetail['tokens']); ?> token</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Naar</h5>
                        <p class="card-text"> <?php echo htmlspecialchars($transferDetail['receiverFN']);
                                                echo " ";
                                                echo htmlspecialchars($transferDetail['receiverLN']); ?></p>

                    </div>
                </div>

                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Bericht</h5>
                        <p class="card-text"> <?php echo htmlspecialchars($transferDetail['description']); ?></p>
                    </div>
                </div>

            <?php else : ?>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Je kreeg</h5>
                        <?php if ($transferDetail['tokens'] > 1) : ?>
                            <p class="card-text"> <?php echo htmlspecialchars($transferDetail['tokens']); ?> tokens</p>
                        <?php else : ?>
                            <p class="card-text"> <?php echo htmlspecialchars($transferDetail['tokens']); ?> token</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Van</h5>
                        <p class="card-text"> <?php echo htmlspecialchars($transferDetail['senderFN']);
                                                echo " ";
                                                echo htmlspecialchars($transferDetail['senderLN']); ?></p>

                    </div>
                </div>

                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Bericht</h5>
                        <p class="card-text"> <?php echo htmlspecialchars($transferDetail['description']); ?></p>
                    </div>
                </div>
            <?php endif; ?>

        </div>

</body>

</html>