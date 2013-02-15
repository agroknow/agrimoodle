<?php

// require_once 'XML/Serializer.php';
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
    global $CFG, $DB, $tmpId, $setType;
	
    $d = DIRECTORY_SEPARATOR;
    $baseCourses = $CFG->dirroot.$d.'lom'.$d.'course'.$d.'complete'.$d;
	$baseResources = $CFG->dirroot.$d.'lom'.$d.'resource'.$d.'complete'.$d;
//---html output....
		$output = "<html><body>";
//---html output....

    $lom_files = array();
    $dirIter = new RecursiveDirectoryIterator($baseCourses, RecursiveDirectoryIterator::KEY_AS_PATHNAME);
    $recIter = new RecursiveIteratorIterator($dirIter, RecursiveIteratorIterator::CHILD_FIRST);
    foreach ($recIter as $info) {
        if (($info->isFile()) && fnmatch("*json", $info->getFilename())) {
            $lom_files['c'.$info->getFilename()] = $info->getPathname();
        }
    }

    $output .= "<ul>";
    foreach ($lom_files as $lom => $lompath) {

	$xmlOutput = '        <lom xmlns="http://ltsc.ieee.org/xsd/LOM">'."\n";
	$xmlOutput .='          <general>'."\n";
//-----need value for identifier: catalog, entry for each
	$identifier ='            <identifier>'."\n";
    $identifier .='              <catalog></catalog>'."\n";
    $identifier .='              <entry></entry>'."\n";
    $identifier .='            </identifier>'."\n";
	$xmlOutput .= $identifier;
	
//---html output....
		$ts = filemtime($lompath);
		$mydate = new DateTime("@$ts");
		$myenterdate = $mydate->format('Y-m-d H:i:s');
		
		$output .= "<li>$lom<ul><li>$lompath</li><li>".$myenterdate."</li><pre>";
        $output .= "</pre></ul></li>";
		$output .= "</ul></body></html>";
//---html output....

//-- send SQL command to mysql to execute

		$record = new stdClass;
		$record->provider 		= 'foo';
		$record->url			= 'http://www.foo.gr';
		$record->enterdate		= $myenterdate;
		$record->oai_identifier	= $lompath;
		$record->oai_set		= 'foo';
		$record->datestamp		= $myenterdate;
		$record->deleted		= 'false';
		////$xmlstringtoDB = utf8_encode(json_test($lompath,file_get_contents($lompath),$xmlOutput));
		$xmlstringtoDB = json_test($lompath,file_get_contents($lompath),$xmlOutput);
		$xmlstringtoDB = str_replace(" & ", " &amp; ", $xmlstringtoDB);
		
		$record->lom_record		= $xmlstringtoDB;
		$DB->insert_record('oai_records', $record, false);
   }
}

function json_test($lompath,$json,$xmlOutput) {
	$string=''.$json.'';

	$data = json_decode($string, true);

	echo '-----------------------------------START PARSING JSON FILE-----------------------------------<br/>';
	
	echo 'FILE -> '.$lompath.'<br/>';
	
	
	if (array_key_exists('title', $data)){
		echo 'Title COUNT ->'.count($data['title']).'<br/>';
		$xmlOutput .='            <title>'."\n";
		foreach($data['title'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			echo 'TITLE: '.$row['value'].' lang:'.$row['language'].'<br/>';
			$xmlOutput .= '              <string language="'.$row['language'].'" >'.$row['value'].'</string>'."\n";
		} 
		$xmlOutput .='            </title>'."\n";
	}else{
		echo 'NO TITLE<br/>';
		$xmlOutput .='            <title></title>'."\n";
	}
	
	
	if (array_key_exists('language13', $data)){
		echo 'language13 COUNT ->'.count($data['language13']).'<br/>';
		foreach($data['language13'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			echo 'language13: '.$row.'<br/>';
			$xmlOutput .= '            <language>'.$row.'</language>'."\n";
		} 
	}else{
		echo 'NO language13<br/>';
		$xmlOutput .='            <language></language>'."\n";
	}
	
	
	if (array_key_exists('description', $data)){
		echo 'description COUNT ->'.count($data['description']).'<br/>';
		foreach($data['description'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			$xmlOutput .='            <description>'."\n";
			foreach($row as $i=>$f){
				echo 'description: '.$f['value'].' lang:'.$f['language'].'<br/>';
				$xmlOutput .='              <string language="'.$f['language'].'">'.$f['value'].'</string>'."\n";
			}
			$xmlOutput .='            </description>'."\n";
		}
		
	}else{
		echo 'NO description<br/>';
		$xmlOutput .='            <description></description>'."\n";
	}
	
	
	if (array_key_exists('keyword', $data)){
		echo 'keyword COUNT ->'.count($data['keyword']).'<br/>';
		foreach($data['keyword'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			$xmlOutput .='            <keyword>'."\n";
			foreach($row as $i=>$f){
				echo 'keyword: '.$f['value'].' lang:'.$f['language'].'<br/>';
				$xmlOutput .='              <string language="'.$f['language'].'">'.$f['value'].'</string>'."\n";
      		}
			$xmlOutput .='            </keyword>'."\n";
		}
		
	}else{
		echo 'NO keyword<br/>';
		$xmlOutput .='            <keyword></keyword>'."\n";
	}
	
	
	if (array_key_exists('coverage', $data)){
		echo 'coverage COUNT ->'.count($data['coverage']).'<br/>';
		$xmlOutput .='            <coverage>'."\n";
		foreach($data['coverage'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			echo 'coverage: '.$row.'<br/>';
			$xmlOutput .= '              <string>'.$row.'</string>'."\n";
		}
		$xmlOutput .='            </coverage>'."\n";
	}else{
		echo 'NO coverage<br/>';
		$xmlOutput .='            <coverage></coverage>'."\n";
	}
	
	
//----need values for structure: source and value
	$xmlOutput .='            <structure>'."\n";
	$xmlOutput .='              <source></source>'."\n";
	$xmlOutput .='              <value></value>'."\n";
	$xmlOutput .='            </structure>'."\n";
	
//----close general tag	
	$xmlOutput .='          </general>'."\n";

//----start <lifeCycle>
	$xmlOutput .='          <lifeCycle>'."\n";

//----need values for status: source and value
	$xmlOutput .='            <status>'."\n";
	$xmlOutput .='              <source></source>'."\n";
	$xmlOutput .='              <value></value>'."\n";
	$xmlOutput .='            </status>'."\n";

	
	if (array_key_exists('contribute2', $data)){
		echo 'contribute2 COUNT ->'.count($data['contribute2']).'<br/>';
		foreach($data['contribute2'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			$xmlOutput .='            <contribute>'."\n";
			echo 'contribute2: '.$row['role'].' date:'.$row['date'].' entity:';
			
			$xmlOutput .='              <role>'."\n";
			$xmlOutput .='                <source></source>'."\n";
			$xmlOutput .='                <value>'.$row['role'].' </value>'."\n";
			$xmlOutput .='              </role>'."\n";
       		$entity = $row['entity'];
			//echo count($entity);
			foreach($entity as $t){
				echo ' firstname:'.$t['firstname'].' lastname:'.$t['lastname'].' email:'.$t['email'].' organization:'.$t['organization'].'<br/>';
				$xmlOutput .='              <entity><![CDATA[BEGIN:VCARD FN:'.$t['firstname'].' '.$t['lastname'].' ORG:'.$t['organization'].' EMAIL;TYPE=INTERNET:'.$t['email'].' N:'.$t['lastname'].';'.$t['firstname'].' VERSION:3.0 END:VCARD]]></entity>'."\n";
			}
			$xmlOutput .='              <date>'."\n";
			$xmlOutput .='                <dateTime>'.$row['date'].'</dateTime>'."\n";
			$xmlOutput .='              </date>'."\n";
			
			$xmlOutput .='            </contribute>'."\n";
		}
	}else{
		echo 'NO contribute2<br/>';
		$xmlOutput .='            <contribute></contribute>'."\n";
	}

	
//----close lifeCycle tag
	$xmlOutput .='          </lifeCycle>'."\n";
	

//----start <metaMetadata>
	$xmlOutput .='          <metaMetadata>'."\n";

//----need values for identifier: catalog and entry
	$xmlOutput .='            <identifier>'."\n";
	$xmlOutput .='              <catalog></catalog>'."\n";
	$xmlOutput .='              <entry></entry>'."\n";
	$xmlOutput .='            </identifier>'."\n";
	
	if (array_key_exists('contribute3', $data)){
		echo 'contribute3 COUNT ->'.count($data['contribute3']).'<br/>';
		echo 'contribute3-> language34:'.$data['contribute3']['language34'];
		
		for ($i=0;$i<count($data['contribute3'])-1;$i++){
			$xmlOutput .='            <contribute>'."\n";
			
			echo ' role:'.$data['contribute3']["$i"]['role'].' date:'.$data['contribute3']["$i"]['date'];
			
			$xmlOutput .='            <role>'."\n";
			$xmlOutput .='              <source></source>'."\n";
			$xmlOutput .='              <value>'.$data['contribute3']["$i"]['role'].'</value>'."\n";
			$xmlOutput .='            </role>'."\n";
			$entity = $data['contribute3']["$i"]['entity'];
			//echo count($entity);
			foreach($entity as $t){
				echo ' firstname:'.$t['firstname'].' lastname:'.$t['lastname'].' email:'.$t['email'].' organization:'.$t['organization'].'<br/>';
				$xmlOutput .='            <entity><![CDATA[BEGIN:VCARD FN:'.$t['firstname'].' '.$t['lastname'].' ORG:'.$t['organization'].' EMAIL;TYPE=INTERNET:'.$t['email'].' N:'.$t['lastname'].';'.$t['firstname'].' VERSION:3.0 END:VCARD]]></entity>'."\n";
			}
			$xmlOutput .='            <date>'."\n";
			$xmlOutput .='              <dateTime>'.$data['contribute3']["$i"]['date'].'</dateTime>'."\n";
			$xmlOutput .='            </date>'."\n";
			$xmlOutput .='            </contribute>'."\n";
		}
		
	}else{
		echo 'NO contribute3<br/>';
		$xmlOutput .='            <contribute></contribute>'."\n";
	}
	
	
//----need values for metadataSchema
	$xmlOutput .='            <metadataSchema>LOMv1.0</metadataSchema>'."\n";
	$xmlOutput .='            <metadataSchema>LREv3.0</metadataSchema>'."\n";
	
//----close metaMetadata tag	
	$xmlOutput .='          </metaMetadata>'."\n";
	
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
	$xmlOutput .='          <educational>'."\n";
	
	
	
	if (array_key_exists('resource_type', $data)){
		echo 'resource_type COUNT ->'.count($data['resource_type']).'<br/>';
		foreach($data['resource_type'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			echo 'resource_type: '.$row.'<br/>';
			$xmlOutput .='           <learningResourceType>'."\n";
			$xmlOutput .='             <source></source>'."\n";
			$xmlOutput .='             <value>'.$row.'</value>'."\n";
			$xmlOutput .='           </learningResourceType>'."\n";
		} 
	}else{
		echo 'NO resource_type<br/>';
		$xmlOutput .='           <learningResourceType></learningResourceType>'."\n";
	}
	
	
	if (array_key_exists('educational', $data)){
		echo 'educational COUNT ->'.count($data['educational']).'<br/>';
		echo 'educational-> interactivity_level:'.$data['educational']['interactivity_level'].' semantic_density:'.$data['educational']['semantic_density'].'<br/>';
		$xmlOutput .='           <interactivityLevel>'."\n";
		$xmlOutput .='             <source></source>'."\n";
		$xmlOutput .='             <value>'.$data['educational']['interactivity_level'].'</value>'."\n";
		$xmlOutput .='           </interactivityLevel>'."\n";
		$xmlOutput .='           <semanticDensity>'."\n";
		$xmlOutput .='             <source></source>'."\n";
		$xmlOutput .='             <value>'.$data['educational']['semantic_density'].'</value>'."\n";
		$xmlOutput .='           </semanticDensity>'."\n";

	}else{
		echo 'NO educational<br/>';
		$xmlOutput .='           <interactivityLevel></interactivityLevel>'."\n";
		$xmlOutput .='           <semanticDensity></semanticDensity>'."\n";
	}
	
	if (array_key_exists('indended_user', $data)){
		echo 'indended_user COUNT ->'.count($data['indended_user']).'<br/>';
		foreach($data['indended_user'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			echo 'indended_user: '.$row.'<br/>';
			$xmlOutput .='           <intendedEndUserRole>'."\n";
			$xmlOutput .='             <source></source>'."\n";
			$xmlOutput .='             <value>'.$row.'</value>'."\n";
			$xmlOutput .='           </intendedEndUserRole>'."\n";
		} 
	}else{
		echo 'NO indended_user<br/>';
		$xmlOutput .='           <intendedEndUserRole></intendedEndUserRole>'."\n";
	}
	
	if (array_key_exists('context', $data)){
		echo 'context COUNT ->'.count($data['context']).'<br/>';
		foreach($data['context'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			echo 'context: '.$row.'<br/>';
			$xmlOutput .='           <context>'."\n";
			$xmlOutput .='             <source></source>'."\n";
			$xmlOutput .='             <value>'.$row.'</value>'."\n";
			$xmlOutput .='           </context>'."\n";
		} 
	}else{
		echo 'NO context<br/>';
		$xmlOutput .='           <context></context>'."\n";
	}
	
	if (array_key_exists('educational', $data)){
		echo 'educational COUNT ->'.count($data['educational']).'<br/>';
		echo 'typical_age:'.$data['educational']['typical_age'].'<br/>';
		$xmlOutput .='           <typicalAgeRange>'."\n";
		$xmlOutput .='             <string language="">'.$data['educational']['typical_age'].'</string>'."\n";
		$xmlOutput .='           </typicalAgeRange>'."\n";
	}else{
		echo 'NO educational<br/>';
		$xmlOutput .='           <typicalAgeRange></typicalAgeRange>'."\n";
	}
	
	if (array_key_exists('educational', $data)){
		echo 'difficulty:'.$data['educational']['difficulty'].' learning_time:'.$data['educational']['learning_time'].'<br/>';
		$xmlOutput .='           <difficulty>'."\n";
		$xmlOutput .='             <source></source>'."\n";
		$xmlOutput .='             <value>'.$data['educational']['difficulty'].'</value>'."\n";
		$xmlOutput .='           </difficulty>'."\n";
		$xmlOutput .='           <typicalLearningTime>'."\n";
		$xmlOutput .='             <source></source>'."\n";
		$xmlOutput .='             <value>'.$data['educational']['learning_time'].'</value>'."\n";
		$xmlOutput .='           </typicalLearningTime>'."\n";
	}else{
		echo 'NO educational<br/>';
		$xmlOutput .='           <difficulty></difficulty>'."\n";
		$xmlOutput .='           <typicalLearningTime></typicalLearningTime>'."\n";
	}
	
	
	if (array_key_exists('description5', $data)){
		echo 'description5 COUNT ->'.count($data['description5']).'<br/>';
		$xmlOutput .='           <description>'."\n";
		foreach($data['description5'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			foreach($row as $i=>$f){
				echo 'description5: '.$f['value'].' lang:'.$f['language'].'<br/>';
				$xmlOutput .='           <string language="'.$f['language'].'">'.$f['value'].'</string>'."\n";
			}
		}
		$xmlOutput .='           </description>'."\n";
	}else{
		echo 'NO description5<br/>';
		$xmlOutput .='           <description></description>'."\n";
	}

	
	if (array_key_exists('language5', $data)){
		echo 'language5 COUNT ->'.count($data['language5']).'<br/>';
		foreach($data['language5'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			echo 'language5: '.$row.'<br/>';
			$xmlOutput .='           <language>'."\n";
			$xmlOutput .='             <source></source>'."\n";
			$xmlOutput .='             <value>'.$row.' </value>'."\n";
			$xmlOutput .='           </language>'."\n";
		} 
	}else{
		echo 'NO language5<br/>';
		$xmlOutput .='           <language>'."\n";
		$xmlOutput .='             <source></source>'."\n";
		$xmlOutput .='             <value></value>'."\n";
		$xmlOutput .='           </language>'."\n";
	}
	
//----end <educational>
	$xmlOutput .='          </educational>'."\n";

	
//----start <rights>
	if (array_key_exists('rights', $data)){
		echo 'rights COUNT ->'.count($data['rights']).'<br/>';
		echo 'rights:'.$data['rights'].'<br/>';
		$xmlOutput .='          <rights>'."\n";
		
		for ($i=0;$i<count($data['rights']);$i++){
			echo 'cost: '.$data['rights']["$i"]['cost'].' restrictions:'.$data['rights']["$i"]['restrictions'].'<br/>';
			$xmlOutput .='            <cost>'."\n";
			$xmlOutput .='              <source></source>'."\n";
			$xmlOutput .='              <value>'.$data['rights']["$i"]['cost'].'</value>'."\n";
			$xmlOutput .='            </cost>'."\n";
			$xmlOutput .='            <copyrightAndOtherRestrictions>'."\n";
			$xmlOutput .='              <source></source>'."\n";
			$xmlOutput .='              <value>'.$data['rights']["$i"]['restrictions'].'</value>'."\n";
			$xmlOutput .='            </copyrightAndOtherRestrictions>'."\n";
			$description = $data['rights']["$i"]['description'];
			//echo count($entity);
			foreach($description as $t){
				echo ' description:'.$t['value'].' language:'.$t['language'].'<br/>';
				$xmlOutput .= '            <description lang="'.$t['language'].'">'."\n";
				$xmlOutput .='               <string>'.$t['value'].'</string>'."\n";
				$xmlOutput .='             </description>'."\n";
			}
		}
		
		$xmlOutput .='          </rights>'."\n";
	}else{
		if (array_key_exists('cc', $data)){
			echo 'cc COUNT ->'.count($data['cc']).'<br/>';
			echo 'cc:'.$data['cc'].'<br/>';
			$xmlOutput .='          <rights>'."\n";
			$xmlOutput .='            <cost>'."\n";
			$xmlOutput .='              <source></source>'."\n";
			$xmlOutput .='              <value></value>'."\n";
			$xmlOutput .='            </cost>'."\n";
			$xmlOutput .='            <copyrightAndOtherRestrictions>'."\n";
			$xmlOutput .='              <source></source>'."\n";
			$xmlOutput .='              <value>'.$data['cc'].'</value>'."\n";
			$xmlOutput .='            </copyrightAndOtherRestrictions>'."\n";
			$xmlOutput .='            <description>'."\n";
			$xmlOutput .='              <string></string>'."\n";
			$xmlOutput .='            </description>'."\n";
			$xmlOutput .='          </rights>'."\n";
		}else{
			echo 'NO cc<br/>';
			$xmlOutput .='          <rights></rights>'."\n";

		}
	}
	
	
//----end <rights>



//----start <classification>
//----need values for classification: purpose
	$xmlOutput .='          <classification>'."\n";
    $xmlOutput .='            <purpose>'."\n";
    $xmlOutput .='              <value></value>'."\n";
    $xmlOutput .='            </purpose>'."\n";
	
	if (array_key_exists('classification_details', $data)){
		echo 'classification_details COUNT ->'.count($data['classification_details']).'<br/>';
		foreach($data['classification_details'] as $p=>$row){
			//if (is_array($row)) echo 'Array';
			echo 'classification_details: '.$row.'<br/>';
			$xmlOutput .='            <taxonPath>'."\n";
			$xmlOutput .='              <source>'."\n";
			$xmlOutput .='                <string language=""></string>'."\n";
			$xmlOutput .='              </source>'."\n";
			$xmlOutput .='              <taxon>'."\n";
			$xmlOutput .='                <id></id>'."\n";
			$xmlOutput .='                <entry>'."\n";
			$xmlOutput .='                  <string>'.$row.'</string>'."\n";
			$xmlOutput .='                </entry>'."\n";
			$xmlOutput .='              </taxon>'."\n";
			$xmlOutput .='            </taxonPath>'."\n";
		}
		$xmlOutput .='          </classification>'."\n";
	}else{
		echo 'NO classification_details<br/>';
		$xmlOutput .='          </classification>'."\n";
		
	}
//----end <classification>

//----end <lom>	
	$xmlOutput .='        </lom>';
		
	echo '----------------------------------------END OF JSON FILE----------------------------------------<br/>';
	echo '                                                                                                <br/>';
	echo '************************************************************************************************<br/>';
	echo '                                                                                                <br/>';
	
	return $xmlOutput;
}
if ($_GET['verb']){
$verb = $_GET['verb'];
}

//$course_id = intval($_GET['id']);
// if course id not valid exit

if (empty($verb)) {
    print_r("Invalid verb!");
    exit;
}

new cronlib(10, $verb);
?>