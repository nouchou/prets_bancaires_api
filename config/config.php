<?php
// Fichier import_database.php
// À SUPPRIMER APRÈS UTILISATION POUR DES RAISONS DE SÉCURITÉ

// Configuration de la base de données
$db_host = getenv('mysql.railway.internal');
$db_name = getenv('railway');
$db_user = getenv('root');
$db_pass = getenv('KoZscdOZWivBoEjQOZlOzJMEhQnavnrW');
$db_port = getenv('3306');

// Connexion à la BDD
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Votre SQL d'importation ici (remplacez par le contenu de votre fichier SQL)
$sql = "
CREATE TABLE IF NOT EXISTS pret_bancaire (
    numero_compte VARCHAR(20) PRIMARY KEY,
    nom_client VARCHAR(100) NOT NULL,
    nom_banque VARCHAR(100) NOT NULL,
    montant DECIMAL(15,2) NOT NULL,
    date_pret DATE NOT NULL,
    taux_pret DECIMAL(5,4) NOT NULL
);


INSERT INTO pret_bancaire (numero_compte, nom_client, nom_banque, montant, date_pret, taux_pret) VALUES
('C001', 'Dupont Jean', 'BNP Paribas', 15000.00, '2023-06-15', 0.0350),
('C002', 'Martin Sophie', 'Crédit Agricole', 25000.00, '2023-05-20', 0.0315),
('C003', 'Lambert Michel', 'Société Générale', 10000.00, '2023-07-10', 0.0420),
('C004', 'Petit Laura', 'LCL', 18000.00, '2023-08-05', 0.0375);

// Exécution
if ($conn->multi_query($sql)) {
    echo "Importation réussie!";
} else {
    echo "Erreur: " . $conn->error;
}

$conn->close();
?>