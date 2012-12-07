<?php
error_reporting(E_ALL);

$url = "https://dkmtools.fbk.eu/moki/organiclingua/OntologyService/RequestManager.php";

$ch = curl_init();

//"method"         : contains the name of the method that you want to invoke. This is the only parameter that is mandatory for invoking the service.
//"concept"        : contains the name of the concept from which you want to retrieve information.
//"keyword"        : contains the keyword, or set of keywords, that you want to send for retrieving correlated concepts.
//"langid"         : contains the identifier of the language that you want to use for filtering information provided by the service.
//"newtranslation" : this parameter is managed only for the method that permit you to update a translation in a concept; otherwise, it is ignored.
//"conceptlist"    : contains the list of the concept that you want to use for retrieving resources.


$request = array (
		"method" => "getOntology", 
		"concept" => "", 
		"keyword" => "", 
		"langid" => "en", 
		"newtranslation" => "",
		"conceptlist" => ""
	);

$defaults = array (
		CURLOPT_POST => 1,
		CURLOPT_HEADER => 0,
		CURLOPT_URL => $url,
		CURLOPT_FRESH_CONNECT => 1,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_FORBID_REUSE => 1,
		CURLOPT_TIMEOUT => 60,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_SSL_VERIFYPEER => FALSE,
		CURLOPT_POSTFIELDS => http_build_query($request)
	);
		
$options = array(
//		"langid" => "en"
	);
											
curl_setopt_array($ch, ($options + $defaults));
//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, TRUE);
//curl_setopt($ch, CURLOPT_PROXY, "http://proxy-address"); 
	
if(!$result = curl_exec($ch))
{
	echo "REQUEST FAILED:<br/>";
	echo curl_error($ch)."<br/><br/>";
}
else echo $result;

curl_close($ch);