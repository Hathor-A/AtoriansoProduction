<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
		<title>Une petite gallerie d'images</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body style="background-image: url('./Images/fond jaune creatif.jpeg')">
	<button onclick="scrollToTop()" id="btnScrollToTop" title="Remonter en haut de la page">&#8593</button>
	<script>
        window.onscroll = function() { scrollFunction() };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("btnScrollToTop").style.display = "block";
            } else {
                document.getElementById("btnScrollToTop").style.display = "none";
            }
        }

        function scrollToTop() {
            document.body.scrollTop = 0; // Pour les anciens navigateurs
            document.documentElement.scrollTop = 0; // Pour les nouveaux navigateurs
        }
    </script>	
	<center><h2> L'index de toute mes pages </h2>
		<p>
			<form action="./index.html" method="GET">
				  <input type="submit" value="Index">
				</form>
		</p>
		<p>
		<center><form action="https://www.google.com/search" method="GET" target="_blank">
			<input type="search" name="q" placeholder="Recherche Google">
			<input type="submit" value="Go!">
		</form></center>
		</p>
		<h1>Liste du contenu du répertoire image: </h1>
		
		<img src="./Images/Moi.jpeg" alt="Mon Moi" title="Moi" height="320"/>
		
		<?php
			chdir("Images");
			
			$Images = glob("*.jpeg");
			
			echo "<pre>_n";
			echo "Images:\n";
			var_dump($images);
			echo "</pre>_n";
			
			echo "<table>\n";
			echo "<tbody>\n";
			
			$nu_Images = 1;
			/* La boucle fatale !!! */
			foreach ($images as $idx) {
				if ($nu_images  == 1)
					echo "<tr>\n";
						/* Affichage de l'image */
			?>
			
			<br>
			<td>
			<figure>
			<img src='./Images/<?php echo $idx;?>'
				alt='Moi' title='Moi'
				style='height: 250px; width: 350px; 
						border: 5px solid black; 
						padding: 5px'
				/>
			<strong><figcaption><?php echo $idx; ?></figcaption></strong>
			</figure>			
			<?php
			
				echo "<br>Numero Images: ";
				echo $nu_Images;
				echo "\n";
				echo "<td>\n";
				
				if ($nu_Images % 2 == 0)
					echo "<tr>\n";
					
				$nu_image = $nu_Images + 1;
				
			}		
			echo "</tbody>\n";
			echo "</table>\n";
		?>	
	</body>
		<footer>
			<center><p>©Copyright 2023 by Atorianzo. All rights reversed.<br></center>
		</footer>
</html>