<html>
  <head>
    <div class =texte>
    <title>A toi de sauver les ampoules !</title>
  </div>
    <form name="form1" method="get" action="index.php"></form>
    <link rel="stylesheet" href="main.css">
  </head>
  <body>

<header>
  <div class =texte>
    <h1>Ajout ou modifcation d’un changement d’ampoule.</h1>
  </div>

</header>



    <div class =texte>
    <p>Voir l’historique du changement des ampoules</p>
  </div>
  </body>
</html>



<?php

//accès database
$serveur="localhost";
$login="root";
$pass="";
$db_name="ampoules";


    
    //valeur table
    if(isset($_POST['id']) && $_POST['id'] != ""){
    if(isset($_POST['etage']) && $_POST['etage'] != ""){
        if(isset($_POST['prix']) && $_GET['prix'] != ""){
            if(isset($_POST['lieux']) && $_POST['lieux'] != ""){
                if(isset($_POST['date']) && $_POST['date'] != ""){
                    $date = $_POST["date"];
                    $etage = $_POST["etage"];
                    $lieux = $_POST["lieux"];
                    $prix = $_POST["prix"];
                    $statement = "INSERT INTO historique VALUES (NULL, '{$etage}', '{$prix}', '{$lieux}',  '{$date}')";
                    $h = $connexion->exec($statement);

                }
                else echo "Il semblerait qu'une erreur soit intervenue. <br>";
            }
            else echo "Il semblerait qu'une erreur soit intervenue. <br>";
        }
        else echo "Il semblerait qu'une erreur soit intervenue. <br>";
    }
    else echo "Il semblerait qu'une erreur soit intervenue. <br>";
}

//database
try{
$connexion = new PDO("mysql:host=$serveur;$db_name",$login,$pass);
$connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//echo 'Connexion à la base de données réussi';

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }


?>

<?php
      if( isset($_POST['id']) && isset($_POST['edit'])){
            echo'<h1>Modifier des informations</h1>';
        }else{
            echo'<h1>Une nouvelle ampoule dans la famille ?</h1>';
        }

    
    ?>

  <!-- formulaire vide -->
    <div>
        <form action="" method="post">
            <div>
                <input type="text" name="etage" id="etage" placeholder="Etage" value= " <?php if(isset($etage))echo $etage;?>">
            </div>
            <div>
            <input type="text" name="lieux" id="lieux" placeholder="lieux" value= " <?php if(isset($lieux))echo $lieux;?>">
            </div>
            <div>
                <input type="int" name="prix" id="prix" placeholder="Prix" value= " <?php if(isset($prix))echo $prix;?>">
            </div>
            <div>
                <input type="date" name="date" id="date" placeholder="Date" value= " <?php if(isset($date))echo $date;?>">
            </div>

            <?php
                if( isset ($_POST['id']) && isset($_POST['edit'])){
                    $texteButton = "Modifier";
                }else{
                    $texteButton = "Ajouter";
                }

            ?>

            <div>
                <button type="submit"><?=$texteButton ?></button>
            </div>

            <?php 
                if( isset($_POST['id']) && isset($_POST['edit'])){
            ?>
                    <input type="hidden" name="edit" value="1" />
                    <input type="hidden" name="id" value="<?=$id ?>">
            <?php
                }
            ?>
        </form>
    </div>