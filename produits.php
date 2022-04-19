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
        <title>CRUD 3 </title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- La navbar responsive-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a  class="navbar-brand" href="#">CRUD 3 </a>
                
            </div>
        </nav>
        <!-- la Page -->
        <div class="container">
            <div class="text-center mt-5">
                <h1>Acceuil du site</h1>
                 <form method="post">
                    <div class="  text-center">
                        <button id="btn-deconnexion" class="btn btn-danger" name="btn-deconnexion">Déconnexion</button>
                        <a href="inscription.php" class="mx-3 btn btn-info">Ajouter un administrateur</a>

                    </div>
                    <div class="  text-center">
                        <a href="categorisation.php" class="mt-3 btn btn-outline-secondary">Page de catégorisation des éléments</a>


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
            try {
               
                $dbh = new PDO('mysql:host=localhost;dbname=e-commerce', $user, $pass);
                
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "<p class='container alert alert-success text-center'>Vous êtes connectez à PDO MySQL</p>";

            } catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage() . "<br/>";
                die();
            }     
            if($dbh){
                $sql = "SELECT * FROM `produits` INNER JOIN catégorie ON produits.categorie_id=catégorie.id_categorie INNER JOIN vendeur ON produits.vendeur_id=vendeur.id_vendeur";
             
                $statement = $dbh->query($sql);
            }
        ?>
        <div class="container">
                <div class="text-center">
                    <a href="ajouter_unproduit.php" class="mt-3 btn btn-outline-secondary">Ajouter un produit</a>
                </div>

                <h2 class="mt-3 text-center text-warning">Vos produits</h2>

                <div class="row">
                    <?php
                        foreach ($statement as $produits){
                            $date_depot = new DateTime($produits['date_dépot']);
                            ?>
                            <div class="col-sm-12 col-lg-4 mt-5">
                                <div class="card">
                                    <div class="text-center">
                                        <h4 class="card-title text-info"><?= $produits['nom_produit'] ?></h4>
                                        <img src="<?= $produits['image_produit'] ?>" class="card-img-top img-fluid" alt="<?= $produits['nom_produit'] ?>" title="<?= $produits['nom_produit'] ?>">
                                    </div>

                                
                                    <div class="card-body">

                                        <p class="card-text"><?= $produits['description'] ?></p>
                                        <p class="card-text">PRIX : <?= $produits['prix_produit'] ?> €</p>
                                        <p class="card-text">Disponible:
                                            <?php
                                            if($produits['stock_produit'] == true){
                                                echo "OUI";
                                            }
                                            else{
                                                echo "NON";
                                            }
                                            ?>
                                        </p>
                                        <em class="card-text">Date de dépôt : <?= $date_depot->format('d-m-Y') ?></em>
                                        <br> <br> 
                                        <p class="card-text text-success fw-bold">Catégories : <b class="text-info"><?= $produits["type_categorie"]; ?></b></p>
                                        <p class="card-text text-success fw-bold">Nom du vendeur : <?= $produits['enseigne'] ?></p>


                                        <div class="container-fluid d-flex justify-content-center">

                                                <a href="details_produit.php?id_produit=<?= $produits['id_produit'] ?>" class="mt-2 btn btn-success">Détails</a>
                                                <a href="éditer_produit.php?id_produit=<?= $produits['id_produit'] ?>" class="mt-2 btn btn-warning">Editer</a>
                                                <a href="supprimerunproduit.php?id_produit=<?= $produits['id_produit'] ?>" class="mt-2 btn btn-danger">Supprimer</a>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    ?>

                </div>
            </div>
        </div>


        
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
       