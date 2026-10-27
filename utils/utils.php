<?php

try{
    $pdo = new PDO('mysql:host=localhost;dbname=ludotheque','root','root',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $request = $pdo->prepare('SELECT j.joueurs_min, j.joueurs_max, j.titre FROM jeu j');
    $request->execute();
    $data = $request->fetchAll(PDO::FETCH_ASSOC);
}catch(Exception $error){
    die($error->getMessage());
}
//print_r($data);
function formatJoueur($tab)
{
    foreach ($tab as $jeu){
        echo "<p>";
        echo "TITRE : " . htmlspecialchars($jeu['titre']) . "<br>";

        if($jeu['joueurs_min'] == 1 && $jeu['joueurs_max'] == 1){
            echo "SOLO";
        }else if($jeu['joueurs_min'] == $jeu['joueurs_max']){
            echo $jeu['joueurs_min'] . " joueurs";
        }else{
            echo $jeu['joueurs_min'] . " à " . $jeu['joueurs_max'] . " joueurs";
        }

        echo "</p>";
    }
}

formatJoueur($data);




try{
    $pdo = new PDO('mysql:host=localhost;dbname=ludotheque','root','root',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $request = $pdo->prepare('SELECT c.nom_categorie, j.duree FROM jeu j
    INNER JOIN categorie c ON c.id_categorie = j.id_categorie');
    $request->execute();
    $data = $request->fetchAll(PDO::FETCH_ASSOC);
}catch(Exception $error){
    die($error->getMessage());
}
    //print_r($data)
function categorieDuree($tab1)

{foreach ($tab1 as $jeu){
        echo "<p>";
        echo "Durée du jeu : " . htmlspecialchars($jeu['duree']) . "<br>";

        if($jeu['duree'] <= 30) {
            echo "partie rapide";
        }else if($jeu['duree'] >= 30 && $jeu['duree'] <= 90){
            echo "partie moyenne";
        }else{
            echo "partie longue";
        }

        echo "</p>";
    }
}

categorieDuree($data);

?>
