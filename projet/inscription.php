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
    <header class="topBar">
        <h1>Musiques</h1>
        <nav class="menu">
            <li><a href="acceuil.php">Accueil</a></li>
            <li><a href="insertion.php">Insertion</a></li>
            <li><a href="inscription.php">S'inscrire</a></li>
            <li><a href="connection.php">Connection</a></li>
        </nav>
    </header>
    <div class="login">
        <h1>S'inscrire</h1>
        <form action="inscription.php"method="post">
            <div class="text-box">
                 <input type="text" name="firstName" placeholder="Votre nom">
            </div>
            <div class="text-box">
                 <input type="text" name="lastName" placeholder="Votre prenom">
            </div>
            <div class="text-box">
                 <input type="email" name="mail" placeholder="exemple@gmail.com">
            </div>
            <div class="text-box">
                 <input type="password" name="passWord" placeholder="Votre mot de passe">
            </div>
            <input type="submit" value="S'inscrire" class="btn">
        </form>
    </div>
</body>
</html>