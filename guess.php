<html>
<body>
<?php
session_start();

// Initialize un nombre aléatoire entre 1 et 100 en session pour jouer
if (!isset($_SESSION['nombre_a_trouver'])) {
    $_SESSION['nombre_a_trouver'] = rand (1,100) ;
}
echo "Nombre : " . $_SESSION['nombre_a_trouver'];
?>

<br><br>
<input type="text" />

</body>
</html>