<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<?php 

try{

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
      /* On récupère en BDD l'utilisateur correspondant à l'adresse mail saisie */
      $db = new PDO('mysql:host=127.0.0.1;dbname=c9;port=3306;charset=utf8', 'o_revollat', '');
      $statement = $db->prepare('SELECT password FROM utilisateur WHERE mail = :email');
      $statement->bindValue(':email', $_POST['mail']);
      $statement->execute();
      $user = $statement->fetch();
  
      if (password_verify($_POST['password'], $user['password']) === false) {
          throw new Exception('Mot de passe non valide !');
      }
      
      // Save login status to session
      $_SESSION['user_logged_in'] = true;
      $_SESSION['user_email'] = $email;
      
      // Redirect to profile page
      header('HTTP/1.1 302 Redirect');
      header('Location: /admin.php');
      
  }
  
} catch (Exception $e) {
  
  header('HTTP/1.1 401 Unauthorized');
  echo $e->getMessage();
  
}

?>

<form method=post>
    
  <div class="form-group">
    <label for="mail">Mail</label>
    <input type="email" class="form-control" value="<?php if(isset($_POST['mail'])) echo $_POST['mail'] ?>" id="mail" name="mail" placeholder="">
  </div>
  
  <div class="form-group">
    <label for="password">Mot de passe</label>
    <input type="password" class="form-control" value="" id="password" name="password" placeholder="">
  </div>
  
  <button type="submit" class="btn btn-default">Se connecter</button>
  
</form>

</body>
</html>