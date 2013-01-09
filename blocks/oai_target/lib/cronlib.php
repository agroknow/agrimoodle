<?php

require_once 'XML/Serializer.php';


include_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . "common.php";
include_once LIB_DIR . "Course.php";

class cronlib {

    function __construct($course_id, $verb) {
		
        if ($verb == "GetSql") {
            header("Content-type: text/html");
            echo do_verb_sql();

        }

    }

}

function do_verb_sql() {
    global $CFG, $DB;
	
    $d = DIRECTORY_SEPARATOR;
    $base = $CFG->dirroot.$d.'lom'.$d;
//---html output....
    $output = "<html><body>";
//---html output....
    $lom_files = array();

    $dirIter = new RecursiveDirectoryIterator($base, RecursiveDirectoryIterator::KEY_AS_PATHNAME);
    $recIter = new RecursiveIteratorIterator($dirIter, RecursiveIteratorIterator::CHILD_FIRST);
    foreach ($recIter as $info) {
        if (($info->isFile()) && fnmatch("*json", $info->getFilename())) {
            $lom_files[$info->getFilename()] = $info->getPathname();
        }
    }

    $output .= "<ul>";
    foreach ($lom_files as $lom => $lompath) {
	
	$xmlOutput = '<?xml version="1.0" encoding="UTF-8"?>
<lom xmlns="http://ltsc.ieee.org/xsd/LOM">
  <general>
';
//-----need value for identifier: catalog, entry for each
	$identifier ='<identifier>
      <catalog></catalog>
      <entry></entry>
    </identifier>
';
	$xmlOutput .= $identifier;
	
//---html output....
		$ts = filemtime($lompath);
		$mydate = new DateTime("@$ts");
		$myenterdate = $mydate->format('Y-m-d H:i:s');
		
		$output .= "<li>$lom<ul><li>$lompath</li><li>".$myenterdate."</li><pre>";
        //$output .= json_to_xml(file_get_contents($lompath));
        $output .= "</pre></ul></li>";
		$output .= "</ul></body></html>";
//---html output....

//-- send SQL command to mysql to execute
//-- use function json_to_xml() (allready exist) to parse json and create xml

		$record = new stdClass;
		$record->provider 		= 'foo';
		$record->url			= 'http://www.foo.gr';
		//$record->enterdate		= '0000-00-00 00:00:00';
		$record->enterdate		= $myenterdate;
		$record->oai_identifier	= $lompath;
		$record->oai_set		= 'foo';
		//$record->datestamp		= '0000-00-00 00:00:00';
		$record->datestamp		= $myenterdate;
		$record->deleted		= 'false';
		////$record->lom_record		= ''.json_to_xml(file_get_contents($lompath)).'';
		////$xmlstringtoDB = utf8_encode(json_test($lompath,file_get_contents($lompath),$xmlOutput));
		$xmlstringtoDB = json_test($lompath,file_get_contents($lompath),$xmlOutput);
		$record->lom_record		= $xmlstringtoDB;
		$DB->insert_record('oai_records', $record, false);
		
// testing SQL because i couldn't write to the db using moodle api 
		
		$dbhost    = 'localhost';
		$dbname    = 'agrimoodle';
		$dbuser    = 'root';
		$dbpass    = '';
		//$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
		//mysql_select_db($dbname);
		////mysql_set_charset('utf8',$conn);
		////mysql_query("SET NAMES 'utf8'");
		//$xmlstringtoDB = utf8_encode(json_test($lompath,file_get_contents($lompath),$xmlOutput));
		//$sql="INSERT INTO agrimoodle.oai_records SET id= '', provider='foo', url='http://www.foo.gr', enterdate='".$myenterdate."', oai_identifier='".$lompath."', oai_set='foo', datestamp='".$myenterdate."', deleted='false',lom_record='".$xmlstringtoDB."';";
		
		//$result = mysql_query($sql)
				//or die('Query failed. ' . mysql_error());
				
		//mysql_close($conn);
		
///--------------------------------------------------------------------
//function 	json_test created to parse and create valid LOM XML. 
//gives echo of data and return the valid XML.

   		//echo json_test($lompath,file_get_contents($lompath),$xmlOutput);
		//print assocArrayToXML(file_get_contents($lompath));
   
   }
   //return $output;
}


function assocArrayToXML($filedata) { 	
	$string = ''.$filedata.'';
    $ar = json_decode($string, true);
	
	$xml = new SimpleXMLElement("<?xml version=\"1.0\"?><lom></lom>"); 
    $f = create_function('$f,$c,$a',' 
            foreach($a as $k=>$v) { 
                if(is_array($v)) { 
                    $ch=$c->addChild($k); 
                    $f($f,$ch,$v); 
                } else { 
                    $c->addChild($k,$v); 
                } 
            }'); 
    $f($f,$xml,$ar); 
    return $xml->asXML(); 
} 





function json_test($lompath,$json,$xmlOutput) {
	$string=''.$json.'';

	$data = json_decode($string, true);

	echo '-----------------------------------START PARSING JSON FILE-----------------------------------<br/>';
	echo 'FILE -> '.$lompath.'<br/>';
	
	
	if (array_key_exists('title', $data)){
		echo 'Title COUNT ->'.count($data['title']).'<br/>';
		$xmlOutput .='<title>';
		foreach($data['title'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			echo 'TITLE: '.$row['value'].' lang:'.$row['language'].'<br/>';
			$xmlOutput .= '<string language="'.$row['language'].'" >'.$row['value'].'</string>';
		} 
		$xmlOutput .='</title>';
	}else{
		echo 'NO TITLE<br/>';
		$xmlOutput .='<title></title>';
	}
	
	
	if (array_key_exists('language13', $data)){
		echo 'language13 COUNT ->'.count($data['language13']).'<br/>';
		foreach($data['language13'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			echo 'language13: '.$row.'<br/>';
			$xmlOutput .= '<language>'.$row.'</language>';
		} 
	}else{
		echo 'NO language13<br/>';
		$xmlOutput .='<language></language>';
	}
	
	
	if (array_key_exists('description', $data)){
		echo 'description COUNT ->'.count($data['description']).'<br/>';
		foreach($data['description'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			$xmlOutput .='<description>';
			foreach($row as $i=>$f){
				echo 'description: '.$f['value'].' lang:'.$f['language'].'<br/>';
				$xmlOutput .='<string language="'.$f['language'].'">'.$f['value'].'</string>';
			}
			$xmlOutput .='</description>';
		}
		
	}else{
		echo 'NO description<br/>';
		$xmlOutput .='<description></description>';
	}
	
	
	if (array_key_exists('keyword', $data)){
		echo 'keyword COUNT ->'.count($data['keyword']).'<br/>';
		foreach($data['keyword'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			$xmlOutput .='<keyword>';
			foreach($row as $i=>$f){
				echo 'keyword: '.$f['value'].' lang:'.$f['language'].'<br/>';
				$xmlOutput .='<string language="'.$f['language'].'">'.$f['value'].'</string>';
      		}
			$xmlOutput .='</keyword>';
		}
		
	}else{
		echo 'NO keyword<br/>';
		$xmlOutput .='<keyword></keyword>';
	}
	
	
	if (array_key_exists('coverage', $data)){
		echo 'coverage COUNT ->'.count($data['coverage']).'<br/>';
		$xmlOutput .='<coverage>';
		foreach($data['coverage'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			echo 'coverage: '.$row.'<br/>';
			$xmlOutput .= '<string>'.$row.'</string>';
		}
		$xmlOutput .='</coverage>';
	}else{
		echo 'NO coverage<br/>';
		$xmlOutput .='<coverage></coverage>';
	}
	
	
//----need values for structure: source and value
	$xmlOutput .='<structure><source></source><value></value></structure>';
	
//----close general tag	
	$xmlOutput .='</general>';

//----start <lifeCycle>
	$xmlOutput .='<lifeCycle>';

//----need values for status: source and value
	$xmlOutput .='<status><source></source><value></value></status>';

	
	if (array_key_exists('contribute2', $data)){
		echo 'contribute2 COUNT ->'.count($data['contribute2']).'<br/>';
		foreach($data['contribute2'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			$xmlOutput .='<contribute>';
			echo 'contribute2: '.$row['role'].' date:'.$row['date'].' entity:';
			
			$xmlOutput .='<role><source></source><value>'.$row['role'].'</value></role>';
       		$entity = $row['entity'];
			//echo count($entity);
			foreach($entity as $t){
				echo ' firstname:'.$t['firstname'].' lastname:'.$t['lastname'].' email:'.$t['email'].' organization:'.$t['organization'].'<br/>';
				$xmlOutput .='<entity><![CDATA[BEGIN:VCARD FN:'.$t['firstname'].' '.$t['lastname'].' ORG:'.$t['organization'].' EMAIL;TYPE=INTERNET:'.$t['email'].' N:'.$t['lastname'].';'.$t['firstname'].' VERSION:3.0 END:VCARD]]></entity>';
			}
			$xmlOutput .='<date><dateTime>'.$row['date'].'</dateTime></date>';
			
			$xmlOutput .='</contribute>';
		}
	}else{
		echo 'NO contribute2<br/>';
		$xmlOutput .='<contribute></contribute>';
	}

	
//----close lifeCycle tag	
	$xmlOutput .='</lifeCycle>';
	

//----start <metaMetadata>
	$xmlOutput .='<metaMetadata>';

//----need values for identifier: catalog and entry
	$xmlOutput .='<identifier><catalog></catalog><entry></entry></identifier>';
	
	
	
	if (array_key_exists('contribute3', $data)){
		echo 'contribute3 COUNT ->'.count($data['contribute3']).'<br/>';
		echo 'contribute3-> language34:'.$data['contribute3']['language34'];
		
		for ($i=0;$i<count($data['contribute3'])-1;$i++){
			$xmlOutput .='<contribute>';
			
			echo ' role:'.$data['contribute3']["$i"]['role'].' date:'.$data['contribute3']["$i"]['date'];
			
			$xmlOutput .='<role><source></source><value>'.$data['contribute3']["$i"]['role'].'</value></role>';
			$entity = $data['contribute3']["$i"]['entity'];
			//echo count($entity);
			foreach($entity as $t){
				echo ' firstname:'.$t['firstname'].' lastname:'.$t['lastname'].' email:'.$t['email'].' organization:'.$t['organization'].'<br/>';
				$xmlOutput .='<entity><![CDATA[BEGIN:VCARD FN:'.$t['firstname'].' '.$t['lastname'].' ORG:'.$t['organization'].' EMAIL;TYPE=INTERNET:'.$t['email'].' N:'.$t['lastname'].';'.$t['firstname'].' VERSION:3.0 END:VCARD]]></entity>';
			}
			$xmlOutput .='<date><dateTime>'.$data['contribute3']["$i"]['date'].'</dateTime></date>';
			$xmlOutput .='</contribute>';
		}
		
	}else{
		echo 'NO contribute3<br/>';
		$xmlOutput .='<contribute></contribute>';
	}
	
	
//----need values for metadataSchema
	$xmlOutput .='<metadataSchema>LOMv1.0</metadataSchema>
    <metadataSchema>LREv3.0</metadataSchema>';
	
//----close metaMetadata tag	
	$xmlOutput .='</metaMetadata>';
	
//----need values for technical: format,size,location,duration ...
/*$xmlOutput .='<technical>
    <format></format>
    <size></size>
    <location>rtsp://v6.cache7.c.youtube.com/CjQLENy73wIaKwk44G5h89WSABMYESARFEIQWW91VHViZUhhcnZlc3RlckgGUgZ2aWRlb3MM/0/0/0/video.3gp</location>
    <duration>
      <duration></duration>
    </duration>
  </technical>';*/
    
//----start <educational>
	$xmlOutput .='<educational>';
	
	
	
	if (array_key_exists('resource_type', $data)){
		echo 'resource_type COUNT ->'.count($data['resource_type']).'<br/>';
		foreach($data['resource_type'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			echo 'resource_type: '.$row.'<br/>';
			$xmlOutput .='<learningResourceType><source></source><value>'.$row.'</value></learningResourceType>';
		} 
	}else{
		echo 'NO resource_type<br/>';
		$xmlOutput .='<learningResourceType></learningResourceType>';
	}
	
	
	if (array_key_exists('educational', $data)){
		echo 'educational COUNT ->'.count($data['educational']).'<br/>';
		echo 'educational-> interactivity_level:'.$data['educational']['interactivity_level'].' semantic_density:'.$data['educational']['semantic_density'].'<br/>';
		$xmlOutput .='<interactivityLevel><source></source><value>'.$data['educational']['interactivity_level'].'</value></interactivityLevel><semanticDensity><source></source><value>'.$data['educational']['semantic_density'].'</value></semanticDensity>';

	}else{
		echo 'NO educational<br/>';
		$xmlOutput .='<interactivityLevel></interactivityLevel><semanticDensity></semanticDensity>';
	}
	
	if (array_key_exists('indended_user', $data)){
		echo 'indended_user COUNT ->'.count($data['indended_user']).'<br/>';
		foreach($data['indended_user'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			echo 'indended_user: '.$row.'<br/>';
			$xmlOutput .='<intendedEndUserRole><source></source><value>'.$row.'</value></intendedEndUserRole>';
		} 
	}else{
		echo 'NO indended_user<br/>';
		$xmlOutput .='<intendedEndUserRole></intendedEndUserRole>';
	}
	
	if (array_key_exists('context', $data)){
		echo 'context COUNT ->'.count($data['context']).'<br/>';
		foreach($data['context'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			echo 'context: '.$row.'<br/>';
			$xmlOutput .='<context><source></source><value>'.$row.'</value></context>';
		} 
	}else{
		echo 'NO context<br/>';
		$xmlOutput .='<context></context>';
	}
	
	if (array_key_exists('educational', $data)){
		echo 'educational COUNT ->'.count($data['educational']).'<br/>';
		echo 'typical_age:'.$data['educational']['typical_age'].'<br/>';
		$xmlOutput .='<typicalAgeRange><string language="">'.$data['educational']['typical_age'].'</string></typicalAgeRange>';
	}else{
		echo 'NO educational<br/>';
		$xmlOutput .='<typicalAgeRange></typicalAgeRange>';
	}
	
	if (array_key_exists('educational', $data)){
		echo 'difficulty:'.$data['educational']['difficulty'].' learning_time:'.$data['educational']['learning_time'].'<br/>';
		$xmlOutput .='<difficulty><source></source><value>'.$data['educational']['difficulty'].'</value></difficulty><typicalLearningTime><source></source><value>'.$data['educational']['learning_time'].'</value></typicalLearningTime>';
	}else{
		echo 'NO educational<br/>';
		$xmlOutput .='<difficulty></difficulty><typicalLearningTime></typicalLearningTime>';
	}
	
	
	if (array_key_exists('description5', $data)){
		echo 'description5 COUNT ->'.count($data['description5']).'<br/>';
		$xmlOutput .='<description>';
		foreach($data['description5'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			foreach($row as $i=>$f){
				echo 'description5: '.$f['value'].' lang:'.$f['language'].'<br/>';
				$xmlOutput .='
<string language="'.$f['language'].'">'.$f['value'].'</string>
';
			}
		}
		$xmlOutput .='</description>';
	}else{
		echo 'NO description5<br/>';
		$xmlOutput .='<description></description>';
	}

	
	if (array_key_exists('language5', $data)){
		echo 'language5 COUNT ->'.count($data['language5']).'<br/>';
		foreach($data['language5'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			echo 'language5: '.$row.'<br/>';
			$xmlOutput .='<language><source></source><value>'.$row.'</value></language>';
		} 
	}else{
		echo 'NO language5<br/>';
		$xmlOutput .='<language><source></source><value></value></language>';
	}
	
//----end <educational>
	$xmlOutput .='</educational>';

	
//----start <rights>
	if (array_key_exists('rights', $data)){
		echo 'rights COUNT ->'.count($data['rights']).'<br/>';
		echo 'rights:'.$data['rights'].'<br/>';
		$xmlOutput .='<rights>';
		
		for ($i=0;$i<count($data['rights']);$i++){
			echo 'cost: '.$data['rights']["$i"]['cost'].' restrictions:'.$data['rights']["$i"]['restrictions'].'<br/>';
			$xmlOutput .= '<cost><source></source><value>'.$data['rights']["$i"]['cost'].'</value></cost>';
			$xmlOutput .= '<copyrightAndOtherRestrictions><source></source><value>'.$data['rights']["$i"]['restrictions'].'</value></copyrightAndOtherRestrictions>';
			$description = $data['rights']["$i"]['description'];
			//echo count($entity);
			foreach($description as $t){
				echo ' description:'.$t['value'].' language:'.$t['language'].'<br/>';
				$xmlOutput .= '<description lang="'.$t['language'].'"><string>'.$t['value'].'</string></description>';
			}
		}
		
		$xmlOutput .='</rights>';
	}else{
		if (array_key_exists('cc', $data)){
			echo 'cc COUNT ->'.count($data['cc']).'<br/>';
			echo 'cc:'.$data['cc'].'<br/>';
			$xmlOutput .='<rights><cost><source></source><value></value></cost><copyrightAndOtherRestrictions><source></source><value>'.$data['cc'].'</value></copyrightAndOtherRestrictions><description><string></string></description></rights>';
		}else{
			echo 'NO cc<br/>';
			$xmlOutput .='<rights>
	  </rights>';

		}
	}
	
	
//----end <rights>



//----start <classification>
//----need values for classification: purpose
	$xmlOutput .='<classification>
    <purpose>
      <value></value>
    </purpose>';
	
	if (array_key_exists('classification_details', $data)){
		echo 'classification_details COUNT ->'.count($data['classification_details']).'<br/>';
		foreach($data['classification_details'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			echo 'classification_details: '.$row.'<br/>';
			$xmlOutput .='<taxonPath><source><string language=""></string></source><taxon><id></id><entry><string>'.$row.'</string></entry></taxon></taxonPath>';
		}
		$xmlOutput .='</classification>';
	}else{
		echo 'NO classification_details<br/>';
		$xmlOutput .='
	
</classification>';
		
	}
//----end <classification>

//----end <lom>	
	$xmlOutput .='</lom>';
	
	
	echo '----------------------------------------END OF JSON FILE----------------------------------------<br/>';
	echo '                                                                                                <br/>';
	echo '************************************************************************************************<br/>';
	echo '                                                                                                <br/>';
	
	return $xmlOutput;
}

function json_to_xml($json) {

// -- this maybe not be used if XML_Serializer() workd for u.
	$data = json_decode($json, true);	
	$json = $data;
	
	
	$xml_json = new SimpleXMLElement("<json></json>");
//-- use array_to_xml function (new function) to get xml. 
	array_to_xml($json,$xml_json);
	$xmlstring = $xml_json->asXML();
//-- my function return some unacceptable tag name <0> so use str_replace() to replace them with item0  
	$xmlstring1rstRplc = str_replace("<0>", "<item0>", $xmlstring);
	$xmlstring2ndRplc = str_replace("</0>", "</item0>", $xmlstring1rstRplc);
	return $xmlstring2ndRplc;
}

function array_to_xml($json, $xml_json) {
	foreach($json as $key => $keyvalue) {
		if(is_array($keyvalue)) {
			if(!is_numeric($key)){
				$subnode = $xml_json->addChild("$key");
				array_to_xml($keyvalue, $subnode);
			}
			else{
				array_to_xml($keyvalue, $xml_json);
			}
		}
		else {
			$xml_json->addChild("$key","$keyvalue");
		}
	}
}

$verb = $_GET['verb'];

//$course_id = intval($_GET['id']);
// if course id not valid exit

if (empty($verb)) {
    print_r("Invalid verb!");
    exit;
}

new cronlib(10, $verb);
?>
