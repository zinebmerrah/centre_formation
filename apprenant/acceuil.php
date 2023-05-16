<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
          <link rel="stylesheet" href="formations.css">
          <title>Acceuil</title>
</head>
<body>
<?php 
      session_start();

      if (!isset($_SESSION['email'])) {
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
                                    <form role="search" action="inscrire.php" method="POST">
                                          <button class="btn btn-outline" id="btn_acceuil" type="submit">S'inscrire</button>
                                    </form>
                                    <form action="connection.php">
                                          <button class="btn btn-outline" id="btn_acceuil" type="submit">se connecter</button>
                                    </form>
                        </div>
            
            </div>
        </div>
    </nav>
<?php 
      }else{
           

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
                              <form action="profil.php">
                                    <button class="btn btn-outline" id="btn_acceuil"  type="submit">profil</button>
                              </form>    
                              <form action="deconnecter.php" method ="GET">
                                    <button class="btn btn-outline" id="btn_acceuil" name ="deconnecter" type="submit">se déconnecter</button>
                              </form>
                        </div>
            
            </div>
        </div>
    </nav>
<?php }
 ?>
            


          
          <section id="image">
                    
                    <p> connectez-vous pour profitez de notre progammes </p>
                    
          </section>
          
                    <h3>Nos formation pour ce mois</h3>

                    <div class="container-fluid">
                    <form class="d-flex" method="post" role="search">
                    
                        <label class="pb-2" for="date_debut">date début:</label>
                        <input type="date" id="date_debut" name="date_debut" class="form-control form-control-lg form-control-a" style="width: 50%;">
                        <label class="pb-2" for="date_fin">date fin:</label>
                        <input type="date" id="date_fin" name="date_fin" class="form-control form-control-lg form-control-a" style="width: 50%;">

               
                                    <label class="pb-2" for="categorie">categorie</label>
                                    <select class="form-control form-select  form-control-a" name="categorie" id="Type">
                                    <option selected></option>
                                    <option value="Informatique">Informatique</option>
                                    <option value="Langue">Langue</option>
                                    <option value="Communication">Communication</option>
                              
                                    </select>
                        
                        
                  
                      <button class="btn" id="btn_search" name="recherche" type="submit">recherche</button>
                    </form>
                   
                    
                  </div>
                 
                 
          
          <?php 
                    include "connect.php";
                    if(isset($_POST['recherche'])){
                        $date_debut = $_POST['date_debut'];
                        $date_fin = $_POST['date_fin'];
                        $categorie = $_POST['categorie'];

                        $formation = $conn->query('SELECT * FROM formation F INNER JOIN session S ON F.id_formation = S.id_formation WHERE month(S.date_debut) = month(CURRENT_DATE()) GROUP BY S.id_formation');

                        if(!empty($categorie)){

                              $formation = $conn->query("SELECT * FROM formation WHERE categorie = '$categorie'");
                        }elseif(!empty($date_debut)){

                              $formation = $conn->query("SELECT * FROM formation F INNER JOIN session S on F.id_formation = S.id_formation WHERE S.date_debut = '$date_debut'");
                        }elseif(!empty($date_fin)){

                              $formation = $conn->query("SELECT * FROM formation F INNER JOIN session S on F.id_formation = S.id_formation WHERE S.date_fin = '$date_fin'");
                        }elseif(!empty($date_debut) &&  !empty($date_fin)){

                              $formation = $conn->query("SELECT * FROM formation F INNER JOIN session S on F.id_formation = S.id_formation WHERE S.date_debut = '$date_debut' AND S.date_fin = '$date_fin'");
                        }

                        $formations = $formation->fetchAll();

                        foreach($formations as $row){
                              $id = $row["id_formation"];
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
                    }else{
                    $formation = $conn->query('SELECT * FROM formation F INNER JOIN session S ON F.id_formation = S.id_formation WHERE month(S.date_debut) = month(CURRENT_DATE()) GROUP BY S.id_formation');
                    $formations = $formation->fetchAll();

                    foreach($formations as $row){
                        $id = $row["id_formation"];
                              echo '<div class="card  mb-3" style="max-width: 540px;">
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
                    </div>
                    '
                    ;
                    }
            
                  }
          ?>

                  
                  <div id="cat">
                        <h3>Nos categories</h3>
                        <p>Informatique</p>
                        <p>ressource humaine</p>
                        <p>langues</p>
                        <p>communication</p>

                  </div>
          
          <h3>Nos formateurs</h3>
          <div id="formateur">
            <?php 
                  $formateur = $conn->query('SELECT * FROM formateur');
                  $formateurs = $formateur->fetchAll();

                  foreach($formateurs as $ligne){
                  echo '
                  <div class="card" style="width: 18rem;">
                        <div class="card-body">
                        <p class="card-text">'.$ligne['nom'].' '.$ligne['prenom'].'</p>
                        <p class="card-text">'.$ligne['description'].'</p>
                        </div>
                  </div>';
                  }
            ?>
                  
                  
                  
          </div>

</body>
<footer>
      2023@copyright
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</html>