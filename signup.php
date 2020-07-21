<?php



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>

    <div class="container">
        <h2>Create a new account</h2>
        <form method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">First name</label>
                <input name="firstname" class="form-control" placeholder="Enter first name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Last name</label>
                <input name="lastname" class="form-control" placeholder="Enter last name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" class="form-control" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input name="password" type="password" class="form-control" placeholder="Password">
            </div>

            <input type="submit" class="btn btn-primary">
        </form>
    </div>

</body>

</html>