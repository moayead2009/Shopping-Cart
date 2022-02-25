<?php
try {
    $dbh = new PDO("mysql:host=localhost;dbname=final","root","");
} catch (Exception $error) {
    die("ERROR: Couldn't connect. {$error->getMessage()}");
}
