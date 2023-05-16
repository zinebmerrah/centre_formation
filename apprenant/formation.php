<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
          <link rel="stylesheet" href="formations.css">
          <title>Foramtions</title>
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
<div class="row row-cols-1 row-cols-md-2 g-4">

<?php 
                    include "connect.php";
                    $formation = $conn->query('SELECT * FROM formation');
                    $formations = $formation->fetchAll();

                    foreach($formations as $row){
                        $id = $row["id_formation"];
                              echo '<div class="card mb-2" style="max-width: 650px;">
                              <div class="row g-0">
                                        <div class="col-md-4">
                                                  <a href="sessions.php?id='.$id.'" ><img src="img/'.$row['image'].'"  style="height: 200px; class="img-fluid rounded-start" alt="..."></a>
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
          ?>
      </div>
      
      
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</html>