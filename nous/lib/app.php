<?php
  // All constants with credentials should be defined in secrets.php
  include('secrets.php');

  // Set proper values for error display
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  // Return an instance of PDO, ready to use
  function getDatabase() {
    $pdo = new PDO(DB_HOST, DB_USER, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    return $pdo;
  }
?>