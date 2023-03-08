<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h4>Lista</h4>
    <ul>
        <li>wielkopolska
          <ol>
                <li>Poznan</li>
                <li>Gniezno</li>
                <li>Witkowo</li>
                <li>Skorzęcin</li>
          </ol>
        </li> 
        <li>śląskie</li>
          <?php
            $city = 'Wroclaw';
            echo "<ol>";
                echo "<li>Legnica</li>";
                echo "<li>$city</li>";
            //echo "</ol>";
          ?>
          <li>Boleslawiec</li>
          </ol>
        </li>
        <li>kujawsko-pomorskie</li>
    <ul>
</body>
</html>