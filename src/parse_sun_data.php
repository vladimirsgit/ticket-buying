<?php

parseSunData();
function parseSunData(): void{
    $lat = $_GET['lat'] ?? null;
    $long = $_GET['long'] ?? null;

    $url = 'https://www.timeanddate.com/sun/@' . $lat . ',' . $long;

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, 0);

    $html = curl_exec($curl);

    curl_close($curl);

    if ($html === false) {
        exit("Error fetching content");
    }


    $dom = new DOMDocument();

    @$dom->loadHTML($html);

    $table = $dom->getElementsByTagName('table');

    echo $dom->saveHTML($table[0]);
}

