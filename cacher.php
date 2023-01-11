<?php

if ( isset ($_POST['message']) and !empty($_POST['message']) and isset ($_POST['image']) ){
	$message = $_POST['message'];
	$lien = $_POST['image'];
	$octet_decoupe = array();
	$message .= chr(26);
	$f_image = fopen($lien, 'r+b'); 
	fseek($f_image, 54); 
	for($i=0;$i<strlen($message);$i++){
        $caractere = $message[$i];
        $valeur_octet = ord($caractere);
		$octet_binaire = decbin($valeur_octet);
		$octet_binaire = str_pad($octet_binaire, 8, '0', STR_PAD_LEFT);
		$octet_decoupe = str_split($octet_binaire, 2);
		foreach($octet_decoupe AS $partie_octet){  
			$octet_image = fread($f_image, 1); 
			$octet_image = ord($octet_image); 
			$octet_image -= $octet_image%4; 
			$partie_octet = bindec($partie_octet); 
			$octet_image += $partie_octet; 
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