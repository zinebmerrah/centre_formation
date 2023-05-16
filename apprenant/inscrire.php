<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
          <link rel="stylesheet" href="style.css">
          <title>S'inscrire</title>
</head>
<body>   
<?php 
 
         $msgvalider="";

        
          include "connect.php";
          if(isset($_POST["submit"])){
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];
                $mot_de_passe = $_POST['password'];
                $confrim = $_POST['confirmer'];

                if(!empty($nom) && !empty($prenom) && !empty($email) && !empty($mot_de_passe) && !empty($confrim)){
                    if($mot_de_passe == $confrim){
                    $sql = "INSERT INTO `apprenant`(`nom`, `prenom`, `email`, `mot_de_passe`) VALUES ('$nom','$prenom','$email','$mot_de_passe')";
                    $conn->exec($sql);
                    if($conn == true){
                        header("Location: connection.php?email=$email&mot_de_passe=$mot_de_passe");
                        exit();
                    }else{
                              $msgvalider= "vous avez une problème";
                    }
                    }else{
                        $msgvalider = "verifier le mot de passe";
                    }

                
          }
                
          }

      ?>
  <div id="body">    
          <h1>Créer votre compte</h1>
          

          <form action="inscrire.php" id="form_inscription" method="post">
                    <div>
                              <div class="d-flex flex-row align-items-center mb-4 p-2">
                              <div class="form-outline flex-fill mb-0 ">
                                 <label class="form-label text-secondary" for="form3Example1c">Nom: <span class="text-danger">*</span></label>
                                 <input type="text" name="nom" id="form3Example1c" class="form-control" />
                              </div>
                    </div>

                              <div class="d-flex flex-row align-items-center mb-4 p-2">
                              <div class="form-outline flex-fill mb-0">
                                        <label class="form-label text-secondary" for="form3Example3c">Prénom: <span class="text-danger">*</span></label>
                                        <input type="text" name="prenom" id="form3Example3c" class="form-control" />
                              </div>
                              </div>

                              <div class="d-flex flex-row align-items-center mb-4 p-2">
                              <div class="form-outline flex-fill mb-0">
                                        <label class="form-label text-secondary" for="form3Example3c">Email: <span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="form3Example3c" class="form-control" />
                              </div>
                              </div>

                              <div class="d-flex flex-row align-items-center mb-4 p-2">
                              <div class="form-outline flex-fill mb-0">
                                        <label class="form-label text-secondary" for="password">Mot de passe: <span class="text-danger">*</span> </label>
                                        <input type="password" name="password" onkeyup="passwordValid()" id="password" class="form-control" />
                              </div>
                              </div>

                              <div class="d-flex flex-row align-items-center mb-4 p-2">
                              
                              <div class="form-outline flex-fill mb-0">
                                        <label class="form-label text-secondary" for="form3Example4cd">Confirmer le mot de passe: <span class="text-danger">*</span></label>
                                        <input type="password" id="conMTP" name='confirmer' class="form-control" />
                              </div>
                              </div>
                              <p style="color:green;margin-left:4%;"><?php  echo $msgvalider; ?></p>
                                
                              <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4 p-2">
                              <a href="acceuil.php" class="btn btn-primary" id="btn_retour">retour</a>
                              <input type="submit" id="btn_inscrire" class="btn  my-sm-0 mb-3 ms-5" name="submit" value="S'inscrire">
                              </div>
                              </div>
          </form>
  </div>    
<script>
 function passwordValid(){
    let mtp = document.getElementById("password").value;
    let regEx = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;

    if(regEx.test(mtp)){
        document.getElementById("password").style.border='2px solid green';
    }
    else{
        document.getElementById("password").style.border='2px solid red';
    }
    document.getElementById("conMTP").onkeyup=function(){
        let confMTP = document.getElementById("conMTP").value;
        if(confMTP==mtp){
            document.getElementById("conMTP").style.border='2px solid green';
        }
        else{
            document.getElementById("conMTP").style.border='2px solid red';
        }

    }
 }
</script>

          
         
         
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</html>