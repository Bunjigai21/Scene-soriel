<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Canvas</title>
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="css/dessin.css">
  </head>
  <body>

  <?php
  include_once('header.html'); 

    // Fonction de selection des fichiers suivant les extensions predeterminées avec $extensions
function addphoto($dir,$extensions,$photos=array()){
	
	foreach($extensions as $ext){
		$addphoto = glob($dir . '/*.'.$ext); // selectionne les photos contenues du dossier
		$photos =  array_merge($photos, $addphoto); // ajoute les photos au tableau de resultats
	}
	return $photos;
}

// Fonction de parcours du dossier
function scandir_through($dir,$extensions,$photos=array()){

    $photos = addphoto($dir,$extensions,$photos); // lance la fonction addphoto de selection des photos du dossier (concerne le dossier principal, si il contient pas d'images, tu peux supprimer cette ligne)
	$items = glob($dir . '/*'); // selectionne le contenu de $dir

    for ($i = 0; $i < count($items); $i++) { // parcours du contenu de $dir
        if (is_dir($items[$i])) { // si le contenu est un dossier		
			$photos = addphoto($items[$i],$extensions,$photos); // lance la fonction addphoto de selection des photos du dossier	
			scandir_through($items[$i],$extensions,$photos); // lance la fonction scandir_through pour parcourir le dossier
        }
    }

    return $photos;
}

/*VARIABLES A ADAPTER A TON CAS*/
$dossier_principal='images/saved';//nom du repertoire a lister
$extensions = array('png'); // tableau des extensions d'images a selectionner: Rajouter ou enlever des extensions


foreach(scandir_through($dossier_principal,$extensions) as $key=>$filename){echo '<img src="'.$filename.'"width=120px;></img>';}

?>   
   <?php 
        include_once("footer.html");
        ?>
  </body>
</html>