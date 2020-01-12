<?php 
//On vérifie si les champs 'titre', 'interpretation'... ne sont pas vide.
if(!empty($_POST['titre']) AND !empty($_POST['interpretation']) AND !empty($_POST['lien']) AND !empty($_POST['genre']))
{
    //On vérifie si l'utilisateur a bien entré des données .
    if(isset($_POST['titre'], $_POST['interpretation'], $_POST['lien'], $_POST['genre']))
    {   
        //On se connecte à la base par un try catch 
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=ProjetFinal;charset=utf8', 'root', '');
        }catch(PDOException $PDOe)
        {
            die('Error: '.$PDOe->getMessage());
        }
        //on preprare une requêtre sql de type INSERT INTO
        $q = $db->prepare('INSERT INTO insertion(titre, interpretation, lien, genre) VALUES(:titre, :interpretation, :lien, :genre)');

        //ensuite envoie le paramétre par la methode bindValue().
        $q->bindValue('titre', htmlentities($_POST['titre']));
        $q->bindValue('interpretation', htmlentities($_POST['interpretation']));
        $q->bindValue('lien', htmlentities($_POST['lien']));
        $q->bindValue('genre', htmlentities($_POST['genre']));

        //Enfin on exécute la requête.
        $q->execute();
    }
}
else 
    $erreur = "Veuillez remplir les champs svp";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Insertion</title>
</head>
<body>
    <header class="topBar">
        <h1>Musiques</h1>
        <nav class="menu">
            <li><a href="acceuil.php">Accueil</a></li>
            <li><a href="deconnection.php">Se deconnecter</a></li>
        </nav>
    </header>
    <div class="insertion">
        <!--On vérifie si l'utilisateur n'a pas rempli le formulaire . -->

        <?php if(isset($erreur)): ?>
            <p><?= $erreur ?></p>
        <?php endif ?>

        <!-- Fin de la vérification. -->
        <h1>Insertion musicale</h1>
        <form action="insertion.php" method="POST">
            <div class="text">
                <div class="insertion-box">
                    <input type="text" name="titre" placeholder="Titre">
                </div>
                <div class="insertion-box">
                    <input type="text" name="interpretation" placeholder="Interpretation du musique">
                </div>
                <div class="insertion-box">
                    <input type="text" name="lien" placeholder="Lien d'internet">
                </div>
                <input type="submit" value="Insérer" class="btn-insertion">
            </div>
            <div class="file-select">
                <div class="insertion-select">
                    <select name="genre" SIZE="1">
                        <option>Rock
                        <option>Pop
                        <option>Jazz
                        <option>Rap
                        <option>variétés Françaises
                    </select>
                </div>
                <input type="file" name="file" placeholder="File">
            </div>
        </form>
    </div>
</body>
</html>