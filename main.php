<html>
  <head>
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>A toi de sauver les ampoules !</title>

    <link rel="stylesheet" href="main.css">
  </head>
  <body>

<header>
  <div class= "textee">
    <h1>Ajout ou modifcation d’un changement d’ampoule.</h1>
  </div>

</header>



    <div class ="texte">
    <p>Voir l’historique du changement des ampoules</p>
  </div>

<div class ="resp">

<?php

//accès database
$serveur="localhost";
$login="root";
$pass="";
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

      if( isset($_POST['id']) && isset($_POST['edit'])){
            echo'<h1>Modifier des informations</h1>';
        }else{
            echo'<h1>Une nouvelle ampoule dans la famille ?</h1>';
        }
        //UPDATE
if(isset($_POST['Bouton']) && isset($_POST['id']) && isset($_POST['lieux']) && isset($_POST['etage']) && isset($_POST['prix']) && isset($_POST["date"])) {
    
    // Réecriture des variables
    $id = $_POST['id'];
    $lieux = $_POST['lieux'];
    $etage = $_POST['etage'];
    $prix = $_POST['prix'];
    $date = $_POST['date'];
    $action = $_POST['Bouton'];
    $new_date = date("Y-m-d", strtotime($date));
    echo " " . $action;
    if($action == 'Modifier'){
        // Requête de modification d'enregistrement
      
        $upd = "UPDATE ampoules SET
        Position='{$lieux}',
        Etage='{$etage}',
        Prix='{$prix}',
        Date_chgmt='{$new_date}'
        WHERE id = '{$id}' ";
    echo $new_date;
    $h = $connexion->exec($upd);

        // Exécution de la requête
    }
    if($action == 'Ajouter'){
        $statement = "INSERT INTO ampoules VALUES (NULL, '{$date}', '{$etage}', '{$lieux}',  '{$prix}')";
        $h = $connexion->exec($statement);
        echo "Ceci a fonctionné !";

    }
    if($action == 'Supprimer'){
        $statement = "DELETE FROM ampoules where id = $id";
        $h = $connexion->exec($statement);
        echo "Ceci a fonctionné !";
    }

 }
    
    ?>
    
  <!-- formulaire vide -->

  <div class ="form">
    <div>
        <form action="?" method="POST">

          
            <div class ="formu">
            <input type="text" name="etage" id="etage" placeholder="Etage" value= "<?php if(isset($etage))echo $etage;?>">
            <input type="text" name="lieux" id="lieux" placeholder="lieux" value= "<?php if(isset($lieux))echo $lieux;?>">
            <input type="int" name="prix" id="prix" placeholder="Prix" value= "<?php if(isset($prix))echo $prix;?>">
            <input type="date" name="date" id="date" placeholder="Date" value= "<?php if(isset($date))echo $date;?>">
            </div>
            </div>



            <?php

                    $texteButton = "Ajouter";

            ?>
               

                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                <input type="submit" name='Bouton' value='<?php echo $texteButton; ?>'/>

            </form>


<?php
echo "<h1>AFFICHAGE</h1><hr><br>";
///////////////////////////////////////AFFICHAGE !
     $connexion = new PDO("mysql:host=$serveur;dbname=$db_name",$login,$pass);
     $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     //echo 'Connexion à la base de données réussi';

     $statement = "SELECT * FROM ampoules";
     $h = $connexion->query($statement);
     echo" <center>";
     echo "<table> <tr><th>ID</th><th>Etage</th><th>Lieux</th><th>Prix</th><th>Date</th></tr>";
     while($t = $h->fetch()){
         echo "<form action='main.php' method='POST'>";
         echo "<tr>";
         echo "<td>" . $t['id']."</td>";
         echo "<input type='hidden' name='id' value='".$t['id']."'/>";
         echo '<td><input type="text" name="etage" id="etage" placeholder="Etage" value= "' .$t['Etage'].'"/></td>';
         echo '<td><input type="text" name="lieux" id="lieux" placeholder="Lieux" value= "' .$t['Position'].'"/></td>';
         echo '<td><input type="text" name="prix" id="prix" placeholder="Prix" value= "' .$t['Prix'].'"/></td>';
         $new_date = date("Y-m-d", strtotime($t['Date_chgmt']));
         echo '<td><input type="date" name="date" id="date" value= "' .$new_date.'"/></td>';
         echo "<td><input type='submit' name='Bouton' value='Modifier'/></td>";
         echo "<td><input type='submit' name='Bouton' value='Supprimer'/></td>";
         echo "</tr></form>";
         echo "</center>";
     }

echo "</table><br>";
?>

</div>
    </body>
</html>
