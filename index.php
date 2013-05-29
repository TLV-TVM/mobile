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
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="js/jqm/jquery.mobile-1.3.1.js"></script> 


<!-- jQuery UI Map v3 -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
 
 <script type="text/javascript" src="js/ui-map/ui/jquery.ui.map.js"></script>
 <script type="text/javascript" src="js/ui-map/ui/jquery.ui.map.services.js"></script>
<script type="text/javascript" src="js/ui-map/ui/jquery.ui.map.extensions.js"></script>

    


<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.core.min.js"></script>
<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.calbox.min.js"></script>
<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/i18n/jquery.mobile.datebox.i18n.fr.utf8.js"></script>


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
		//echo "connecté en persistant";
	}
	
	$db_selected = mysql_select_db($nom_bdd , $link);
	if (!$db_selected) {
	   die ('Impossible de sélectionner la base de données : ' . mysql_error());
}	

?> 
</head>

<body  class="portrait">



<!-- SPLASH -->


<!-- HOME -->
<div data-role="page" class="page-tlv" id="home">
  <div  data-role="header"   data-position="fixed"   >
      <div id="header-tlv"><img src="img/logo-tlv.jpg"  height="45" /></div>
      <div id="header-sub-tlv">porquerolles <span class="tiret">-</span> port cros <span class="tiret">-</span> le levant</div>
  </div>
  
  <div data-role="content" class="page-tlv">
  
  <div id="nav-home-tlv" >
         <div class="bouton">
         <a href="#horaires" data-transition="slide"><img src="img/btn/btn-horaire.jpg" border="0" /></a>
         </div>
         <div class="bouton">
         <a href="#tarifs" data-transition="slidedown"><img src="img/btn/btn-tarifs.jpg" border="0" /></a>
         </div>
         <div class="bouton">
         <a href="#geoLoc" data-transition="pop"><img src="img/btn/btn-loc.jpg"  border="0"/></a>
         </div>
         <div class="bouton">
        <a href="#alertes" data-transition="slideup"><img src="img/btn/btn-alerte.jpg" border="0" /></a>
         </div>
         <div class="bouton">
        <a href="#infosTlv" data-transition="flip"><img src="img/btn/btn-infos.jpg" border="0" /></a>
         </div>
         <div class="bouton">
         <img src="img/btn/btn-meteo.jpg" />
         </div>
         <div style="clear:both"></div>
      </div> 
  </div>
  
  
<div data-role="footer" data-position="fixed"   style="background-image:none; background-color:transparent;border-top:0px" id="footer-tlv" ><img src="img/footer.png"  width="100%"  id="img-footer" /></div>
  
</div>





<!-- HORAIRES -->
<div data-role="page"  id="horaires" data-add-back-btn="true">
   <div  data-role="header"   data-position="fixed"   >
   	 
       <div id="header-tlv"><img src="img/logo-tlv.jpg"  height="45" /></div>
       <a data-role="button" data-direction="reverse" data-rel="back" href="#home" data-icon="arrow-l" data-iconpos="left" style="margin-top:4px">
Accueil
</a>
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

<input value="<?=date("d/m/Y")?>" name="date_depart" id="date_depart" type="date" data-role="datebox"
   data-options='{"mode": "calbox","useFocus": true, "calShowWeek": true}'>
   <p>&nbsp;</p>
   <input type="button" value="Consulter les horaires" id="btnHoraireGo" />
      
      <div id="infoHoraire">&nbsp;</div>
  </div>
  
  
<div data-role="footer"  data-position="fixed"  style="background-image:none; background-color:transparent;border-top:0px" id="footer-tlv" ><img src="img/footer.png"  width="100%"  id="img-footer" /></div>
  
</div>







<!-- TARIFS -->
<div data-role="page"  id="tarifs" data-add-back-btn="true">
   <div  data-role="header"   data-position="fixed"   >
   	 
       <div id="header-tlv"><img src="img/logo-tlv.jpg"  height="45" /></div>
       <a data-role="button" data-direction="reverse" data-rel="back" href="#home" data-icon="arrow-l" data-iconpos="left" style="margin-top:4px">
Accueil
</a>
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
  
  
<div data-role="footer"  data-position="fixed"  style="background-image:none; background-color:transparent;border-top:0px" id="footer-tlv" ><img src="img/footer.png"  width="100%"  id="img-footer" /></div>
  
</div>













<!-- ALERTES -->
<div data-role="page"  id="alertes" data-add-back-btn="true">
   <div  data-role="header"   data-position="fixed"   >
   	 
       <div id="header-tlv"><img src="img/logo-tlv.jpg"  height="45" /></div>
       <a data-role="button" data-direction="reverse" data-rel="back" href="#home" data-icon="arrow-l" data-iconpos="left" style="margin-top:4px">
Accueil
</a>
      <div id="header-sub-tlv">porquerolles <span class="tiret">-</span> port cros <span class="tiret">-</span> le levant</div>
  </div>
  
  
  <div data-role="content" class="page-content-tlv">
  
     <H1>Alertes Info TLV</H1>
                
                <img src="http://www.tlv-tvm.com/images/Visuel-Paoramique-Intemperies.jpg" class="img_border" width="100%" />
                
                <div class="content">
                       <?
			 
				$strSqlSelectActuVerif = "select * from alerte_info  where publier = 1  and id_langue=1  order by date_alerte_info desc ";
				$resultSelectActuVerif = mysql_query($strSqlSelectActuVerif) or die ("Erreur de lecture des actualités");
				
				if($nbActu = mysql_num_rows($resultSelectActuVerif)>0){
                    while($rowActu = mysql_fetch_array($resultSelectActuVerif)){
                  ?>
                      
          <p><h3 style="color:#F00;margin:0px" >
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
   						    <span class="date"><strong><?=FlipDate($rowActu['date_crea'])?></strong></span></p>
                            
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
				}else{
				?>
                <p align="center">- Aucune alertes pour le moment -</p>	
				<? } ?>	
					
                      </div>
  </div>
  
  
<div data-role="footer"  data-position="fixed"  style="background-image:none; background-color:transparent;border-top:0px" id="footer-tlv" ><img src="img/footer.png"  width="100%"  id="img-footer" /></div>
  
</div>






<!-- infosTlv -->
<div data-role="page"  id="infosTlv" data-add-back-btn="true">
   <div  data-role="header"   data-position="fixed"   >
   	 
       <div id="header-tlv"><img src="img/logo-tlv.jpg"  height="45" /></div>
       <a data-role="button" data-direction="reverse" data-rel="back" href="#home" data-icon="arrow-l" data-iconpos="left" style="margin-top:4px">
Accueil
</a>
      <div id="header-sub-tlv">porquerolles <span class="tiret">-</span> port cros <span class="tiret">-</span> le levant</div>
  </div>
  
  
  <div data-role="content" class="page-content-tlv">
  
     <ul data-role="listview" data-divider-theme="a" data-inset="true">
          <li data-role="list-divider" role="heading">Plus d'infos sur
          </li>
          <li data-theme="c">
            <a href="#page2" data-transition="slide">Porquerolles</a>
          </li>
          <li data-theme="c">
            <a href="#page3" data-transition="slide">La vision des mer</a>
          </li>
          <li data-theme="c">
            <a href="#page4" data-transition="slide">QQC</a>
          </li>
        </ul>
  </div>
  
  
<div data-role="footer"  data-position="fixed"  style="background-image:none; background-color:transparent;border-top:0px" id="footer-tlv" ><img src="img/footer.png"  width="100%"  id="img-footer" /></div>
  
</div>

 












<!-- GEOLOC -->
<div data-role="page"  id="geoLoc" data-add-back-btn="true">
   <div  data-role="header"   data-position="fixed"   >
   	 
       <div id="header-tlv"><img src="img/logo-tlv.jpg"  height="45" /></div>
       <a data-role="button" data-direction="reverse" data-rel="back" href="#home" data-icon="arrow-l" data-iconpos="left" style="margin-top:4px">
Accueil
</a>
      <div id="header-sub-tlv">porquerolles <span class="tiret">-</span> port cros <span class="tiret">-</span> le levant</div>
  </div>
  
  
  <div data-role="content" class="page-content-tlv">
  
     <h2>Geolocation</h2>
				 
					<div id="laCarte" style="height:250px;"></div>
					<p>
						<label for="from">De</label>
						<input id="from" class="ui-bar-c" type="text" value="" />
					</p>
					<p>
						<label for="to">A</label>
						<input id="to" class="ui-bar-c" type="text" value="" />
					</p>
					<a id="submit" href="#" data-role="button" data-icon="search">Voir l'itin&eacute;raire</a>
				</div>
				<div id="results" class="ui-listview ui-listview-inset ui-corner-all ui-shadow" style="display:none;">
					<div class="ui-li ui-li-divider ui-btn ui-bar-b ui-corner-top ui-btn-up-undefined">Results</div>
					<div id="directions"></div>
					<div class="ui-li ui-li-divider ui-btn ui-bar-b ui-corner-bottom ui-btn-up-undefined"></div>
				 

  </div>
  
  
<div data-role="footer"  data-position="fixed"  style="background-image:none; background-color:transparent;border-top:0px" id="footer-tlv" ><img src="img/footer.png"  width="100%"  id="img-footer" /></div>
  
</div>









<script type="text/javascript" charset="utf-8">


$(document).bind("mobileinit", function(){
  $.mobile.touchOverflowEnabled = true;
  $.mobile.orientationChangeEnabled = false;
  $.mobile.allowCrossDomainPages = true;
  
 
});


//// Carte
$('#geoLoc').live('pageshow', function() {
	
	if (navigator.geolocation){
	 //navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
	  navigator.geolocation.getCurrentPosition(successCallback, errorCallback, { maximumAge: 3000, timeout: 5000, enableHighAccuracy: true });
	}else{
	  alert("Votre navigateur ne prend pas en compte la géolocalisation HTML5");
	}
	
	
	function successCallback(position){
	 	// alert("Latitude : " + position.coords.latitude + ", longitude : " + position.coords.longitude);
	  
	 	 var clientPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
		 $('#laCarte').gmap('addMarker', {'position': clientPosition,'zoom':18, 'bounds': true});
	  
	}; 
	 
	function errorCallback(error){
	  switch(error.code){
		case error.PERMISSION_DENIED:
		  alert("L'utilisateur n'a pas autorisé l'accès à sa position");
		  break;     
		case error.POSITION_UNAVAILABLE:
		  alert("L'emplacement de l'utilisateur n'a pas pu être déterminé");
		  break;
		case error.TIMEOUT:
		  alert("Le service n'a pas répondu à temps");
		  break;
		}
	};
});
/*
	$('#laCarte').gmap('getCurrentPosition', function(position, status) {
		if ( status === 'OK' ) {
			
			var LatTLV  =0;
			var LongTLV = 0;
			
			if (navigator.geolocation){
			  navigator.geolocation.getCurrentPosition(function(position) {
					LatTLV =position.coords.latitude ;
					LongTLV =  position.coords.longitude ;
				  });
			} 
			
			var clientPosition = new google.maps.LatLng(LatTLV, LongTLV);
			
			
			$('#laCarte').gmap('addMarker', {'position': clientPosition, 'zoom':10, 'bounds': true});
			 
		}
	});
	*/


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
