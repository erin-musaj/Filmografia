<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>

<body>
    <form action="filterByFilm.php" method="POST" onsubmit="confirmSubmit()">
        <label for="nome">Nome film</label>
        <br>
        <input type="text" id="nome" name="nome">
        <br>
        <br>
        <button type="submit">invia</button>
        </select>
    </form>

    <?php
    require "connection.php";
    $nome = $_POST["nome"];
    $result = $connection->prepare("SELECT attori.* FROM attori INNER JOIN recitare ON attori.id_attore=recitare.id_attore INNER JOIN film ON recitare.id_film=film.id_film WHERE film.nome=:nome;");
    $result->execute(array(":nome" => $nome));
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
    ?>
</body>

</html>