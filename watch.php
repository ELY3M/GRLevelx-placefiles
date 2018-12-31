<?php

/*

Watch plotter for GRlevelx   

I am sick of others placefiles breaking on me.  
so I will make them myself and release this source code.  
ELY M.  


This placefile read up to 6 Watches at a time.  

	
*/

ini_set('error_reporting', E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE); // Show all errors minus STRICT, DEPRECATED and NOTICES
ini_set('display_errors', 0); // disable error display
ini_set('log_errors', 0); // disable error logging
header('Content-Type: text/plain');

$torcolor = "Color: 255 0 0";
$svrcolor = "Color: 0 0 255";

$color1 = $svrcolor; 
$color2 = $svrcolor; 
$color3 = $svrcolor; 
$color4 = $svrcolor; 
$color5 = $svrcolor; 
$color6 = $svrcolor; 

echo "
Refresh: 10
Title: Watches
Threshold: 999
";
                                                                                                                                                                   

$watchurl = "https://www.spc.noaa.gov/products/watch/";


$readwatch = file_get_contents($watchurl);
//echo $readwatch;
$getwatchnum = "/<a href=.\/products\/watch\/ws(.*?).html.>Latest Watch Status Message<\/a>/";

preg_match_all($getwatchnum, $readwatch, $numbermatches);
//print_r($numbermatches);



$watchno1 = $numbermatches[1][0];
$watchno2 = $numbermatches[1][1];
$watchno3 = $numbermatches[1][2];
$watchno4 = $numbermatches[1][3];
$watchno5 = $numbermatches[1][4];
$watchno6 = $numbermatches[1][5];
#0000ff

 

$readwatchpage1 = "https://www.spc.noaa.gov/products/watch/ww$watchno1.html";
$readwatchpage2 = "https://www.spc.noaa.gov/products/watch/ww$watchno2.html";
$readwatchpage3 = "https://www.spc.noaa.gov/products/watch/ww$watchno3.html";
$readwatchpage4 = "https://www.spc.noaa.gov/products/watch/ww$watchno4.html";
$readwatchpage5 = "https://www.spc.noaa.gov/products/watch/ww$watchno5.html";
$readwatchpage6 = "https://www.spc.noaa.gov/products/watch/ww$watchno6.html";


$getwatchpage1 = file_get_contents($readwatchpage1);
$getwatchpage2 = file_get_contents($readwatchpage2);
$getwatchpage3 = file_get_contents($readwatchpage3);
$getwatchpage4 = file_get_contents($readwatchpage4);
$getwatchpage5 = file_get_contents($readwatchpage5);
$getwatchpage6 = file_get_contents($readwatchpage6);


//text
$getwatchtext = "#<pre>(.*?)<\/pre>#s";
preg_match($getwatchtext, $getwatchpage1, $bodymatch1);
preg_match($getwatchtext, $getwatchpage2, $bodymatch2);
preg_match($getwatchtext, $getwatchpage3, $bodymatch3);
preg_match($getwatchtext, $getwatchpage4, $bodymatch4);
preg_match($getwatchtext, $getwatchpage5, $bodymatch5);
preg_match($getwatchtext, $getwatchpage6, $bodymatch6);

//echo $bodymatch1[0];

$watchtext1 = str_replace("\n"," * ", $bodymatch1[0]);
$watchtext2 = str_replace("\n"," * ", $bodymatch2[0]);
$watchtext3 = str_replace("\n"," * ", $bodymatch3[0]);
$watchtext4 = str_replace("\n"," * ", $bodymatch4[0]);
$watchtext5 = str_replace("\n"," * ", $bodymatch5[0]);
$watchtext6 = str_replace("\n"," * ", $bodymatch6[0]);

$checkwatchtext = "#Tornado#";
preg_match($checkwatchtext, $watchtext1, $bodymatch1);
preg_match($checkwatchtext, $watchtext2, $bodymatch2);
preg_match($checkwatchtext, $watchtext3, $bodymatch3);
preg_match($checkwatchtext, $watchtext4, $bodymatch4);
preg_match($checkwatchtext, $watchtext5, $bodymatch5);
preg_match($checkwatchtext, $watchtext6, $bodymatch6);


if ($bodymatch1[0] == "Tornado") {
$color1 = $torcolor;	
}
if ($bodymatch2[0] == "Tornado") {
$color2 = $torcolor;	
}
if ($bodymatch3[0] == "Tornado") {
$color3 = $torcolor;	
}
if ($bodymatch4[0] == "Tornado") {
$color4 = $torcolor;	
}
if ($bodymatch5[0] == "Tornado") {
$color5 = $torcolor;	
}
if ($bodymatch6[0] == "Tornado") {
$color6 = $torcolor;	
}

$readwatchlatlon1 = "https://www.spc.noaa.gov/products/watch/wou$watchno1.html";
$readwatchlatlon2 = "https://www.spc.noaa.gov/products/watch/wou$watchno2.html";
$readwatchlatlon3 = "https://www.spc.noaa.gov/products/watch/wou$watchno3.html";
$readwatchlatlon4 = "https://www.spc.noaa.gov/products/watch/wou$watchno4.html";
$readwatchlatlon5 = "https://www.spc.noaa.gov/products/watch/wou$watchno5.html";
$readwatchlatlon6 = "https://www.spc.noaa.gov/products/watch/wou$watchno6.html";
$getwatchlatlon1 = file_get_contents($readwatchlatlon1);
$getwatchlatlon2 = file_get_contents($readwatchlatlon2);
$getwatchlatlon3 = file_get_contents($readwatchlatlon3);
$getwatchlatlon4 = file_get_contents($readwatchlatlon4);
$getwatchlatlon5 = file_get_contents($readwatchlatlon5);
$getwatchlatlon6 = file_get_contents($readwatchlatlon6);



//LAT...LON 
//$matchlatlon = "/LAT...LON((?:.|\n)*)$/m";
$matchlatlon = "#LAT...LON [0-9]{8} [0-9]{8} [0-9]{8} [0-9]{8}#s";
preg_match($matchlatlon, $getwatchlatlon1, $latlonmatch1);
preg_match($matchlatlon, $getwatchlatlon2, $latlonmatch2);
preg_match($matchlatlon, $getwatchlatlon3, $latlonmatch3);
preg_match($matchlatlon, $getwatchlatlon4, $latlonmatch4);
preg_match($matchlatlon, $getwatchlatlon5, $latlonmatch5);
preg_match($matchlatlon, $getwatchlatlon6, $latlonmatch6);

//echo $latlonmatch1[0];



if ($latlonmatch1[0] != null) {
echo "
$color1
Line: 3, 0, \"$watchtext1\"
";
$arr1 =  explode(" ", $latlonmatch1[0]);
foreach($arr1 as $v)
{
if(preg_match("/^[0-9]{8}$/",$v)) {
		echo LatLon(substr($v,0,8)) . "\n";
	}
}
echo "End:";
} 


if ($latlonmatch2[0] != null) {
echo "
$color2
Line: 3, 0, \"$watchtext2\"
";
$arr2 =  explode(" ", $latlonmatch2[0]);
foreach($arr2 as $v)
{
if(preg_match("/^[0-9]{8}$/",$v)) {
		echo LatLon(substr($v,0,8)) . "\n";
	}
}
echo "End:";
} 

if ($latlonmatch3[0] != null) {
echo "
$color3
Line: 3, 0, \"$watchtext3\"
";
$arr3 =  explode(" ", $latlonmatch3[0]);
foreach($arr3 as $v)
{
if(preg_match("/^[0-9]{8}$/",$v)) {
		echo LatLon(substr($v,0,8)) . "\n";
	}
}
echo "End:";
}

if ($latlonmatch4[0] != null) {
echo "
$color4
Line: 3, 0, \"$watchtext4\"
";
$arr4 =  explode(" ", $latlonmatch4[0]);
foreach($arr4 as $v)
{
if(preg_match("/^[0-9]{8}$/",$v)) {
		echo LatLon(substr($v,0,8)) . "\n";
	}
}
echo "End:";
}

if ($latlonmatch5[0] != null) {
echo "
$color5
Line: 3, 0, \"$watchtext5\"
";
$arr5 =  explode(" ", $latlonmatch5[0]);
foreach($arr5 as $v)
{
if(preg_match("/^[0-9]{8}$/",$v)) {
		echo LatLon(substr($v,0,8)) . "\n";
	}
}
echo "End:";
}

if ($latlonmatch6[0] != null) {
echo "
$color6
Line: 3, 0, \"$watchtext4\"
";
$arr6 =  explode(" ", $latlonmatch6[0]);
foreach($arr6 as $v)
{
if(preg_match("/^[0-9]{8}$/",$v)) {
		echo LatLon(substr($v,0,8)) . "\n";
	}
}
echo "End:";
}



//process each latlon pairs  
//Thank you to Paul Wetter (https://github.com/paulwetter)
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
