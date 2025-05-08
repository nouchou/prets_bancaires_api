<?php
header('Content-Type: application/json');

// Message d'accueil basique pour tester l'API
$response = [
    "status" => "success",
    "message" => "Bienvenue sur l'API de gestion des prêts bancaires. 🎯",
    "endpoints" => [
        "GET /get_all_loans.php" => "Liste tous les prêts",
        "POST /add_loan.php" => "Ajoute un nouveau prêt",
        "POST /update_loan.php" => "Met à jour un prêt existant",
        "POST /delete_loan.php" => "Supprime un prêt existant"
    ]
];

echo json_encode($response, JSON_PRETTY_PRINT);
