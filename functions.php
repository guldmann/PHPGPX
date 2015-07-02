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

    $date = $realDateTime->format('Y-m-d');
    $time = $realDateTime->format('H:i:s');

    return array("data" => $date, "time" => $time);

}
