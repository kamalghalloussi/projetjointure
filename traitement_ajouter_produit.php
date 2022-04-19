<?php
session_start();
if(isset($_SESSION["email"])){
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>GAMING SHOP</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- La navbar responsive-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a href="produits.php" class="navbar-brand" href="#">GAMING SHOP</a>
            </div>
        </nav>
        <!-- la Page -->
        <div class="container">
            <div class="text-center mt-5">
                <h1>Acceuil du site</h1>
                 <form method="post">
                    <div class="text-center">
                        <button id="btn-deconnexion" class="btn btn-danger" name="btn-deconnexion">Déconnexion</button>
                    </div>
                    <span class="mt-3 d-flex justify-content-around">
                    <h3 class="mt-3 text-warning">Bienvenue <?= $_SESSION['email'] ?></h3>
                    </span>
                </form>
            </div>
        </div>

        <?php


if(isset($_FILES['image_produit'])){
    $repertoireDestination = "../img";
 
    $photo_produit = $repertoireDestination . basename($_FILES['image_produit']['name']);
   
    $_POST['image_produit'] = $photo_produit;
    if(move_uploaded_file($_FILES['image_produit']['tmp_name'], $photo_produit)){
        echo "<p class='container alert alert-success'>Le fichier est valide et téléchargé avec succès !</p>";
    }else{
        echo "<p class='container alert alert-danger'>Erreur lors du téléchargement de votre fichier !</p>";
    }
}else{
    echo "<p class='container alert alert-danger'>Le fichier est invalide seul les format .png, .jpg, .bmp, .svg, .webp sont autorisé !</p>";
}


$user = "root";
$pass = "";
try {
 
    $dbh = new PDO('mysql:host=localhost;dbname=e-commerce', $user, $pass);
 
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p class='container alert alert-success text-center'>Vous êtes connectez a PDO MySQL</p>";

} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

if($dbh){
    $sql = "INSERT INTO `produits`(`id_produit`, `nom_produit`, `description`, `prix_produit`, `stock_produit`, `date_dépot`, `image_produit`, `categorie_id`, `vendeur_id`) VALUES (?,?,?,?,?,?,?,?,?)";

    $insert = $dbh->prepare($sql);

    $insert->bindParam(1, $_POST['id_produit']);
    $insert->bindParam(2, $_POST['nom_produit']);
    $insert->bindParam(3, $_POST['description']);
    $insert->bindParam(4, $_POST['prix_produit']);
    $insert->bindParam(5, $_POST['stock_produit']);
    $insert->bindParam(6, $_POST['date_dépot']);
    $insert->bindParam(7, $_POST['image_produit']);
    $insert->bindParam(8,$_POST['catégorie']);
    $insert->bindParam(9,$_POST['vendeur']);


    $insert->execute(array(
        $_POST['id_produit'],
        $_POST['nom_produit'],
        $_POST['description'],
        $_POST['prix_produit'],
        $_POST['stock_produit'],
        $_POST['date_dépot'],
        $_POST['image_produit'],
        $_POST['catégorie'],
        $_POST['vendeur'],
    ));

    if($insert){
        echo "<p class='container alert alert-success'>Votre produit a été ajouté avec succès !</p>";
        echo "<a href='produits.php' class='container alert alert-success'>Voir mon produit</a>";
    }else{
        echo "<p class='alert alert-danger'>Erreur lors de l'ajout de produit</p>";
    }
}
}else{
    echo "<a href='' class='btn btn-warning'>S'inscrire</a>";
}
?>


