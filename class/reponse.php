<?php
/* Mon premier commentaire */

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
	
/* Generation de la page en html */
	function printHeader()
	{
		echo "<head>";
		echo "\n";
		echo '<meta charset="UTF-8"/>';
		echo "\n";
		echo "</head>";
		echo "\n";
	}
	
	{
		echo "<!DOCTYPE html>";
		echo "\n";
		echo '<html lang="fr">';
		echo "\n";
	}
	function printPersonne($nom,$prenom,$mail,$ville,$cp,$telephone)	
	{	
		echo "<body>";
		echo "\n";
		echo $nomVar=$_POST["nominput"]; echo "\n";
		echo "<br>"; echo "\n";
		echo $prenomVar=$_POST["prenominput"]; echo "\n";
		echo "<br>"; echo "\n";
		echo $mailVar=$_POST["mailinput"]; echo "\n";
		echo "<br>"; echo "\n";
		echo $villeVar=$_POST["villeinput"]; echo "\n";
		echo "<br>"; echo "\n";
		echo $cpVar=$_POST["cpinput"]; echo "\n";
		echo "<br>"; echo "\n";
		echo $telephoneVar=$_POST["telephoneinput"]; echo "\n";
		echo "<br>"; echo "\n";
		echo "</body>"; echo "\n";
	}	
		printHeader();
		
		printPersonne($nomVar,$prenomVar,$mailVar,$villeVar,$cpVar,$telephoneVar);
	
		
		echo "</html>";
		echo "\n";
		