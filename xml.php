<?php
libxml_use_internal_errors(true);

$xml = simplexml_load_file("move.gpx");
//echo $xml->asXML();
$trk = $xml->trk;
$trkseg = $xml->trk->trkseg;
$flip = $xml->trk->trkseg->trkpt;

$name  = $xml->trk->name;
$seg = $xml->trk->trkseg;
$testes = $seg->trkpt;


foreach ($testes as $key => $value) {
//echo "key : ".print_r($key,true). "=> ".print_r($value,true);
echo "<br><br>"; 
$ops = $value->attributes(); 
$lat = $ops['lat']; 
$lon = $ops['lon'];
$ele = $value->ele; 
$time = $value->time; 
$extension = $value->extension;


        $namespaces = $extension->getNamespaces(true);
     echo '<pre>';
     print_r($namespaces);
     echo '</pre>';
       // $gpxtpx = $value->extension->children($namespaces['gpxtpx']);
       // $hr = (string) $gpxtpx->TrackPointExtension->hr;
       // echo '<pre>';
       // print_r($hr);
       // echo '</pre>';





echo "lat: " .$lat ."<br>";
echo "lon: " .$lon ."<br>";
echo "ele: " .$ele ."<br>";
echo "Time: " .$time ."<br>";
echo "extenssion ". print_r($extension,true)."<br>";



echo "<br><br>"; 
}



echo "name: " .$name; 
echo "<br><br>"; 
//echo "tes :" .print_r($testes[7],true);

echo "<br><br>"; 

//print_r($trk);

//foreach ($trkseg->trkpt as $key => $value) {
//echo $key."->".$value;
//}
//$trkpt = $trk->trkseg;
//print_r($trkseg);


?>