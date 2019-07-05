<?php
$host="localhost"; //127.0.0.1;
$bd="regniermail";
$user="mael";
$password="mila24122010";
try{
$base = new PDO("mysql:host=$host;dbname=$bd",$user,$password);
}catch(Exception $e){
    die("Erreur : " . $e->getMessage());
}
?>