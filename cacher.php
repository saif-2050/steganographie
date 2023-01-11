<?php

if ( isset ($_POST['message']) and !empty($_POST['message']) and isset ($_POST['image']) ){
	$message = $_POST['message']; // votre message 
	$lien = $_POST['image']; // votre image 
	$octet_decoupe = array(); // declarartion d ' un tableau
	$message .= chr(26); // concatener notre message avec un caractere specifique
	$f_image = fopen($lien, 'r+b'); // lire note image sous la forme binaire
	fseek($f_image, 54); // deplacer le pointeur vers la position 54 
	for($i=0;$i<strlen($message);$i++){  // boucle for de 0 jusqu a la longeur de notre message
        $caractere = $message[$i];      // chaque caractere de notre message
        $valeur_octet = ord($caractere); // convertir vers code ascii de chaque caractere
		$octet_binaire = decbin($valeur_octet); // valeur_octet convertir vers code binaire 
		$octet_binaire = str_pad($octet_binaire, 8, '0', STR_PAD_LEFT); //ajouter des 0 dans le partie gauche du code binaire jusqu a la longeur deviant 8 exemple : 00011111
		$octet_decoupe = str_split($octet_binaire, 2); // diviser le code binaire en deux caractere :  00 01 11 11
		foreach($octet_decoupe AS $partie_octet){  
			$octet_image = fread($f_image, 1); // lire une seul bit depuis l'image
			$octet_image = ord($octet_image); // convertir vers code ascii 
			$octet_image -= $octet_image%4; // x=x-x%4
			$partie_octet = bindec($partie_octet);  // convertir du binaire vers decimale
			$octet_image += $partie_octet; // a chaque fois concatener le code decimale avec code de l'image
			fseek($f_image, -1, SEEK_CUR); 
			fputs($f_image, chr($octet_image)); 
		}
	}
	fclose($f_image);
	?>
	<html>
	<head>
	<title>Operation Cacher Message</title>
	<link rel="stylesheet" media="screen" type="text/css" title="design" href="stego.css" />
	</head>
	<body>
	<h1>Application De Steganographie</h1>
	<p>Votre Message A Ete Inserer Dans l'Image Avec Succes !!!</p>
	<a href="index.php"><button>Page D'Acceuil</button></a>
	</body>
	</html>
	<?php
} else { header('location:index.php?'); exit;}

?>