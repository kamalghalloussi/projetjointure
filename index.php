<?php
session_start();
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
                <a class="navbar-brand" href="#">CRUD 3</a>
                
            </div>
        </nav>
        <!-- la Page -->
        <div class="container">
            <div class="text-center mt-5">
                <h1>Veuillez vous connecter à votre session.</h1>
                <p class="lead">Il vous suffit de mettre votre identifiants ainsi que votre mot de passe.</p>
                <p>Accédez à votre espace utlisateur !</p>
            </div>
        </div>


         <div class="container-fluid">
            <form  id="formulaire-connexion" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Votre Email</label>
                    <input type="email" class="form-control" name="email" id="email"  required/>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Votre mot de passe</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
                </div>
                <button type="submit" name="btn-connexion" class="btn btn-primary">Connexion</button>
            </form>
        </div>

         <?php
            
            function connexion(){


    
                $utilisateur_phpadmin = "root";
                $mot_passe_phpadmin = "";
                $dbname = "e-commerce";
                $host = "localhost";


                try {

                    $db = new PDO("mysql:host=".$host.";dbname=".$dbname.";charset=UTF8", $utilisateur_phpadmin, $mot_passe_phpadmin);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    echo "Connexion A MySQL via la classe PDO";

                }catch (PDOException $exception){
                    echo "Erreur de connexion a PDO MySQL " . $exception->getMessage();
                    var_dump($db);
                    die();
                }



                if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])){
                    
                    $emailUtilisateur = trim(htmlspecialchars($_POST['email']));
                    $passwordUtilisateur = trim(htmlspecialchars($_POST['password']));

                    $sql = "SELECT * FROM utilisateur WHERE email = ? AND password = ?";

                    $connexion = $db->prepare($sql);

                    $connexion->bindParam(1, $emailUtilisateur);
                    $connexion->bindParam(2, $passwordUtilisateur);

                    $connexion->execute();

                    if($connexion->rowCount() >= 0){
                        
                        $ligne = $connexion->fetch();
                        if($ligne){
                            $email = $ligne['email'];
                            $password = $ligne['password'];

                            
                            if($emailUtilisateur === $email && $passwordUtilisateur === $password){
                                $_SESSION['email'] = $emailUtilisateur;
                                header("Location: produits.php");
                            }else{
                                echo "<div class='mt-3 container'>
                            <p class='alert alert-danger p-3'>Erreur de connexion: merci de verifié votre email et mot de passe</p>
                            </div>";
                            }
                        }else{
                            echo "<div class='mt-3 container'>
                            <p class='alert alert-danger p-3'>Erreur de connexion: Aucun utilisateur dans votre table</p>
                            </div>";
                        }

                    }else{
                        
                        echo "Votre table est vide";
                    }


                }else{
                    echo "Merci de remplir tous les champs";
                }

            }
                if(isset($_POST['btn-connexion'])){
                connexion();}
         ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
