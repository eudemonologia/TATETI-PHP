<?php

// Conectarse o crear una base de datos en SQLite
$db = new PDO('sqlite:./tictactoe.sqlite');

// Crear la tabla de juegos si no existe
$db->exec('CREATE TABLE IF NOT EXISTS games (
    id INTEGER PRIMARY KEY,
    player1 TEXT,
    player2 TEXT,
    game TEXT,
    winner TEXT,
    date DATETIME DEFAULT CURRENT_TIMESTAMP
)');
