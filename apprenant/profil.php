<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="formations.css">
    <title>Document</title>
</head>
<body>
    <?php 
    session_start();
    $id_apprenant = $_SESSION['id_apprenant'];
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
    $email = $_SESSION['email'];
    ?>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
        <a class="navbar-brand" href="acceuil.php"><img src="img/centre_de_formation.png" style="width:35%" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="acceuil.php">Acceuil</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="formation.php">formations</a>
                </li>

            </ul>
            <div class="d-flex me-5">
                              
                               <button class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#exampleModal" id="btn_acceuil"  type="submit">modifier mon profil</button>
                               <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="profil.php" >
                                                <div class="row mb-4">
                                                    <label class="form-label text-secondary" for="form3Example1c">Nom: <span class="text-danger">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="nom" id="form3Example1c" value="<?php echo $nom?>" class="form-control" />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                <label class="form-label text-secondary" for="form3Example1c">Prénom: <span class="text-danger">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="prenom" value="<?php echo $prenom?>" id="form3Example1c" class="form-control" />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                <label class="form-label text-secondary" for="form3Example1c">Email: <span class="text-danger">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="email" value="<?php echo $email?>" id="form3Example1c" class="form-control" />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                <label class="form-label text-secondary" for="form3Example1c">Mot de passe: <span class="text-danger">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="password" id="form3Example1c" class="form-control" />
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                <label class="form-label text-secondary" for="form3Example1c">Confirmer le mot de passe: <span class="text-danger">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="confirmer" id="form3Example1c" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                <a href="acceuil.php" class="btn btn-primary" id="btn_retour">retour</a>
                                                    <button type="submit" name="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                                </div>
                                            </form>
                                        </div>
                                        
                                        </div>
                                    </div>
                                </div>
                                 
                              <form action="deconnecter.php" method ="GET">
                                    <button class="btn btn-outline" id="btn_acceuil" name ="deconnecter" type="submit">se déconnecter</button>
                              </form>
                        </div>
            
            </div>
        </div>
    </nav>
       

        <h3>Mes formations</h3>
        <?php
                    include "connect.php";
                    $session = $conn->query("SELECT * FROM formation F INNER JOIN session S on F.id_formation = S.id_formation INNER JOIN apprenant_session ASS ON S.id_session = ASS.id_session WHERE ASS.id_apprenant = '$id_apprenant';
                    ");
                    $sessions = $session->fetchAll();
                    foreach($sessions as $row){
                       
                        $id = $row['id_formation'];
                              echo '<div class="card mb-3" style="max-width: 540px;">
                              <div class="row g-0">
                                        <div class="col-md-4">
                                                  <a href="sessions.php?id='.$id.'" ><img src="img/'.$row['image'].'" class="img-fluid rounded-start" alt="..."></a>
                                        </div>
                                        <div class="col-md-8">
                                                  <div class="card-body">
                                                            <h5 class="card-title">'.$row['sujet'].'</h5>
                                                            <p class="card-text">'.$row['description'].'</p>
                                                            <p class="card-text"><small class="text-body-secondary">masse horaire : '.$row['masse_horaire'].'h</small></p>
                                                  </div>
                                                  
                                        </div>
                              </div>
                    </div>';
                    }



                    include "connect.php";
                    if(isset($_POST["submit"])){
                          $nom = $_POST['nom'];
                          $prenom = $_POST['prenom'];
                          $email = $_POST['email'];
                          $mot_de_passe = $_POST['password'];
                          $confrim = $_POST['confirmer'];

                           $_SESSION['nom'] = $_POST['nom'];
                           $_SESSION['prenom'] = $_POST['prenom'];
                           $_SESSION['email'] = $_POST['email'];
          
                          $sql = "UPDATE `apprenant` SET `nom`='$nom',`prenom`='$prenom',`email`='$email',`mot_de_passe`='$mot_de_passe' WHERE id_apprenant = '$id_apprenant'";
                          $conn->exec($sql);
                          if($conn == true){

                            
                              header("Location: profil.php");
                              exit();
                          }else{
                                    $msgvalider= "vous avez une problème";
                          }
          
                          
                    }
        ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</html>