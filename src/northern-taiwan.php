<?php
$area_name = 'northern-taiwan';

// use wikipedia colors
$colors = [
    'BR' => '#c48c31',
    'R' => '#e3002c',
    'G' => '#008659',
    'O' => '#f8b61c',
    'BL' => '#0070bd',
    'Y' => '#fddb00',
    'A' => '#8246af',
];

$geometry = [
    'type' => 'Point'
];

$lines = file(__DIR__ . "/{$area_name}.csv");
foreach ($lines as $line) {
    $stations[] = str_getcsv($line, escape: '');
}

// remove column name
unset($stations[0]);

foreach ($stations as $station) {
    list(
        $station_code,
        /* $construction_id */,
        $station_name_tw,
        $station_name_en,
        $line_code,
        $line_name,
        $address,
        $lat,
        $lon
    ) = $station;

    $geometry['coordinates'] = [(float) $lon, (float) $lat];
    $properties = [
        '車站編號' => $station_code,
        '中文站名' => $station_name_tw,
        '英譯站名' => $station_name_en,
        '路線編號' => $line_code,
        '路線名' => $line_name,
        '地址' => $address,
        '緯度' => (float) $lat,
        '經度' => (float) $lon,
        // https://help.github.com/en/github/managing-files-in-a-repository/mapping-geojson-files-on-github#styling-features
        'marker-size' => 'medium',
        'marker-symbol' => 'rail-metro',
        'marker-color' => $colors[$line_code],
    ];

    $feature = [
        'type' => 'Feature',
        'geometry' => $geometry,
        'properties' => $properties
    ];

    $features[] = $feature;
}

$geojson = [
    'type' => 'FeatureCollection',
    'features' => $features
];

$handle = fopen(__DIR__ . "/../output/$area_name.geojson", 'w+');
fwrite($handle, json_encode($geojson, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
fclose($handle);
