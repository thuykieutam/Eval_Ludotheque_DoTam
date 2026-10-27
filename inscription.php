<?php
session_start();
include('utils/utils.php'); 
$message = '';

// vérification si les champs existent
if(isset($_POST["inscription"])){
    //2) Vérifier que tous les champs sont remplis
    if(!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirmer_mot_de_passe'])){
    }else{
        $message = "Veuillez remplir tous les champs du formulaire.";
    }

    // Vérification de l'email
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    }else{
        $message = "Votre email n'est pas au bon format.";
    }

    // Vérification du mot de passe
    if(mb_strlen($_POST['password'], 'UTF-8') >= 12){
    }else{
        $message = "Votre mot de passe doit faire au moins 12 caractères.";
    }

    if($_POST['password'] === $_POST['confirmer_mot_de_passe']){
    }else{
        $message = "Votre mot de passe n'est pas identique.";
    }

        //trimmer les données, sauf le mdp
        $prenom = trim($_POST['prenom']);
        $nom = trim($_POST['nom']);
        $email = trim($_POST['email']);
        // Hasher le mot de passe
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        try {
            $pdo = new PDO('mysql:host=localhost;dbname=ludotheque','root','root',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            $verif = $pdo->prepare('SELECT m.email FROM membre m WHERE email = ?'); // vérifier si l'email existe déjà
            $verif->execute([$email]);

            if($verif->fetch() === false){
                $request = $pdo->prepare('INSERT INTO membre (prenom, nom, email, mot_de_passe) VALUES(?, ?, ?, ?)');
                $request->bindParam(1,$prenom,PDO::PARAM_STR);
                $request->bindParam(2,$nom,PDO::PARAM_STR);
                $request->bindParam(3,$email,PDO::PARAM_STR);
                $request->bindParam(4,$password,PDO::PARAM_STR);

                $request->execute();

                $message = "L'utilisateur a été enregistré :  {$prenom} {$nom} - {$email}";

            }else{
                $message = "Cet email est déjà utilisé par un autre compte.";
            }

        }catch(Exception $error){
            die($error->getMessage());
        }
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <h1>Page d'Accueil</h1>
        <section>
            <h2>Inscription</h2>
            <form action="" method="post">
                <label for="prenom">Prénom <input type="text" name="prenom" id="prenom"></label>
                <label for="nom">Nom <input type="text" name="nom" id="nom"></label>
                <label for="email">Email <input type="text" name="email" id="email"></label>
                <label for="password">Mot de passe <input type="password" name="password" id="password"></label>
                <label for="confirmer_mot_de_passe">Confirmer le mot de passe <input type="password" name="confirmer_mot_de_passe" id="confirmer_mot_de_passe"></label>
                <input type="submit" name="inscription" value="S'inscrire">
            </form>
            <p>
                <?php echo htmlspecialchars($message); ?>
            </p>
        </section>
        <section>
            <h2>    </h2>
            <ul>
                <?php  ?>
            </ul>
        </section>
    </main>
</body>
</html>



