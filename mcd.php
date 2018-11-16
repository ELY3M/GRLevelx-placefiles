<?php

/*

MCD plotter for GRlevelx   

I am sick of others placefiles breaking on me.  
so I will make them myself and release this source code.  
ELY M.  


echo "<pre>
Refresh: 1
Title: testing
Threshold: 999
Color: 0 0 255
Line: 3, 0, \"testing\" 
40.60, -74.46
40.91, -74.27
41.00, -74.30
41.04, -74.50
41.09, -74.50
41.23, -74.34
41.12, -73.23
41.00, -73.61
40.85, -73.76
40.84, -73.75
40.95, -73.49
40.91, -73.22
40.98, -73.12
40.99, -72.64
41.10, -72.41
41.04, -72.20
41.10, -72.07
40.77, -72.70
40.62, -73.22
40.56, -73.92
40.60, -74.46
End:
</pre>";

	
*/

ini_set('error_reporting', E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE); // Show all errors minus STRICT, DEPRECATED and NOTICES
ini_set('display_errors', 0); // disable error display
ini_set('log_errors', 0); // disable error logging


//$mcdurl = "testmcd.txt";
$mcdurl = "https://www.spc.noaa.gov/products/md/";


$readmcd = file_get_contents($mcdurl);
//echo $readmcd;


$getmcdnum = "/<strong><a href=.\/products\/md\/md.....html.>Mesoscale Discussion #(.*?)<\/a><\/strong>/";

preg_match_all($getmcdnum, $readmcd, $numbermatches);
//echo "<pre>";
//print_r($numbermatches);
//echo "</pre>";


$mcdno = $numbermatches[1][0];

$readmcdpage = "https://www.spc.noaa.gov/products/md/md$mcdno.html";
$getmcdpage = file_get_contents($readmcdpage);
//echo $getmcdpage;


//text
$getmcdtext = "#<pre>(.*?)<\/pre>#s";
preg_match($getmcdtext, $getmcdpage, $bodymatch);
//echo "<pre>";
//echo $bodymatch[0];
//echo "</pre>";


//LAT...LON 
//$matchlatlon = "/LAT...LON((?:.|\n)*)$/m";
$matchlatlon = "#LAT...LON   (.*?)<\/pre>#s";
preg_match($matchlatlon, $getmcdpage, $latlonmatch);
//echo "<pre>";
//echo $latlonmatch[0];
//echo "</pre>";



echo "<pre>
Refresh: 10
Title: MCDs
Threshold: 999
Color: 0 0 255
Line: 3, 0, \"testing\"<br>";


//process each latlon pairs  

$arr =  explode(" ", $latlonmatch[0]);
foreach($arr as $v)
{	
echo putdotin($v);
}


echo "<br>End:
</pre>";





function putdotin(String $oldnum) {
$number = ($oldnum * 0.000001);
if ($number == 0) { return ""; }
$number.= ', <br>';
return $number;
}
















?>