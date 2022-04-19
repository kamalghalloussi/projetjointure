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
        <link rel="icon" type="image_produit/x-icon" href="assets/favicon.ico" />
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
                <h1>Editer un produit</h1>
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
                try {
                
                        $dbh = new PDO('mysql:host=localhost;dbname=e-commerce', $user, $pass);  
                        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        echo "<p class='container alert alert-success text-center'>Vous êtes connectez a PDO MySQL</p>";
                    
                            } catch (PDOException $e) {
                        print "Erreur !: " . $e->getMessage() . "<br/>";
                        die();
                    }
   
                    if($dbh){
                        $sql = "SELECT * FROM produits WHERE id_produit = ?";
                    
                        $id_produits = $_GET['id_produit'];
                        
                        $request = $dbh->prepare($sql);
                        $request->bindParam(1, $id_produits);
                        $request->execute();
                        $details = $request->fetch(PDO::FETCH_ASSOC);
   
                    }            
       ?>

        <div class="container">


            <form action="traitement_éditer_produit.php?id_produit=<?= $details['id_produit'] ?>"  id="form-update" method="post" enctype="multipart/form-data">
                
                <div class="mb-3">
                    <label for="nom_produit" class="form-label">Nom du produit</label>
                    <input type="text" class="form-control" id="nom_produit" name="nom_produit" value="<?= $details['nom_produit'] ?>" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" rows="5" id="description" name="description" value="<?= $details['description'] ?>" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="prix_produit" class="form-label">Prix du produit</label>
                    <input type="number" step="0.01" class="form-control" id="prix_produit" name="prix_produit" value="<?= $details['prix_produit'] ?>" required>
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
                    <input type="date" class="form-control" id="date_dépot" name="date_dépot" value="<?= $details['date_dépot'] ?>"required >
                </div>

                <div class="mb-3">
                    <label for="image_produit" class="form-label">image du produit</label>
                    <input type="file" class="form-control" id="image_produit" name="image_produit" required value="<?= $details['image_produit'] ?>">
                </div>

                <div class="mb-3">
                    <label for="categorie_id" class="form-label">catégorie du produit</label>
                    <input  class="form-control" id="categorie_id" name="categorie_id" required value="<?= $details['categorie_id'] ?>">
                </div>

                <div class="mb-3">
                    <label for="vendeur_id" class="form-label">vendeur du produit</label>
                    <input  class="form-control" id="vendeur_id" name="vendeur_id" required value="<?= $details['vendeur_id'] ?>">
                </div>

                <div class="d-flex justify-content-around">
                    <button type="submit" name="btn-connexion" class="btn btn-warning">Mettre a jour</button>
                    <a href="produits.php" class="btn btn-success">Annuler</a>
                </div>


            </form>

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