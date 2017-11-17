<?php
try
{
// CONNEXION BDD
	$bdd = new PDO('mysql:host=localhost;dbname=test_bko;charset=utf8', 'root', '');
}
catch(Exception $e)
{
// SI ERREUR, AFFICHAGE ERREUR ET ARRET
	die('Erreur : '.$e->getMessage());
}
if (isset($_POST['nom'])) {
// DELARATIION VARIABLES
	$nom=$bdd->quote($_POST['nom']);
	$email=$bdd->quote($_POST['email']);
	$tel=$bdd->quote($_POST['tel']);
	$message=$bdd->quote($_POST['message']);
// AJOUT TABLE MESSAGE
	$bdd->query("INSERT INTO `message`(`nom`, `email`, `tel`, `message`) VALUES ($nom,$email,$tel,$message)");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>TestBulko - 2017</title>
	<meta name="viewport" content="user-scalable=no, initial-scale = 1, minimum-scale = 1, maximum-scale = 1, width=device-width">
	<link rel="icon" type="image/vnd.microsoft.icon" href="http://www.bulko.net/templates/img/favicon.ico" />
	<link rel="shortcut icon" type="image/x-icon" href="http://www.bulko.net/templates/img/favicon.ico" />
	<link rel="stylesheet" href="https://cdn.bootcss.com/meyer-reset/2.0/reset.min.css">
	<link rel="stylesheet" href="../asset/css/styles.css">
<!-- UTILISATION DE JQUERY -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type="text/javascript">
		$(function() {
			// VERIFICATION DE L'EMAIL
			$("#email").keyup(function(){
				// FORMAT DU MAIL
				if(!$("#email").val().match(/^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/)){
					$("#email").next(".form-error").show().text("Ceci n'est pas une adresse email");
				}else{
					//QUAND LE MAIL EST CORRECT, L'ERREUR S'EFFACE
					$("#email").next(".form-error").hide().text("");
				}
			});
			// VERIFICATION DU TELEPHONE
			$("#tel").keyup(function(){
				// FORMAT DU TELEPHONE
				if(!$("#tel").val().match(/^(0)[1-9][0-9]{8}$/)){
					$("#tel").next(".form-error").show().text("Le format téléphone n'est pas valide.");
				}
				else{
					//QUAND LE TELEPHONE EST CORRECT, L'ERREUR S'EFFACE
					$("#tel").next(".form-error").hide().text("");
				}
			});
		});
	</script>
</head>
<body>
	<header>
		<div class="wrapper">
			<a class="logo-bulko" href="http://www.bulko.net/" title="Logo Agence Bulko"><img src="../asset/img/logoBulko.png" alt="Logo Agence Bulko" ></a>
			<a class="logo-github" href="https://github.com/Bulko/test-dev-bulko/blob/master/README.md" title="Lire les consignes" target="_blank" rel="noopener">
				<img src="../asset/img/github-icon.png" alt="Logo github">README.md
			</a>
		</div>
	</header>
	<main>
		<!-- <div class="form-ok">Pour votre message de validation de formulaire</div> -->
		<!-- <div class="form-error">Pour votre message d'erreur</div> -->
		<form method="post" action="traitement.php">
			<p>Contactez-nous</p>
			<div class="form-part-1">
				<div class="form-control">
					<input type="text" name="nom" placeholder="Nom"/>
				</div>
				<div class="form-control">
					<input type="email" name="email" placeholder="Email *" id="email" />
					<div class="form-error"></div>
				</div>
				<div class="form-control">
					<input type="tel" name="tel" placeholder="Téléphone *" id="tel" />
					<div class="form-error"></div>
				</div>
			</div>
			<div class="form-part-2">
				<div class="form-control">
					<textarea name="message" placeholder="Message"></textarea>
				</div>
				<input type="submit" value="Envoyer" id="envoyer" name="envoi"/>
			</div>
		</form>
	</main>
	<footer>
		<p>© Bulko - 2017<br>🦄  GLHF</p>
	</footer>
</body>
</html>