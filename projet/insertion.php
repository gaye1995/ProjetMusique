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
    <div class="insertion">
        <h1>Insertion musicale</h1>
        <form action="insertion.php" method="post">
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