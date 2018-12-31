<?php

ini_set('error_reporting', E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE); // Show all errors minus STRICT, DEPRECATED and NOTICES
ini_set('display_errors', 0); // disable error display
ini_set('log_errors', 0); // disable error logging
header('Content-Type: text/plain');



//https://forecast.weather.gov/product.php?site=NWS&issuedby=MCD&product=SWO&format=txt&version=1&glossary=0
//$readmcd = file_get_contents($mcdurl);
//echo $readmcd;

$mcdurl = "http://tgftp.nws.noaa.gov/data/raw/ac/acus11.kwns.swo.mcd.txt";
$readmcd = file_get_contents($mcdurl);
//echo $readmcd;

$finalreadmcd = str_replace("\n"," * ", $readmcd);
//$finalreadmcd = str_replace(" ","-", $readmcd);
//echo $finalreadmcd;

//LAT...LON 
//$matchlatlon = "/LAT...LON((?:.|\n)*)$/m";
$matchlatlon = "#LAT...LON   (.*?)$#s";
preg_match($matchlatlon, $readmcd, $latlonmatch);



echo "
Refresh: 10
Title: Get Last MCD
Threshold: 999
Color: 232 232 175
Line: 3, 0, \"$finalreadmcd\"
";



//process each latlon pairs  
//Thank you to Paul Wetter (https://github.com/paulwetter)

$arr =  explode(" ", $latlonmatch[0]);
foreach($arr as $v)
{
if(preg_match("/^[0-9]{8}$/",$v)) {
		//echo substr($v,0,8) . "\n";
		echo LatLon(substr($v,0,8)) . "\n";
	}
}


echo "End:";

function left($str, $length) {
     return substr($str, 0, $length);
}
 
function right($str, $length) {
     return substr($str, -$length);
}



function LatLon(String $oldnum) {
$Lat = Left($oldnum,4);
$Lon = Right($oldnum,4);
$Lat = Left($Lat,2) . "." . Right($Lat,2);
$Lon = "-" . Left($Lon,2) . "." . Right($Lon,2);
if(preg_match("/^-0/",$Lon)) {
$Lon = str_replace("-0","-10", $Lon);
}
return $Lat . ", " . $Lon ;
}






?>