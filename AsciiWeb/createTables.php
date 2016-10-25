<?php

function conect(&$conn) {
    $servername = "localhost";
    $username = "asciiweb";
    $password = "pene";
    $dbname = "asciiweb";

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}

function disconect(&$conn) {
    $conn->close();
}

function crearTablaJuegos($entrada) {
    conect($conn);
// sql to create table
    $sql = "CREATE TABLE JUEGOS$entrada (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
nombre VARCHAR(30) NOT NULL,
durmedia INT(4) NOT NULL,
puntbase INT(4) NOT NULL,
puntmanual INT(4) DEFAULT '0',
juegodeldia BOOLEAN DEFAULT FALSE,
ultjugado TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
    if ($conn->query($sql) === TRUE) {
        echo "tabla Juegos creada correctamente";
    } else {
        echo "Error creating table: " . $conn->error;
    }
    disconect($conn);
}

function creatablas($edicion, $juegos) {
    conect($conn);
    // sql to create table
    $sql = "CREATE TABLE PARTIDA$edicion (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
idJuego INT(6) UNSIGNED NOT NULL,
aprobado BOOLEAN DEFAULT FALSE,
FOREIGN KEY (idJuego) REFERENCES JUEGOS$juegos(id) )";
    if ($conn->query($sql) === TRUE) {
        echo "tabla Partida creada correctamente";
    } else {
        echo "Error creating table: " . $conn->error;
    }
    $sql = "CREATE TABLE JUGADORES$edicion (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(30) NOT NULL,
puntos INT(6) NOT NULL)";
    if ($conn->query($sql) === TRUE) {
        echo "tabla Jugadores creada correctamente";
    } else {
        echo "Error creating table: " . $conn->error;
    } 
    $sql = "CREATE TABLE JUGAR$edicion (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
idJuego INT(6) UNSIGNED NOT NULL,
idJugador INT(6) UNSIGNED NOT NULL,
posicion INT(2)NOT NULL,
FOREIGN KEY (idJuego) REFERENCES JUEGOS$juegos(id),
FOREIGN KEY (idJuego) REFERENCES JUGADORES$edicion(id))";
    if ($conn->query($sql) === TRUE) {
        echo "tabla Jugadores creada correctamente";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    disconect($conn);
}

?>
