<!DOCTYPE html>
<html lang="fr">
	<!-- Tout document HTML est donc constitué d'un élément head et body -->
		<head>
		<!-- On ajoute une balise meta pour specifier le jeu de caractères -->
		<meta charset="UTF-8" />
		<!-- le titre de la page -->
		<title>Résultat !</title>

	
	<?php
	require "./Personne.php";
		$image = imagecreatefromjpeg(file_get_contents('./Images/SpaceHD/Réacteur fusée.jpeg'));
			imagefill($image, 0, 0, imagecolorallocate($image, 255, 255, 255));
			imagejpeg($image, 'Réacteur fusée.jpeg');
	
	/* Initialisation des parametres*/
	
		$nomVar="";
	
		if(isset($_POST["nominput"])) {
			$nomVar=$_POST["nominput"];
		}
		
		$prenomVar="";
	
		if(isset($_POST["prenominput"])) {
			$prenomVar=$_POST["prenominput"];	
		}
	
		$mailVar="";
	
		if(isset($_POST["mailinput"])) {
			$mailVar=$_POST["mailinput"];
		}
		
		$villeVar="";
	
		if(isset($_POST["villeinput"])) {
			$villeVar=$_POST["villeinput"];
		}
		
		$cpVar="";
	
		if(isset($_POST["cpinput"])) {
			$cpVar=$_POST["cpinput"];
		}
		
		$telephoneVar="";
	
		if(isset($_POST["telephoneinput"])) {
			$telephoneVar=$_POST["telephoneinput"];
		}
		
		$utilisateur = new Personne($nomVar,$prenomVar,$mailVar,$villeVar,$cpVar,$telephoneVar);
		
		/*$utilisateur->nom = $nomVar;*/
		$utilisateur->setNom("");
		$utilisateur->setPrenom("");
		$utilisateur->setMail("");
		$utilisateur->setVille("");
		$utilisateur->setCp("");
		$utilisateur->setTelephone("");
	?>
		</head>
		<body>
			<h1>Résultat du Formulaire</h1>
			Nom: <?php echo $nomVar['nom']; ?> <br>
			Nom (objet):<?php echo $utilisateur->getNom(); ?><br>
			
			Prénom: <?php echo $prenomVar['prenom']; ?> <br>
			Prénom (objet):<?php echo $utilisateur->getPrenom(); ?><br>
			
			Mail: <?php echo $mailVar['mail']; ?> <br>
			Mail (objet):<?php echo $utilisateur->getMail(); ?><br>
			
			Ville: <?php echo $villeVar['ville']; ?> <br>
			Ville (objet):<?php echo $utilisateur->getVille(); ?><br>
			
			CP: <?php echo $cpVar['cp']; ?> <br>
			CP (objet):<?php echo $utilisateur->getCp(); ?><br>
			
			Téléphone: <?php echo $telephoneVar['telephone']; ?><br>
			Telephone (objet):<?php echo $utilisateur->getTelephone(); ?><br>
		
		</body>
	</html>
		