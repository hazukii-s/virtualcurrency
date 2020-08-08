<?php
session_start();
include_once(__DIR__ . "/classes/Transfer.php");
include_once(__DIR__ . "/classes/User.php");


if (!empty($_POST)) {
    try {
        $transfer = new Transfer();
        $user = new User();
        $transfer->getUser($_POST['username']);
        $transfer->setAmount($_POST['amount']);
        $transfer->getMessage($_POST['transferMsg']);
        $transfer->setId($_SESSION['user_id']);
        $tokens = $transfer->getAvailableTokens();
        var_dump($tokens['tokens']);
        $transfer->userSuggestion();
    } catch (\Throwable $th) {
        $error = $th->getMessage();
    }
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer maken</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>
    <div class="container w-50">
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger" role="alert">
                <p>
                    <?php echo $error ?>
                </p>
            </div>
        <?php endif; ?>
    </div>

    <div class="container w-50 mt-5">
        <a class="btn btn-outline-secondary mb-4" href="../virtualcurrency/index.php" role="button">Terug</a>

        <h3>Maak een transfer</h3>
        <form method="POST">

            <div class="input-group mb-3 mt-4">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input name="username" type="text" class="form-control" id="searchUsername" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">€</span>
                </div>
                <input name="amount" type="number" min="1" max="500" class="form-control">
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Bericht</span>
                </div>
                <textarea name="transferMsg" class="form-control" aria-label="With textarea"></textarea>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Verzenden</button>
            </div>

        </form>
    </div>
</body>

</html>