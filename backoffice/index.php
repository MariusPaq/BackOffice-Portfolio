<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
</head>
<body>

    <main class="container">
    <div class="row">
        <div class="d-flex justify-content-center">
            <div id="loginCard" class="card">
                <div class="card-body">
                    <h5 class="card-title">Back-Office</h5>
                    <form method="post" action="connexion.php">
                    <div class="mb-3">
                        <label for="inputName" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="inputName" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="inputPassword" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                    <a href="register.php" class="btn btn-outline-primary">S'inscrire</a>
                    </form>
                </div>
            </div>
    </div>
    </div>

        <?php
                if(!empty($_SESSION['error'])){
                    echo '  <div class="alert alert-danger" role="alert">
                                ' . $_SESSION['error'] . '
                            </div>
                    ';
                    $_SESSION['error'] = '';
                }
            ?>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
