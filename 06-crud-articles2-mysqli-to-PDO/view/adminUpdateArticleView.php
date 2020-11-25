<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mettre à jour un article</title>
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
<link rel="stylesheet" href="css/custom.min.css" media="screen"></head>
<body>
<div class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <div class="container">
        <a href="./" class="navbar-brand">Accueil</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="?p=create" title="Ajouter un article">Création d'un nouvel article</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?p=disconnect">Déconnexion</a>
                </li>

            </ul>

        </div>
    </div>
</div>

<div class="container">

    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <h1>Administration</h1>
                <p class="lead">Bienvenue <?=$_SESSION['thename']?>, vous êtes <?=$_SESSION['droit_name']?></p>
                <h2>Mettre à jour un article</h2>
                <p class="lead"><a href="./">Retournez à l'accueil de l'admin</a></p>
                <?php
                if(isset($erreur)):
                ?>

                <h2><?=$erreur?></h2>


                <?php
                else:
                // var_dump($recupArticle,$recupUsers);
                endif;
                ?>
                <hr>

                <form action="" name="insertion" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Votre titre :</label>
                        <input name="titre" type="text" class="form-control"  placeholder="Votre titre" value="<?=$recupArticle['titre']?>" required>

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Votre texte</label>
                        <textarea name="texte" class="form-control"  placeholder="Votre texte" required><?=$recupArticle['texte']?></textarea>
                    </div>
                    <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label">Date</label>
                        <div class="col-10">
                            <input name="thedate" class="form-control" type="text" value="<?=$recupArticle['thedate']?>" id="example-date-input">
                        </div>
                    </div>
                    <!-- champs caché utile pour l'id -->
                    <input type="hidden" name="idarticles" value="<?=$recupArticle['idarticles']?>">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Choix de l'auteur</label>
                        <?php
                        foreach($recupUsers as $item):
                            // ternaire qui vérifie la récupération de l'idusers de 2 requêtes différentes: $recupArticles et comparaison avec celui de $recupUsers - permet de choisir l'auteur d'origine de l'article
                            $choice = ($item['idusers']==$recupArticle['idusers'])? "checked": "";
                        ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="users_idusers" id="exampleRadios1" value="<?=$item['idusers']?>" required <?=$choice?>>
                                <label class="form-check-label" for="exampleRadios1">
                                    <?=$item['thename']?>
                                </label>
                            </div>

                        <?php
                        endforeach;
                        ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>

        </div>
    </div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>