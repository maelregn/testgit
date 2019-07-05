<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
	<title>Maël Regnier CV</title>
	<link rel="stylesheet" href="cv.css">
</head>
<body>
	<h1>desabonnement</h1>

	<?php
	
	if($_GET['email']){
		$adresseMail = $_GET['email'];
		//$db = new PDO('mysql:host=localhost;dbname=cv;charset=utf8', 'root', 'root');
		$db = new PDO('mysql:host=exmachinefmci.mysql.db;dbname=exmachinefmci;charset=utf8', 'exmachinefmci', 'carp310M');

		$selectall = $db->query('SELECT * FROM regniermail WHERE adresseMail="'.$adresseMail.'"');
        $result = $selectall->fetch();
        $counttable = (count($result));

        if($counttable >= 1){
            $delete = $db->prepare('DELETE FROM regniermail WHERE adresseMail="'.$adresseMail.'"');
            $delete->execute();
        }

		// confirmation de suppresion
		echo('Votre &ecirc;tes bien desabonn&eacute; de notre liste de diffusion');
		}
		echo("<a href='index.html'>pour retourner vers mon cv</a> <br> <a href='contact'>pour retourner vers ma page de contacte</a>");
	?>
	<form>
		
	</form>
</body>
</html>