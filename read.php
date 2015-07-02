<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2015-06-29
 * Time: 19:36
 */

$xml = simplexml_load_file('move.gpx');


// GET track points
foreach($xml->trk->trkseg->trkpt as $trkpt) {

    // points elements  lat lon
    $ops = $trkpt->attributes();
    $lat = $ops['lat'];
    $lon = $ops['lon'];

    // elevation and time
    $ele = $trkpt->ele;
    $time = $trkpt->time;

    // Get extension data
    $namespaces = $trkpt->getNamespaces(true);
    $gpxtpx = $trkpt->extensions->children($namespaces['gpxtpx']);
    $hr = (string) $gpxtpx->TrackPointExtension->hr;

    $namespaces = $trkpt->getNamespaces(true);
    $gpxdata= $trkpt->extensions->children($namespaces['gpxdata']);
    $cadense = $gpxdata->cadence;

    $temp = $gpxdata->temp;
    $distance = $gpxdata->distance;
    $altitude = $gpxdata->altitude;
    $energy = $gpxdata->energy;
    $seaLevelPressure = $gpxdata->seaLevelPressure;
    $speed = $gpxdata->speed;
    $verticalSpeed = $gpxdata->verticalSpeed;

// DO print
    echo "ele: " .$ele ."<br>";
    echo "Time: " .$time ."<br>";
    echo "lat: " .$lat ."<br>";
    echo "lon: " .$lon ."<br>";
    echo "Hr: " .$hr ."<br>";
    echo "cadence: " .$cadense ."<br>";
    echo "temp: " .$temp ."<br>";
    echo "distance: " .$distance ."<br>";
    echo "altitude: " .$altitude ."<br>";
    echo "energy: " .$energy ."<br>";
    echo "seaLevelPressure: " .$seaLevelPressure ."<br>";
    echo "speed: " .$speed ."<br>";
    echo "verticalSpeed: " .$verticalSpeed ."<br>";

    echo "<br><br>";



}

echo "LAPS: <br>";
$counter  = 1;
foreach($xml->extensions->lap as $lap) {

    $index = $lap->index;
    $startTime = $lap->startTime;
    $elapsedTime = $lap->elapsedTime;
    $distance = $lap->distance;

    if($distance >= 1 && $elapsedTime >=1 )
    {
        echo "lap number: " .$counter."<br>";
        echo "index: " . $index . "<br>";
        echo "starttime: " . $startTime . "<br>";
        echo "elapsedtime: " . $elapsedTime . "<br>";
        echo "distance: " . $distance . "<br>";
        echo "<br><br>";
        $counter++;
    }


}