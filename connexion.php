<?php

session_start();
include('utils/utils.php'); 
$messageCo = '';

// Vérifier formulaire de connexion
if(isset($_POST['submitCo'])){

    //Vérifier champs
    if(!empty($_POST['emailCo']) && !empty($_POST['passwordCo'])){
        // Vérifier le format des données
        if(filter_var($_POST['emailCo'], FILTER_VALIDATE_EMAIL)){
            //trimmer mail
            $email = trim($_POST['emailCo']);

            //Vérifier qu'un compte existe
            try{
                
                $pdo = new PDO('mysql:host=localhost;dbname=ludotheque','root','root',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
                $request = $pdo->prepare('SELECT m.prenom, m.nom, m.email, m.mot_de_passe FROM membre m WHERE m.email = ?');    
                $request->bindParam(1, $email, PDO::PARAM_STR);          
                $request->execute();        
                $data = $request->fetch(PDO::FETCH_ASSOC);
                if(!empty($data)){
                    // Vérifier si les mots de passe correspondent
                    if(password_verify($_POST['passwordCo'], $data['mot_de_passe'])){
                        // Connecter l'utilisateur 
                        $_SESSION['nom'] = $data['nom'];
                        $_SESSION['prenom'] = $data['prenom'];
                        $_SESSION['email'] = $data['email'];          
                        $messageCo = "{$_SESSION['prenom']} {$_SESSION['nom']} est bien connecté !";

                    }else{
                        $messageCo = "Email et/ou Mot de Passe incorrect.";
                    }

                }else{
                    $messageCo = "Email et/ou Mot de Passe incorrect.";
                }

            }catch(Exception $error){
                die($error->getMessage());
            }
        }else{
            $messageCo = 'Vous devez entrer un email valide';
        }
    }else{
        $messageCo = 'Veuillez remplir tous les champs';
    }
}
include('includes/header.php');
?>
<DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <main>
        <section>
            <h2>Connexion</h2>
            <form action="" method="post">
                <label for="emailCo">Email <input type="text" name="emailCo" id="emailCo"></label>
                <label for="passwordCo">Mot de passe <input type="password" name="passwordCo" id="passwordCo"></label>
                <input type="submit" name="submitCo" value="Se connecter">
            </form>
        </section>

        <p>
            <?php echo htmlspecialchars($messageCo); ?>
        </p>
    </main>
</body>
</html>
<?php
    include('includes/footer.php');
?>