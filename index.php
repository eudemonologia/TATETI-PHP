<?php
session_start();

// Verificar que se haya completado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tomar los nombres de los jugadores
    $player1 = ucwords(strtolower($_POST["player1"]));
    $player2 = ucwords(strtolower($_POST["player2"]));
    // Verificar que los nombres de los jugadores no esten vacios
    if ($player1 == "" || $player2 == "") {
        header("Location: index.php?error=Debes ingresar los nombres de los jugadores.");

        // Verificar que los nombres de los jugadores no sean iguales
    } else if ($player1 == $player2) {
        header("Location: index.php?error=Los nombres de los jugadores no pueden ser iguales.");

        // Verificar que los nombres no superan los 10 caracteres
    } else if (strlen($player1) > 10 || strlen($player2) > 10) {
        header("Location: index.php?error=Los nombres de los jugadores no pueden superar los 10 caracteres.");

        // Guardar los nombres de los jugadores en sesion
    } else {
        $_SESSION["player1"] = $player1;
        $_SESSION["player2"] = $player2;
        // Redireccionar a la página de juego
        header("Location: game.php");
    }
} else {
    // Destruir la sesion en caso de que no se esté utilizando el formulario
    session_destroy();
}

include './layout/head.php';
?>

<body>
    <main class="card">
        <h1>¡Bienvenido al <span class="nowrap-text">TA-TE-TI!</span></h1>
        <?php if (isset($_GET["error"])) {
            echo "<p class='error'> " . $_GET["error"] . "</p>";
        } ?>
        <form action="" method="POST" class="form">
            <!-- Tomar el nombre del primer y segundo jugador -->
            <div class="input">
                <label for="player1">Nombre del primer jugador</label>
                <input type="text" id="player1" name="player1" placeholder="Nombre del primer jugador" required>
            </div>
            <div class="input">
                <label for="player2">Nombre del segundo jugador</label>
                <input type="text" id="player2" name="player2" placeholder="Nombre del segundo jugador" required>
            </div>
            <div class="botonera">
                <button class="button" type="submit">Jugar</button>
                <a class="button" href="historial.php">Historial</a>
            </div>
        </form>
    </main>
</body>

<?php
include './layout/footer.php';
?>