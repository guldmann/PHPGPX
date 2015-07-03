<?php
/**
 * Created by PhpStorm.
 * Project GPXparser
 * User: john Larsen    john@pcis.se
 *
 * Date: 2015-07-01
 * Time: 09:44
 */

// TODO: add some error handling
class CGPXparser
{
    private $activity;
    private $point;
    private $lap;
    private $gpx;

    /**
     * for now only supporting gpx data as a file
     * @param $gpxData
     *
     * TODO: add support for data as string
     */
    public function AddGpx($gpxDataFile)
    {


        if(file_exists ( $gpxDataFile )) {

            $this->gpx = simplexml_load_file($gpxDataFile);
            $this->activity = new CActivity();
            self::points();
            self::Laps();
        }


       //TODO: implement data as string
        /*
            $this->gpx = simplexml_load_string($gpxData);
            $this->activity = new CActivity();
            self::points();
            self::Laps();
        */

    }

    /**
     * @return CActivity object
     */
    public function GetActivity()
    {
        return $this->activity;
    }

    /**
     * @return array CPoints object
     */
    public function GetPoints()
    {
        return $this->activity->getPoints();
    }

    /**
     * @return array CLaps object
     */
    public function GetLaps()
    {
        return $this->activity->getLaps();
    }

    /**
     * Set the activity type like running, biking , skiing...
     * @param $type
     */
    public function SetActivityType($type)
    {
        if(isset($type) && $type != null && $type != "")
        {
            $this->activity->setType($type);
        }
    }

    /**
     * @param $name
     */
    public function SetName($name)
    {
        if(isset($name) && $name != null && $name != "")
        {
            $this->activity->setName($name);
        }
    }
    public function GetPontByIndex($index)
    {
        return $this->activity->GetPontByIndex($index);
    }

    public function SetNameFromFirstPoint()
    {
        $point = self::GetPontByIndex(0);
        var_dump($point);
        Get_Address_From_Google_Maps($point->getLat(), $point->GetLon());

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