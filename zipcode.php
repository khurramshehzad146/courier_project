<?php
$geonamesUsername = 'khurram146';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        
        <select name="country" id="">
            <option value="">--select--</option>
            <?php
            $countires = get_all_country($geonamesUsername);
            foreach($countires as $country)
            {
                echo "<option value=".$country['countryCode'].">".$country['countryName']."</option>";
            }
            ?>
        </select>
        <input type="submit" value="submit">
    </form>
</body>
</html>


<?php

if(isset($_POST['country'])){
    $country = $_POST['country'];
    get_country_wise_states($geonamesUsername, $country);
}
// get_country_wise_states($geonamesUsername, $zipCode);

function get_all_country($geonamesUsername)
{
        $apiUrl = "http://api.geonames.org/countryInfoJSON?username=$geonamesUsername";
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            die('cURL error: ' . curl_error($ch));
        }

        curl_close($ch);
        $data = json_decode($response, true);
        return $data['geonames'];
        // print_r($data['geonames']);
}

function get_country_wise_states($geonamesUsername, $country)
{
    $apiUrl = "http://api.geonames.org/postalCodeLookupJSON?postalcode=44000&country=$country&username=$geonamesUsername";
    // $apiUrl = "http://api.geonames.org/postalCodeLookupJSON?postalcode=$zipCode&country=PK&username=$geonamesUsername";

    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        die('cURL error: ' . curl_error($ch));
    }

    curl_close($ch);
    $data = json_decode($response,true);
    print_r($data['postalcodes']);
    // if (!empty($data->postalcodes)) {
    //     $countryCode = $data->postalcodes[0]->countryCode;
    //     $countryName = $data->postalcodes[0]->countryName;

    //     echo "Zip Code: $zipCode<br>";
    //     echo "Country Code: $countryCode<br>";
    //     echo "Country Name: $countryName<br>";
    // } else {
    //     echo "No data found for the provided zip code.";
    // }
}

?>
