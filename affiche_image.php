  <?php

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


foreach(scandir_through($dossier_principal,$extensions) as $key=>$filename){echo '<img class="test" src="'.$filename.'"width=120px;></img>';}

?>   
