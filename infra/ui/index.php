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

# ça ressemble à un injection sql mais c'est volontaire
# l'utilisateur peu query la bdd
# faudra à l'avenir faire en sorte qu'il puisse que consulter les donners (readonly) et que events pas apikey
if (isset($_GET['query'])){
    $query = $_GET['query']; 
} else {
    $query = "SELECT * FROM `events`";
}

$sql = $query;
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($results) {
    foreach ($results as $row) {
        foreach ($row as $value) {
            echo htmlspecialchars($value);
        }
        echo "<br>";
    }
}


?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title>
        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
    </head>
    <body>

        <form action="" method="get">
        <label for="query">query to bdd :</label>
        <textarea id="query" name="query" rows="10" cols="50"></textarea><br>
        <button type="submit">Submit</button>
        </form> 

        <br>
        <br>

        <a href="generate_api_key.php">Generer des clés API</a>
        
        <h1>Récupérer les agents : </h1>
        <p>wget http://srv_ip/agent_linux.zip</p>
    </body>
</html>