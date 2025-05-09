<?php
// Inclure le fichier de configuration
require_once 'config.php';

// Configurer les en-têtes CORS
setCorsHeaders();

// Vérification de la méthode de requête
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status" => "error",
        "message" => ERROR_INVALID_REQUEST
    ]);
    exit;
}

// Récupération des données POST
$numero_compte = isset($_POST['numero_compte']) ? trim($_POST['numero_compte']) : "";
$nom_client = isset($_POST['nom_client']) ? trim($_POST['nom_client']) : "";
$nom_banque = isset($_POST['nom_banque']) ? trim($_POST['nom_banque']) : "";
$montant = isset($_POST['montant']) ? floatval($_POST['montant']) : 0;
$date_pret = isset($_POST['date_pret']) ? trim($_POST['date_pret']) : "";
$taux_pret = isset($_POST['taux_pret']) ? floatval($_POST['taux_pret']) : 0;

// Validation des données
if (!validateLoanData($numero_compte, $nom_client, $nom_banque, $montant, $date_pret, $taux_pret)) {
    echo json_encode([
        "status" => "error",
        "message" => ERROR_INVALID_DATA
    ]);
    exit;
}

try {
    $conn = getDbConnection();

    // Vérifier si le numéro de compte existe déjà
    $checkQuery = "SELECT COUNT(*) FROM pret_bancaire WHERE numero_compte = :numero_compte";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bindParam(':numero_compte', $numero_compte);
    $checkStmt->execute();
    
    if ($checkStmt->fetchColumn() > 0) {
        echo json_encode([
            "status" => "error",
            "message" => "Ce numéro de compte existe déjà"
        ]);
        exit;
    }

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
        echo json_encode([
            "status" => "success",
            "message" => "Prêt ajouté avec succès"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => ERROR_INSERT
        ]);
    }
} catch(PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
$conn = null;
?>