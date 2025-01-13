<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>

<table>
<?php
    require "connection.php";
    $queries = array(
        "SELECT * FROM attori",
        "SELECT film.*, generi.nome AS genere FROM film LEFT JOIN generi ON film.id_genere=generi.id_genere"
    );
    foreach($queries as $value){
        $result = $connection->prepare($value);
        $result->execute();
        echo "<table>";
        $numColumns = $result->columnCount();
        for ($col = 0; $col < $numColumns; $col++) {
            $columnMeta = $result->getColumnMeta($col);
            echo "<th>" . $columnMeta['name'] . "</th>";
        }
        echo"</tr>";

        while($row = $result->fetch(mode: PDO::FETCH_ASSOC)) {
            echo "<tr>";
            foreach ($row as $value){
                echo "<td>". $value ."</td>";
            }
            echo "</tr>";
        }
        echo "</table><br><br>";
    }
?>
</body>
</html>