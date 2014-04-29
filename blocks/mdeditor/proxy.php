<?php

$url = $_GET['url'];
//$url = str_replace(" ", "%20", $url);
$url = urlencode($url);

//$url = 'http://research.celi.it:8080/DomainTerminologyChecker/rest/domain_terminology_checker?translation=En+consecuencia%2C+los+agricultores+tienden+a+implementar+una+estrategia+de+control+de+malezas+no+enfocado+amplio%2C+sobre+la+base+de+productos+de+amplio+espectro+y+las+mezclas+de+diferentes+productos.&to=es&source=Consequently%2C+farmers+tend+to+implement+a+broad+non+focused+weed+control+strategy%2C+on+the+basis+of+broad+spectrum+products+and+mixtures+of+different+products.&from=en&service=microsoft&domainID=organic.lingua&json_output=true';
//gets the data from a URL
function get_url($url) {
    $ch = curl_init();

    if ($ch === false) {
        die('Failed to create curl object');
    }

    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

echo get_url($url);
?>