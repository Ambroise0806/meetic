<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: connection.php");
    exit();
}
$id = $_SESSION['id'];
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$email = $_SESSION['email'];
$ville = $_SESSION['ville'];
$genre = $_SESSION['genre'];
$loisir = $_SESSION['loisir'];
$date = $_SESSION['date'];
$aujourdhui = date("Y-m-d");
$diff = date_diff(date_create($date), date_create($aujourdhui));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <h1>Profil de <?php echo $nom . '  ' . $prenom . '  ' . $diff->format('%y') . ' ans'; ?></h1>
    <p><strong>Email :</strong> <?php echo $email; ?></p>
    <p><strong>Naissance :</strong> <?php echo $date; ?></p>
    <p><strong>Ville :</strong> <?php echo $ville; ?></p>
    <p><strong>Genre :</strong> <?php echo $genre; ?></p>
    <p><strong>loisir :</strong> <?php echo $loisir; ?></p>
    <a href="reglage.php">Modifications</a>
    <a href="recherche.php">Swipe</a>
    <a href="connection.php">Se déconnecter</a>
</body>
</html>
