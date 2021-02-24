<?php
session_start();

if ($_SESSION['username']) {
    require_once('db-connect.php');

    $sql = 'SELECT * FROM `projects`';
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    $sql2 = 'SELECT * FROM `tags`';
    $query2 = $db->prepare($sql2);
    $query2->execute();
    $result2 = $query2->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($result);

    require_once('close.php');
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
    <title>Liste des projets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <main class="container">
      <p id="disc"><a href="disconnect.php" title="Se déconnecter" class="btn btn-primary"><i class="fas fa-user-slash"></i></a></p>
        <div class="row">
            <section id="listProj" class="col-12">
            <h1>Liste des projets</h1>
            <?php
                if(!empty($_SESSION['error'])){
                    echo '  <div class="alert alert-danger" role="alert">
                                ' . $_SESSION['error'] . '
                            </div>
                    ';
                    $_SESSION['error'] = '';
                }
                if(!empty($_SESSION['success'])){
                    echo '  <div class="alert alert-success" role="success">
                                ' . $_SESSION['success'] . '
                            </div>
                    ';
                    $_SESSION['success'] = '';
                }
            ?>
                <table class="table">
                    <thead>
                        <th>Projets</th>
                        <th></th>
                        <th>Technologies</th>
                        <th>Descriptions</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <?php
                            // Boucle sur la variable result qui contient un tableau
                            foreach($result as $key => $projects){
                        ?>
                            <tr>
                                <td><strong><?= $projects['title'] ?></strong></td>
                                <td><img id="thumbHome" src="<?= $projects['thumbnail'] ?>" alt="Miniature"></td>
                                <td><?= $projects['technologies'] ?></td>
                                <td><?= substr($projects['description'],0,200).'...' ?></td>
                                <td>
                                    <a href="details.php?id=<?= $projects['id'] ?>" title="Consultez le projet « <?= $projects['title'] ?> »"><i class="fas fa-pager"></i></a>

                                    <a href="edit.php?id=<?= $projects['id'] ?>" title="Modifier le projet « <?= $projects['title'] ?> »"><i class="fas fa-edit"></i></a>

                                        <br>

                                    <a href="hide.php?id=<?= $projects['id'] ?>" title="Afficher / Masquer le projet « <?= $projects['title'] ?> »">
                                        <?php
                                        if($projects['hide'] == 0){
                                           echo '<i class="far fa-eye-slash"></i>' ;
                                        } else {
                                           echo '<i class="far fa-eye"></i>' ;
                                        }
                                        ?>
                                    </a>

                                    <a id="btnSupr" href="delete.php?id=<?= $projects['id'] ?>" title="Supprimer le projet « <?= $projects['title'] ?> »"><i class="fas fa-trash"></i></a>

                                  </td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                <a href="add.php" class="btn btn-primary">Ajouter un projet</a>
            </section>
        </div>

        <!--data-bs-toggle="modal" data-bs-target="#deleteModal"-->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Supprimer un projet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php echo $key;
                  echo $keyTemp;?>
            <div class="modal-body">
                Êtes-vous sûr de vouloir définitivement supprimer « <?= $projects['title'] ?> » ? Aucun retour en arrière ne sera possible !
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Annuler</button>
                <a href="delete.php?id=<?= $projects['id'] ?>" class="btn btn-outline-danger" title="Supprimer le projet « <?= $result[$key]['title'] ?> »">Supprimer</a>
            </div>
            </div>
        </div>
        </div>



    </main>
    <script src="https://kit.fontawesome.com/3dd2efdd7b.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
