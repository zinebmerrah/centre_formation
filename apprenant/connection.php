<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
          <link rel="stylesheet" href="style.css">
          <title>se connecter</title>
</head>
<body>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
          <h1>Se connecter</h1>
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="img/centre.jpg" class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form action="connection.php" method="post">
          <!-- Email input -->
          <div class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Email:</label>
            <input type="email" id="form3Example3" name="email" value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';?>" class="form-control form-control-lg"/>
            
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <label class="form-label" for="form3Example4">Mot de passe:</label>
            <input type="password" id="form3Example4" name="password" value="<?php echo isset($_GET['mot_de_passe']) ? htmlspecialchars($_GET['mot_de_passe']) : '';;?>" class="form-control form-control-lg"/>
            
          </div>

          <div class="d-flex justify-content-between align-items-center">
          
            <a href="#!" class="text-body">mot de passe oublier?</a>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
          <a href="acceuil.php" class="btn btn-primary" id="btn_retour">retour</a>
          <input type="submit" id="btn_inscrire" class="btn  my-sm-0 mb-3 ms-5" name="submit" value="Se connecter">
            <p class="small  mt-2 pt-1 mb-0">vous avez pas du compte? <a href="inscrire.php"
                class="link-danger">Inscrire</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>
 

    
</section>


<?php
   		include "connect.php";

		if(isset($_POST['submit'])) {
			$username = $_POST["email"];
      $password = $_POST["password"];
        
      $connexion = $conn->prepare("SELECT * FROM apprenant WHERE email= :email AND mot_de_passe = :mot_de_passe");
			$connexion->bindParam(':email', $_POST['email']);

			$connexion->bindParam(':mot_de_passe', $_POST['password']);
        
			$connexion->execute();
			$result = $connexion->fetch(PDO::FETCH_ASSOC);

			if ($connexion->execute()) {
				$result = $connexion->fetch(PDO::FETCH_ASSOC);
				if ($result) {
                $_SESSION['id_apprenant'] = $result['id_apprenant'];
					      $_SESSION['nom'] = $result['nom'];
                $_SESSION['prenom'] = $result['prenom'];
                $_SESSION['email'] = $result['email'];
              
                $id = $_SESSION['id_apprenant'];
					header("Location: acceuil.php");
					exit();
				} else {
					echo "nom d'utilisateur ou mot de passe incorrect";
					// $error = "Nom d'utilisateur ou mot de passe incorrect";
				}
			} else {
				echo  "erreur de connexion à la base de données";
				// $error = "Erreur de connexion à la base de données";
			}
        
        }

?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</html>