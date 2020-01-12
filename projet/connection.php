<?php
//On vérifie si l'utilisateur a bien entré des données pour s'authentifier.
if(isset($_POST['mail'], $_POST['passWord']))
{
    //On se connecte à la base par un try catch 
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=ProjetFinal;charset=utf8', 'root', '');
    }catch(PDOException $PDOe)
    {
        die('Error: '.$PDOe->getMessage());
    }

    /*
        On preprare une requêtre sql de type SELECT avec  une clause WHERE pour vérifier si le mail de l'utilisateur existe 
        dans la base de donnée.
    */
    $q = $db->prepare('SELECT mail, passWord FROM inscription WHERE mail = :mail');

     //ensuite envoie le paramétre par un tableau associatif.
    $q->execute([':mail' => htmlentities($_POST['mail'])]);

    //On recupère  le résultat de la requête dans la variable $d
    $d = $q->fetchAll(PDO::FETCH_ASSOC);

    foreach($d as $donnee)
    {
        //On vérifie  dans le " if " ci aprés : si les deux mot de passes sont identiques par la fonction password_verify 
        //On vérifie en même temps est ce que les deux mail sont identiques.
        //$_POST["passWord"] est le mot de passe saisi par l'utilisateur.
        //$donnnee["passWord"] est le mot de passe qui se situe dans la base de donnée.
        $passWord_correct = password_verify($_POST["passWord"], $donnee['$passWord']);

        if($donnee['mail'] === htmlentities($_POST['mail']) AND password_verify($_POST['passWord'], $donnee['passWord']))
        {
            //Si l'authentification a bon on redirige l'utisateur à la page d'insertion.
            header('Location: insertion.php');
        }
        else 
            $erreur = "User or PassWord invalid";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
</head>
<body>
    <div class="login">
    <!--On affiche un message d'erreur si l'utilisateur n'a pas pu s'identifier . -->

        <?php if(isset($erreur)): ?>
            <p><?= $erreur ?></p>
        <?php endif ?>

    <!-- Fin de l'affichage -->

        <h1>Login</h1>
        <form action="connection.php" method="POST">
            <div class="text-box">
                 <input type="email" name="mail" placeholder="exemple@gmail.com" required>
            </div>
            <div class="text-box">
                 <input type="password" name="passWord" placeholder="Votre mot de passe" required>
            </div>
            <input type="submit" value="S'inscrire" class="btn">
        </form>
    </div>
</body>
</html>