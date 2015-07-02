<?php
/**
 * Created by PhpStorm.
 * Project GPXparser
 * User: john Larsen    john@pcis.se
 * Date: 2015-07-01
 * Time: 09:46
 */

class CActivity
{
    private $laps = array();
    private $points = array();
    private $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        if($name != null && isset($name)) {
            $this->name = $name;
        }
    }

    /**
     * Give activity a uniq name ?? use this to what  ?
     */
    public function GenerateName()
    {


    }

    /**
     * @return array
     */
    public function getLaps()
    {
        return $this->laps;
    }

    /**
     * @param CLaps $lap
     */
    public function setLaps(CLaps $lap)
    {
        if(isset($lap) && $lap != null) {
            $this->laps[] = $lap;
        }
    }

    /**
     * @return array
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param CPoints $point
     */
    public function setPoints(CPoints $point)
    {
        if(isset($point) && $point != null) {
            $this->points[] = $point;
        }
    }
} 