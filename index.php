<?php
/*
try{
    $pdo = new PDO('mysql:host=localhost;dbname=ludotheque','root','root',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $request = $pdo->prepare('SELECT j.joueurs_min, j.joueurs_max, j.titre, c.nom_categorie, j.duree, m.prenom FROM jeu j
       INNER JOIN categorie c ON c.id_categorie = j.id_categorie
       INNER JOIN membre m ON j.id_membre = m.id_membre)
       ORDER BY j.titre');
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

echo  "j.titre" . "j.nom_categorie" . formatJoueur($data). "j.duree" . categorieDuree($data);
*/

try{
    $pdo = new PDO('mysql:host=localhost;dbname=ludotheque','root','root',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $request = $pdo->prepare('SELECT j.joueurs_min, j.joueurs_max, j.titre, c.nom_categorie, j.duree, m.prenom
                              FROM jeu j
                              INNER JOIN categorie c ON c.id_categorie = j.id_categorie
                              INNER JOIN membre m ON j.id_membre = m.id_membre
                              ORDER BY j.titre');
    $request->execute();
    $data = $request->fetchAll(PDO::FETCH_ASSOC);
}catch(Exception $error){
    die($error->getMessage());
}
//print_r($data);

function formatJoueur($jeu)
{
    if($jeu['joueurs_min'] == 1 && $jeu['joueurs_max'] == 1){
        echo "SOLO";
    }else if($jeu['joueurs_min'] == $jeu['joueurs_max']){
        echo $jeu['joueurs_min'] . " joueurs";
    }else{
        echo $jeu['joueurs_min'] . " à " . $jeu['joueurs_max'] . " joueurs";
    }
}

function categorieDuree($jeu)
{
    if($jeu['duree'] <= 30){
        echo "partie rapide";
    }else if($jeu['duree'] <= 90){
        echo "partie moyenne";
    }else{
        echo "partie longue";
    }
}

foreach ($data as $jeu){
    echo "<p>";
    echo "TITRE : " . htmlspecialchars($jeu['titre']) . "<br>";
    echo "CATÉGORIE : " . htmlspecialchars($jeu['nom_categorie']) . "<br>";
    echo "JOUEURS : ";
    formatJoueur($jeu);
    echo "<br>";
    echo "DURÉE : " . htmlspecialchars($jeu['duree']) . " min (";
    categorieDuree($jeu);
    echo ")<br>";
    echo "AJOUTÉ PAR : " . htmlspecialchars($jeu['prenom']);
    echo "</p>";
}
?>

