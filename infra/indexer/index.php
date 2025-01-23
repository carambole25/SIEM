<?php

$host = 'db';
$dbname = 'eagle_db';
$username = 'changeme';
$password = 'changeme';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if (isset($_POST['apikey']) && isset($_POST['hostname']) && isset($_POST['log'])){
    echo htmlspecialchars($_POST['apikey']);
    echo htmlspecialchars($_POST['hostname']);
    echo htmlspecialchars($_POST['log']);
}

?>