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



// On détermine sur quelle page on se trouve
if(isset($_GET['page']) && !empty($_GET['page'])){
    $currentPage = (int) strip_tags($_GET['page']);
}else{
    $currentPage = 1;
}

require_once('index.php');

$sql = 'SELECT COUNT(id) AS nombre FROM ampoules;';

$h = $connexion->query($sql);

$result = $h->fetch();

$nbArticles = (int) $result['nombre'];



// On détermine le nombre d'articles par page
$parPage = 4;

// Calcul du nombre de pages total
$pages = ceil($nbArticles / $parPage);

// Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;
$premier = $premier . "";
$parPage = $parPage . "";
$sql = 'SELECT * FROM ampoules ORDER BY id ASC LIMIT ' . $parPage . ' OFFSET ' . $premier;

// On prépare la requête
$query = $connexion->prepare($sql);

// On exécute
$query->execute();

// tableau associatif
$articles = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lel</title>

</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Liste des pages</h1>
                <table class="table">
                    <thead>
               
                    <ul class="pagination">
                        <!-- Lien vers la page précédente-->
                        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                            <a href="./?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                        </li>
                        <?php for($page = 1; $page <= $pages; $page++): ?>
                          <!-- Lien vers chacune des pages -->
                          <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                                <a href="./?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                            </li>
                        <?php endfor ?>
                          <!-- Lien vers la page suivante-->
                          <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                            <a href="./?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                        </li>
                    </ul>
                </nav>
            </section>
        </div>
    </main>
</body>
</html>
