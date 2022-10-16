<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <link rel="shortcut icon" href="./Assets/Italy.png" type="image/x-icon">
    <title>Controlla CF</title>
</head>
<body>
    <div class="container">
        <form action="/Index.php" method="post">
            <div class="title">
                <img src="./Assets/Italy.png" alt="">
                <h1>Calcola CF</h1>
            </div>
    
            <div class="data">
                <label for="CF">Nome</label>
                <input require type="text" name="Nome" id="Nome">
            </div>
    
            <div class="data">
                <label for="CF">Cognome</label>
                <input require type="text" name="Cognome" id="Cognome">
            </div>
    
            <div class="data">
                <label for="CF">Luogo</label>
                <input require type="text" name="Luogo" id="Luogo">
            </div>
    
            <div class="data">
                <label for="CF">Data di nascita</label>
                <input require type="date" name="born" id="born">
            </div>
    
            <div class="data">
                <label for="CF">Codice Fiscale</label>
                <input require type="text" name="CF" id="CF">
            </div>
            <div class="data">
                <input type="submit" value="Calcola">
            </div>    
        </form>

        <div class="result">
            <?php
            if (isset($_POST["Nome"]) && isset($_POST["Cognome"]) && isset($_POST["Luogo"]) && isset($_POST["born"]) && isset($_POST["CF"])) {
                $Nome = trim(strtoupper($_POST["Nome"]));
                $Cognome = trim(strtoupper($_POST["Cognome"]));
                $Luogo = trim(ucfirst($_POST["Luogo"]));
                $born = $_POST["born"];
                $CF = trim(strtoupper($_POST["CF"]));
                $CF = str_replace(" ", "", $CF);
                $CF = str_replace("À", "A", $CF);
                $cfCreato = "";

                $ConsonantCognome = "";
                $ConsonantNome = "";
                $VocalCognome = "";
                $VocalNome = "";

                if (strlen($CF) !== 16 || $Nome == "" || $Cognome == "" || $Luogo == "" || $born == "") {
                    echo "Ci sono alcuni dati mancanti";

                } else {
                    $Consonant = array("B", "C", "D", "F", "G", "H", "J", "K", "L", "M", "N", "P", "Q", "R", "S", "T", "V", "W", "X", "Y", "Z");
                    $vocali = array("A", "E", "I", "O", "U");

                    for ($i = 0; $i < strlen($Cognome); $i++) {
                        if (in_array($Cognome[$i], $Consonant)) {
                            $ConsonantCognome .= $Cognome[$i];
                        }else if (in_array($Cognome[$i], $vocali)) {
                            $VocalCognome .= $Cognome[$i];
                        }
                    }

                    for ($i = 0; $i < strlen($Nome); $i++) {
                        if (in_array($Nome[$i], $Consonant)) {
                            $ConsonantNome .= $Nome[$i];
                        } else if (in_array($Nome[$i], $vocali)) {
                            $VocalNome .= $Nome[$i];
                        }
                    }



                    if (strlen($ConsonantNome) < 3) {
                         $ConsonantNome .= $VocalNome[0];
                    }

                    $cfCreato .= substr($ConsonantCognome, 0, 3);
                    $cfCreato .= substr($ConsonantNome, 0, 3);
                    $cfCreato .= substr($born, 2, 2);

                    if (substr($born, 5, 2) == "01") {
                        $cfCreato .= "A";
                    } elseif (substr($born, 5, 2) == "02") {
                        $cfCreato .= "B";
                    } elseif (substr($born, 5, 2) == "03") {
                        $cfCreato .= "C";
                    } elseif (substr($born, 5, 2) == "04") {
                        $cfCreato .= "D";
                    } elseif (substr($born, 5, 2) == "05") {
                        $cfCreato .= "E";
                    } elseif (substr($born, 5, 2) == "06") {
                        $cfCreato .= "H";
                    } elseif (substr($born, 5, 2) == "07") {
                        $cfCreato .= "L";
                    } elseif (substr($born, 5, 2) == "08") {
                        $cfCreato .= "M";
                    } elseif (substr($born, 5, 2) == "09") {
                        $cfCreato .= "P";
                    } elseif (substr($born, 5, 2) == "10") {
                        $cfCreato .= "R";
                    } elseif (substr($born, 5, 2) == "11") {
                        $cfCreato .= "S";
                    } elseif (substr($born, 5, 2) == "12") {
                        $cfCreato .= "T";
                    }
                    $cfCreato .= substr($born, 8, 2);

                    $row = 1;
                    if (($handle = fopen("CodiciCatastali.csv", "r")) !== FALSE) {
                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            $num = count($data);
                            $row++;
                            for ($c=0; $c < $num; $c++) {
                                
                                $dataParsed = substr($data[$c], 0, -6);
                                $placeData = explode(";", $dataParsed);
                                if ($placeData[0] == $Luogo) {
                                    $cfCreato .= $placeData[2];
                                }

                            }
                        }
                        fclose($handle);
                    }

                    $lettere = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
                    $valorePari = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
                    $valoreDispari = ["1", "0", "5", "7", "9", "13", "15", "17", "19", "21", "2", "4", "18", "20", "11", "3", "6", "8", "12", "14", "16", "10", "22", "25", "24", "23"];
                    $somma = 0;
                    
                    for ($i = 0; $i < strlen($cfCreato); $i++) {
                        if ($i % 2 == 0) {
                            $posizione = in_array($cfCreato[$i], $lettere);
                            $somma += $valorePari[$posizione];
                        } else {
                            $posizione = in_array($cfCreato[$i], $lettere);
                            $somma += $valoreDispari[$posizione];
                        }
                    }
                    $somma = $somma % 26;
                    $somma = $lettere[$somma];
                    $cfCreato .= $somma;
                    echo $cfCreato; 

                    if ($cfCreato == $CF) {
                        echo "Il codice fiscale è corretto";
                    } else {
                        echo "Il codice fiscale è errato";
                    }


                }
            }
            
        ?>
        </div>
    </div>
    
</body>
</html>