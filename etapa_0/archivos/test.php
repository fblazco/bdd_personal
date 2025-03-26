<?php 
function confirm_rut($numero, $dv){
    /**
     * Confirmar Rut
     * Consideraciones:
     * Funcion para confirmar si un numero es rut o no
     * Documentacion:
     * https://www.php.net/manual/es/function.str-split.php
     * https://www.php.net/manual/es/function.strtoupper.php 
     * https://www.php.net/manual/es/function.count.php
     */
   
    $multiplicadores = [2, 3, 4, 5, 6, 7, 2, 3, 4, 5, 6, 7];
    $digitos = str_split(strrev($numero));
    $suma = 0;
    for ($i = 0; $i < count($digitos); $i++) {
        $suma += $digitos[$i] * $multiplicadores[$i];
    }
    $residuo = $suma % 11;
    $dv_calculado = 11 - $residuo;
    if ($dv_calculado == 11) {
        $dv_calculado = 0;
    } elseif ($dv_calculado == 10) {
        $dv_calculado = 'K';
    }
    if (strtoupper($dv) == strtoupper($dv_calculado)) {
        echo "true\n";
        return TRUE; 
    } else {
        echo "false\n";
        return FALSE;
    }
    
}
echo confirm_rut(544962,6);
?>