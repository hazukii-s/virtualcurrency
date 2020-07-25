<?php
// Initialize the session
session_start();

include_once(__DIR__ . "/classes/User.php");

if (!empty($_POST)) {
    //try log in
    try {
        $user = new User();
        $user->login();
        //vergelijk input met database

    } catch (\Throwable $th) {
        //fail? -> error message
        $error = $th->getMessage();
        //succes?-> redirect to homepage

    }
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>
    <div class="contain">
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger" role="alert">
                <p>
                    <?php echo $error ?>
                </p>
            </div>
        <?php endif; ?>
    </div>

    <div class="container">
        <h2>IMD currency </h2>
        <form method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">E-mailadres</label>
                <input name="email" class="form-control" placeholder="E-mailadres">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Wachtwoord</label>
                <input name="password" type="password" class="form-control" placeholder="Wachtwoord">
            </div>

            <input type="submit" class="btn btn-primary">
        </form>
    </div>

</body>

</html>