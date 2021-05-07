<!DOCTYPE html>
<html>
  <head>
    <title>A toi de sauver les ampoules !</title>
    <link rel="stylesheet" href="main.css">
  </head>
  <body>
<header>

  <div class ="Centrer">
    <h1>Historique du changement d'ampoules</h1>
  </div>


</header>

<div class = "Centrer">
    <p>Ajouter ou modifier un changement d’ ampoule.</p>
</div>


  </body>
</html>

<?php include("main.php"); ?>

<?php include("pages.php"); ?>

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
  
  
  
      } catch (PDOException $e) {
          print "Erreur !: " . $e->getMessage() . "<br/>";
          die();
      }


  

//récupération historique qui ne marche pas
 
/*$histori= "SELECT TOP 1 creation_time,
total_worker_time/execution_count AS [Avg CPU Time], 
SUBSTRING(st.text, (qs.statement_start_offset/2)+1,((CASE qs.statement_end_offset WHEN -1 THEN DATALENGTH(st.text)           
ELSE qs.statement_end_offset END - qs.statement_start_offset)/2) + 1) AS statement_text  
FROM sys.dm_exec_query_stats AS qs  
CROSS APPLY sys.dm_exec_sql_text(qs.sql_handle) AS st  
ORDER BY creation_time DESC";
echo $histori;

$t = $connexion->query("SELECT * FROM ampoules");
         while ($histori = $t->fetch()) {
                  echo $histori["id"];    

}*/





//another try avec trigger

/*$trig= "CREATE TRIGGER trigavant
BEFORE UPDATE ON utilisateur FOR EACH ROW
  BEGIN
    SET NEW.version = OLD.version + 1;
    INSERT INTO historique
      (action, date_action, version, nom, id_original)
    VALUES
      ('update', NOW(), OLD.version, OLD.nom, OLD.id);
  END;
  //
delimiter";*/




/*$arch = "SELECT into ampoules 
Lieux= '{$oldlieux}',
Etage='{$oldetage}',
Prix='{$oldprix}',
Date_chgmt='{$old_date}'
WHERE id = '{$oldid}' ";
echo $old_date;
$h = $connexion->exec($arch);




$arr = array();
foreach ($arr as &$value) {
    $value = $oldvalue;
}
unset($value); // Détruit la référence sur le dernier élément
var_dump($arr);
?>

<?php

       /*$t= "CREATE TRIGGER trhistorique 
        AFTER INSERT ON date 
        FOR EACH ROW
        $y= "INSERT INTO $arr
           VALUES  ( id, Date_chmgt, Etage, Lieux, Prix )";
         echo $t;*/

         



         ?>
