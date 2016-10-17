<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<?php 
try {
    // Get email address from request body
    $email = filter_input(INPUT_POST, 'email');
    // Get password from request body
    $password = filter_input(INPUT_POST, 'password');
    
    // Find account with email address (THIS IS PSUEDO-CODE)
    //$user = User::findByEmail($email);
    
    // Verify password with account password hash
    if (password_verify($password, $user->password_hash) === false) {
        throw new Exception('Invalid password');
    }
    
    
    // Save login status to session
    $_SESSION['user_logged_in'] = true;
    $_SESSION['user_email'] = $email;
    // Redirect to profile page
    header('HTTP/1.1 302 Redirect');
    header('Location: /admin.php');
} catch (Exception $e) {
    header('HTTP/1.1 401 Unauthorized');
    echo $e->getMessage();
}
?>

<form method=post>
    
  <div class="form-group">
    <label for="mail">Mail</label>
    <input type="text" class="form-control" value="<?php if(isset($_POST['mail'])) echo $_POST['mail'] ?>" id="mail" name="mail" placeholder="">
  </div>
  
  <div class="form-group">
    <label for="password">Mot de passe</label>
    <input type="password" class="form-control" value=""  id="password" name="password" placeholder="Au moins 8 caractères">
  </div>
  
  <button type="submit" class="btn btn-default">Créer un compte</button>
  
</form>