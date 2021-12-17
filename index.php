<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TA-TE-TI</title>
    <link rel="stylesheet" href="./css/root.css">
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <main class="card">
        <h1>¡Bienvenido al TA-TE-TI!</h1>
        <div class="game">
            <?php if (!isset($_GET["game"])) {
                $turn = "X";
                $game = array(
                    "0" => "-",
                    "1" => "-",
                    "2" => "-",
                    "3" => "-",
                    "4" => "-",
                    "5" => "-",
                    "6" => "-",
                    "7" => "-",
                    "8" => "-"
                );
                for ($i = 0; $i < 9; $i++) {
                    $url = "";
                    for ($j = 0; $j < 9; $j++) {
                        if ($j == $i) {
                            $url .= $turn;
                        } else {
                            $url .= $game[$j];
                        }
                    }
                    echo "<a href='?turn=$turn&game=$url' class='box'>$game[$i]</a>";
                }
            } else {
                if (isset($_GET["turn"])) {
                    if ($_GET["turn"] == "X") {
                        $turn = "O";
                    } else {
                        $turn = "X";
                    }
                }
                if (isset($_GET["game"])) {
                    $game = $_GET["game"];
                }
                $game = str_split($game);
                for ($i = 0; $i < 9; $i++) {
                    if ($game[$i] == "-") {
                        $url = "";
                        for ($j = 0; $j < 9; $j++) {
                            if ($j == $i && $game[$j] == "-") {
                                $url .= $turn;
                            } else {
                                $url .= $game[$j];
                            }
                        }
                        echo "<a href='?turn=$turn&game=$url' class='box'>$game[$i]</a>";
                    } else {
                        echo "<div class='box'>$game[$i]</div>";
                    }
                }
                if (!strstr($_GET["game"], "-")) { ?>
                    <div class="mensaje">
                        <h2>¡Juego terminado!</h2>
                        <a href="?">Volver a iniciar</a>
                    </div>
                    <?php } else {
                    if ($turn == "X") { ?>
                        <div class="mensaje">
                            <h2>¡Es el turno de X!</h2>
                            <a href="?">Volver a iniciar</a>
                        </div>
                    <?php } else { ?>
                        <div class="mensaje">
                            <h2>¡Es el turno de O!</h2>
                            <a href="?">Volver a iniciar</a>
                        </div>
            <?php }
                }
            }
            ?>

        </div>
        <small>Todos los derechos reservados a Cristian Diego Góngora Pabón</small>
    </main>

</body>

</html>