<?php
session_start();
include './layout/head.php';
require './db.php';
// Verificar que esten los nombres de los jugadores en sesion
if (isset($_SESSION["player1"]) && isset($_SESSION["player2"])) {
    // Tomar los nombres de los jugadores
    $player1 = $_SESSION["player1"];
    $player2 = $_SESSION["player2"];
} else {
    // Redireccionar a la página de login
    header("Location: index.php?error=Debes ingresar los nombres de los jugadores");
}

$game = [];
$winner = "";

if (isset($_GET['game'])) {
    // Convertir cada caracter del string a un array
    $game = str_split($_GET['game']);

    // Verificar si hay un ganador al tic tac toe o si hay un empate sin tomar en cuenta los guiónes

    // Verificar si hay un ganador en filas
    for ($i = 0; $i < 3; $i++) {
        if ($game[$i * 3] == $game[$i * 3 + 1] && $game[$i * 3 + 1] == $game[$i * 3 + 2]) {
            if ($game[$i * 3] == "X") {
                $winner = $player1;
            } else if ($game[$i * 3] == "O") {
                $winner = $player2;
            }
        }
    }

    // Verificar si hay un ganador en columnas
    for ($i = 0; $i < 3; $i++) {
        if ($game[$i] == $game[$i + 3] && $game[$i + 3] == $game[$i + 6]) {
            if ($game[$i] == "X") {
                $winner = $player1;
            } else if ($game[$i] == "O") {
                $winner = $player2;
            }
        }
    }

    // Verificar si hay un ganador en diagonales
    if ($game[0] == $game[4] && $game[4] == $game[8]) {
        if ($game[0] == "X") {
            $winner = $player1;
        } else if ($game[0] == "O") {
            $winner = $player2;
        }
    }

    if ($game[2] == $game[4] && $game[4] == $game[6]) {
        if ($game[2] == "X") {
            $winner = $player1;
        } else if ($game[2] == "O") {
            $winner = $player2;
        }
    }

    // Verificar si hay un empate verificando que no haya ningun guión
    if ($winner == "") {
        if (!strstr($_GET["game"], "-")) {
            $winner = "Empate";
        }
    }

    //Guardar partida finalizada en la base de datos
    if ($winner != "") {
        $db->exec("INSERT INTO games (player1, player2, game, winner) VALUES ('$player1', '$player2', '$_GET[game]', '$winner')");
    }
} else {
    // Inicializar el juego con 9 guiones
    $game = array_fill(0, 9, '-');
}

if (isset($_GET['turn'])) {
    if ($_GET['turn'] == $player1) {
        $turn = $player2;
    } else {
        $turn = $player1;
    }
} else {
    $turn = $player1;
}
?>

<body>
    <main class="card">
        <h1>
            <?php
            if ($winner == "" && !isset($_GET['game'])) {
                echo "¡Empieza " . $player1 . "!";
            } else if ($winner == "") {
                echo " ¡Turno de " . $turn . "!";
            } else {
                echo "¡Felicidades " . $winner . "! ¡Has ganado!";
            }
            ?>
        </h1>
        <div class="game">
            <?php
            for ($i = 0; $i < 9; $i++) {
                if ($game[$i] == "-" && $winner == "") {
            ?>

                    <a href="game.php?game=<?php
                                            $newGame = $game;
                                            if ($turn == $player1) {
                                                $newGame[$i] = "X";
                                            } else {
                                                $newGame[$i] = "O";
                                            }
                                            echo implode($newGame) . "&turn=" . $turn;
                                            ?>" class='box'>
                        <?php echo $game[$i]; ?>
                    </a>

                <?php
                } else { ?>
                    <div class='box'>
                        <?php echo $game[$i]; ?>
                    </div>
            <?php
                }
            } ?>



        </div>

        <div class="botonera">
            <a class="button" href="index.php">Inicio</a>
            <a class="button" href="historial.php">Historial</a>
        </div>

        <small>Todos los derechos reservados a Cristian Diego Góngora Pabón</small>
    </main>

</body>

</html>