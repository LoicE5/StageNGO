<?php

//création de la connexion avec PDO
//variables de connexion
$servername="localhost";
$username="root";
$password="";
$dbname="stagengo";

$conn=new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

?>
