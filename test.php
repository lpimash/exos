<p>
<?php
$email = 'john@exa/\mpl e.com';
$isEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
var_dump($isEmail);

$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$isEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
var_dump($isEmail);
?>
</p>