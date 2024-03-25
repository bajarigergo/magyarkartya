<?php
    include_once "adatbazis.php";
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bajári Gergő</title>
</head>
<body>
    <?php
        $adatbazis = new adatbazis();
        //megjelenítjük a szin tábla képeit
        $eredmeny = $adatbazis->adatleker("kep", "szin");

        $adatbazis->megvalosit($eredmeny);

        $eredmeny = $adatbazis->adatleker2("ertek", "szoveg", "forma");

        $adatbazis->megvalositAsszoc($eredmeny,"ertek","szoveg");

        if ($adatbazis->azonMind("kartya")<1){
        $adatbazis->kartyaFeltolt("kartya");}

        $adatbazis->kapcsolatBezar();

    ?>
</body>
</html>