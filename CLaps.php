<?php
/**
 * Created by PhpStorm.
 * Project GPXparser
 * User: john Larsen    john@pcis.se
 * Date: 2015-07-01
 * Time: 09:47
 */

/**
 * Class CLaps
 * Lap data from GPX file
 */
class CLaps
{
    private $startTime;
    private $elapsedTime;
    private $distance;
    private $date;
    private $time;


    public function setLap($startTime,$elapsedTime,$distance )
    {
        self::setStartTime($startTime);
        self::setElapsedTime($elapsedTime);
        self::setDistance($distance);
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set startTime
     * Call function ConvertDateTime to retrieve date and time from string
     * Set date and time
     * @param $startTime
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
        $datetimearray = ConvertDateTime($startTime);
        $this->time = isset($datetimearray['time']) ? $datetimearray['time'] : null;
        $this->date = isset($datetimearray['date']) ? $datetimearray['date'] : null;
    }

    /**
     * @return mixed
     */
    public function getElapsedTime()
    {
        return $this->elapsedTime;
    }

    /**
     * @param mixed $elapsedTime
     */
    public function setElapsedTime($elapsedTime)
    {
        $this->elapsedTime = $elapsedTime;
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














} 