<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcola CF</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="containerCalc">
        <form action="/Calcola.php" method="post">
            <div class="header">
                <div class="title">
                    <img src="./Assets/Italy.png" alt="logo italia 🗿">
                    <h1>Calcola CF</h1>
                </div>
                <div>
                    <h4>O</h4>
                </div>
                <button><a href="./index.php">CONTROLLANE UNO</a></button>
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
                <div class="row">
                    <div class="col">
                        <label for="CF">Data di nascita</label>
                        <input require type="date" name="born" id="born">
                    </div>
                    <div class="col">
                        <label for="Sesso">Sesso</label>
                        <select name="Sesso" id="Sesso">
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="button">
                <input class="calcola" type="submit" value="CONTROLLA">
            </div>    
        </form>
        <div class="result">
            <?php
            if (isset($_POST["Nome"]) && isset($_POST["Cognome"]) && isset($_POST["Luogo"]) && isset($_POST["born"])) {
                $Nome = trim(strtoupper($_POST["Nome"]));
                $Nome = str_replace(" ", "", $Nome);
                $Nome = str_replace("À", "A", $Nome);
                $Nome = str_replace("È", "E", $Nome);
                $Nome = str_replace("Ì", "I", $Nome);
                $Nome = str_replace("Ò", "O", $Nome);
                $Nome = str_replace("Ù", "U", $Nome);

                $Cognome = trim(strtoupper($_POST["Cognome"]));
                $Cognome = str_replace(" ", "", $Cognome);
                $Cognome = str_replace("À", "A", $Cognome);
                $Cognome = str_replace("È", "E", $Cognome);
                $Cognome = str_replace("Ì", "I", $Cognome);
                $Cognome = str_replace("Ò", "O", $Cognome);
                $Cognome = str_replace("Ù", "U", $Cognome);

                $Luogo = trim(strtolower($_POST["Luogo"]));
                $Luogo = ucfirst($Luogo);

                $born = $_POST["born"];
                if ( $born > date("Y-m-d") ) {
                    echo "Data di nascita non valida";
                } else {
                    $born = date("d/m/Y", strtotime($born));
                    $cfCreato = "";
                    $sesso = $_POST["Sesso"];

                    $ConsonantCognome = "";
                    $ConsonantNome = "";
                    $VocalCognome = "";
                    $VocalNome = "";

                    if ($Nome == "" || $Cognome == "" || $Luogo == "" || $born == "" || $sesso == "") {
                        echo "<div class='errato'>Ci sono alcuni dati mancanti!</div>";

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

                        $cfCreato .= substr($ConsonantCognome, 0, 3);

                        if (strlen($ConsonantNome) == 3) {
                            $cfCreato .= substr($ConsonantNome, 0, 3);
                        } else if (strlen($ConsonantNome) == 2) {
                            $cfCreato .= $VocalNome[0];
                        } else if (strlen($ConsonantNome) == 1) {
                            $cfCreato .= $VocalNome[0] . $VocalNome[1];
                        } else if (strlen($ConsonantNome) == 0) {
                            $cfCreato .= $VocalNome[0] . $VocalNome[1] . $VocalNome[2];
                        } else if (strlen($ConsonantNome) > 3) {
                            $cfCreato .= $ConsonantNome[0]. $ConsonantNome[2]. $ConsonantNome[3];
                        }
                        $cfCreato .= substr($born, 8, 2);

                        if (substr($born, 5, 2) == "01") {
                            $cfCreato .= "A";
                        } elseif (substr($born, 3, 2) == "02") {
                            $cfCreato .= "B";
                        } elseif (substr($born, 3, 2) == "03") {
                            $cfCreato .= "C";
                        } elseif (substr($born, 3, 2) == "04") {
                            $cfCreato .= "D";
                        } elseif (substr($born, 3, 2) == "05") {
                            $cfCreato .= "E";
                        } elseif (substr($born, 3, 2) == "06") {
                            $cfCreato .= "H";
                        } elseif (substr($born, 3, 2) == "07") {
                            $cfCreato .= "L";
                        } elseif (substr($born, 3, 2) == "08") {
                            $cfCreato .= "M";
                        } elseif (substr($born, 3, 2) == "09") {
                            $cfCreato .= "P";
                        } elseif (substr($born, 3, 2) == "10") {
                            $cfCreato .= "R";
                        } elseif (substr($born, 3, 2) == "11") {
                            $cfCreato .= "S";
                        } elseif (substr($born, 3, 2) == "12") {
                            $cfCreato .= "T";
                        }
                        if ($sesso == "M") {
                            $cfCreato .= substr($born, 0, 2);
                        } else {
                            $int_val = intval(substr($born, 0, 2)) + 40;
                            $cfCreato .= $int_val;
                        }

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

                        $somma=0;

                        $lettere = ['A', 'B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','0','1','2','3','4','5','6','7','8','9'];
                        $valorePari = [1,0,5,7,9,13,15,17,19,21,2,4,18,20,11,3,6,8,12,14,16,10,22,25,24,23,1,0,5,7,9,13,15,17,19,21];
                        $valoreDispari = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,0,1,2,3,4,5,6,7,8,9];
                        $somma = 0;
                        
                        for ($i = 0; $i < strlen($cfCreato); $i++) {
                            if ($i % 2 == 0) {
                                $posizione = array_search($cfCreato[$i], $lettere);
                                $somma += $valorePari[$posizione];
                            } else {
                                $posizione = array_search($cfCreato[$i], $lettere);
                                $somma += $valoreDispari[$posizione];
                            }
                            
                        }
                        $resto = $somma % 26;


                        $cfCreato .= $lettere[$resto];
                        echo $cfCreato;


                    }
                }
                
                
            }
            
        ?>
        </div>

    </div>
</body>
</html>