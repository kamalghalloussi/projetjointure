
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
                <a  class="navbar-brand" href="produits.php">CRUD 3 </a>
                
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
                    </span>
                </form>
            </div>
        </div>

<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=e-commerce;charset=UTF8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p class='container alert alert-success text-center'>Vous êtes connectez à PDO MySQL</p>";
}catch (PDOException $exception){
    echo "erreur " .$exception->getMessage();
}

?>    

<div class="container">
    <form class="text-center" method="post" id="form-register">
        <h4 class="text-center text-info">AJOUTER UN ADMINISTRATEUR</h4>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>

        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="password_repeat" class="form-label">Répeter le mot de passe</label>
            <input type="password" class="form-control" id="password_repeat" name="password_repeat" required>
        </div>

        <input type="hidden" value="ADMIN" name="role">

        <button type="submit" name="btn-ajouter-admin" class="mt-3 btn btn-info">AJOUTER</button>
    </form>
</div>


<?php

$emailAdmin = trim(htmlspecialchars($_POST['email']));
$passwordAdmin = trim(htmlspecialchars($_POST['password']));
$password_repeat_admin = trim(htmlspecialchars($_POST['password_repeat']));

if(isset($emailAdmin) && !empty($emailAdmin) && isset($passwordAdmin) && !empty($passwordAdmin)){
    if($passwordAdmin === $password_repeat_admin){
        $sql = "INSERT INTO `utilisateur`(`email`, `password`) VALUES (?,?)";
        $insertUser = $db->prepare($sql);

        $insertUser->bindParam(1, $emailAdmin);
        $insertUser->bindParam(2, $passwordAdmin);

        $insertUser->execute(array(
            $emailAdmin,
            $passwordAdmin
        ));

        if($insertUser){
            ?>
            <div class="container">
            <?php
            echo "<p class='alert alert-success p-3 mt-3'>Vous etes inscrits</p>";
            echo "<a class='btn btn-success mt-3' href='../index.php'>Se connecter</a>";
            ?>
            </div>
          
            <style>
                #form-register{
                    display: none;
                }
            </style>
            <?php
        }else{
            echo "<div class='container'>
                <p class='alert alert-danger'>Merci de remplir tous les champs !</p></div>";
        }

    }else{
        echo "<div class='container'>
            <p class='alert alert-danger'>Les 2 mots de passe ne sont pas identiques</p></div>";
    }
}

?>


</body>

</html>

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
       
