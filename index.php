<?php
    session_start();

    // Nacte tridy
    require_once ('tridy/kalkulacka.php');   
        
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/styl.css" type="text/css">
    </head>
    <body>
        <div class="obal">
            <div class="kalkulacka">
                <h1>
                    Objektová kalkulačka verze 2</h1>
                <form method="post">
                    <div class="zobrazeni">
                        <?php     
                            // Vytvoří novou instanci
                            $kalkulacka = new Kalkulacka();
                            $kalkulacka->vytvorPamet();

                            // Předá vstup s požadovanou operací ke zpracování
                            if(isset($_POST['operace'])) {
                                    $kalkulacka->zpracuj($_POST['vstup'], $_POST['operace']);
                                    $kalkulacka->zobrazPamet();
                            }

                            // Vymaže všechna zadání
                            if(isset($_POST['vymaz'])) {
                                    $kalkulacka->vymazPamet();
                            }
                        ?>
                    </div>
                    <table>    
                        <tr>
                            <td colspan="2">
                                <input class="vstup" type="text"
                                       name="vstup"/></td></tr>
                        <tr>
                            <td>
                                <input class="tlacitko" type="submit"
                                       name="operace" value="+"/></td>
                            <td>
                                <input class="tlacitko" type="submit" 
                                       name="operace" value="-"/></td></tr>
                        <tr>
                            <td>
                                <input class="tlacitko" type="submit"
                                       name="operace" value="*"/></td>
                            <td>
                                <input class="tlacitko" type="submit"
                                       name="operace" value="/"/></td></tr>
                        <tr>
                            <td>
                                <input class="tlacitko" type="submit"
                                       name="operace" value="="/></td>
                            <td>
                                <input class="tlacitko" type="submit"
                                       name="vymaz" value="C"/></td></tr>
                    </table>
                </form>
            </div>
        </div>
        <?php
$string = "(11+10)*3";
$math_string ="print (".$string.");";
$result = eval($math_string);
echo $result;
?>
    </body>
</html>
