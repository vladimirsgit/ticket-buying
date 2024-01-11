<?php

$url = 'https://www.timeanddate.com/sun/@40.71,-73.98';

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, 0);

$html = curl_exec($curl);

curl_close($curl);

if($html === false){
    exit("Error fetching content");
}


echo $html;
$dom = new DOMDocument();

@$dom->loadHTML($html);

$divs = $dom->getElementsByTagName('div');
