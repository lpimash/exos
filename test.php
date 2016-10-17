<?php
// Nombres premiers entre 3 et 100

for ($i = 3; $i <= 100; $i++) {
    
    if($i % 2 == 0) continue; // Le nombre est pair donc pas premier (sauf 2)
    
    $isPrime = true;
    for ($j = 3; $j < $i; $j++){
        if( ($i % $j) == 0){
            $isPrime = false;
            break;
        } 
    }
    
    if($isPrime) echo $i . "<br>";
    
}