
<?php
$nav ="";

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon site</title>
    <link rel="stylesheet" href="src/css/style.css">
</head>
<?php
$nav = '<a href="index.php">Accueil</a>';
$nav = '<a href="inscription.php">Inscription</a>';
$nav = '<a href="connexion.php">Connexion</a>';
?>
<body>
    <header>
        <nav>
            <?php echo $nav; ?>
        </nav>
    </header>