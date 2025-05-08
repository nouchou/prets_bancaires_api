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
$nom_client = isset($_POST['nom_client']) ? $_POST['nom_client'] : "";
$nom_banque = isset($_POST['nom_banque']) ? $_POST['nom_banque'] : "";
$montant = isset($_POST['montant']) ? floatval($_POST['montant']) : 0;
$date_pret = isset($_POST['date_pret']) ? $_POST['date_pret'] : "";
$taux_pret = isset($_POST['taux_pret']) ? floatval($_POST['taux_pret']) : 0;

// Validation des données
if (empty($numero_compte) || empty($nom_client) || empty($nom_banque) ||
    $montant <= 0 || empty($date_pret) || $taux_pret < 0) {
    echo "Invalid data provided";
    exit;
}

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "INSERT INTO pret_bancaire (numero_compte, nom_client, nom_banque, montant, date_pret, taux_pret)
              VALUES (:numero_compte, :nom_client, :nom_banque, :montant, :date_pret, :taux_pret)";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':numero_compte', $numero_compte);
    $stmt->bindParam(':nom_client', $nom_client);
    $stmt->bindParam(':nom_banque', $nom_banque);
    $stmt->bindParam(':montant', $montant);
    $stmt->bindParam(':date_pret', $date_pret);
    $stmt->bindParam(':taux_pret', $taux_pret);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error inserting record";
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>