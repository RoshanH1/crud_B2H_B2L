<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=fietsenmaker', 'root', '');
} catch (PDOException $e){
    die('Error: ' . $e->getMessage());
}
