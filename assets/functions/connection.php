<?php
$servername = "185.227.81.30";
$username = "runecher_ouderavond";
$password = "Eq1rgNmkJr";

try {
    $conn = new PDO("mysql:host=$servername;dbname=runecher_ouderavond", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
?>