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

    $sql2 = 'SELECT `project_id`,`tag_name` FROM `tags`,`projects_tags` WHERE `id` = `tag_id` AND `project_id` = :id';
    $query2 = $db->prepare($sql2);
    $query2->bindValue(':id', $id, PDO::PARAM_STR);
    $query2->execute();
    $project2 = $query2->fetchAll();
    $tagsList = '';
    foreach ($project2 as $a) {
      if ($a[0]!=$id) {
        unset($project2[array_search($a, $project2)]);
      } else {
        $tagsList = $tagsList.','.$a[1];
      }
    }
    $tagsList = substr($tagsList,1);

    if(!$project2){
        $_SESSION['error'] = "Cette id n'existe pas.";
        header('Location: home.php');
    }

    //Vérification de l'existence du projet
    if(!$project){
        $_SESSION['error'] = "Cette id n'existe pas.";
        header('Location: home.php');
    }

} else {
    $_SESSION['error'] = "URL invalide";
    header('Location: home.php');
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
    <title><?= $project['title'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <main class="container">
      <p><a id="homeDetails" href="home.php" title="retour à la liste des projets" class="btn btn-primary"><i class="fas fa-home"></i></a> <a id="editDetails" href="edit.php?id=<?= $project['id'] ?>"  title="modifier le projet" class="btn btn-primary"><i class="fas fa-edit"></i></a></p>
        <div class="row">
            <section id="projetDetails" class="col-12">
                <img id="thumb" src="<?= $project['thumbnail'] ?>" alt="miniature">
                <h1><?= $project['title'] ?></h1>
                <p><strong><?= $tagsList ?></strong> </p>
                <p><strong>Date:</strong> <?= $project['completion_period'] ?></p>
                <p><strong>Technologies:</strong> <?= $project['technologies'] ?></p>
                <p><?= $project['description'] ?></p>
                <p><strong>Lien du projet:</strong> <a href="<?= $project['project_link'] ?>"><?= $project['project_link'] ?></a></p>
                <p><strong>Lien Github:</strong> <a href="<?= $project['github_link'] ?>"><?= $project['github_link'] ?></a></p>
            </section>
        </div>
    </main>
    <script src="https://kit.fontawesome.com/3dd2efdd7b.js" crossorigin="anonymous"></script>
</body>
</html>
