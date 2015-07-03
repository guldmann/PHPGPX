<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2015-07-01
 * Time: 09:51
 */




function ConvertDateTime($datatime)
{
    $realDateTime = new DateTime($datatime);

    //reformat to server timezopne  ?
    $new=new DateTime(); $new->setTimestamp($realDateTime->getTimestamp());
    $date = $new->format('Y-m-d');
    $time = $new->format('H:i:s');
    return array("date" => $date, "time" => $time);
}

function Get_Address_From_Google_Maps($lat, $lon) {

    $url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lon&sensor=false";

// Make the HTTP request
    $data = @file_get_contents($url);
// Parse the json response
    $jsondata = json_decode($data,true);

// If the json data is invalid, return empty array
    if (!check_status($jsondata))   return array();

    $address = array(
        'country' => google_getCountry($jsondata),
        'province' => google_getProvince($jsondata),
        'city' => google_getCity($jsondata),
        'street' => google_getStreet($jsondata),
        'postal_code' => google_getPostalCode($jsondata),
        'country_code' => google_getCountryCode($jsondata),
        'formatted_address' => google_getAddress($jsondata),
    );
    var_dump($address);
    return $address;
}

/*
* Check if the json data from Google Geo is valid
*/

function check_status($jsondata) {
    if ($jsondata["status"] == "OK") return true;
    return false;
}

/*
* Given Google Geocode json, return the value in the specified element of the array
*/

function google_getCountry($jsondata) {
    return Find_Long_Name_Given_Type("country", $jsondata["results"][0]["address_components"]);
}
function google_getProvince($jsondata) {
    return Find_Long_Name_Given_Type("administrative_area_level_1", $jsondata["results"][0]["address_components"], true);
}
function google_getCity($jsondata) {
    return Find_Long_Name_Given_Type("locality", $jsondata["results"][0]["address_components"]);
}
function google_getStreet($jsondata) {
    return Find_Long_Name_Given_Type("street_number", $jsondata["results"][0]["address_components"]) . ' ' . Find_Long_Name_Given_Type("route", $jsondata["results"][0]["address_components"]);
}
function google_getPostalCode($jsondata) {
    return Find_Long_Name_Given_Type("postal_code", $jsondata["results"][0]["address_components"]);
}
function google_getCountryCode($jsondata) {
    return Find_Long_Name_Given_Type("country", $jsondata["results"][0]["address_components"], true);
}
function google_getAddress($jsondata) {
    return $jsondata["results"][0]["formatted_address"];
}

/*
* Searching in Google Geo json, return the long name given the type.
* (If short_name is true, return short name)
*/

function Find_Long_Name_Given_Type($type, $array, $short_name = false) {
    foreach( $array as $value) {
        if (in_array($type, $value["types"])) {
            if ($short_name)
                return $value["short_name"];
            return $value["long_name"];
        }
    }
}

/*
*  Print an array
*/

function d($a) {
    echo "<pre>";
    print_r($a);
    echo "</pre>";
}