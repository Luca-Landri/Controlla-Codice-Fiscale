<?php

function getConsonant($Cognome) {
    $Consonant = array("B", "C", "D", "F", "G", "H", "J", "K", "L", "M", "N", "P", "Q", "R", "S", "T", "V", "W", "X", "Y", "Z");
    $vocali = array("A", "E", "I", "O", "U");
    $ConsonantCognome = "";
    $VocalCognome = "";

    for ($i = 0; $i < strlen($Cognome); $i++) {
        if (in_array($Cognome[$i], $Consonant)) {
            $ConsonantCognome .= $Cognome[$i];
        } else if (in_array($Cognome[$i], $vocali)) {
            $VocalCognome .= $Cognome[$i];
        }
    }

    
}
?>