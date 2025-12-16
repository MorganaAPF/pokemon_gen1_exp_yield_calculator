<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php
        // Conectando ao banco de dados
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'pokemon';
        $conection = mysqli_connect($host, $username, $password, $database);

        // Coletando os dados do formulário preenchido pelo usuário
        $pokemon = $_GET["enemy_pokemon"];
        $level = (integer) $_GET["level"];
        $split = (integer) $_GET["split"];
        $battle = (double) $_GET["battle"];
        $trade = 1; // Ainda não personalizado

        // Coletando o rendimento de experiência base do Pokémon especificado pelo usuário
        $stmt = mysqli_prepare($conection, "SELECT base_exp_yield FROM pokedex WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $pokemon);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $array = mysqli_fetch_assoc($result);
        $yield = $array["base_exp_yield"];
    ?>
    <div id="php1">
        <div id="halfbutton1"></div>
        <?php 
            // Fazendo o cálculo e mostrando o resultado
            $exp_float = (($yield * $level) / 7) * (1 / $split) * $battle * $trade;
            $exp = floor($exp_float);
            echo "<p>$exp experience points will be received by each Pokémon.</p>";
            mysqli_stmt_close($stmt);
            mysqli_close($conection);
        ?>
    </div>
    <div id="php2">
        <a href="javascript:history.go(-1)">Previous page</a>
    </div>
        <div id="halfbutton2"></div>
</body>
</html>
