<?php
$lines = file('taipei.csv');
foreach ($lines as $line) {
    $stations[] = str_getcsv($line);
}

// remove keys.
unset($stations[0]);

$geometry = [
    'type' => 'Point'
];

foreach ($stations as $station) {
    list(
        $station_code,
        /* $construction_id */,
        $station_name_tw,
        $station_name_en,
        $line_code,
        $line_name,
        $zipcode,
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
        '郵遞區號' => (int) $zipcode,
        '地址' => $address,
        '緯度' => (float) $lat,
        '經度' => (float) $lon
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

echo json_encode($geojson, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
