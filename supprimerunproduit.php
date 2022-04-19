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
                <a href="produit.php" class="navbar-brand" href="#">GAMING SHOP</a>
                
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
        
        $user = "root";
        $pass = "";
        $nomBaseDonnees = "e-commerce";
        $hote="localhost";
        try {         
            $dbh = new PDO("mysql:host=".$hote.";dbname=".$nomBaseDonnees.";charset=UTF8", $user, $pass);           
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "<p class='container alert alert-success text-center'>Vous êtes connectez a PDO MySQL</p>";

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }

        if($dbh){
            $sql = "SELECT * FROM produits WHERE id_produit = ?";
            $id_produit = $_GET['id_produit'];
            $request = $dbh->prepare($sql);
            $request->bindParam(1, $id_produit);
            $request->execute();          
            $details = $request->fetch(PDO::FETCH_ASSOC);

        }

        ?>
        <form method="post" id="form-delete">
            <p class="text-center text-danger">SUPPRIMER LE PRODUIT</p>
            <p class="text-center text-danger"><?= $details['nom_du_produit'] ?></p>
            <p class="text-center text-danger"><?= $details['description'] ?></p>
            <p class="text-center text-danger"><?= $details['prix_produit'] ?></p>
            <p class="text-center text-danger">
                <img src="<?= $details['image'] ?>" class="img-thumbnail" alt="" title="" width="200"/>
            </p>
            <p class="text-center text-danger"><?= $details['date_dépot'] ?></p>
            <p class="text-center text-danger"><?= $details['stock_produit'] ?></p>
            <div class="d-flex justify-content-center">
                <button type="submit" name="btn-supprimer" class="btn btn-danger">Confimer</button>
                <a href="produits.php" class="btn btn-success">Annuler</a>
            </div>

        </form>
        <?php

        if(isset($_POST['btn-supprimer'])){
            $sql = "DELETE FROM `produits` WHERE id_produit =  ?";
            $delete = $dbh->prepare($sql);
            $idProduit = $_GET['id_produit'];
            $delete->bindParam(1, $idProduit);
            $delete->execute();
            if($delete){
                echo "<p class='container alert alert-success'>Votre produit a bien été supprimer !</p>";
                echo "<div class='container'><a href='produits.php' class='mt-3 btn btn-success'>RETOUR</a></div>";
                ?>
                    <style>
                        #form-delete{
                            display: none;
                        }
                    </style>
                <?php
            }else{
                echo "<p class='alert alert-danger'>Erreur lors de la supression du produit !</p>";
                echo "<div class='container'><a href='produits.php' class='mt-3 btn btn-success'>RETOUR</a></div>";
            }

        }


}else{
    header("location:index.php");
    
}
?>
        <script> src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>

<?php
    function deconnexion(){
     session_unset();
     session_destroy();
     header("Location:index.php");}
     
 if(isset($_POST['btn-deconnexion'])){
deconnexion();}       
?>    
       