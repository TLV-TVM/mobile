<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TLV TVM</title>

<meta name="viewport" content="height=device-height,width=device-width,initial-scale=1.0,maximum-scale=1.0, user-scalable=no"  >
<meta name="apple-mobile-web-app-capable" content="yes" />

<link rel="apple-touch-icon" href="img/jqtouch.png" />
<link rel="apple-touch-icon" sizes="72x72" href="img/jqtouch.png" /><!-- 72x72-->
<link rel="apple-touch-icon" sizes="114x114" href="img/jqtouch.png" /><!-- 114x144-->

<!--<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>-->
<script src="js/jquery-1.9.1.min.js"></script>



<!-- jQuery UI Map v3 -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>

 


    




<link rel="stylesheet" href="js/jqm/jquery.mobile-1.3.1.css" />
<link rel="stylesheet" type="text/css" href="css/jqm-calendar.css" /> 
<link rel="stylesheet" href="css/main.css" />

 
 
 
<script language="javascript">
	var IciLat;
	var IciLong;
	var map = null; 

	if (navigator.geolocation){
 	  navigator.geolocation.getCurrentPosition(successCallback, errorCallback, { maximumAge: 3000, timeout:30000, enableHighAccuracy: true });
	}else{
	  alert("Votre navigateur ne prend pas en compte la géolocalisation HTML5");
	}   
	
 	
	function successCallback(position){
		IciLat =position.coords.latitude ;
		IciLong = position.coords.longitude;
	 
	
		  $('#from').val(IciLat + "," + IciLong);
		  
			var directionsDisplay;
			var directionsService = new google.maps.DirectionsService();
			var map;
			
			var PtDepart = new google.maps.LatLng(IciLat ,IciLong);
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
		  break;     
		case error.POSITION_UNAVAILABLE:
		  alert("L'emplacement de l'utilisateur n'a pas pu être déterminé");
		  break;
		case error.TIMEOUT:
		  alert("Le service n'a pas répondu à temps");
		  break;
		}
	};

</script>

 <script src="js/jqm/jquery.mobile-1.3.1.js"></script> 
<!--<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.core.min.js"></script>
<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.calbox.min.js"></script>
<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/i18n/jquery.mobile.datebox.i18n.fr.utf8.js"></script>-->
<script type="text/javascript" src="js/jqm-datebox.core.min.js"></script>
<script type="text/javascript" src="js/jqm-datebox.mode.calbox.min.js"></script>
<script type="text/javascript" src="js/jquery.mobile.datebox.i18n.fr.utf8.js"></script>
 
</head>

<body  class="portrait"  >



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
        <a href="#meteoTLV"  data-transition="slide"><img src="img/btn/btn-meteo.jpg" border="0" /></a>
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

<input value="" name="date_depart" id="date_depart" type="date" data-role="datebox"
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

 




<!-- meteoTLV -->
<div data-role="page"  id="meteoTLV" data-add-back-btn="true">
   <div  data-role="header"   data-position="fixed"   >
   	 
       <div id="header-tlv"><img src="img/logo-tlv.jpg"  height="45" /></div>
       <a data-role="button" data-direction="reverse" data-rel="back" href="#home" data-icon="arrow-l" data-iconpos="left" style="margin-top:4px">
Accueil
</a>
      <div id="header-sub-tlv">porquerolles <span class="tiret">-</span> port cros <span class="tiret">-</span> le levant</div>
  </div>
  
  
  <div data-role="content" class="page-content-tlv">
  	 <h2>M&eacute;t&eacute;o Hyeres / Porquerolles</h2>
     <div id="descMeteo">
      
     
     </div>
    <script language="javascript">
	 	//get Ajax de la météo
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
					
					//tempe_matin="11.7" namepictos_matin="Dégagé"   pictos_matin="soleil" tempe_midi="15.8" namepictos_midi="Dégagé" pictos_midi="soleil" tempe_apmidi="17.9" namepictos_apmidi="Nuageux"   pictos_apmidi="nuageux" tempe_soir="16.9" namepictos_soir="Nuageux"   pictos_soir="nuageux" 
					
					$("#descMeteo").append("<span class='ladate'>Le "+DateMeteo+"</span><p><img class='"+PictoMidi+"' src='' width='128'  /><br /><span class='info'>Matin : "+TempMatin+"&deg;<br>Midi : "+TempMidi+"&deg;<br>Soir : "+TempSoir+"&deg;<br></span></p><hr>");     
					
			   })
			   
			   
			   
			   ///traitement des pictos
			   /*
			   soleil = Ciel dégagé
				voile = Ciel voilé
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
				alert("Aucun flux trouvé");
			}
		});
      
		 
		
	 </script>
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
  
     <h2>Itin&eacute;raires</h2>
				 
					
					<p>
						De : <strong>ma position actuelle</strong>
               
						<input id="from"   type="hidden" value="" />
					</p>
					<p>
						<label for="to">A :</label>
						  <select name="endPoint" id="endPoint">
      <option value="43.0822795,6.1569269">Le Port d'Hyeres</option>
      <option value="43.0280560,6.1550942">La Tour Fondue</option>
      <option value="43.003111,6.200658">Embarquadaire Proquerolles</option>
      </select>
					</p>
                    
                  
                    
                    
                    
                    <select id="mode" onchange="calcRoute();">
                      <option value="DRIVING">Voiture</option>
                      <option value="WALKING">Pieton</option>
                      <option value="BICYCLING">Vélo</option>
                     
                    </select>
				
					<input type="button" id="CalcItin"  name="CalcItin"  data-icon="search" value="Voir l'itin&eacute;raire"> 
                    <p>&nbsp;</p>
                    <div id="itineraireShow" style="   color:#FFF"></div><p>&nbsp;</p>
                    <div id="laCarte" style="border:1px solid #FFF;height:280px;width:280px;margin:auto"></div>
                    
                    
				</div>
				 
  
  
<div data-role="footer"  data-position="fixed"  style="background-image:none; background-color:transparent;border-top:0px" id="footer-tlv" ><img src="img/footer.png"  width="100%"  id="img-footer" /></div>
  
</div>









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
