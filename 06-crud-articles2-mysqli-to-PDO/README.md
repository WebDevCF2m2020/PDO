# Transformation mysqli vers PDO

## Exercice appliqué

### Installation de la DB
- Importez la DB depuis
    
        datas/structure-donnees-articles2.sql

- Renommez en local le fichier config.php.local en config.php

### Test du site en mysqli

- Vérifiez que le site fonctionne depuis

        index.php
        
- Vérifiez que vous pouvez vous connecter avec

        login : Christiane    
        mot de passe : Christiane    

Vous devez pouvoir modifier / ajouter / supprimer des articles
### Exercice

1. Transformez la connexion en connexion PDO

        model/connectDB.php
        
2. Transformez les requêtes de mysqli en PDO
dans :

        model/articlesModel.php
        model/usersModel.php
        
Avec comme règles :
- SELECT sans données utilisateurs : ->query
- INSERT UPDATE DELETE sans données utilisateurs : ->exec
- Toutes requêtes avec données utilisateurs : ->prepare, ->bindParam ou ->bindValue, puis ->execute
- remplacement des fetch et num_rows en équivalent PDO
####! gardez les données en tableaux associatifs (ou indexés contenant de l'associatif pour le fetchAll) pour ne pas devoir modifier le code des vues

### Envoyez moi le lien de votre résultat sur VOTRE fork github

L'adresse pointant vers votre dossier 

        https://github.com/VotreNom/PDO/.../06-crud-articles2-mysqli-to-pdo
        
Bon travail !        