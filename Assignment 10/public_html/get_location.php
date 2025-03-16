<?php
header('Content-Type: application/json');

// Get client IP
$client_ip = $_SERVER['REMOTE_ADDR'];

// Use ipinfo.io for geolocation (replace 'YOUR_TOKEN' with your API key)
$geo_api_url = "https://ipinfo.io/{$client_ip}/json?token=YOUR_TOKEN";

// Fetch location data
$location_data = file_get_contents($geo_api_url);
if ($location_data === FALSE) {
    echo json_encode(["error" => "Unable to fetch location"]);
    exit();
}

// Parse and return the location data
$location = json_decode($location_data, true);
if (isset($location['loc'])) {
    list($latitude, $longitude) = explode(',', $location['loc']);
    echo json_encode([
        "ip" => $client_ip,
        "latitude" => $latitude,
        "longitude" => $longitude
    ]);
} else {
    echo json_encode(["error" => "Location data unavailable"]);
}
?>