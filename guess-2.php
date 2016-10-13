<html>
<body>
<?php
session_start();

// Initialize un nombre aléatoire entre 1 et 100 en session pour jouer
if (!isset($_SESSION['nombre_a_trouver'])) {
    $_SESSION['nombre_a_trouver'] = rand (1,100) ;
}

//echo "Nombre : " . $_SESSION['nombre_a_trouver'];

if ( isset($_POST['proposition']) ) {
    $proposition = (int) $_POST['proposition'];
    $gagne = $proposition === $_SESSION['nombre_a_trouver'];
    $message = $proposition < $_SESSION['nombre_a_trouver'] ? "Trop petit" : "Trop grand";
}
?>


<?php if( isset($gagne) && !$gagne ): ?>
    <font size="6">&#x1f63f; <?php echo $message; ?> ... Essayes encore ...</font>
<?php elseif( isset($gagne) && $gagne ): ?>
    <font size="6">&#x1f63a; Bazinga !!!</font>  
    <?php unset($_SESSION['nombre_a_trouver']); ?>
<?php endif; ?>


<form method="POST">
    <input type="text" name="proposition" />
    <input type="submit" value="Tenter ma chance !" />
</form>

</body>
</html>