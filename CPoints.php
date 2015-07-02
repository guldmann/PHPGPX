<?php
/**
 * Created by PhpStorm.
 * Project GPXparser
 * User: john Larsen    john@pcis.se
 * Date: 2015-07-01
 * Time: 09:47
 */

class CPoints
{
    private $lat;       //
    private $lon;       //
    private $elevation; //
    private $fulltime;  //
    private $date;      //
    private $time;      //
    private $hr;        //
    private $cadence;   //
    private $temp;      // temperature in celsius
    private $distance;  // distance in meters
    private $altitude;  // altitude in meters
    private $energy;  // energy in cal
    private $seaLevelPressure; //
    private $speed;
    private $verticalSpeed;


    public function setPoint($data)
    {
        if(isset($data) && is_array($data))
        {
            self::setLat($data['lat']);
            self::setLon($data['lon']);
            self::setElevation($data['elevation']);
            self::setFulltime(['time']);
            self::setHr(['hr']);
            self::setCadence(['cadence']);
            self::setTemp(['temp']);
            self::setDistance(['distance']);
            self::setAltitude(['altitude']);
            self::setEnergy(['energy']);
            self::setSeaLevelPressure(['seaLevelPressure']);
            self::setSpeed(['speed']);
            self::setVerticalSpeed(['verticalSpeed']);

        }

    }

    /**
     * @return mixed
     */
    public function getAltitude()
    {
        return $this->altitude;
    }

    /**
     * @param mixed $altitude
     */
    public function setAltitude($altitude)
    {
        $this->altitude = $altitude;
    }

    /**
     * @return mixed
     */
    public function getCadence()
    {
        return $this->cadence;
    }

    /**
     * @param mixed $cadence
     */
    public function setCadence($cadence)
    {
        $this->cadence = $cadence;
    }


    /**
     * @return mixed
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param mixed $distance
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
    }

    /**
     * @return mixed
     */
    public function getElevation()
    {
        return $this->elevation;
    }

    /**
     * @param mixed $elevation
     */
    public function setElevation($elevation)
    {
        $this->elevation = $elevation;
    }

    /**
     * @return mixed
     */
    public function getEnergy()
    {
        return $this->energy;
    }

    /**
     * @param mixed $energy
     */
    public function setEnergy($energy)
    {
        $this->energy = $energy;
    }

    /**
     * @return mixed
     */
    public function getFulltime()
    {
        return $this->fulltime;

    }

    /**
     * @param mixed $fulltime
     */
    public function setFulltime($fulltime)
    {
        $this->fulltime = $fulltime;
        $datetimearray = ConvertDateTime($fulltime);
        $this->time = isset($datetimearray['time']) ? $datetimearray['time'] : null;
        $this->date = isset($datetimearray['date']) ? $datetimearray['date'] : null;
    }

    /**
     * @return mixed
     */
    public function getHr()
    {
        return $this->hr;
    }

    /**
     * @param mixed $hr
     */
    public function setHr($hr)
    {
        $this->hr = $hr;
    }

    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param mixed $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return mixed
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * @param mixed $lon
     */
    public function setLon($lon)
    {
        $this->lon = $lon;
    }

    /**
     * @return mixed
     */
    public function getSeaLevelPressure()
    {
        return $this->seaLevelPressure;
    }

    /**
     * @param mixed $seaLevelPressure
     */
    public function setSeaLevelPressure($seaLevelPressure)
    {
        $this->seaLevelPressure = $seaLevelPressure;
    }

    /**
     * @return mixed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param mixed $speed
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
    }

    /**
     * @return mixed
     */
    public function getTemp()
    {
        return $this->temp;
    }

    /**
     * @param mixed $temp
     */
    public function setTemp($temp)
    {
        $this->temp = $temp;
    }


    /**
     * @return mixed
     */
    public function getVerticalSpeed()
    {
        return $this->verticalSpeed;
    }

    /**
     * @param mixed $verticalSpeed
     */
    public function setVerticalSpeed($verticalSpeed)
    {
        $this->verticalSpeed = $verticalSpeed;
    }






} 