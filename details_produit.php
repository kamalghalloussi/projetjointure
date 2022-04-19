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
        <title>CRUD 3</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- La navbar responsive-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a href="produit.php" class="navbar-brand" href="#">CRUD 3</a>
                
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
    $hote = "localhost";
    $nomBaseDonnees = "e-commerce";

    try {

        $connexionDataBase = new PDO("mysql:host=".$hote.";dbname=".$nomBaseDonnees.";charset=UTF8", $user, $pass);
        $connexionDataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<p class='container alert alert-success text-center'>Vous êtes connectez a PDO MySQL</p>";




    }catch (PDOException $exception){
        echo "Erreur de connexion a MySQL " .$exception->getMessage();
        die();
    }

    if($connexionDataBase == true){
        $sql = "SELECT * FROM produits WHERE id_produit = ?";
        $id_produit = $_GET['id_produit'];

        $requete = $connexionDataBase->prepare($sql);

        $requete->bindParam(1, $id_produit);
        $requete->execute();
        $details = $requete->fetch();

    }




    ?>

 

<div class="container col-sm-12 col-lg-4 mt-5" >
            <h4 class="text-warning text-center">Détail du produit</h4>

            <p class="text-center "><?= $details['nom_produit'] ?></p>
            <p class="text-center ">
                <img src="<?= $details['image_produit'] ?>" class="img-thumbnail" alt="" title="" width="200"/>
            </p>
            <p class="text-center ">Le prix : <?= $details['prix_produit'] ?></p>
            <p class="text-center ">Description du produit : <?= $details['description'] ?></p>
            <p class="text-center ">Date de dépôt : <?= $details['date_dépot'] ?></p>
            <p class="text-center "> En stock ?  -----> <?= $details['stock_produit'] ?></p>
            <p class="text-center ">Catégorie -----> <?= $details['categorie_id'] ?></p>
            <p class="text-center "> Vendeur -----><?= $details['vendeur_id'] ?></p>
            <div class="text-center">
                            <a href="produits.php" class=" btn btn-success">Retour à la liste des produits</a>
            </div>
            
        <div class="row">

            <br>
            <br>
<?php
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
       