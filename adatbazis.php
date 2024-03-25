<?php
class adatbazis{
    private $host = "localhost";
    private $felhasznaloNev = "root";
    private $jelszo = "";
    private $adatbazisNev = "magyarkartya";
    private $kapcsolat;

    //konstruktor
    public function __construct()
    {
        //kapcsolat beálítása
        $this->kapcsolat = new mysqli(
            $this->host,
            $this->felhasznaloNev,
            $this->jelszo,
            $this->adatbazisNev,
        );
        $szoveg = "";
        if ($this->kapcsolat->connect_error) {
            $szoveg = "Sikertelen";
        }else{
            $szoveg = "Sikeres";
        }
        $this->kapcsolat->query('SET NAMES UTF8');
        $this->kapcsolat->query('SET CHARACTER SET UTF8');
        echo $szoveg;
    }
    public function adatleker($oszlop,$tabla){
        $sql = "SELECT $oszlop from $tabla";
        $adatok = $this->kapcsolat->query($sql);
        if ($adatok){
            echo "Sikeres beolvasás";
        }else{
            echo "Sikertelen beolvasás";
        }
        return $adatok;
    }
    public function adatleker2($melyik1,$melyik2,$tabla){
        $sql = "SELECT $melyik1, $melyik2 from $tabla ORDER BY $melyik1";
        return $this->kapcsolat->query($sql);
    }
    
    public function megvalosit($eredmeny){
        while ($sor = $eredmeny->fetch_row()){
            echo "<img src=\"forras/$sor[0]\" alt=\"$sor[0]\">";
        }
        echo "<br>";
    }

    
    public function megvalositAsszoc($eredmeny,$melyik1,$melyik2){
        while ($row = $eredmeny->fetch_assoc()) {
            echo "1.oszlop $row[$melyik1] - 2.oszlop: $row[$melyik2] <br>";
        }
    }
    public function azonMind($tabla){
        $result = $this->kapcsolat->query("SELECT * FROM $tabla");
        return $result->num_rows;
    }

    public function kapcsolatBezar(){
        $this->kapcsolat->close();
    }
    public function kartyaFeltolt($tabla){
        $countSzin = $this->azonMind('szin')+1;
        $countForma = $this->azonMind('forma')+1;

        for ($iSzin=1; $iSzin < $countSzin; $iSzin++) { 
            for ($iForma=1; $iForma <$countForma ; $iForma++) { 
                $sql = "INSERT INTO $tabla (szinAzon, formaAzon) VALUES ($iSzin, $iForma);";
                $this->kapcsolat->query($sql);
            }
        }
    } 



}
?>