<html>
<head>
<title>Bienvenue sur l'Application de Steganographie</title>
<link rel="stylesheet" media="screen" type="text/css" title="design" href="stego.css" />
</head>
<body>
<h1>Application De Steganographie</h1>
<h2>Choisissez Une Image</h2>
<form  action="test.php" enctype="multipart/form-data"  method="post" >
<label>Inserer une photo:</label><input type="file" name="photo" /> 
<br/><br/>
<input type="submit" value="cacher le message" name="cacher" /> <input type="submit" value="afficher le message" name="afficher" />  
</form> 
</body>
</html>