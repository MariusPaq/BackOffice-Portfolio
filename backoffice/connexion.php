<?php

require_once('db-connect.php');

$sql = 'SELECT id, username, password FROM users WHERE username = :username';

$query = $db->prepare($sql);
$query->bindParam(':username', $username, PDO::PARAM_STR);
$query->bindParam(':password', $password, PDO::PARAM_STR);
$query->execute(array('username' => $_POST['username']));
$result = $query->fetch();

if (!$result){
    $_SESSION['error'] = "L'identifiant ou le mot de passe sont incorrects." ;
} else{
    //$checkingPassword = password_verify($_POST['password'], $result['password']);
    $checkingPassword = $_POST['password'] ==  $result['password'];
    if (!$checkingPassword) {
        $_SESSION['error'] = "L'identifiant ou le mot de passe sont incorrects.";
    }
    else {
        session_start();
        $_SESSION['id'] = $result['id'];
        $_SESSION['username'] = $result['username'];
        $_SESSION['success'] = "Connexion réussie !";
        header('Location: home.php');
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
<main class="container">
<p><a href="index.php" title="retour à la liste des projets" class="btn btn-primary"><i class="fas fa-home"></i></a></p>
<?php
    if(!empty($_SESSION['success'])){
        echo '  <div class="alert alert-success" role="success">
                    ' . $_SESSION['success'] .'
                </div>
        ';
        $_SESSION['success'] = '';

    }

    if(!empty($_SESSION['error'])){
        echo '  <div class="alert alert-danger" role="alert">
                    ' . $_SESSION['error'] . '
                </div>
        ';
        $_SESSION['error'] = '';
    }
?>
</main>

<script src="https://kit.fontawesome.com/3dd2efdd7b.js" crossorigin="anonymous"></script>
</body>
</html>
