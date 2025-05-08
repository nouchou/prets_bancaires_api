<?php
// Configuration de la base de données
$host = "sql213.infinityfree.com";
$db_name = "if0_38923779_prets_bancaires";
$username = "if0_38923779";
$password = "app2025bank";

// Vérification de la méthode de requête
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Invalid request method";
    exit;
}

// Récupération des données POST
$numero_compte = isset($_POST['numero_compte']) ? $_POST['numero_compte'] : "";

// Validation des données
if (empty($numero_compte)) {
    echo "Invalid data provided";
    exit;
}

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "DELETE FROM pret_bancaire WHERE numero_compte = :numero_compte";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':numero_compte', $numero_compte);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error deleting record";
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>