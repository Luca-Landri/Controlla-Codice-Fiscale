<?php
        $Nome = strtoupper($_POST["Nome"]);
        $Cognome = strtoupper($_POST["Cognome"]);
        $Luogo = ucfirst($_POST["Luogo"]);
        $born = $_POST["born"];
        $CF = $_POST["CF"];
        $CF = strtoupper($CF);
        $CF = str_replace(" ", "", $CF);
        $CF = str_replace("À", "A", $CF);

        $ConsonantCognome = "";
        $ConsonantNome = "";

        if (strlen($CF) !== 16 || $Nome == "" || $Cognome == "" || $Luogo == "" || $born == "") {
            echo "Ci sono alcuni dati mancanti";

        } else {
            $Consonant = array("B", "C", "D", "F", "G", "H", "J", "K", "L", "M", "N", "P", "Q", "R", "S", "T", "V", "W", "X", "Y", "Z");
            
            for ($i = 0; $i < strlen($Cognome); $i++) {
                if (in_array($Cognome[$i], $Consonant)) {
                    $ConsonantCognome .= $Cognome[$i];
                }
            }

            for ($i = 0; $i < strlen($Nome); $i++) {
                if (in_array($Nome[$i], $Consonant)) {
                    $ConsonantNome .= $Nome[$i];
                }
            }

            echo substr($ConsonantCognome, 0, 3);
            echo $ConsonantNome;
            echo substr($born, 2, 2);

            if (substr($born, 5, 2) == "01") {
                echo "A";
            } elseif (substr($born, 5, 2) == "02") {
                echo "B";
            } elseif (substr($born, 5, 2) == "03") {
                echo "C";
            } elseif (substr($born, 5, 2) == "04") {
                echo "D";
            } elseif (substr($born, 5, 2) == "05") {
                echo "E";
            } elseif (substr($born, 5, 2) == "06") {
                echo "H";
            } elseif (substr($born, 5, 2) == "07") {
                echo "L";
            } elseif (substr($born, 5, 2) == "08") {
                echo "M";
            } elseif (substr($born, 5, 2) == "09") {
                echo "P";
            } elseif (substr($born, 5, 2) == "10") {
                echo "R";
            } elseif (substr($born, 5, 2) == "11") {
                echo "S";
            } elseif (substr($born, 5, 2) == "12") {
                echo "T";
            }
            echo substr($born, 8, 2);

            $row = 1;
            if (($handle = fopen("CodiciCatastali.csv", "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $num = count($data);
                    $row++;
                    for ($c=0; $c < $num; $c++) {
                        $dataParsed = substr($data[$c], 0, -6);
                        $placeData = explode(";", $dataParsed);
                        if ($placeData[0] == $Luogo) {
                            echo $placeData[2];
                        }

                    }
                }
                fclose($handle);
            }


        }

    
    ?>