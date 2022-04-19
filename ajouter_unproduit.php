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
        try {
    $dbh = new PDO('mysql:host=localhost;dbname=e-commerce;charset=UTF8', "root", "");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connexion a PDO";

} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
/*
 *INSERT INTO `produits`(`id_produit`, `nom_produit`, `description_produit`, `prix_produit`, `stock_produit`, `date_depot`, `image_produit`, `categorie_id`, `vendeur_id`, `commentaire_id`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10])
 */

?>
    
    </header>
    

            <form action="traitement_ajouter_produit.php"  id="form-login" method="post" enctype="multipart/form-data">
                <div class="text-center">
                    <h2> AJOUTER UN PRODUIT </h2>
               </div>
                <div class="mb-3">
                    <label for="nom_produit" class="form-label">Nom du produit</label>
                    <input type="text" class="form-control" id="nom_produit" name="nom_produit" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" rows="5" id="description" name="description" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="prix_produit" class="form-label">Prix du produit</label>
                    <input type="number" step="0.01" class="form-control" id="prix_produit" name="prix_produit" required>
                </div>

                <div class="mb-3">
                    <label for="stock_produit" class="form-label">Disponible</label>
                    <select class="form-control" name="stock_produit" id="stock_produit" required>
                        <option value="0">OUI</option>
                        <option value="1">NON</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="date_dépot" class="form-label">Date de dépot du produit</label>
                    <input type="date" class="form-control" id="date_dépot" name="date_dépot" required>
                </div>

                <div class="mb-3">
                    <label for="image_produit" class="form-label">Image du produit</label>
                    <input type="file" class="form-control" id="image_produit" name="image_produit" required>
                </div>

                
                <div class="mb-3">
                    Catégories :
                    <select name="catégorie" class="form-control">
                        <?php
                            $sql = "SELECT * FROM catégorie";
                            $catégorie = $dbh->query($sql);
                            foreach ($catégorie as $category){

                                ?>
                                <option value="<?= $category['id_categorie'] ?>"><?= $category['type_categorie'] ?></option>
                        <?php
                            }

                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    Vendeurs :
                    <select name="vendeur" class="form-control">
                        <?php
                        $sql = "SELECT * FROM vendeur";
                        $vendeurs = $dbh->query($sql);
                        foreach ($vendeurs as $vendeur){
                            ?>
                            <option value="<?=  $vendeur['id_vendeur'] ?>"><?= $vendeur['nom_vendeur'] ?></option>
                            <?php
                        }

                        ?>
                    </select>
                </div>


                <div class="d-flex justify-content-around">
                    <button type="submit" name="btn-connexion" class="btn btn-warning">Ajouter</button>
                    <a href="produits.php" class="btn btn-success">Annuler</a>
                </div>
            </form>

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
            