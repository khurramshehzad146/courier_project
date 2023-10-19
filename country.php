<?php
$geonamesUsername = 'khurram146';
$apiUrl = "http://api.geonames.org/countryInfoJSON?username=$geonamesUsername";
// http://api.geonames.org/childrenJSON?geonameId=1168579&username=khurram146
// $apiUrl = "http://api.geonames.org/postalCodeLookupJSON?postalcode=&country=PK&username=$geonamesUsername";

$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
if (curl_errno($ch)) {
    die('cURL error: ' . curl_error($ch));
}

curl_close($ch);
$data = json_decode($response, true);
        print_r($data);
// git upload data

?>