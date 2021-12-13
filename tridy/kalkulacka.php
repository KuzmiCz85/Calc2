<?php

class Kalkulacka

{
    // Vytvori pole pro ukladani zadani do pameti
    public function vytvorPamet()    
    {
        if(!isset($_SESSION['pamet'])) {
            $_SESSION['pamet'] = [];
            echo('0');
        }
    }
    
    // Prevadi pamet z pole na textovy retezec
    private function pametNaText()
    {
        $pamet = $_SESSION['pamet'];
        $pametNaText = implode($pamet);
        return $pametNaText;
    }
    
    // Prevadi desetinnou carku na tecku
    private function carkaNaTecku($carka)
    {
        $carkaNaTecku = str_replace(',', '.', $carka);
        return $carkaNaTecku;
    }
    
    // Zpracovava zadani a uklada ho do pameti dokud se vypocet neuzavre
    public function zpracuj($vstup, $operace)
    {           
        $upravenyVstup = $this->carkaNaTecku($vstup);
        
        // Pokud je zadana hodnota spravna, ulozi se do pameti a aplikace
        // prejde k vyhodnoceni pozadovane operace
        if(is_numeric($upravenyVstup)) {
            $_SESSION['pamet'][] = $upravenyVstup;

            // Overi zda neprisel pozadavek na uzavreni vypoctu
            if($operace == '=') {
                
                // Prevede textovy retezec na matematicky vzorec
                $vzorecText = $this->pametNaText();
                $vzorec = "print($vzorecText);";
                
                // Kontrola deleni nulou
                if(!str_contains($vzorec, ' / 0')) {
                    
                    // Vypise zadany priklad
                    $this->zobrazPamet();
                    echo (' = ');
                    
                    // Spocita vzorec a prida do prikladu vysledek
                    $vypocet = eval($vzorec);
                    echo($vypocet);
                }
                
                else {
                    echo('Nelze dělit nulou!');
                }
                
                $_SESSION['pamet'] = [];
            }                
            
            // Ulozi operaci do pameti
            else {            
            $_SESSION['pamet'][] = ' ' . $operace . ' ';
            }
        }
        // špatně zadaný vstup. Zobrazí chybové hlášení.
        else {            
            echo('Chybný vstup');
        }
    }
    
    // Zobrazí uživateli obsah paměti
    public function zobrazPamet()
    {
        echo($this->pametNatext());
    }
    
    // Vymaze pamet
    public function vymazPamet()
    {
        session_destroy();
        header('Location: index.php');
        exit();
    } 
}
