<?php
// Démarrage d'une session
session_start();

if ($_SESSION['username']) {
    if ($_POST) {
        if(isset($_POST['title']) && !empty($_POST['title'])
        && isset($_POST['tags']) && !empty($_POST['tags'])
        && isset($_POST['completion_period']) && !empty($_POST['completion_period'])
        && isset($_POST['technologies']) && !empty($_POST['technologies'])
        && isset($_POST['description']) && !empty($_POST['description'])
        && isset($_POST['thumbnail']) && !empty($_POST['thumbnail'])
        && isset($_POST['project_link']) && !empty($_POST['project_link'])
        && isset($_POST['github_link']) && !empty($_POST['github_link'])){
            // Connexion à la base de données
            require_once('db-connect.php');

            // Nettoyage
            $title = strip_tags($_POST['title']);
            $tags = explode(",",$_POST['tags']);
            $completion_period = strip_tags($_POST['completion_period']);
            $technologies = strip_tags($_POST['technologies']);
            $description = strip_tags($_POST['description']);
            $thumbnail = strip_tags($_POST['thumbnail']);
            $project_link = strip_tags($_POST['project_link']);
            $github_link = strip_tags($_POST['github_link']);

            $sql = 'INSERT INTO `projects` (`id`, `title`, `completion_period`, `technologies`, `description`, `thumbnail`, `project_link`, `github_link`) VALUES (:id, :title, :completion_period, :technologies, :description, :thumbnail, :project_link, :github_link);';

            $query = $db->prepare($sql);

            $id_project = $title.uniqid();
            $query->bindParam(':id', $id_project, PDO::PARAM_STR);
            $query->bindValue(':title', $title, PDO::PARAM_STR);
            $query->bindValue(':completion_period', $completion_period, PDO::PARAM_STR);
            $query->bindValue(':technologies', $technologies, PDO::PARAM_STR);
            $query->bindValue(':description', $description, PDO::PARAM_STR);
            $query->bindValue(':thumbnail', $thumbnail, PDO::PARAM_STR);
            $query->bindValue(':project_link', $project_link, PDO::PARAM_STR);
            $query->bindValue(':github_link', $github_link, PDO::PARAM_STR);

            $query->execute();

            foreach ($tags as $tag) {
              $id_tag = $tag.uniqid();
              $sqlt = 'INSERT INTO `tags` VALUES(?,?)';
              $queryt = $db->prepare($sqlt);
              $queryt->bindParam(1, $id_tag);
              $queryt->bindParam(2, $tag);
              $queryt->execute();
              $sqlpt = 'INSERT INTO `projects_tags` VALUES(?,?)';
              $querypt = $db->prepare($sqlpt);
              $querypt->bindParam(1, $id_project);
              $querypt->bindParam(2, $id_tag);
              $querypt->execute();
            }

            $_SESSION['success'] = "Projet ajouté.";

            require_once('close.php');

            header('Location: home.php');
            require_once('close.php');

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
    <title>Ajouter un projet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <main class="container">
      <p><a id="homeAdd" href="home.php" title="retour à la liste des projets" class="btn btn-primary"><i class="fas fa-home"></i></a></p>
        <div class="row">
            <section id="addSection" class="col-12">
            <h1>Ajout d'un projet</h1>
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
                        <input type="text" id="title" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input type="text" id="tags" name="tags" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="completion_period">completion_period</label>
                        <input type="text" id="completion_period" name="completion_period" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="technologies">Technologies</label>
                        <input type="text" id="technologies" name="technologies" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">thumbnail</label>
                        <input type="text" id="thumbnail" name="thumbnail" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" row="4"> </textarea>
                    </div>
                    <div class="form-group">
                        <label for="project_link">project_link</label>
                        <input type="text" id="project_link" name="project_link" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="github_link">github_link</label>
                        <input type="text" id="github_link" name="github_link" class="form-control">
                    </div>

                    <p class="alert alert-warning" role="alert">Par défaut, lorsque vous créez un projet, il n'apparaît pas immédiatement dans votre liste de projets sur votre portfolio. Une fois le projet créé et lorsqu'il est prêt à être publié, vous pouvez paramétrer sa visibilité depuis la liste des projets sur la page d'accueil.</p>

                    <button class="btn btn-outline-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
    <script src="https://kit.fontawesome.com/3dd2efdd7b.js" crossorigin="anonymous"></script>
</body>
</html>
