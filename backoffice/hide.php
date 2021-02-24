<?php
// Démarrage d'une session
session_start();

if ($_SESSION['username']) {
// Vérification de l'existence de l'id et du fait qu'il n'est pas vide dans l'url
if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('db-connect.php');
    // Nettoyage de l'id envoyée
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `projects` WHERE `id` = :id;';
    // Préparation de la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètres (id)
    $query->bindValue(':id', $id, PDO::PARAM_STR);

    // Exécution de la requête
    $query->execute();

    // Récupération du projet
    $project = $query->fetch();

    //Vérification de l'existence du projet
    if(!$project){
        $_SESSION['error'] = "Cette id n'existe pas.";
        header('Location: home.php');
    }

    $hide = ($project['hide'] == 0) ? 1 : 0;




    $sql = 'UPDATE `projects` SET `hide` = :hide WHERE `id` = :id;';
    // Préparation de la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètres (id)
    $query->bindValue(':id', $id, PDO::PARAM_STR);
    $query->bindValue(':hide', $hide, PDO::PARAM_INT);

    // Exécution de la requête
    $query->execute();

    header('Location: home.php');


} else {
    $_SESSION['error'] = "URL invalide";
    header('Location: home.php');
}
} else {
    $_SESSION['error'] = "L'identifiant ou le mot de passe sont incorrects.";
    header('Location: index.php');
}



?>
