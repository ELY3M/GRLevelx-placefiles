<?php


//https://forecast.weather.gov/product.php?site=NWS&issuedby=MCD&product=SWO&format=txt&version=1&glossary=0


//$readmcd = file_get_contents($mcdurl);
//echo $readmcd;

$mcdurl = "http://tgftp.nws.noaa.gov/data/raw/ac/acus11.kwns.swo.mcd.txt";

//$getmcdnum = "/Mesoscale Discussion #(.*?)/";

//$getmcdnum = "/<strong><a href=.\/products\/md\/md.....html.>Mesoscale Discussion #(.*?)<\/a><\/strong>/";

//echo $getmcdnum;


$readmcd = file_get_contents($mcdurl);

echo $readmcd;

//LAT...LON 

$matchlatlon = "/LAT...LON((?:.|\n)*)$/m";


preg_match($matchlatlon, $readmcd, $matches);

echo "<pre>";
print_r($matches);
echo "</pre>";



//echo $matches[0];
//echo $matches[1];
//echo $matches[2];
//echo $matches[3];
//echo $matches[4];




?>