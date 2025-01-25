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
    echo "<table border='1'>";
    echo "<tr>";
    foreach (array_keys($results[0]) as $header) {
        echo "<th>" . htmlspecialchars($header) . "</th>";
    }
    echo "</tr>";

    foreach ($results as $row) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}


?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title>
        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
        <link rel="stylesheet" type="text/css" href="style_index.css">
    </head>
    <body>
        <br>
        <form action="" method="get">
        <label for="query">Query to bdd :</label><br>
        <textarea id="query" name="query" rows="10" cols="50"></textarea><br>
        <button type="submit">Submit</button>
        </form> 

        <br>
        <br>

        <a href="generate_api_key.php">Generer des clés API</a>
        
        <br>
        <br>

        <h1>Récupérer les agents : wget http://srv_ip/agent_linux.zip</h1>
    </body>
</html>