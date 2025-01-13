<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<script>
        function confirmSubmit(){
            return confirm("sei sicuro?")
        }
</script>
        <form action="insert.php" method="POST" onsubmit="confirmSubmit()">
            <label for="nome">nome</label>
            <br>
            <input type="text" id="nome" name="nome">
            <br>
            <br>
            <label for="cognome">cognome</label>
            <br>
            <input type="text" id="cognome" name="cognome">
            <br>
            <br>
            <label for="data">data di nascita</label>
            <br>
            <input type="date" id="data" name="data">
            <button type="submit" >invia</button>
            </select>
        </form>
<?php
    if(isset($_POST["nome"]) && isset($_POST["cognome"])){
        require "connection.php";
        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $data = $_POST["data"];
        $result = $connection->prepare("INSERT INTO attori (nome, cognome, data_nascita) VALUES (:nome, :cognome, :datan);");
        $result->execute(array(':nome' => $nome, ':cognome' => $cognome, ':datan' => $data));
        echo "inserimento effettuato";
    }
?>
</body>
</html>