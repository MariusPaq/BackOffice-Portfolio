<?php 

// Démarrage d'une session
session_start();

if ($_SESSION['username']) {
    if ($_POST) {
        if (isset($_POST['username']) && !empty($_POST['username']) 
        && isset($_POST['email']) && !empty($_POST['email']) 
        && isset($_POST['password']) && !empty($_POST['password']) 
        && isset($_POST['confirmation']) && !empty($_POST['confirmation'])
        ){
            if ($_POST['password'] == $_POST['confirmation']) {
                // Connexion à la base de données
                require_once('db-connect.php');
    
                // Nettoyage
                $username = strip_tags($_POST['username']);
                $email = strip_tags($_POST['email']);
                $pass = strip_tags($_POST['password']);
                $password = password_hash($pass , PASSWORD_DEFAULT);
                $confirmation = strip_tags($_POST['confirmation']);
    
                $sql = 'INSERT INTO users(username, password, email) VALUES(:username, :password, :email)';
    
                $query = $db->prepare($sql);
    
                $query->bindValue(':username', $username, PDO::PARAM_STR);
                $query->bindValue(':email', $email, PDO::PARAM_STR);
                $query->bindValue(':password', $password, PDO::PARAM_STR);
    
    
                $query->execute();
    
                $_SESSION['success'] = "Utilisateur créé. Nous étudions votre demande, vous recevrez votre confirmation d'inscription par mail.";
    
                require_once('close.php');
    
                header('Location: index.php'); 
            } else {
                $_SESSION['error'] = "Les mots de passe ne correspondent pas.";  
            }
        } else {
            $_SESSION['error'] = "Remplissez tous les champs.";  
        }
    }
    
} else {
    $_SESSION['error'] = "L'identifiant ou le mot de passe sont incorrects.";
    header('Location: index.php');
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
        <?php
            if(!empty($_SESSION['error'])){
                echo '<div class="alert alert-danger" role="alert">'. $_SESSION['error'] .'</div>';
                    $_SESSION['error'] = '';
                }
            ?>
        <form method="post">
            <div class="mb-3">
                <label for="inputUsername" class="form-label">Nom</label>
                <input type="text" class="form-control" id="inputUsername" name="username">
            </div>
            <div class="mb-3">
                <label for="inputEmail" class="form-label">Adresse email</label>
                <input type="email" class="form-control" id="inputEmail" name="email">
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="inputPassword" name="password">
            </div>
            <div class="mb-3">
                <label for="inputConfirmation" class="form-label">Retapez votre mot de passe</label>
                <input type="password" class="form-control" id="inputConfirmation" name="confirmation">
            </div>
            <button type="submit" class="btn btn-primary">S'inscrire</button>
            <a href="index.php" class="btn btn-outline-danger">Annuler</a>
        </form>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>