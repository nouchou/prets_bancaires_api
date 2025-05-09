<?php
// Configuration de la base de données
$host = "mysql.railway.internal";
$db_name = "railway'";
$username = "root";
$password = "KoZscdOZWivBoEjQOZlOzJMEhQnavnrW";
$db_port = getenv('3306');
try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM pret_bancaire ORDER BY nom_client ASC";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $loans = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $loans[] = $row;
    }

    echo json_encode($loans);
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
