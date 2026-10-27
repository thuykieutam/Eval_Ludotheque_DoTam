<?php 
include(connexion.php);

$message = '';
$erreur = '';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=ludotheque', 'root', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    // Catégories pour la liste déroulante
    $request = $pdo->prepare('SELECT id_categorie, nom_categorie FROM categorie ORDER BY nom_categorie');
    $request->execute();
    $categories = $request->fetchAll(PDO::FETCH_ASSOC);





    
} catch (Exception $error) {
    die($error->getMessage());
}

include('includes/header.php');
?>

<main>
    <section>
        <h2>Ajouter un jeu</h2>

        <form action="" method="post">
            <label for="titre">Titre <input type="text" name="titre" id="titre"></label>
            <label for="joueurs_min">Nombre minimum de joueurs <input type="number" name="joueurs_min" id="joueurs_min"></label>
            <label for="joueurs_max">Nombre maximum de joueurs <input type="number" name="joueurs_max" id="joueurs_max"></label>
            <label for="duree">Durée d'une partie (en minutes) <input type="number" name="duree" id="duree"></label>
            <label for="id_categorie">Catégorie
                <select name="id_categorie" id="id_categorie">
            <input type="submit" name="submitJeu" value="Ajouter le jeu">
        </form>
        <?php include('includes/footer.php'); ?>