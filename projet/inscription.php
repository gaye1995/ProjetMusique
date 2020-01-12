<?php 
//On vérifie si les champs 'firstName', 'lastName'... ne sont pas vide.
if(!empty($_POST['firstName']) AND !empty($_POST['lastName']) AND !empty($_POST['mail']) AND !empty($_POST['passWord']))
{
    //On vérifie si l'utilisateur a bien entré des données .
    if(isset($_POST['firstName'], $_POST['lastName'], $_POST['mail'], $_POST['passWord']))
    {
        //On se connecte à la base par un try catch 
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=ProjetFinal;charset=utf8', 'root', '');
        }catch(PDOException $PDOe)
        {
            die('Error: '.$PDOe->getMessage());
        }

        /*On preprare une requêtre sql de type SELECT avec une fonction sql COUNT() 
            et une clause WHERE pour vérifier si le prenom de l'utilisateur existe 
            dans la base de donnée.
        */
        $q = $db->prepare('SELECT COUNT(*) AS somme FROM inscription WHERE lastName = :lastName');
    
        //ensuite envoie le paramétre par un tableau associatif.
        $q->execute([':lastName' => htmlentities($_POST['lastName'])]);
        
        //On recupère  le résultat de la requête dans la variable $bool
        $bool = $q->fetchColumn();
        
        /*On vérifie si le résulat si c'est vrai : le nom de l'utilisateur existe déjà dans la base de donnée.
            sinon insére les données de l'utilisateur dans la base de donnée.
        */
        if($bool)
            $erreur =  "Si vous avez déjà un compte connectez vous.";
        else 
        {
            //on preprare une requêtre sql de type INSERT INTO
            $q = $db->prepare('INSERT INTO inscription(firstName, lastName, mail, passWord) VALUES(:firstName, :lastName, :mail, :passWord)');
            //ensuite envoie le paramétre par la methode bindValue().
            $q->bindValue('firstName', htmlentities($_POST['firstName']));
            $q->bindValue('lastName', htmlentities($_POST['lastName']));
            $q->bindValue('mail', htmlentities($_POST['mail']));
            $passWord = htmlentities($_POST['passWord']);
            //On hache le mot de passe avant de l'enregistrer dans la base de donnée par la fonction password_hash.
            $q->bindValue('passWord', password_hash($passWord, PASSWORD_DEFAULT));
            
            //Enfin on exécute la requête.
            $q->execute();
    
            $success = "Merci pour potre inscription";
            
            // Une fois l'insertion a réusit on envoie l'utilisateur à la page d'insertion par header().
            header('Location: insertion.php');
        }
    } 
} 
else
    $erreur = "Veuillez remplir le formulaire svp";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Inscription</title>
</head>
<body>
    <div class="login">
    <!--On vérifie si l'utilisateur n'a pas rempli le formulaire . -->

        <?php if(isset($erreur)): ?>
            <p><?= $erreur ?></p>
        <?php endif ?>

     <!-- Fin de la vérification. -->

        <h1>S'inscrire</h1>
        <form action="inscription.php" method="post">
            <div class="text-box">
                 <input type="text" name="firstName" placeholder="Votre nom" required>
            </div>
            <div class="text-box">
                 <input type="text" name="lastName" placeholder="Votre prenom" required>
            </div>
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