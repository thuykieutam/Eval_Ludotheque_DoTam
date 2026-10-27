
<?php
$nav = "";

if(isset($_SESSION['prenom'])){
    // si connecté
    $nav .= '<echo>Bonjour ' . htmlspecialchars($_SESSION['prenom']) . '</echo>';
    $nav .= '<a href="index.php">Accueil</a>';
    $nav .= '<a href="ajout-jeu.php">Ajouter un jeu</a>';
    $nav .= '<a href="deconnexion.php">Se déconnecter</a>';
}else{
    // si non connecté
    $nav .= '<a href="index.php">Accueil</a>';
    $nav .= '<a href="inscription.php">Inscription</a>';
    $nav .= '<a href="connexion.php">Connexion</a>';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon site</title>
    <link rel="stylesheet" href="src/css/style.css">
</head>
<body>
    <header>
        <nav>
            <?php echo $nav; ?>
        </nav>
    </header>