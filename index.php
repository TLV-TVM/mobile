<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>TLV TVM</title>
	
	<meta name="viewport" content="height=device-height,width=device-width,initial-scale=1.0,maximum-scale=1.0, user-scalable=no"  >
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<link rel="apple-touch-startup-image" href="img/jqt_startup.png" />
	<link rel="apple-touch-icon" href="img/jqtouch.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="img/jqtouch.png" /><!-- 72x72-->
	<link rel="apple-touch-icon" sizes="114x114" href="img/jqtouch.png" /><!-- 114x144-->
	
	<?
		$iOSkey = "AIzaSyC2STsn75whVHEDtXaP9fhm4Nfo9hlgqIk";
		$AndroidKey = "AIzaSyDyFXcxcclq36-Cs1CHb7U192mehdBkP6A";
	?>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	
	<!-- jQuery UI Map v3 -->
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
	
	<link rel="stylesheet" href="js/jqm/jquery.mobile-1.3.1.css" />
	<link rel="stylesheet" type="text/css" href="css/jqm-calendar.css" /> 
	<link rel="stylesheet" href="css/main.css" />
<?

 $addr_serveur = 'localhost';
	$login_mysql = 'yoogi_tlv';
	$pass_mysql = 'tlv83';
	$nom_bdd = 'yoogi_tlv';
	
	
	$link = mysql_connect($addr_serveur ,$login_mysql, $pass_mysql);
	if (!$link) {
	   die('Impossible de se connecter  : ' . mysql_error());
	}else{
		//echo "connect&eacute; en persistant";
	}
	
	$db_selected = mysql_select_db($nom_bdd , $link);
	if (!$db_selected) {
	   die ('Impossible de sélectionner la base de données : ' . mysql_error());
}	

?> 
 
 
 
	<script language="javascript">
		var IciLat;
		var IciLong;
		var map = null; 
	
		if (navigator.geolocation){
	 	  navigator.geolocation.getCurrentPosition(successCallback, errorCallback, { maximumAge: 3000, timeout:3000, enableHighAccuracy: true });
		}else{
		  alert("Votre navigateur ne prend pas en compte la géolocalisation HTML5");
		}   
		
	 	
		function successCallback(position){
			
			/*if (error == true) {
				IciLat = '43.082516';
				IciLong = '6.157009';
			} else {*/
				IciLat =position.coords.latitude ;
				IciLong = position.coords.longitude;
			//}
			
		
			  $('#from').val(IciLat + "," + IciLong);
			  
				var directionsDisplay;
				var directionsService = new google.maps.DirectionsService();
				var map;
				
				var PtDepart = new google.maps.LatLng(IciLat ,IciLong);
				//alert('Point de départ '+position);
				//var oceanBeach = new google.maps.LatLng(37.7683909618184, -122.51089453697205);
				
				google.maps.visualRefresh = true;
	
				
	 			function initialize() {
				  directionsDisplay = new google.maps.DirectionsRenderer();
				  var mapOptions = {
					zoom: 16,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					center: PtDepart,
					disableDefaultUI: true
				  }
				  map = new google.maps.Map(document.getElementById('laCarte'), mapOptions);
				  directionsDisplay.setMap(map);
				  
	 
	 			 directionsDisplay.setPanel(document.getElementById('itineraireShow'));
	
				  
				  var marker = new google.maps.Marker({
					  position: PtDepart,
					  map: map 
				  });
	
				  
				}
				
				function calcRoute() {
				  
				  $("#itineraireShow").html('');
				 //alert('CalcRoute :' + PtDepart);
				  
				  var EndPoint;
				  EndPoint = $("#endPoint :selected").val().split(',');
				  
				  
				 var destinaTionTlv = new google.maps.LatLng(EndPoint[0], EndPoint[1]);
				 
				 
				  var selectedMode = document.getElementById('mode').value;
				  var request = {
					  origin: PtDepart,
					  destination: destinaTionTlv,
					 // route : 'itineraireShow', 
					  // Note that Javascript allows us to access the constant
					  // using square brackets and a string value as its
					  // "property."
					  travelMode: google.maps.TravelMode[selectedMode]
				  };
				  directionsService.route(request, function(response, status) {
					if (status == google.maps.DirectionsStatus.OK) {
					  directionsDisplay.setDirections(response);
					}
				  });
				  
				  var documentBody = (($.browser.chrome)||($.browser.safari)) ? document.body : document.documentElement;
				  $(documentBody).animate({scrollTop: $('#itineraireShow').offset().top-90}, 2000);
				}
				
				///btn itineraire
				 $("input[name=CalcItin]").click(function(){
						calcRoute();
				});
				
				google.maps.event.addDomListener(window, 'load', initialize);
		 }; 
	 
		function errorCallback(error){
		  switch(error.code){
			case error.PERMISSION_DENIED:
			  alert("L'utilisateur n'a pas autorisé l'accès à sa position");
			  //successCallback(position='0',error=true);
			  break;     
			case error.POSITION_UNAVAILABLE:
			  alert("L'emplacement de l'utilisateur n'a pas pu être déterminé");
			  //successCallback(position='0',error=true);
			  break;
			case error.TIMEOUT:
			  alert("Le service n'a pas répondu à temps");
			  //successCallback(position='0',error=true);
			  break;
			}
		};
	
	</script>
	
	<script src="js/jqm/jquery.mobile-1.3.1.js"></script> 
	<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.core.min.js"></script>
	<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.calbox.min.js"></script>
	<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/i18n/jquery.mobile.datebox.i18n.fr.utf8.js"></script>
 
</head>

<body class="portrait">

<!-- SPLASH -->


<!-- HOME -->
<div data-role="page" class="page-tlv" id="home">
	<div  data-role="header" data-position="fixed">
		<div id="header-tlv"><img src="img/logo-tlv.jpg"  height="45" /></div>
		<div id="header-sub-tlv">porquerolles <span class="tiret">-</span> port cros <span class="tiret">-</span> le levant</div>
	</div>
	  
	<div data-role="content" class="page-tlv">
	  
		<div id="nav-home-tlv">
			<div class="bouton">
				<a href="#horaires" data-transition="flip"><img src="img/btn/btn_horaires.png" border="0" /></a>
			</div>
			<div class="bouton">
				<a href="#tarifs" data-transition="flip"><img src="img/btn/btn_tarifs.png" border="0" /></a>
			</div>
			<div class="bouton">
				<a href="#infosTlv" data-transition="flip"><img src="img/btn/btn_infos.png" border="0" /></a>
			</div>
			<div class="bouton">
				<a href="#alertes" data-transition="flip"><img src="img/btn/btn_alertes.png" border="0" /></a>
			</div>
			<div class="bouton">
				<a href="#geoLoc" data-transition="flip"><img src="img/btn/btn_geoloc.png"  border="0"/></a>
			</div>
			<div class="bouton">
				<a href="#meteoTLV"  data-transition="flip"><img src="img/btn/btn_meteo.png" border="0" /></a>
			</div>
			<div style="clear:both"></div>
		</div> 
		
	</div>
	  
	<div data-role="footer" data-position="fixed" style="background-image:none; background-color:transparent;border-top:0px" id="footer-tlv"><img src="img/footer.png" width="100%" id="img-footer" /></div>
  
</div>
<!-- FIN HOME -->


<!-- HORAIRES -->
<div data-role="page" id="horaires" data-add-back-btn="true">
	<div data-role="header" data-position="fixed">
		<div id="header-tlv"><img src="img/logo-tlv.jpg"  height="45" /></div>
		<a data-role="button" data-direction="reverse" data-rel="back" href="#home" data-icon="arrow-l" data-iconpos="left" style="margin-top:4px">Accueil</a>
		<div id="header-sub-tlv">porquerolles <span class="tiret">-</span> port cros <span class="tiret">-</span> le levant</div>
	</div>
	
	<div data-role="content" class="page-content-tlv">
		
		<label for="lieu_depart">D&eacute;part de :</label>
      	<select name="lieu_depart"  id="lieu_depart">
			<option value="1" >Tour Fondue / Porquerolles</option>
			<option value="2" >Hy&egrave;res / Port Cros / Le Levant</option>
			<option value="3" >Circuit des 2 &Icirc;les</option>
			<option value="4" >Vision sous-marine</option>
		</select>
		
		<label for="date_depart">Horaires du :</label>
		<input value="<?=date("d/m/Y")?>" name="date_depart" id="date_depart" type="date" data-role="datebox" data-options='{"mode": "calbox","useFocus": true, "calShowWeek": true}'>
		<p>&nbsp;</p>
		<div id="bouton_submit"><input type="button" class="bt-valid" value="Consulter les horaires" id="btnHoraireGo" /></div>
		<div id="infoHoraire">&nbsp;</div>
	</div>
	
	<div data-role="footer" data-position="fixed" style="background-image:none; background-color:transparent;border-top:0px" id="footer-tlv"><img src="img/footer.png" width="100%" id="img-footer" /></div>
  
</div>
<!-- FIN HORAIRES -->


<!-- TARIFS -->
<div data-role="page" id="tarifs" data-add-back-btn="true">
	
	<div data-role="header" data-position="fixed">
		<div id="header-tlv"><img src="img/logo-tlv.jpg"  height="45" /></div>
		<a data-role="button" data-direction="reverse" data-rel="back" href="#home" data-icon="arrow-l" data-iconpos="left" style="margin-top:4px">Accueil</a>
		<div id="header-sub-tlv">porquerolles <span class="tiret">-</span> port cros <span class="tiret">-</span> le levant</div>
	</div>
	
	<div data-role="content" class="page-content-tlv">
		<?
		// id Page = 15 --> Tarifs FR
		$page=15;
		$strSqlSelectPage = "select *  from pages where id_pages = ".$page;
		$resultSelectPage = mysql_query($strSqlSelectPage) or die ("Erreur de lecture de la page : ".mysql_error());
		$rowPage = mysql_fetch_array($resultSelectPage);
	
		echo $rowPage['contenu'];
		
		?>
	</div>
	
	<div data-role="footer" data-position="fixed" style="background-image:none; background-color:transparent;border-top:0px" id="footer-tlv"><img src="img/footer.png" width="100%" id="img-footer" /></div>
  
</div>
<!-- FIN TARIFS -->


<!-- ALERTES -->
<div data-role="page" id="alertes" data-add-back-btn="true">
	<div data-role="header" data-position="fixed">
		<div id="header-tlv"><img src="img/logo-tlv.jpg" height="45" /></div>
		<a data-role="button" data-direction="reverse" data-rel="back" href="#home" data-icon="arrow-l" data-iconpos="left" style="margin-top:4px">Accueil</a>
      	<div id="header-sub-tlv">porquerolles <span class="tiret">-</span> port cros <span class="tiret">-</span> le levant</div>
	</div>
	
	<div data-role="content" class="page-content-tlv">
		<H1>Alertes Info TLV</H1>
		
		<img src="http://www.tlv-tvm.com/images/Visuel-Paoramique-Intemperies.jpg" class="img_border" width="100%" />
		
		<div class="content">
		<?
			$strSqlSelectActuVerif = "select * from alerte_info  where publier = 1  and id_langue=1  order by date_alerte_info desc ";
			$resultSelectActuVerif = mysql_query($strSqlSelectActuVerif) or die ("Erreur de lecture des actualit&eacute;s");
			
			if($nbActu = mysql_num_rows($resultSelectActuVerif)>0){
	            while($rowActu = mysql_fetch_array($resultSelectActuVerif)){
		?>
                      
        <p>
        	<h3 style="color:#F00;margin:0px" >
				<? if($rowActu['lien_next']){
	
						$lienActu = "";
						$lienActu = UrlRewriter(strtolower(stripslashes($rowActu['titre'])));
						
						$lienActu = $lienActu."-0-0-0-".$rowActu['id_alerte_info'].".html";
						$lienActu =str_replace("--","-",$lienActu);
				?>
				<a href="<?=$lienActu?>"  class="iframe"><?=stripslashes($rowActu['titre'])?></a>
	            <? }else{ ?>
	            <?=stripslashes($rowActu['titre'])?>
	            <? } ?>
            </h3>
            <span class="date"><strong><?=FlipDate($rowActu['date_crea'])?></strong></span>
        </p>
        <p><?=stripslashes($rowActu['chapeau'])?></p>
        <? if($rowActu['lien_next']){
			$lienActu = "";
			$lienActu = UrlRewriter(strtolower(stripslashes($rowActu['titre'])));
			
			$lienActu = $lienActu."-0-".$rowActu['id_actualite'].".html";
			$lienActu =str_replace("--","-",$lienActu);
		?>
		<!--<p class="suite" align="right"><a href="<?=$lienActu?>"  class="iframe">&gt;  Lire la suite</a></p>--> 
		<? } ?>
		&nbsp;
 		<?	}
		}else{ ?>
			<p align="center">- Aucune alertes pour le moment -</p>	
		<? } ?>	
		</div>
	</div>
	
	<div data-role="footer"  data-position="fixed"  style="background-image:none; background-color:transparent;border-top:0px" id="footer-tlv" ><img src="img/footer.png"  width="100%"  id="img-footer" /></div>
  
</div>
<!-- FIN ALERTES -->


<!-- infosTlv -->
<div data-role="page" id="infosTlv" data-add-back-btn="true">
	<div data-role="header" data-position="fixed">
		<div id="header-tlv"><img src="img/logo-tlv.jpg"  height="45" /></div>
		<a data-role="button" data-direction="reverse" data-rel="back" href="#home" data-icon="arrow-l" data-iconpos="left" style="margin-top:4px">Accueil</a>
		<div id="header-sub-tlv">porquerolles <span class="tiret">-</span> port cros <span class="tiret">-</span> le levant</div>
	</div>
	
	<div data-role="content" class="page-content-tlv">
		<ul data-role="listview" data-divider-theme="a" data-inset="true">
			<li data-role="list-divider" role="heading">Plus d'infos sur</li>
			<li data-theme="c">
				<a href="#page2" data-transition="slide">Accessibilit&eacute;</a>
			</li>
			<li data-theme="c">
				<a href="#page3" data-transition="slide">R&eacute;glementation</a>
			</li>
			<li data-theme="c">
            	<a href="#page4" data-transition="slide">Le parc National</a>
        	</li>
    	</ul>
	</div>
  
	<div data-role="footer"  data-position="fixed"  style="background-image:none; background-color:transparent;border-top:0px" id="footer-tlv" ><img src="img/footer.png"  width="100%"  id="img-footer" /></div>
  
</div>

<!-- Page Accessibilité -->
<div data-role="page" id="page2" data-add-back-btn="true">
	<div data-role="header" data-position="fixed">
		<div id="header-tlv"><img src="img/logo-tlv.jpg"  height="45" /></div>
		<a data-role="button" data-direction="reverse" data-rel="back" href="#infosTlv" data-icon="arrow-l" data-iconpos="left" style="margin-top:4px">Retour</a>
		<div id="header-sub-tlv">porquerolles <span class="tiret">-</span> port cros <span class="tiret">-</span> le levant</div>
	</div>
	
	<div data-role="content" class="page-content-tlv">
		&Eacute;quipements pour les diff&eacute;rents types de handicaps<br /><br />
		Au d&eacute;part de la Tour Fondue, en direction de Porquerolles:<br /><br />
		Trois bateaux sont &eacute;quip&eacute;s d'une rampe permettant l'acc&egrave;s des personnes en fauteuil roulant manuel ou &eacute;lectrique.<br /><br />
		Au d&eacute;part du port d’Hy&egrave;res en direction de Port Cros et du Levant :<br /><br />
		Il faut se renseigner au <strong>04 94 57 44 07.</strong><br /><br />
		Tarif sp&eacute;cial pour PMR sur pr&eacute;sentation de la carte d'invalidit&eacute;.<br /><br />
		Le circuit "vision sous-marine" n'est cependant pas accessible aux personnes en fauteuil roulant et malvoyantes.
	</div>
	
	<div data-role="footer"  data-position="fixed"  style="background-image:none; background-color:transparent;border-top:0px" id="footer-tlv" ><img src="img/footer.png"  width="100%"  id="img-footer" /></div>
  
</div>
<div data-role="page" id="page3" data-add-back-btn="true">
	<div data-role="header" data-position="fixed">
		<div id="header-tlv"><img src="img/logo-tlv.jpg"  height="45" /></div>
		<a data-role="button" data-direction="reverse" data-rel="back" href="#infosTlv" data-icon="arrow-l" data-iconpos="left" style="margin-top:4px">Retour</a>
		<div id="header-sub-tlv">porquerolles <span class="tiret">-</span> port cros <span class="tiret">-</span> le levant</div>
	</div>
	
	<div data-role="content" class="page-content-tlv">
		<h2>La r&eacute;glementation de l'&icirc;le de Port-Cros</h2>
		<p>Un parc national est un <strong>territoire d'exception</strong>, ouvert &agrave; tous sous la responsabilit&eacute; de chacun. Il est <strong>prot&eacute;g&eacute; par une r&eacute;glementation</strong>. Merci de la respecter.</p>
		<h3>R&egrave;glementation</h3>
		<p>
			<ul>
				<li><strong>Pas de feu ni de cigarette en dehors du village</strong>, pour pr&eacute;venir l'incendie et garder les plages propres.</li>
				<li><strong>Pas de camping ni de bivouac</strong></li>
				<li><strong>Pas de v&eacute;hicule motoris&eacute; ni de v&eacute;lo</strong> &agrave; l'exception des v&eacute;hicules de service ou autoris&eacute;s, l'&icirc;le est r&eacute;serv&eacute;e aux pi&eacute;tons.</li>
				<li><strong>Pas de d&eacute;chets en dehors des conteneurs</strong>, pour ne pas alt&eacute;rer les milieux naturels et les paysages.</li>
				<li><strong>Pas de bruit ni de d&eacute;rangement</strong> pour pr&eacute;server le caract&egrave;re des lieux.</li>
				<li><strong>Pas d'arme</strong>, la chasse est interdite.</li>
				<li><strong>Pas de cueillette ni de pr&eacute;l&egrave;vement</strong> pour conserver la diversit&eacute; biologique.</li>
				<li><strong>Pas de chien</strong> pour maintenir la tranquillit&eacute; de la faune et la salubrit&eacute; des plages. Dans le village, entre le fort du Moulin et la statue de St Joseph, l’acc&egrave;s du chien tenu en laisse est autoris&eacute;.</li>
				<li><strong>Pas de p&ecirc;che de loisir</strong> pour sauvegarder la faune et la flore marines.</li>
				<li><strong>La p&ecirc;che sous-marine, la p&ecirc;che &agrave; l'hameçon et la p&ecirc;che &agrave; pied sont interdites.</strong></li> 
				Seule, la p&ecirc;che &agrave; la tra&icirc;ne est autoris&eacute;e &agrave; plus de 50 m&egrave;tres du rivage, au nord des parall&egrave;les passant par la pointe du Cognet et la Pointe de Port-Man
			</ul>
		</p>
		<h3>Danger Incendie (S&eacute;cheresse + vent = risque accru d'incendie)</h3>
		<p>Pour la s&eacute;curit&eacute; de chacun, les massifs forestiers sont alors ferm&eacute;s (voir la carte) &agrave; la fr&eacute;quentation du public, et la circulation n'est autoris&eacute;e que sur les chemins d'acc&egrave;s aux plages.
	   	<ul>
	   		<li>Se renseigner au 04 89 96 43 43 ou sur internet <a href="www.sigvar.org">www.sigvar.org</a></li>
	   		<li>En cas d'incendie: appeler le 18 ou le 112</li>
	   		<li>Ne pas s'&eacute;loigner de la mer</li>
	   	</ul>
		</p>
		<br />
		<h2>La r&eacute;glementation de l'&icirc;le de Porquerolles</h2>
		<p>L'&icirc;le de Porquerolles est un territoire d'exception, ouvert &agrave; tous sous la responsabilit&eacute; de chacun. Il est prot&eacute;g&eacute; par une r&eacute;glementation. Merci de la respecter.</p>
		<h3>R&eacute;glementation</h3>
		<p>
			<ul>
				<li><strong>Pas de feu ni de cigarette</strong> en dehors du village, pour pr&eacute;venir l'incendie et garder les plages propres.</li>
				<li><strong>Pas de camping ni de bivouac</strong></li>
				<li><strong>Pas de d&eacute;chets en dehors des conteneurs</strong>, pour ne pas alt&eacute;rer les milieux naturels et les paysages</li>
				<li><strong>Pas de bruit ni de d&eacute;rangement</strong> pour pr&eacute;server le caract&egrave;re des lieux.</li>
				<li><strong>Pas de cueillette ni de pr&eacute;l&egrave;vement</strong> pour conserver la diversit&eacute; biologique.</li>
				<li><strong>La circulation des v&eacute;hicules motoris&eacute;s et des v&eacute;los est r&eacute;glement&eacute;e.</strong></li>
				<li>Pour sauvegarder la flore et la faune sauvages, <strong>ne pas quitter le trac&eacute;</strong> des pistes et des sentiers autoris&eacute;s.</li>
				<li>Pour la tranquillit&eacute; de la faune, <strong>les chiens doivent &ecirc;tre tenus en laisse.</strong> Ils sont interdits d'acc&egrave;s sur les plages pour des raisons de salubrit&eacute;.</li>
			</ul>
			Le contenu d&eacute;taill&eacute; de la r&eacute;glementation peut &ecirc;tre consult&eacute; dans les points d'informations du Parc National de Port-Cros et du Conservatoire Botanique National M&eacute;diterran&eacute;en de Porquerolles.
		</p>
		<h3>Danger Incendie (S&eacute;cheresse + vent = risque accru d'incendie)</h3>
		<p>Pour la s&eacute;curit&eacute; de chacun, <strong>les massifs forestiers sont alors ferm&eacute;s</strong> &agrave; la fr&eacute;quentation du public, et la circulation n'est autoris&eacute;e que sur les chemins d'acc&egrave;s au plages.
		<ul>
			<li>Se renseigner au 04 89 96 43 43 ou sur internet <a href="www.sigvar.org">www.sigvar.org</a></li>
			<li>En cas d'incendie: appeler le 18 ou le 112</li>
			<li>Ne pas s'&eacute;loigner de la mer</li>
		</ul>	
		</p>
	</div>
	
	<div data-role="footer"  data-position="fixed"  style="background-image:none; background-color:transparent;border-top:0px" id="footer-tlv" ><img src="img/footer.png"  width="100%"  id="img-footer" /></div>
  
</div>

<div data-role="page" id="page4" data-add-back-btn="true">
	<div data-role="header" data-position="fixed">
		<div id="header-tlv"><img src="img/logo-tlv.jpg"  height="45" /></div>
		<a data-role="button" data-direction="reverse" data-rel="back" href="#infosTlv" data-icon="arrow-l" data-iconpos="left" style="margin-top:4px">Retour</a>
		<div id="header-sub-tlv">porquerolles <span class="tiret">-</span> port cros <span class="tiret">-</span> le levant</div>
	</div>
	
	<div data-role="content" class="page-content-tlv">
		<div style="margin: 0 auto 15px; width: 95px;"><img src="images/logo-ParcNationalPortCros.jpg" alt="Parc National Port Cros" /></div>
		Cr&eacute;&eacute; le 14 d&eacute;cembre 1963, le Parc national de Port-Cros, qui occupe 700 ha de terres &eacute;merg&eacute;es et 1288 ha de surfaces marines, est l'un des deux plus anciens Parc Nationaux de France et le premier parc marin europ&eacute;en. Il comprend l'&icirc;le de Port-Cros, celle de Bagaud, les &icirc;lots de la Gabini&egrave;re et du Rascas ainsi qu'un  p&eacute;rim&egrave;tre marin de 600 m de large.
		Le 6 mai 2012 a &eacute;t&eacute; publi&eacute; au journal officiel de la r&eacute;publique, le d&eacute;cret n° 2012-649 qui, en application de la loi d'avril 2006, r&eacute;forme le parc national en profondeur. A l'issue d'une concertation avec les acteurs locaux, l'espace du Parc national se trouve totalement reconfigur&eacute;. Il comporte aujourd'hui :
		<ul>
			<li>deux &laquo; cœurs &raquo;, espaces de protection et d'accueil du public, constitu&eacute;s de l' &icirc;le de Port-Cros et des espaces naturels propri&eacute;t&eacute; de l'Etat de l'&icirc;le Porquerolles ainsi que leur frange marine jusqu'&agrave; une distance de 600 m,</li>
			<li>une &laquo; aire potentielle d'adh&eacute;sion &raquo;, espace de projet de d&eacute;veloppement durable &agrave; &eacute;laborer avec les onze communes qui le composent,</li>
			<li>une &laquo; aire maritime adjacente &raquo; r&eacute;plique en mer de l'aire d'adh&eacute;sion, qui couvre l'espace marin au droit de ces onze communes et &eacute;tendue jusqu'&agrave; 3 milles marins au sud des &icirc;les.</li>
		</ul>
	</div>
	
	<div data-role="footer"  data-position="fixed"  style="background-image:none; background-color:transparent;border-top:0px" id="footer-tlv" ><img src="img/footer.png"  width="100%"  id="img-footer" /></div>
  
</div>

<!-- FIN infosTlv -->


<!-- meteoTLV -->
<div data-role="page" id="meteoTLV" data-add-back-btn="true">
	<div data-role="header" data-position="fixed">
		<div id="header-tlv"><img src="img/logo-tlv.jpg"  height="45" /></div>
       	<a data-role="button" data-direction="reverse" data-rel="back" href="#home" data-icon="arrow-l" data-iconpos="left" style="margin-top:4px">Accueil</a>
       	<div id="header-sub-tlv">porquerolles <span class="tiret">-</span> port cros <span class="tiret">-</span> le levant</div>
  	</div>
  
  
  <div data-role="content" class="page-content-tlv">
  	 <h2>M&eacute;t&eacute;o Hyeres / Porquerolles</h2>
     <div id="descMeteo">
      <?
		  
			$filename = "http://api.meteorologic.net/forecarss?p=Hyeres";
			if($handle = fopen($filename, "r")){
				//$contents = fread($handle, filesize($filename));
				$contents = stream_get_contents($handle);
				$search = array(' ', "\t", "\n", "\r");
				$contents = str_replace($search, '', $contents);
				fclose($handle);
			}else{
				$contents = "NO METEO";	
			}
			 
			 
		 ?>
     
     </div>
    <script language="javascript">
	 	//get Ajax de la m&eacute;t&eacute;o
		var fluxMeteo;
		var AffMeteo;
		
		 
		$.ajax({
			url:'proxy.php',
			dataType:'xml',
			type:'GET',
			success:function(xml) {
				$(xml).find('meteo').each(function() {
					
					var DateMeteo =  $(this).attr('date');
					var PictoMidi = $(this).attr('pictos_midi');
					var TempMatin = $(this).attr('tempe_matin');
					var TempMidi = $(this).attr('tempe_midi');
					var TempSoir = $(this).attr('tempe_soir');
					
					//tempe_matin="11.7" namepictos_matin="D&eacute;gag&eacute;"   pictos_matin="soleil" tempe_midi="15.8" namepictos_midi="D&eacute;gag&eacute;" pictos_midi="soleil" tempe_apmidi="17.9" namepictos_apmidi="Nuageux"   pictos_apmidi="nuageux" tempe_soir="16.9" namepictos_soir="Nuageux"   pictos_soir="nuageux" 
					
					$("#descMeteo").append("<span class='ladate'>Le "+DateMeteo+"</span><p><img class='"+PictoMidi+"' src='' width='128'  /><br /><span class='info'>Matin : "+TempMatin+"&deg;<br>Midi : "+TempMidi+"&deg;<br>Soir : "+TempSoir+"&deg;<br></span></p><hr>");     
					
			   })
			   
			   
			   
			   ///traitement des pictos
			   /*
			   soleil = Ciel d&eacute;gag&eacute;
				voile = Ciel voil&eacute;
				nuageux = Ciel nuageux
				couvert = Ciel couvert
				brouillard = couvert
				brouillardgivrant = couvert
				neifefaible = averseneige
				neigemoderer = averseneige
				neigeforte = averseneige
				pluiefaible = Pluie faible
				pluiemoderer = pluiefaible
				pluieforte = pluieforte
				verglas = Verglas
				averse = pluiefaible
				averseneige = averseneige
				orageloc =orageloc
				oragefort = Violents orages
				*/
				$("img.soleil").attr('src','img/meteo/soleil.png');
				$("img.voile").attr('src','img/meteo/voile.png');
				$("img.nuageux").attr('src','img/meteo/nuageux.png');
				$("img.couvert").attr('src','img/meteo/couvert.png');
				
				$("img.brouillard").attr('src','img/meteo/couvert.png');
				$("img.brouillardgivrant").attr('src','img/meteo/couvert.png');
				$("img.neifefaible").attr('src','img/meteo/averseneige.png');
				$("img.neigemoderer").attr('src','img/meteo/averseneige.png');
				
				$("img.neigeforte").attr('src','img/meteo/averseneige.png');
				
				
				$("img.pluiefaible").attr('src','img/meteo/pluiefaible.png');
				$("img.pluiemoderer").attr('src','img/meteo/pluiefaible.png');
				$("img.pluieforte").attr('src','img/meteo/pluieforte.png');
				$("img.verglas").attr('src','img/meteo/pluieforte.png');
				$("img.averse").attr('src','img/meteo/pluiefaible.png');
				$("img.averseneige").attr('src','img/meteo/averseneige.png');
				$("img.orageloc").attr('src','img/meteo/orageloc.png');
				$("img.oragefort").attr('src','img/meteo/orageloc.png');
			},
			error:function() {
				alert("Aucun flux trouv&eacute;");
			}
		});
      
		 
		
	 </script>
  </div>
  
  
<div data-role="footer"  data-position="fixed"  style="background-image:none; background-color:transparent;border-top:0px" id="footer-tlv" ><img src="img/footer.png"  width="100%"  id="img-footer" /></div>
  
</div>
<!-- FIN meteoTLV -->


<!-- GEOLOC -->
<div data-role="page" id="geoLoc" data-add-back-btn="true">
	<div data-role="header" data-position="fixed">
		
		<div id="header-tlv"><img src="img/logo-tlv.jpg"  height="45" /></div>
		
		<a data-role="button" data-direction="reverse" data-rel="back" href="#home" data-icon="arrow-l" data-iconpos="left" style="margin-top:4px">Accueil</a>
      	<div id="header-sub-tlv">porquerolles <span class="tiret">-</span> port cros <span class="tiret">-</span> le levant</div>
	</div>
	
	<div data-role="content" class="page-content-tlv">
		
		<h2>Itin&eacute;raires</h2>
		<p>
			Pour vous rendre &agrave; la Tour Fondue ou au Port de Hy&egrave;res en bus, consultez les horaires sur:<br />
			<a href="#" id="appli" style="width: 78px; margin: 5px auto; display: block;"><img src="images/bus_mistral.png" alt="Application Bus Mistral" style="vertical-align: top;" /></a>
		</p>
		<p>
			<label>De :</label> 
			<div class="ui-btn ui-shadow ui-btn-corner-all ui-btn-icon-right ui-btn-up-c" style="line-height: 38px;font-family: Helvetica,Arial,sans-serif; font-weight: bold; font-size: 16px; border-radius: 1em;">Ma position actuelle</div>
			<input id="from"   type="hidden" value="" />
		</p>
		<p>
			<label>A :</label>
			<select name="endPoint" id="endPoint">
				<option value="43.0822795,6.1569269">Le Port d'Hyeres</option>
				<option value="43.0280560,6.1550942">La Tour Fondue</option>
				<option value="43.003111,6.200658">Embarcad&egrave;re Porquerolles</option>
			</select>
		</p>
		<p>
			<label>Moyen de transport :</label>
			<select id="mode" onchange="calcRoute();">
				<option value="DRIVING">Voiture</option>
				<option value="WALKING">Pieton</option>
				<option value="BICYCLING">V&eacute;lo</option>
			</select>
		</p>
		<div id="bouton_submit">
			<input type="button" id="CalcItin" class="bt-valid"  name="CalcItin"  data-icon="search" value="Voir l'itin&eacute;raire">
		</div>
		<p>&nbsp;</p>
		<div id="itineraireShow" style="   color:#FFF"></div><p>&nbsp;</p>
		<div id="laCarte" style="border:1px solid #FFF;height:280px;width:100%;margin:auto"></div>
	</div>
	
	<script type="text/javascript" src="js/jquery.browser_detect.js"></script>
	<script type="text/javascript">
		var isAndroid = /android/i.test(navigator.userAgent.toLowerCase());
		var isiDevice = /ipad|iphone|ipod/i.test(navigator.userAgent.toLowerCase());
		if (isAndroid) {
			$("#appli").attr('href', 'https://play.google.com/store/apps/details?id=fr.cityway.android.rmtt');
		} else if (isiDevice) {
			$("#appli").attr('href', 'https://itunes.apple.com/fr/app/reseau-mistral/id429896529?mt=8');
		}
	</script>			 
  
  
	<div data-role="footer"  data-position="fixed"  style="background-image:none; background-color:transparent;border-top:0px" id="footer-tlv" ><img src="img/footer.png"  width="100%"  id="img-footer" /></div>
  
</div>
<!-- FIN GEOLOC -->

<script type="text/javascript" charset="utf-8">

$(document).bind("mobileinit", function(){
	$.mobile.touchOverflowEnabled = true;
  	$.mobile.orientationChangeEnabled = false;
  	$.mobile.allowCrossDomainPages = true;
});


 
 ////carte

//if (navigator.userAgent.match(/iPhone/i)) {

        //cache the viewport tag if the user is using an iPhone
        var $viewport = $('head').children('meta[name="viewport"]');

        //bind an event handler to the window object for the orientationchange event
        $(window).bind('orientationchange', function() {
            if (window.orientation == 90 || window.orientation == -90 || window.orientation == 270) {

                //landscape
                $viewport.attr('content', 'height=device-width,width=device-height,initial-scale=1.0,maximum-scale=1.0');
				$("body").removeClass("portrait");
				$("body").addClass("landscape");
				$("body").css("landscape");
				$("#img-footer").attr("src","img/footer-landscape.png");
				$("#nav-home").css('margin-top','0px');
				$("#footer-tlv").css('display','none');
				/*
				$('body').css('background-image', 'url("img/bg-appli-landscape.png")');
				
				$('body').css(
				{	'background-image':'url(img/bg-appli-landscape.png) !important ',
					'background-color':'#004787  !important',
    				'background-repeat':'no-repeat  !important',
   					' background-position':'center center  !important ',
   					' background-attachment':'scroll !important ',
    				'background-size':'100% 100% !important '
				});
				*/
				$('.ui-content').css(
				{	'background-image':'url(img/bg-appli-landscape.png) !important ',
					'background-color':'#004787  !important',
    				'background-repeat':'no-repeat  !important',
   					' background-position':'top right  !important ',
   					' background-attachment':'scroll !important ',
    				'background-size':'100% 100% !important '
				});
				
            } else {

                //portrait
                $viewport.attr('content', 'height=device-height,width=device-width,initial-scale=1.0,maximum-scale=1.0');
				
				$("body").removeClass("landscape");
				$("body").addClass("portrait");
	 
				$("#img-footer").attr("src","img/footer.png");
				$("#nav-home").css('margin-top','110px');
				$("#footer-tlv").css('display','');
				/*
				$('body').css('background-image', 'url("img/bg-appli.png")');
				
				$('body').css(
				{	'background-image':'url(img/bg-appli.png) !important ',
					'background-color':'#004787  !important',
    				'background-repeat':'no-repeat  !important',
   					' background-position':'center center  !important ',
   					' background-attachment':'scroll !important ',
    				'background-size':'100% 100% !important '
				});
				*/
				$('.ui-content').css(
				{	'background-image':'url(img/bg-appli-content.png) !important ',
					'background-color':'#004787  !important',
    				'background-repeat':'no-repeat  !important',
   					' background-position':'center center  !important ',
   					' background-attachment':'scroll !important ',
    				'background-size':'100% 100% !important '
				});
            }

        //trigger an orientationchange event on the window object to initialize this code (basically in-case the user opens the page in landscape mode)
        }).trigger('orientationchange');
//  }		

//verrouillage portrait
function shouldRotateToOrientation(interfaceOrientation) {
    return (1 === interfaceOrientation);
}		



/////Core
$("#btnHoraireGo").click(function(){
	$("#infoHoraire").html("&nbsp;");
	var idCatLieux = $('select[name=lieu_depart] option:selected').val();
	var DateDep = $('input[name=date_depart]').val();
	// alert("DateDep = "+DateDep);
	
	var DateTxt = DateDep.split('/');
		var jour = DateTxt[0];
		var mois = DateTxt[1];
		var an = DateTxt[2];
		
		$.ajax({
		  url: 'checkHoraire.php',
		  type: "POST",
		  data:{idch:idCatLieux, datedep: ''+an+'-'+mois+'-'+jour },
		  success: function(htmlReturn) {
			$('#infoHoraire').html(htmlReturn);
 		  }
		});
	
})



	
</script>

</body>
</html>
