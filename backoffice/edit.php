<?php
// Démarrage d'une session
session_start();

if ($_SESSION['username']) {
    if ($_POST) {
        if (isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['title']) && !empty($_POST['title'])
        && isset($_POST['tags']) && !empty($_POST['tags'])
        && isset($_POST['completion_period']) && !empty($_POST['completion_period'])
        && isset($_POST['technologies']) && !empty($_POST['technologies'])
        && isset($_POST['description']) && !empty($_POST['description'])
        && isset($_POST['thumbnail']) && !empty($_POST['thumbnail'])
        && isset($_POST['project_link']) && !empty($_POST['project_link'])
        && isset($_POST['github_link']) && !empty($_POST['github_link'])
        ){
            // Connexion à la base de données
            require_once('db-connect.php');

            $id = strip_tags($_POST['id']);
            $title = strip_tags($_POST['title']);
            $tags = explode(",",$_POST['tags']);
            $completion_period = strip_tags($_POST['completion_period']);
            $technologies = strip_tags($_POST['technologies']);
            $description = strip_tags($_POST['description']);
            $thumbnail = strip_tags($_POST['thumbnail']);
            $project_link = strip_tags($_POST['project_link']);
            $github_link = strip_tags($_POST['github_link']);

            $sql = 'UPDATE `projects` SET `title`=:title,`completion_period`=:completion_period, `technologies`=:technologies, `description`=:description, `thumbnail`=:thumbnail, `project_link`=:project_link, `github_link`=:github_link WHERE `id`=:id;';
            $query = $db->prepare($sql);

            $query->bindValue(':id', $id, PDO::PARAM_STR);
            $query->bindValue(':title', $title, PDO::PARAM_STR);
            $query->bindValue(':completion_period', $completion_period, PDO::PARAM_STR);
            $query->bindValue(':technologies', $technologies, PDO::PARAM_STR);
            $query->bindValue(':description', $description, PDO::PARAM_STR);
            $query->bindValue(':thumbnail', $thumbnail, PDO::PARAM_STR);
            $query->bindValue(':project_link', $project_link, PDO::PARAM_STR);
            $query->bindValue(':github_link', $github_link, PDO::PARAM_STR);


            $query->execute();


            $sqls = 'DELETE `tags`,`projects_tags` FROM `tags` INNER JOIN `projects_tags` ON `projects_tags`.`tag_id` = `tags`.`id` WHERE `projects_tags`.`project_id` =:id';
            $querys = $db->prepare($sqls);
            $querys->bindParam(':id', $id);
            $querys->execute();
            foreach ($tags as $tag) {
              $id_tag = $tag.uniqid();
              $sqlt = 'INSERT INTO `tags` VALUES(?,?)';
              $queryt = $db->prepare($sqlt);
              $queryt->bindParam(1, $id_tag);
              $queryt->bindParam(2, $tag);
              $queryt->execute();
              $sqlpt = 'INSERT INTO `projects_tags` VALUES(?,?)';
              $querypt = $db->prepare($sqlpt);
              $querypt->bindParam(1, $id);
              $querypt->bindParam(2, $id_tag);
              $querypt->execute();
            }


            $_SESSION['success'] = "Projet modifié.";

            header('Location: home.php');


        } else {
            $_SESSION['error'] = "Remplissez tous les champs.";
        }
    }

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
    <title>Ajouter un projet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <main class="container">
      <p><a id="homeEdit" href="home.php" title="retour à la liste des projets" class="btn btn-primary"><i class="fas fa-home"></i></a></p>
        <div class="row">
            <section id="editSection" class="col-12">
            <h1>Modification du projet « <?= $project['title'] ?> »</h1>
            <?php
                if(!empty($_SESSION['error'])){
                    echo '  <div class="alert alert-danger" role="alert">
                                ' . $_SESSION['error'] . '
                            </div>
                    ';
                    $_SESSION['error'] = '';
                }
            ?>
                <form method="post">
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" id="title" name="title" class="form-control" value="<?= $project['title'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input type="text" id="tags" name="tags" class="form-control" value="<?= $tagsList ?>">
                    </div>
                    <div class="form-group">
                        <label for="completion_period">completion_period</label>
                        <input type="text" id="completion_period" name="completion_period" class="form-control" value="<?= $project['completion_period'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="technologies">Technologies</label>
                        <input type="text" id="technologies" name="technologies" class="form-control" value="<?= $project['technologies'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" row="4"><?= $project['description'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">thumbnail</label>
                        <input type="text" id="thumbnail" name="thumbnail" class="form-control" value="<?= $project['thumbnail'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="project_link">project_link</label>
                        <input type="text" id="project_link" name="project_link" class="form-control" value="<?= $project['project_link'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="github_link">github_link</label>
                        <input type="text" id="github_link" name="github_link" class="form-control" value="<?= $project['github_link'] ?>">
                    </div>
                    <input type="hidden" value="<?= $project['id'] ?>" name="id">

                    <button class="btn btn-outline-primary">Envoyer</button> <a href="home.php" class="btn btn-outline-danger">Annuler</a>


                </form>
            </section>
        </div>
    </main>
    <script src="https://kit.fontawesome.com/3dd2efdd7b.js" crossorigin="anonymous"></script>
</body>
</html>
