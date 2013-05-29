<?
	$addr_serveur = 'localhost';
	$login_mysql = 'yoogi_tlv';
	$pass_mysql = 'tlv83';
	$nom_bdd = 'yoogi_tlv';
	
	
	$link = mysql_connect($addr_serveur ,$login_mysql, $pass_mysql);
	if (!$link) {
	   die('Impossible de se connecter  : ' . mysql_error());
	}else{
		//echo "connecté en persistant";
	}
	
	$db_selected = mysql_select_db($nom_bdd , $link);
	if (!$db_selected) {
	   die ('Impossible de sélectionner la base de données : ' . mysql_error());
}
	
	
	$strSqlHoraire = "select * from horaire where id_horaire_categorie = ".$_POST['idch']." and suppr = 0 and (periode_deb <='".$_POST['datedep']."' and periode_fin >=  '".$_POST['datedep']."')";
	$resultHoraire = mysql_query($strSqlHoraire) or die ("Erreur de lecutre des horaires : ".mysql_error()."<hr><hr>".$strSqlHoraire );
	
	if($num = mysql_num_rows($resultHoraire) > 0){
		$rowHoraire = mysql_fetch_array($resultHoraire);
		$titre = "";
		$sstitre = "<h4>".utf8_encode(ucfirst(stripslashes($rowHoraire['titre'])))."</h4>";
		$desc =$rowHoraire['descriptif'];
		
		switch($_POST['idch']){
			case 1:
				$titre = "<h1>Horaire d&eacute;part de la Tour Fondue / Porquerolles</h1>";
				break;
			case 2:
				$titre = "<h1>Horaire d&eacute;part du Port d'Hyeres / Port Cros - Le Levant</h1>";
				break;
			case 3:
				$titre = "<h1>Horaire Circuits des 2 &Icirc;les</h1>";
				break;
			case 4:
				$titre = "<h1>Horaire circuit Vision sous-marine</h1>";
				break;
		}
		
		$PrintLink='<p>&nbsp;</p>';
		
		echo $titre.$sstitre.$desc.$PrintLink;
 		
		
	}else{
		
		echo "<p align='center'>Il n'y a aucun trajet pour cette date</p>	";
	}
	
 ?>