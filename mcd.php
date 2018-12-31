<?php

/*

MCD plotter for GRlevelx   

I am sick of others placefiles breaking on me.  
so I will make them myself and release this source code.  
ELY M.  


This placefile read up to 6 MCDs at a time.  

	
*/

ini_set('error_reporting', E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE); // Show all errors minus STRICT, DEPRECATED and NOTICES
ini_set('display_errors', 0); // disable error display
ini_set('log_errors', 0); // disable error logging
header('Content-Type: text/plain');


echo "
Refresh: 10
Title: MCDs
Threshold: 999
";
                                                                                                                                                                   

$mcdurl = "https://www.spc.noaa.gov/products/md/";


$readmcd = file_get_contents($mcdurl);
//echo $readmcd;


$getmcdnum = "/<strong><a href=.\/products\/md\/md.....html.>Mesoscale Discussion #(.*?)<\/a><\/strong>/";

preg_match_all($getmcdnum, $readmcd, $numbermatches);
//print_r($numbermatches);



$mcdno1 = $numbermatches[1][0];
$mcdno2 = $numbermatches[1][1];
$mcdno3 = $numbermatches[1][2];
$mcdno4 = $numbermatches[1][3];
$mcdno5 = $numbermatches[1][3];
$mcdno6 = $numbermatches[1][3];
//for testing
//$mcdno = 1482; 



 

$readmcdpage1 = "https://www.spc.noaa.gov/products/md/md$mcdno1.html";
$readmcdpage2 = "https://www.spc.noaa.gov/products/md/md$mcdno2.html";
$readmcdpage3 = "https://www.spc.noaa.gov/products/md/md$mcdno3.html";
$readmcdpage4 = "https://www.spc.noaa.gov/products/md/md$mcdno4.html";
$readmcdpage5 = "https://www.spc.noaa.gov/products/md/md$mcdno5.html";
$readmcdpage6 = "https://www.spc.noaa.gov/products/md/md$mcdno6.html";


$getmcdpage1 = file_get_contents($readmcdpage1);
$getmcdpage2 = file_get_contents($readmcdpage2);
$getmcdpage3 = file_get_contents($readmcdpage3);
$getmcdpage4 = file_get_contents($readmcdpage4);
$getmcdpage5 = file_get_contents($readmcdpage5);
$getmcdpage6 = file_get_contents($readmcdpage6);



//text
$getmcdtext = "#<pre>(.*?)<\/pre>#s";
preg_match($getmcdtext, $getmcdpage1, $bodymatch1);
preg_match($getmcdtext, $getmcdpage2, $bodymatch2);
preg_match($getmcdtext, $getmcdpage3, $bodymatch3);
preg_match($getmcdtext, $getmcdpage4, $bodymatch4);
preg_match($getmcdtext, $getmcdpage5, $bodymatch5);
preg_match($getmcdtext, $getmcdpage6, $bodymatch6);
//echo $bodymatch[0];

$mcdtext1 = str_replace("\n"," * ", $bodymatch1[0]);
$mcdtext2 = str_replace("\n"," * ", $bodymatch2[0]);
$mcdtext3 = str_replace("\n"," * ", $bodymatch3[0]);
$mcdtext4 = str_replace("\n"," * ", $bodymatch4[0]);
$mcdtext5 = str_replace("\n"," * ", $bodymatch5[0]);
$mcdtext6 = str_replace("\n"," * ", $bodymatch6[0]);


//LAT...LON 
//$matchlatlon = "/LAT...LON((?:.|\n)*)$/m";
$matchlatlon = "#LAT...LON   (.*?)<\/pre>#s";
preg_match($matchlatlon, $getmcdpage1, $latlonmatch1);
preg_match($matchlatlon, $getmcdpage2, $latlonmatch2);
preg_match($matchlatlon, $getmcdpage3, $latlonmatch3);
preg_match($matchlatlon, $getmcdpage4, $latlonmatch4);
preg_match($matchlatlon, $getmcdpage5, $latlonmatch5);
preg_match($matchlatlon, $getmcdpage6, $latlonmatch6);
//echo $latlonmatch[0];



if ($latlonmatch1[0] != null) {
echo "
Color: 232 232 175
Line: 3, 0, \"$mcdtext1\"
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
Color: 232 232 175
Line: 3, 0, \"$mcdtext2\"
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
Color: 232 232 175
Line: 3, 0, \"$mcdtext3\"
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
Color: 232 232 175
Line: 3, 0, \"$mcdtext4\"
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
Color: 232 232 175
Line: 3, 0, \"$mcdtext5\"
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
Color: 232 232 175
Line: 3, 0, \"$mcdtext4\"
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
