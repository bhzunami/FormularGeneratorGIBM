<?php
$db = new mysqli('localhost', 'root', 'as3fg9mn', 'Formular');
if (mysqli_connect_errno()) {
    die ('Konnte keine Verbindung zur Datenbank aufbauen: '.mysqli_connect_error().'('.mysqli_connect_errno().')');
}

?>