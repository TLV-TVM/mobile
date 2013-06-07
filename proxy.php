<?php
// Set your return content type
header('Content-type: application/xml');

// Website url to open
$daurl = 'http://api.meteorologic.net/forecarss?p=Hyeres';

// Get that website's content
$handle = fopen($daurl, "r");

// If there is something, read and return
if ($handle) {
    while (!feof($handle)) {
        $buffer .= fgets($handle, 4096);
       // echo $buffer;
    }
    fclose($handle);
}

///traitement buffer

$posStart = strpos($buffer,"<meteo:weather");



$bufferPartiel = substr($buffer,$posStart, strlen($buffer));

$posEnd =  strpos($bufferPartiel,"<pubDate");
//

$bufferPartiel = substr($bufferPartiel,0,$posEnd);

 

$fluxMeteo = '<?xml version = "1.0" encoding="UTF-8" standalone="yes"?><rss version="2.0" xmlns:meteo="http://www.meteorologic.net/rss/1.0"><channel>';

$bufferPartiel = str_replace('<meteo:weather','<meteo',$bufferPartiel);
$bufferPartiel = str_replace('/>','></meteo>',$bufferPartiel);

$fluxMeteo .=$bufferPartiel;

$fluxMeteo .=  '</channel></rss>';

echo $fluxMeteo  ;

/* 
<meteo:weather date="30 Mai" link="http://www.meteorologic.net/meteo-france/Hy%E8res_32656.html" tempe_matin="11.7" namepictos_matin="DÃ©gagÃ©"   pictos_matin="soleil" tempe_midi="15.8" namepictos_midi="DÃ©gagÃ©" pictos_midi="soleil" tempe_apmidi="17.9" namepictos_apmidi="Nuageux"   pictos_apmidi="nuageux" tempe_soir="16.9" namepictos_soir="Nuageux"   pictos_soir="nuageux" />
		<meteo:weather date="31 Mai" link="http://www.meteorologic.net/meteo-france/Hy%E8res_32656.html" tempe_matin="12.4" namepictos_matin="DÃ©gagÃ©"   pictos_matin="soleil" tempe_midi="17.1" namepictos_midi="VoilÃ©" pictos_midi="voile" tempe_apmidi="20.4" namepictos_apmidi="VoilÃ©"   pictos_apmidi="voile" tempe_soir="18.5" namepictos_soir="VoilÃ©"   pictos_soir="voile" />
		<meteo:weather date="01 Juin" link="http://www.meteorologic.net/meteo-france/Hy%E8res_32656.html" tempe_matin="14.2" namepictos_matin="VoilÃ©"   pictos_matin="voile" tempe_midi="18.7" namepictos_midi="VoilÃ©" pictos_midi="voile" tempe_apmidi="21.3" namepictos_apmidi="VoilÃ©"   pictos_apmidi="voile" tempe_soir="20" namepictos_soir="VoilÃ©"   pictos_soir="voile" />
*/

?>
