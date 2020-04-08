<?php
$db = "mysql:host=185.227.81.30;dbname=runecher_ouderavond";
$username = "runecher_ouderavond";
$password = "Eq1rgNmkJr";

try {
    $conn = new PDO($db, $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected!";
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
?>