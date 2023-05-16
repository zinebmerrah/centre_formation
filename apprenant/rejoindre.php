<?php
include "connect.php";
session_start();

$id_session = $_GET['id'];
$id_apprenant = $_SESSION['id_apprenant'];

// Test de chauvechement
$chauvechement = $conn->prepare("SELECT COUNT(*) FROM apprenant_session A INNER JOIN session S ON S.id_session = A.id_session  WHERE id_apprenant = ? AND 
    (
        (S.date_debut > (SELECT date_debut FROM session S WHERE id_session = ?) AND S.date_debut < (SELECT date_fin FROM session S WHERE id_session = ?))
        OR (S.date_fin > (SELECT date_debut FROM session S WHERE id_session = ?) AND S.date_fin < (SELECT date_fin FROM session S WHERE id_session = ?))
        OR (S.date_debut < (SELECT date_debut FROM session S WHERE id_session = ?) AND S.date_fin > (SELECT date_fin FROM session S WHERE id_session = ?))
    )");
$chauvechement->bindParam(1, $id_apprenant);
$chauvechement->bindParam(2, $id_session);
$chauvechement->bindParam(3, $id_session);
$chauvechement->bindParam(4, $id_session);
$chauvechement->bindParam(5, $id_session);
$chauvechement->bindParam(6, $id_session);
$chauvechement->bindParam(7, $id_session);
$chauvechement->execute();
$chauvechements = $chauvechement->fetchColumn();

// Test du nombre d'inscrits
$number_session = $conn->prepare("SELECT COUNT(*) FROM apprenant_session A INNER JOIN session S ON S.id_session = A.id_session  WHERE A.id_apprenant = ? AND YEAR(S.date_debut) = YEAR(NOW())");
$number_session->bindParam(1, $id_apprenant);
$number_session->execute();
$count_session = $number_session->fetchColumn();

// Test des places maximales
$nombre_inscrit = $conn->prepare("SELECT COUNT(*) FROM apprenant_session A INNER JOIN session S ON S.id_session = A.id_session  WHERE S.id_session = ?");
$nombre_inscrit->bindParam(1, $id_session);
$nombre_inscrit->execute();
$nmbi = $nombre_inscrit->fetchColumn();

$nombre_place_maximal = $conn->prepare("SELECT nombres_places_maximal FROM session S WHERE S.id_session = ?");
$nombre_place_maximal->bindParam(1, $id_session);
$nombre_place_maximal->execute();
$nmpl = $nombre_place_maximal->fetchColumn();

// test de date
$date_debut = $conn->prepare("SELECT date_debut FROM session S WHERE S.id_session = ?");
$date_debut->bindParam(1, $id_session);
$date_debut->execute();
$date = $date_debut->fetchColumn();

if ($nmbi < $nmpl && $count_session < 2 && $chauvechements == 0) {
    $sql = "INSERT INTO apprenant_session (id_apprenant, id_session) VALUES (?, ?)";
    $insert = $conn->prepare($sql);
    $insert->bindParam(1, $id_apprenant);
    $insert->bindParam(2, $id_session);
    $insert->execute();

    if ($insert) {
        header("Location: profil.php");
        exit();
    } else {
        echo "Erreur lors de l'insertion";
    }
}elseif($nmbi == $nmpl ){
   $update_session = "UPDATE `session` SET `etat`='inscription achevée' WHERE id_session = '$id_session'";
   $conn->exec($update_session);
}elseif($nmbi > 3 && $date == NOW()){
    $update_session = "UPDATE `session` SET `etat`='en cours' WHERE id_session = '$id_session'";
   $conn->exec($update_session);
}elseif($count_session == 2){
    echo'
        <h2> vous avez dèja 2 session</h2>
    ';
}elseif($chauvechements > 0){
    echo'
        <h2> vous avez dèja une session qui se chevauche avec une autre session </h2>
    ';
}
?>
