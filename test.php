<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2015-07-02
 * Time: 17:26
 */
// Code for testing to read GPX file (move.gpx)


include('CActivity.php');
include('CGPXparser.php');
include('CLaps.php');
include('CPoints.php');
include('functions.php');

$parser = new CGPXparser();
$parser->AddGpx('move.gpx');
$parser->SetActivityType("Running");

$laps = $parser->GetLaps();
$activity = $parser->GetActivity();
$points = $parser->GetPoints();
$parser->SetNameFromFirstPoint();


echo "<pre>";
//print_r($activity);
echo "</pre>";
echo "<pre>";
//print_r($laps);
echo "</pre>";
echo "<pre>";
//print_r($points);
echo "</pre>";


