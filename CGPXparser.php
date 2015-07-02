<?php
/**
 * Created by PhpStorm.
 * Project GPXparser
 * User: john Larsen    john@pcis.se
 *
 * Date: 2015-07-01
 * Time: 09:44
 */

class CGPXparser
{
    private $activity;
    private $point;
   private $lap;
    private $gpx;

    /**
     * Add gpx data in form of string or file
     * @param $gpxData
     */
    public function AddGpx($gpxData)
    {
       // if(get_resource_type($gpxData) == 'file' || get_resource_type($gpxData) == 'stream')
       // {
            $this->gpx = simplexml_load_file($gpxData);
            $this->activity = new CActivity();
            self::points();
            self::Laps();
        //}
        /*
        else if(is_string($gpxData))
        {
            $this->gpx = simplexml_load_string($gpxData);
            $this->activity = new CActivity();
            self::points();
            self::Laps();
        }
        else
        {
            // handle we have an error no file or string
            // what to do ? output ?
        }*/
    }
    public function SetName($name)
    {
        if(isset($name) && $name != null && $name != "")
        {
            $this->activity->setName($name);
        }
    }

    public function SetNameFromFirstPoint()
    {
        // get city street name from first lat lon point and suffix with date time

        self::SetName(null);
    }

    private function points()
    {
        if($this->gpx != null && isset($this->gpx))
        {
            foreach($this->gpx->trk->trkseg->trkpt as $trkpt) {

                $point = new CPoints();

                // points elements  lat lon
                $ops = $trkpt->attributes();
                $lat = isset($ops['lat']) ? (string) $ops['lat'] : null;
                $lon = isset($ops['lon'])? (string) $ops['lon'] : null;
                $point->setLat($lat);
                $point->setLon($lon);

                // elevation and time
                $point->setElevation($trkpt->ele);
                $ele = isset($trkpt->ele)   ? (string) $trkpt->ele : null ;
                $time = isset($trkpt->time) ? (string) $trkpt->time : null;
                $point->setElevation($ele);
                $point->setFulltime($time);

                // Get extension data
                $namespaces = $trkpt->getNamespaces(true);
                $gpxtpx = $trkpt->extensions->children($namespaces['gpxtpx']);
                $hr = isset($gpxtpx->TrackPointExtension->hr) ? (string)$gpxtpx->TrackPointExtension->hr : null;
                $point->setHr($hr);

                $namespaces = $trkpt->getNamespaces(true);
                $gpxdata = $trkpt->extensions->children($namespaces['gpxdata']);
                $cadense = isset($gpxdata->cadence) ? (string) $gpxdata->cadence : null;
                $temp = isset($gpxdata->temp)? (string)  $gpxdata->temp : null ;
                $distance = isset($gpxdata->distance)? (string) $gpxdata->distance  : null;
                $altitude = isset($gpxdata->altitude) ? (string) $gpxdata->altitude : null;
                $energy = isset($gpxdata->energy)? (string) $gpxdata->energy : null;
                $seaLevelPressure = isset($gpxdata->seaLevelPressure)? (string) $gpxdata->seaLevelPressure : null;
                $speed = isset($gpxdata->speed) ? (string) $gpxdata->speed : null;
                $verticalSpeed = isset($gpxdata->verticalSpeed) ? (string) $gpxdata->verticalSpeed : null;

                // add extension data to point
                $point->setCadence($cadense);
                $point->setTemp($temp);
                $point->setDistance($distance);
                $point->setAltitude($altitude);
                $point->setEnergy($energy);
                $point->setSeaLevelPressure($seaLevelPressure);
                $point->setSpeed($speed);
                $point->setVerticalSpeed($verticalSpeed);

                //add point to activity
                $this->activity->setPoints($point);

            }
        }

    }

    private function Laps()
    {
        if($this->gpx != null && isset($this->gpx)) {

            $counter = 1;
            foreach ($this->gpx->extensions->lap as $lapval) {
                $lap = new CLaps();

                $lapNumber = null;
                $index = isset($lapval->index) ? (string) $lapval->index : null  ;
                $startTime = isset($lapval->startTime) ? (string) $lapval->startTime : null ;
                $elapsedTime = isset($lapval->elapsedTime) ? (string) $lapval->elapsedTime : null;
                $distance = isset($lapval->distance) ? (string) $lapval->distance: null;

                if ($distance >= 1 && $elapsedTime >= 1) {
                    $lapNumber = $counter;
                    $counter++;
                }
                $lap->setStartTime($startTime);
                $lap->setDistance($distance);
                $lap->setElapsedTime($elapsedTime);
                $lap->setLapIndex($index);
                $lap->setLapNumber($lapNumber);
                $this->activity->setLaps($lap);
            }
        }
    }
} 