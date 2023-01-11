<?php

if ( isset ($_GET['image'])) {
	$lien = $_GET['image'];
	$tampon = "";
	$message = "";
	$f_image = fopen($lien, 'rb'); 
	fseek($f_image, 54); 
	while(!feof($f_image)){
		$octet_image = fread($f_image, 1);
		$octet_image = ord($octet_image); 
		$bits_pf = $octet_image%4;
		$bits_pf = decbin($bits_pf); 
		$bits_pf = str_pad($bits_pf, 2, '0', STR_PAD_LEFT); 
		$tampon .= $bits_pf; 
		if(strlen($tampon) == 8){
			$tampon = bindec($tampon); 
			if($tampon == 26){
?>
				<html>
				<head>
				<title>Operation Cacher Message</title>
				<link rel="stylesheet" media="screen" type="text/css" title="design" href="stego.css" />
				</head>
				<body>
				<h1>Application De Steganographie</h1> 
				<p> 
				<form>
				<?php if (strlen($message) < 50){ ?> 
				<label>LE MESSAGE CACHE EST: </label><?php echo ('<h3><font color="red">'.$message.'</font></h3>') ;?>
				<?php } else { ?>
				<textarea rows="5" cols="40">Il N'Y A PAS DE MESSAGE CACHE</textarea> 
				<?php } ?>
				</form>
				</p>	
				<a href="index.php"><button>Page D'Acceuil</button></a>
				</body>
				</html>
				<?php return;
			} 
		$message .= chr($tampon); 
		$tampon = "";
		} 
	} 
} else { header('location:index.php?'); exit; }

?>