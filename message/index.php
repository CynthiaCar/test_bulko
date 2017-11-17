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
		<div class="container" style="background-color:#fff;">
			<?php
// SI ON VISUALISE UN MESSAGE
			if (isset($_GET['id'])) {
				$id=$_GET['id'];
				?>
				<p>Contactez-nous</p>
				<div class="form-part-1">
					<?php
// RECUPERATION DES DONNEES DE LA TABLE MESSAGE
					$reponse = $bdd->query("SELECT * FROM message WHERE id=$id");
// AFFICHAGE DE CHAQUE ENTREE
					while ($donnees = $reponse->fetch())
					{
						?>
						<div class="form-control">
							<input type="text" name="nom" placeholder="<?php echo $donnees['nom']; ?>"/>
						</div>
						<div class="form-control">
							<input type="email" name="email" placeholder="<?php echo $donnees['email']; ?>"/>
						</div>
						<div class="form-control">
							<input type="tel" name="tel" placeholder="<?php echo $donnees['tel']; ?>"/>
						</div>
					</div>
					<div class="form-part-2">
						<div class="form-control">
							<textarea name="message" placeholder="<?php echo $donnees['message']; ?>"></textarea>
						</div>
						<?php
					}
					?>
				</div>
				<?php
// SI AUCUN MESSAGE N'EST SELECTIONNE
			}else{
				?>
				<table>
					<thead>
						<tr>
							<td>Id</td>
							<td>Nom</td>
							<td>Email</td>
							<td>Tel</td>
							<td>Message</td>
						</tr>
					</thead>
					<tbody>
						<?php
// RECUPERATION DES DONNEES DE LA TABLE MESSAGE
						$reponse = $bdd->query("SELECT * FROM message");
// AFFICHAGE DE CHAQUE ENTREE
						while ($donnees = $reponse->fetch())
						{
							?>
							<div class="autresMessages">
								<a href="index.php?id=<?php echo $donnees['id']; ?>">
									<?php echo $donnees['id']; ?>
								</a>
							</div>
							<tr>
								<td>
									<a href="index.php?id=<?php echo $donnees['id']; ?>">
										<?php echo $donnees['id']; ?>
									</a>
								</td>
								<td>
									<a href="index.php?id=<?php echo $donnees['id']; ?>"><?php echo $donnees['nom']; ?>
									</a>
								</td>
								<td>
									<?php echo $donnees['email']; ?>
								</td>
								<td>
									<?php echo $donnees['tel']; ?>
								</td>
								<td>
									<?php echo $donnees['message']; ?>
								</td>
							</tr>
							<?php
						}
					}
// FIN DE TRAITEMENT DE LA REQUETE
					$reponse->closeCursor(); 
					?>
				</tbody>
			</table>
		</div>
	</main>
	<footer>
		<p>© Bulko - 2017<br>🦄  GLHF</p>
	</footer>
</body>
</html>