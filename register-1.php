<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $erreur_dans_formulaire = false;
    $msg_erreur = "";

    try {
      $db = new PDO('mysql:host=127.0.0.1;dbname=c9;port=3306;charset=utf8', 'o_revollat', '');
    } catch (PDOException $e) { // Gérer le erreur de connexion avec un message bien présenté et eviter la divulgation d'informations sensibles
        echo "Connexion à la base de donnée échouée"; exit;
    }

    // Validations
    
    $email = filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL);
    if (!$email){
        $erreur_dans_formulaire = true;
        $msg_erreur .= "<br>Erreur dans l'adresse mail.";
    }

    $password = filter_var($_POST['password']);
    if (!$password || mb_strlen($password) < 8){
        $erreur_dans_formulaire = true;
        $msg_erreur .= "<br>Le mot de passe doit faire plus de 8 caractères.";
    }
    
    // Si formulaire valide (pas d'erreurs) alors on enregistre l'utilisateur en BDD
    
    if(!$erreur_dans_formulaire){

        // insertion de l'utilisateur en BDD
        $stmt = $db->prepare("INSERT INTO utilisateur (nom, prenom, mail, password) VALUES (:nom, :prenom, :mail, :password)");
        $stmt->bindParam(':nom', $_POST['nom']);
        $stmt->bindParam(':prenom', $_POST['prenom']);
        $stmt->bindParam(':mail', $email);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
        $stmt->execute();
    
        // Renvoi vers la page de login
        header('HTTP/1.1 302 Redirect');
        header('Location: /login.php');        
        
    }

}

?>

<?php if($erreur_dans_formulaire): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $msg_erreur ?>
    </div>
<?php endif; ?>

<form method=post>
    
  <div class="form-group">
    <label for="prenom">Prenom</label>
    <input type="text" class="form-control" value="<?php if(isset($_POST['prenom'])) echo $_POST['prenom'] ?>" id="prenom" name="prenom" placeholder="">
  </div>
  
  <div class="form-group">
    <label for="nom">Nom</label>
    <input type="text" class="form-control" value="<?php if(isset($_POST['nom'])) echo $_POST['nom'] ?>"  id="nom" name="nom" placeholder="">
  </div>
  
  <div class="form-group">
    <label for="mail">Mail</label>
    <input type="email" class="form-control" value="<?php if(isset($_POST['mail'])) echo $_POST['mail'] ?>"  id="mail" name="mail" placeholder="Ex. moi@example.org">
  </div>
  
  <div class="form-group">
    <label for="password">Mot de passe</label>
    <input type="password" class="form-control" value=""  id="password" name="password" placeholder="Au moins 8 caractères">
  </div>
  
  <button type="submit" class="btn btn-default">Créer un compte</button>
  
</form>

</body>
</html>