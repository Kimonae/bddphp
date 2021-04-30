<html>
  <head>
    <title>A toi de sauver les ampoules !</title>
    <?php // <form name="form1" method="get" action="index.php"></form> 
    ?>
    <link rel="stylesheet" href="main.css">
  </head>
  <body>

<header>
  <div class='texte'>
    <h1>Ajout ou modifcation d’un changement d’ampoule.</h1>
  </div>

</header>



    <div class =texte>
    <p>Voir l’historique du changement des ampoules</p>
  </div>


<?php

//accès database
$serveur="localhost";
$login="root";
$pass="dada";
$db_name="ampoules";

//database
try{
    $connexion = new PDO("mysql:host=$serveur;dbname=$db_name",$login,$pass);
    $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo 'Connexion à la base de données réussi';
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    //valeur table
    if(isset($_GET['id']) && $_GET['id'] != ""){
    if(isset($_GET['etage']) && $_GET['etage'] != ""){
        if(isset($_GET['prix']) && $_GET['prix'] != ""){
            if(isset($_GET['lieux']) && $_GET['lieux'] != ""){
                if(isset($_GET['date']) && $_GET['date'] != ""){
                    $date = $_GET["date"];
                    $etage = $_GET["etage"];
                    $lieux = $_GET["lieux"];
                    $prix = $_GET["prix"];
                    $statement = "INSERT INTO ampoules VALUES (NULL, '{$date}', '{$etage}', '{$lieux}',  '{$prix}')";
                    $h = $connexion->exec($statement);
                    echo "Ceci a fonctionné !";

                }
                else echo "Il semblerait qu'une erreur soit intervenue. <br>";
            }
            else echo "Il semblerait qu'une erreur soit intervenue. <br>";
        }
        else echo "Il semblerait qu'une erreur soit intervenue. <br>";
    }
    else echo "Il semblerait qu'une erreur soit intervenue. <br>";
}
      if( isset($_POST['id']) && isset($_POST['edit'])){
            echo'<h1>Modifier des informations</h1>';
        }else{
            echo'<h1>Une nouvelle ampoule dans la famille ?</h1>';
        }

    
    ?>

  <!-- formulaire vide -->

  <div class ="form">
    <div>
        <form action="?" method="GET">

          

            <input type="text" name="etage" id="etage" placeholder="Etage" value= "<?php if(isset($etage))echo $etage;?>">
            <input type="text" name="lieux" id="lieux" placeholder="lieux" value= "<?php if(isset($lieux))echo $lieux;?>">
            <input type="int" name="prix" id="prix" placeholder="Prix" value= "<?php if(isset($prix))echo $prix;?>">
            <input type="date" name="date" id="date" placeholder="Date" value= "<?php if(isset($date))echo $date;?>">
       
           
            <?php
                if( isset ($_GET['id']) && isset($_GET['edit'])){
                    $texteButton = "Modifier";
                }else{
                    $texteButton = "Ajouter";
                }

            ?>
               
           
    
            <?php 
                if( isset($_GET['id']) && isset($_GET['edit'])){
            ?>
                    <input type="hidden" name="edit" value="1" />
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
            <?php
                }else{
                    echo '<input type="hidden" name="id" value="123">';
                }
                
            ?>
             <div>
                <input type="submit" value='<?php echo $texteButton; ?>'/>
            </div>

                  
</form>
    </div>

    </body>
</html>
