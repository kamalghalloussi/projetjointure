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


        <?php
try {
    $db = new PDO("mysql:host=localhost;dbname=e-commerce;charset=UTF8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p class='container alert alert-success text-center'>Vous êtes connectez à PDO MySQL</p>";
}catch (PDOException $exception){
    echo "erreur " .$exception->getMessage();
}

$sql = "SELECT * FROM `catégorie`";
$catégorie = $db->query($sql);

?>

<div class= text-center>
                <a href="produits.php" class="mt-3 btn btn-outline-secondary">Aller à la page d'acceuil</a>
 </div>
<div class="container">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#ID</th>
            <th scope="col">type categorie</th>
            <th scope="col">EDITER</th>
        </tr>
        </thead>
        <tbody>
        <?php

        //fonction foreach parcours le tableau de ma table utlisateur
            foreach ($categories as $categorie){
                ?>
                <tr>
                    <th scope="row"><?= $categorie['id_categorie'] ?></th>
                    <td><?= $categorie['type_categorie'] ?></td>

                    <td>
                        <a href="éditer_produit.php?categorie_id=<?= $categorie['id_user'] ?>" class="btn btn-success">EDITER</a>
                    </td>
                    
                    <td>
                        <a href="supprimerunproduit.php?categorie_id=<?= $categorie['id_user'] ?>" class="btn btn-danger">SUPPRIMER</a>
                    </td>
                </tr>
        <?php
            }

        ?>


        </tbody>
    </table>
</div>
<?php
}else{
    header("Location: ../index.php");
}
?>
</body>
</html>

