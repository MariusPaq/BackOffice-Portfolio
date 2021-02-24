<?php include 'header.php' ?>
<div id="home" class="home">
  <h1 class="ml11"><!--Animation titre-->
    <span class="text-wrapper">
      <span class="line line1"></span>
      <span class="letters">Marius PAQUET</span>
    </span>
  </h1>
  <h3 class="ml13">Portfolio</h3><!--Animation titre-->
</div>
<div id="aPropos" class="diapo aPropos"><!--section1-->
  <h2 class="whiteFont">A Propos</h2>
  <div class="parallax" id="p5"></div><!--BackgroundBar-->
  <div class="parallax" id="p2"></div><!--BackgroundBar-->
  <div class="aProposBack">
    <div id="linkPropos" class="row">
      <span class="btn-grad" id="btnparcours"><p id="txtbtnparcours">Mon Parcours</p></span>
      <span class="btn-grad" id="btnhobbies"><p id="txtbtnhobbies">Hobbies</p></span>
    </div>
    <div class="contentPropos" id="parcours" ><!--page1-MonParcours-->
      <div class="row">
        <div class="col-7">
          <p id="presentation">
            Ayant toujours été attirés par les metiers de l'informatiques j'ai effectué un Baccalauréat STI2D option Systèmes d’information et numérique. Je me suis ensuite dirigé vers un Diplôme Universitaire de Technologie Informatique à l'Université de Bourgogne à dijon.
            <br>
            Lors d'un effectué dans l'entreprise Effalia, j'ai découvert le webdesigne et web developement dans un milieux proffessionelle, ce qui m'a poussé à effectuer une formation de webdesigner à ONLINEFORMATPRO ACS DIJON qui se déroule en ce moment.
          </p>
        </div>
        <div class="col-5">
          <img src="img/PP.jpg" alt="ImageProfile" id="PP">
        </div>
      </div>
    </div><!--parcours-->
    <div class="contentPropos" id="hobbies"><!--page2-Hobbies-->
      <div class="row">
        <div class="col-7">
          <p id="txtHobbies">
            <ul>
              <li>Dessin: Je dessine depuis maintenant de nombreuse année de façon ponctuelle, au début sur feuille et maintenant sur tablette ou tablette graphique.</li>
              <li>Production musicale assister par ordinateur: depuis maintenant 6 mois j'apprends la production musicale sur ordinateur en autodidacte.</li>
              <li>Découverte de musique: j'écoute beaucoup de musique et suis toujours à la recherche de nouveaux styles et artistes à écouter.</li>
            </ul>
          </p>
        </div>
        <div class="col-5">
          <img src="img/imgDrow1min.png" alt="dessin1">
          <img src="img/imgDrow2min.png" alt="dessin2">
        </div>
      </div>
    </div><!--hobbies-->
</div><!--aProposBack-->
  <div class="curiVita"><!--reseauxBackground-->
    <a href="img/CurriculumVitae.pdf" id="btCv" class="btn-grad"><p id="txtbtCv">Curriculum Vitae</p></a>
    <div class="linkHub">
      <a href="https://fr.linkedin.com/in/marius-paquet"><img src="img/QRLink.png" alt="QR Code Linkedin" class="qrCode" id="qrLink"></a>
      <a href="https://github.com/MariusPaq"><img src="img/QRGit.png" alt="QR Code github" class="qrCode" id="qrGit"></a>
      </div>
    </div>
    <div class="parallax" id="p1"></div><!--BackgroundBar-->
    <div class="parallax" id="p3"></div><!--BackgroundBar-->
    <div class="parallax" id="p4"></div><!--BackgroundBar-->
  </div>
  <div id="competences" class="diapo competences"><!--section2-->
    <h2 class="whiteFont">Competences</h2>
    <div class="competencesContain">
      <div class="competencesBack">
        <div class="parallax2" id="p11"></div><!--BackgroundBar-->
        <div class="d-flex justify-content-center">
          <?php createCardComp('HTML/CSS','img/html.png'); ?>
          <?php createCardComp('JavaScript','img/javascript.png'); ?>
        </div>
        <div class="d-flex justify-content-center">
          <?php createCardComp('PHP','img/php.png'); ?>
          <?php createCardComp('PL/SQL','img/sql.png'); ?>
          <?php createCardComp('Java','img/java.png'); ?>
        </div>
      </div><!--competencesBack-->
      <div class="parallax2" id="p6"></div><!--BackgroundBar-->
      <div class="parallax2" id="p7"></div><!--BackgroundBar-->
      <div class="parallax2" id="p8"></div><!--BackgroundBar-->
      <div class="competencesBack2">
        <p>Je souhaite me tourner plus vers la programmations Front-End mais sans délaisser le Back-End, je suis à l'aise avec la Programmations Orienter objet ( POO, COO ) ainsi que le PL/SQL.</p>
      </div>
      <div class="parallax2" id="p9"></div><!--BackgroundBar-->
      <div class="parallax2" id="p10"></div><!--BackgroundBar-->
    </div><!--competencesContain-->
  </div><!--competences-->
  <div id="projet" class="diapo projet"><!--section3-->
    <h2 class="whiteFont">Projets</h2>
    <?php
    require_once('backoffice/db-connect.php');

    $sql = 'SELECT * FROM `projects`';
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    $sql2 = 'SELECT `project_id`,`tag_name` FROM `tags`,`projects_tags` WHERE `id` = `tag_id`';
    $query2 = $db->prepare($sql2);
    $query2->execute();
    $project2 = $query2->fetchAll();
    $project2Temp = $project2;
    $tagsList = '';
    ?>

        <div class="row justify-content-center">
          <?php
              foreach($result as $key => $projects){
                $id = $projects['id'];
                $project2 = $project2Temp;
          ?>
          <div class="col-lg-4 projectcards">
                  <div class="card-body cardbody">
                    <p><strong><?php echo $projects['title'] ?></strong></p>
                    <img id="thumbFront" src="<?= $projects['thumbnail'] ?>" alt="Miniature">
                    <?php
                    foreach ($project2 as $a) {
                      if ($a[0]!=$id) {
                        unset($project2[array_search($a, $project2)]);
                      } else {
                        $tagsList = $tagsList.','.$a[1];
                      }
                    }
                    $tagsList = substr($tagsList,1);
                     ?>
                    <p><strong><?php echo $tagsList ?></strong></p>
                    <?php $tagsList = ''; ?>
                    <p id="descProj"><?php echo substr($projects['description'],0,200).'...' ?></p>
                    <p class="projects-link">
                      <a id="linkProject" href="<?php echo $projects['project_link'];?>" title="Voir la page web">Project Link</a>
                      <a id="linkGithub" href="<?php echo $projects['github_link'];?>" title="Consultez le code sur Github">Github Link</a>
                    </p>
                  </div>
          </div>
          <?php } ?>
      </div>
  <?php require_once('backoffice/close.php'); ?>

  </div><!--projet-->
<?php include 'footer.php' ?>
