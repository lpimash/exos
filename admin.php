<?php
session_start();
if ( ! (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) ) {
    header('HTTP/1.1 302 Redirect');
    header('Location: /login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

    <h1>Site d'admin</h1>

</body>
</html>