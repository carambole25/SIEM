<?php

$host = 'db';
$dbname = 'eagle_db';
$username = 'changeme_MYSQL_USER';
$password = 'changeme_MYSQL_PASSWORD';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if (isset($_POST['apikey']) && isset($_POST['hostname']) && isset($_POST['log'])){
    $apikey = htmlspecialchars($_POST['apikey']);

    $sql = "SELECT * FROM `api_keys` WHERE api_key = (?)";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$apikey]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $hostname = htmlspecialchars($_POST['hostname']);
        $log = htmlspecialchars($_POST['log']);

        $sql = "INSERT INTO events (hostname, log) VALUES (?, ?)";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$hostname, $log]);

    } else {
        echo "Clé d'api non invalide";
    }
}

?>