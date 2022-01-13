<?php
session_start();
include './layout/head.php';
require './db.php';

//Destruir cualquier sesion que exista
session_destroy();

//Recuperar todos los datos de las partidas
$query = $db->query('SELECT * FROM games');
$games = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
    <main class="card historial">
        <h1>Historial de partidas</h1>
        <h5>
            <?php
            echo "Se han jugado " . count($games) . " partidas";
            ?>
        </h5>
        <div class="scroll">
            <table>
                <thead>
                    <tr>
                        <th>Jugador 1</th>
                        <th>Jugador 2</th>
                        <th>Partida</th>
                        <th>Ganador</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($games as $game) {
                    ?>
                        <tr>
                            <td><?php echo $game['player1']; ?></td>
                            <td><?php echo $game['player2']; ?></td>
                            <td><?php
                                //convertir la partida en un array
                                $board = str_split($game['game']);
                                ?>
                                <table>
                                    <tr>
                                        <td><?php echo $board[0]; ?></td>
                                        <td><?php echo $board[1]; ?></td>
                                        <td><?php echo $board[2]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $board[3]; ?></td>
                                        <td><?php echo $board[4]; ?></td>
                                        <td><?php echo $board[5]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $board[6]; ?></td>
                                        <td><?php echo $board[7]; ?></td>
                                        <td><?php echo $board[8]; ?></td>
                                    </tr>
                                </table>
                            </td>
                            <td><?php echo $game['winner']; ?></td>
                            <td><?php
                                $date = new DateTime($game['date']);
                                echo $date->format('d-m-Y');
                                ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="botonera">
            <a class="button" href="index.php">Volver al inicio</a>
        </div>
    </main>
</body>

<?php
include './layout/footer.php';
?>