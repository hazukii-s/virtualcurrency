<?php




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
    <div class="container">
        <h5>Maak een transfer</h5>
        <form action="">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">€</span>
                </div>
                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Bericht</span>
                </div>
                <textarea class="form-control" aria-label="With textarea"></textarea>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary">Verzenden</button>
            </div>
        </form>
    </div>
</body>

</html>