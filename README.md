[Un tuto pas mal pour commencer](https://www.youtube.com/watch?v=xHyqnEVr3V4)

# Projet Portfolio - Back-office et interface visiteur

Dans le cadre du développement d'un Portfolio de développeur Web, le besoin porte sur la conception et le développement d'un back-office permettant d'administrer la publication de projets, puis d'une interface publique permettant de consulter les projets publiés.

## Développement *back-end*

### Conception de la base de données 

#### Structure de la base de données

Cette base de données se compose de 5 tables. Les tables « utilisateur » et « projet » ne sont pas liées, tout utilisateur qui a le rôle d'administrateur peut utiliser les fonctions d'édition du back-office. 

Par contre, si il y a bien un champs « image mise en avant » pour les projets, il est possible de constituer une gallerie de captures d'écran du projet via le *back-office*, ce qui implique de lier la table « projet » à la table « capture d'écran » via une clé étrangère. 

On monte encore d'un niveau avec les étiquettes : il faut bien sûr une table dédiée aux étiquettes, mais comme un projet peut avoir plusieurs étiquettes, qu'une étiquette peut être attribuée à de nombreux projets... il va falloir une table intermédiaire. ( [Cette vidéo](https://www.youtube.com/watch?v=JLIa0Qj5HYE) montre assez bien comment ça fonctionne)

- la table « users » :
    - id (pk)
    - username
    - email
    - password
    - role (visitor / administrator)

- la table « projects » :
    - id (pk)
    - title
    - completion_period
    - description
    - visibility (hide / visible)
    - thumbnail 
    - project_link
    - github_link

- la table « projects_screenshots » 
    - id (pk)
    - project_id (sk)
    - name
    - alt_text

- la table « tags »
    - id (pk)
    - tag_name (sk)

- la table « projects_tags »
    - id (pk)
    - project_id (sk)
    - tag_id (sk)


#### Modélisation de la base de données

Formalisez le Modèle Conceptuel de Données, le Modèle Logique de Données puis le Modèle Physique de Données. Utiliser [MySQL Workbench](https://www.mysql.com/fr/products/workbench/) pour modéliser la base de données.



### Développement de l'interface du *back-office*

#### La page de connexion

Il s'agît de la page « index.php ». Elle se compose d'un formulaire de connexion permettant de renseigner un nom d'utilisateur et un mot de passe. Le script vérifie si ce nom d'utilisateur et ce mot de passe sont enregistrés dans la base de données, si c'est le cas, on accède à la page « home.php ». Dans le cas contraire, on reste sur cette page, qui propose aussi un lien vers la page « register.php » permettant de soumettre une demande d'inscription, et un lien de récupération du mot de passe.

#### La page d'inscription d'un nouvel utilisateur

Il s'agît de la page « register.php » Elle permet de soumettre une demande d'inscription via un formulaire. Le visiteur doit renseigner un nom d'utilisateur, un email et un mot de passe, qu'il doit re-taper par sécurité dans un second champs de type *password* (bonus : gérer en JavaScript l'impossibilité de coller du texte dans ce champs). 

Lorsqu'un utilisateur soumet une inscription, le programme vérifie la conformité des deux mots de passe saisie puis crypte le mot de passe avant de l'insérer dans la base de données.

Par défaut, le rôle attribué sera celui de visiteur : l'utilisateur enregistré pourra voir la liste des projets (uniquement ceux qui ont le statut visible), mais ne pourra utiliser aucune des fonctions d'édition, de mise-à-jour ou de suppression du *back-office*. 

L'inscription envoie automatiquement un mail à l'administrateur du *back-office* l'informant de l'existence du nouvel utilisateur, l'administrateur pourra alors paramétrer les droits de cet utilisateur.

#### La page de récupération du mot de passe

Il s'agît de la page « recovery.php » : un simple formulaire permettant à l'utilisateur de renseigner son adresse mail pour recevoir un nouveau mot de passe. Elle vérifie si l'adresse mail renseignée existe, si c'est le cas, elle génère un nouveau mot de passe et l'envoie à cette adresse mail. Sinon, un message d'erreur s'affiche. 

#### La page listant les projets

Il s'agît de la page « home.php ». Cette page se connecte à la base de données et affiche le titre de tous les projets contenus dans la table « projects », ainsi que leurs technologies (enregistrées sous formes de *tags* dans la base de données, en cliquant sur une étiquette, on peut n'afficher que les projets ayant eu recours à cette technologie). 

En cliquant sur un titre, on accède à la page « details.php ».

Un bouton « ajouter un projet » permet d'accéder à la page « add.php ». 

Depuis cette page, on peut aussi modifier ou supprimer un projet existant et changer sa visibilité, ou encore se déconnecter du *back-office*.

Pour prévenir d'un *missclick*, la suppression doit se faire en deux étapes : au clic sur le bouton, une fenêtre modale demandant la confirmation doit apparaître. (Bonus : via cette page qui liste les articles, on peux imaginer un système de suppression simultanée de plusieurs articles : un bouton « supprimer des articles » ferait apparaître des *checkbox* à côté de chaque titre, et la confirmation de la suppression supprimerait tous les articles sélectionnés par exemple).

Dernier élément de cette page, un lien vers la page « tags_manager.php », qui permet de créer des étiquettes qui seront attribuées aux projets. 

[La requête pour récupérer les informations affichées sur cette page sera la même que celle à utiliser sur la page listant les projets de l'interface visiteur du portfolio]

#### La page d'administration des étiquettes

Il s'agît de la page « tags_manager.php ». Cette page liste les étiquettes existante et permet d'en créer de nouvelles (mais pas de suppression ou de modification de celles qui existent déjà).

#### La page de création d'un projet

Il s'agît de la page « add.php ». C'est un formulaire permettant de renseigner toutes les informations concernant un nouveau projet : son titre, sa période de réalisation, ses « étiquettes » (le technologies utilisées pour sa réalisation), la description du projet, sa visibilité par défaut (masquée ou affichée), son image mise-en-avant et les liens vers le projet en ligne et son github. Cette page permet aussi de charger des captures d'écran du site ou de l'application web réalisée, pour constituer une gallerie d'image. 

#### La page affichant un projet

Il s'agît de la page « details.php ». Elle affiche toutes les informations concernant un projet en fonction de son id. À côté de chaque information, une icône indique la possibilité de modifier l'information : via cette page, il est en effet possible de modifier une par une chaque information contenue dans la base de données concernant le projet (bonus : utiliser l'Ajax pour n'actualiser que la zone modifiée et ne pas avoir à recharger toute la page). 

La page permet aussi d'ajouter de nouvelles captures d'écran au projet. 

Comme sur la page listant les projets, la fonction supprimer est présente. Attention, ici aussi, la suppression se fait en deux étapes : une modale demandant confirmation doit s'ouvrir pour prévenir toute mauvaise manipulation. 

[La requête pour récupérer les informations affichées sur cette page sera la même que celle à utiliser sur la page d'un projet individuel de l'interface visiteur du portfolio]
