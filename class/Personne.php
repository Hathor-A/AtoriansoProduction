<?php
/* Déclaration de la classe personne*/
		class Personne {
			private string $nom;
			private string $prenom;
			private string $mail;
			private string $ville;
			private string $cp;
			private string $telephone;
			
			function __construct(string $n="Doe", string $p="John", string $m="atorianso_prod@hotmail.fr", string $v="Lyon", string $c="69002", string $t="06.50.60.80.00"){
				$this->nom = $n;
				$this->prenom = $p;
				$this->mail = $m;
				$this->ville = $v;
				$this->cp = $c;
				$this->telephone = $t;
				}
			public function setNom(string $name){
				$this->nom=$name;
				}
			
			public function getNom(): string {
				return $this->nom;
		}
			public function setPrenom(string $name){
				$this->prenom=$name;
				}
			
			public function getPrenom(): string {
				return $this->prenom;
		}
			public function setMail(string $name){
				$this->mail=$name;
				}
			
			public function getMail(): string {
				return $this->mail;
		}
			public function setVille(string $name){
				$this->ville=$name;
				}
			
			public function getVille(): string {
				return $this->ville;
		}
			public function setCp(string $name){
				$this->cp=$name;
				}
			
			public function getCp(): string {
				return $this->cp;
		}
			public function setTelephone(string $name){
				$this->telephone=$name;
				}
			
			public function getTelephone(): string {
				return $this->telephone;
		}
		
		}
		/***$image = imagecreatefromjpeg('./Réacteur fusée.jpeg');
			imagefill($image, 0, 0, imagecolorallocate($image, 255, 255, 255));
			imagejpeg($image, 'Réacteur fusée.jpeg');**/
