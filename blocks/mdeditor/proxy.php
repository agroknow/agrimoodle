<?php
$url = $_GET['url'];
$url =  str_replace(" ","%20", $url);
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$output = curl_exec($ch); 
curl_close($ch);
echo $output;
?>