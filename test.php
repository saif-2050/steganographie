<?php

if (isset ($_POST['cacher']) ) {
	if (isset($_FILES['photo']) AND $_FILES['photo']['error'] == 0 AND $_FILES['photo']['size'] <= 7000000){
        $infosfichier = pathinfo($_FILES['photo']['name']);
        $extension_upload = $infosfichier['extension'];
        $extensions_autorisees = array('jpg', 'jpeg', 'png' ,'bmp','JPEG');
        if (in_array($extension_upload, $extensions_autorisees)){
            $jour = date('d');
			$mois = date('m');
			$annee = date('Y');
			$heure = date('H');
			$minute = date('i');
			$debnom = $jour.'-'.$mois.'-'.$annee.'_'.$heure.'h'.$minute;
			$extension_upload='bmp';
			$_FILES['photo']['name']= $debnom.'.'.$extension_upload;
            move_uploaded_file($_FILES['photo']['tmp_name'], 'photos/'.$_FILES['photo']['name']);
        }
    } else {header('location:index.php'); exit;	}
	$image = 'photos/'.$_FILES['photo']['name'];  
	?>
	<html>
	<head>
	<title>Operation Cacher Message</title>
	<link rel="stylesheet" media="screen" type="text/css" title="design" href="stego.css" />
	</head>
	<body>
	<h1>Application De Steganographie</h1>
	<h2>Entrer le Message A Cacher Dans L'Image</h2>
    <form  action="cacher.php" enctype="multipart/form-data"  method="post" >
    <label>Taper le Message: </label><textarea name="message" rows="5" cols="40">saisissez votre message ici !!!</textarea> 
	<input type="hidden" name="image" value="<?php echo $image; ?>" />
	<br/><br/>
	<input type="submit" value="envoyer le message" />   
	</form> 
	</body>
	</html>
	<?php
	exit;
}

if (isset ($_POST['afficher']) ) {
	if (isset($_FILES['photo']) AND $_FILES['photo']['error'] == 0 AND $_FILES['photo']['size'] <= 7000000){
		$infosfichier = pathinfo($_FILES['photo']['name']);
        $extension_upload = $infosfichier['extension'];
        $extensions_autorisees = array('bmp');
        if (in_array($extension_upload, $extensions_autorisees)){
			move_uploaded_file($_FILES['photo']['tmp_name'], 'photos/'.$_FILES['photo']['name']);	
            $image = 'photos/'.$_FILES['photo']['name'];
        } else {header('location:index.php'); exit;	}
	header('location:afficher.php?image='.$image.' ');
	exit;				        
	} else {header('location:index.php'); exit;	}
}	
header('location:index.php');
exit;

?>