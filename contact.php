<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
	<title>Maël Regnier CV</title>
	<link rel="stylesheet" href="cv.css">
	<script type="text/javascript">
	function validationFormulaire() {
	    var x = document.forms["formContact"]["message_Contact"].value;
	    if (x == null || x == "") {
	        alert("Vous avez oublié d'insérer un message");
	        return false;
	    }
	}
	</script>
</head>
<body>
	<h1>Formulaire de contact</h1>

	<?php
	if (isset($_POST['envoie'])) {
		if (!isset($_POST['message_Contact']) || $_POST['message_Contact']=='') {
			echo('Vous avez oublié d\'ins&eacute;rer un message<br>');
		}
		else{
			// assignation de la varaiable mail si aucune adresse mail renseignée
			if (!isset($_POST['email']) || $_POST['email']=='') {
				$_POST['email']='';
			}
			elseif(isset($_POST['autorisation'])){
				//la valeur $adresseMail prend les information marquer dans l'ongler adresse mail dans le formulaire 
				$adresseMail = $_POST['email'];
				//$db vaut la connextion a la base de donner mysql pas via wamp
				//voici le code pour le faire via wamp
				//$db = new PDO('mysql:host=localhost;dbname=cv;charset=utf8', 'noms d'utilisateur, 'mot de pasee');
				$db = new PDO('mysql:host=exmachinefmci.mysql.db;dbname=exmachinefmci;charset=utf8', 'exmachinefmci', 'carp310M');
				//$result vaut la base de donne qui prepar a marque la commande dans la base de donner
				//insert dans la table regniermail dans la collone adresseMail la valeur adresseMail2
				$result = $db->prepare('INSERT INTO regniermail (adresseMail) VALUES(:adresseMail2)');
				//le $result execute le fait que adresseMail2 vaut $adresseMail
				$result->execute(array('adresseMail2' => $adresseMail));
			}

			$message = 'reponse a votre cv:<br>'.$_POST['message_Contact'];

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
			$headers .= 'From: '.$_POST['email']."\r\n".'Reply-To: '.$_POST['email']."\r\n".'X-Mailer: PHP/' . phpversion();
			
			mail('maelregn9@gmail.com', 'Formulaire de contact Exmachina', $message, $headers);

			// confirmation
			echo('Votre message a bien ete envoyer ;<br>');
		}
	}
	//si le bouton d'envoit est activer
	if(isset($_POST["envoie_desabonnement"])){
		//et que le desabonnement confirme est cocher
		if(isset($_POST["desabonnement_confirme"])){
			$adresseMail_desac=$_POST["desabonnement"];
			//alor ils ce connecte a la base de donner
			$db = new PDO('mysql:host=exmachinefmci.mysql.db;dbname=exmachinefmci;charset=utf8', 'exmachinefmci', 'carp310M');
			//puis ce prepare a suprimer la ligne avec cette adresse mail
			$result = $db->prepare("DELETE FROM `regniermail` WHERE `regniermail`.`adresseMail` ='VALUES(:adresseMail_desac)'");
				// puis met l'adresse mail que l'on a rentre dans le noms de celui que l'on suprime
				$result->execute(array('adresseMail_desac' => $adresseMail_desac));
		}
	}
	?>

	<form name="formContact" onsubmit="return validationFormulaire()" enctype="application/x-www-form-urlencoded" method="post" action="#">
		Nom:<br>
		<input type="text"><br>
		Adresse mail:<br>
		<input type="email" name="email"><br>
		T&eacute;l&eacute;phone:<br>
		<input type="tel"><br>
		Message:<br>
		<textarea id="form-textarea" name="message_Contact"></textarea><br>
		<input type="checkbox" name="autorisation"> Je vous autorise &agrave; conserver ces coordonn&eacute;es<br>
		<input type="submit" name="envoie" value="Envoyer"><br>
		<input type="email" name="desabonnement" value="votre email pour la desinscription">
		<input type="checkbox" name="desabonnement_confirme"> confirmation de la supression
		<input type="submit" name="envoie_desabonnement">
	</form><br>
	
	<a href="index.html">pour retourner vers mon cv</a>

</body>
</html>