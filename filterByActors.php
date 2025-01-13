<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>

<body>
    <form action="filterByActors.php" method="POST" onsubmit="confirmSubmit()">
        <label for="nome">Nome attore</label>
        <br>
        <input type="text" id="nome" name="nome">
        <br>
        <br>
        <label for="cognome">Cognome attores</label>
        <br>
        <input type="text" id="cognome" name="cognome">
        <button type="submit">invia</button>
        </select>
    </form>

    <?php
    if(isset($_POST["nome"]) && isset($_POST["cognome"])){
        require "connection.php";
        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $result = $connection->prepare("SELECT film.* FROM film INNER JOIN recitare ON film.id_film=recitare.id_film INNER JOIN attori ON recitare.id_attore=attori.id_attore WHERE attori.nome=:nome AND attori.cognome=:cognome;");
        $result->execute(array(":nome" => $nome, ":cognome" => $cognome));
        echo "<table>";
        $numColumns = $result->columnCount();
        for ($col = 0; $col < $numColumns; $col++) {
            $columnMeta = $result->getColumnMeta($col);
            echo "<th>" . $columnMeta['name'] . "</th>";
        }
        echo "</tr>";

        while ($row = $result->fetch(mode: PDO::FETCH_ASSOC)) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . $value . "</td>";
            }
            echo "</tr>";
        }
        echo "</table><br><br>";
    }
    ?>
</body>

</html>