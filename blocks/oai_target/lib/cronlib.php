<?php

/**
 * Library code used by oai_target cron.
 *
 * @package   oai_target
 * @copyright 2012 Agro-Know Technologies
 * @author    Tasos Koutoumanos <tafkey@about.me>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


// see end of file for instructions related to testing


// defined('MOODLE_INTERNAL') || die();

include_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . "common.php";
include_once LIB_DIR . "Course.php";

class cronlib {

	public $cid = 0;
	public $rid = 0;

	function __construct($id, $type) {
		if ($type == "course") $this->cid = $id;
		if ($type == "resource") $this->rid = $id;
		
		if ($this->cid + $this->rid > 0) {
			echo "SPECIFIC ARGUMENTS PASSED: Trying to parse JSON record for $type with ID=$id\n";
		} else {
			echo "NO SPECIFIC ARGUMENTS GIVEN: Looking for any complete JSON record!\n";
		}		
	}


	function scan_files() {
		global $CFG, $DB, $tmpId, $setType;
		$output = "";

		$d = DIRECTORY_SEPARATOR;
		$baseCourses = $CFG->dirroot.$d.'lom'.$d.'course'.$d.'complete'.$d;
		$baseResources = $CFG->dirroot.$d.'lom'.$d.'resource'.$d.'complete'.$d;

		$json_files = array();
		// first scan for JSONs related to courses
		$dirIter = new RecursiveDirectoryIterator($baseCourses, RecursiveDirectoryIterator::KEY_AS_PATHNAME);
		$recIter = new RecursiveIteratorIterator($dirIter, RecursiveIteratorIterator::CHILD_FIRST);
		foreach ($recIter as $jf) {
			if (($jf->isFile()) && fnmatch("*json", $jf->getFilename())) {
					$json_files['c'.basename($jf->getFilename(), ".json")] = $jf;
			}
		}
		// then scan for JSONs related to resources
		$dirIter = new RecursiveDirectoryIterator($baseResources, RecursiveDirectoryIterator::KEY_AS_PATHNAME);
		$recIter = new RecursiveIteratorIterator($dirIter, RecursiveIteratorIterator::CHILD_FIRST);
		foreach ($recIter as $jf) {
			if (($jf->isFile()) && fnmatch("*json", $jf->getFilename())) {
					$json_files['c'.basename($jf->getFilename(), ".json")] = $jf;
			}
		}

		// var_dump($json_files);
		foreach ($json_files as $jfid => $jf) {
			
			// true if json file refers to a course, false if it refers to a resource
			$is_course = (substr($jfid, 0, 1) == "r");
			
			// if a specific id has been asked for, skip any other
			if ($is_course and $this->cid > 0) {				
				if ("c{$this->cid}" != $jfid) {
					$output .= "Will not parse {$jf->getFilename()} (looking for $this->cid)\n";
					continue;
				} else {
					$output .= "Found {$jf->getFilename()}. Will parse it!\n";					
				}
			}	elseif ($this->rid > 0) {				
				if ("r{$this->rid}" != $jfid) {
					$output .= "Will not parse {$jf->getFilename()} (looking for $this->rid)\n";
					continue;
				} else {
					$output .= "Found {$jf->getFilename()}. Will parse it!\n";					
				}
			}

			$uri_loc = $CFG->wwwroot;		
			if ($is_course) {
				$uri_loc .= "/course/view.php?id=$tmpId";
	  	} else {
				$uri_loc .= "/mod/resource/view.php?id=$tmpId";
  		}			

			// $xmlOuput = <<<EOT
   //      <lom xmlns="http://ltsc.ieee.org/xsd/LOM"
   //           xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
   //           xsi:schemaLocation="http://ltsc.ieee.org/xsd/LOM http://ltsc.ieee.org/xsd/lomv1.0/lomLoose.xsd">
			$xmlOutput = <<<EOT
          <general>
           <identifier>
              <catalog>URI</catalog>
              <entry>$uri_loc</entry>
            </identifier>
EOT;

			
			$ts = filemtime($jf);
			$mydate = new DateTime("@$ts");
			$myenterdate = $mydate->format('Y-m-d H:i:s');
				
			$output .= "- $jfid :: {$jf->getPathname()} :: $myenterdate\n";

			//-- send SQL command to mysql to execute
			$record = new stdClass;
			// FIXME: ++++ 
			$record->provider = $CFG->wwwroot;
			$record->url = $uri_loc;
			$record->enterdate		= $myenterdate;
			$record->oai_identifier	= $jf->getFilename();
			$record->oai_set		= 'foo';
			$record->datestamp		= $myenterdate;
			$record->deleted		= 'false';
			////$xmlstringtoDB = utf8_encode(parse_json($lompath,file_get_contents($lompath),$xmlOutput));
			$xmlstringtoDB = cronlib::parse_json($jf->getPathname(), file_get_contents($jf), $xmlOutput);
			$xmlstringtoDB = str_replace(" & ", " &amp; ", $xmlstringtoDB);
				
			$record->lom_record		= $xmlstringtoDB;

			$result = $DB->get_record('block_oai_target_lom_records',array('url'=>$record->url));

			if ($result) {
				$record->id = $result->id;
				echo 'UPDATE '.$result->id;
				$DB->update_record('block_oai_target_lom_records', $record, false);
			} else {
				echo 'NEW INSERT';
				$DB->insert_record('block_oai_target_lom_records', $record, false);
			}

//			var_dump($record);
//			$DB->insert_record('mdl_block_oai_target_lom_records', $record, false);
	  }
	  
	  return $output;
	}



	function parse_json($lompath,$json,$xmlOutput) {
		$string=''.$json.'';

		$data = json_decode($string, true);

		echo "---------------------------------- START PARSING $lompath -----------------------------------\n";
		
		
		
		if (array_key_exists('title', $data)){
			echo "TITLE COUNT -> ".count($data['title'])."\n";
			$xmlOutput .= "            <title>\n";
			foreach($data['title'] as $p=>$row){
				echo "  TITLE: '".$row['value']."'  LANG:".$row['language']."\n";
				$xmlOutput .= "              <string language={$row['language']} >{$row['value']}</string>\n";
			} 
			$xmlOutput .="            </title>\n";
		} else{
			echo "  NO TITLE\n";
			$xmlOutput .= "            <title></title>\n";
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
		$xmlOutput .='              <source>LOMv1.0</source>'."\n";
		$xmlOutput .='              <value></value>'."\n";
		$xmlOutput .='            </structure>'."\n";
		
	//----close general tag	
		$xmlOutput .='          </general>'."\n";

	//----start <lifeCycle>
		$xmlOutput .='          <lifeCycle>'."\n";

	//----need values for status: source and value
		$xmlOutput .='            <status>'."\n";
		$xmlOutput .='              <source>LOMv1.0</source>'."\n";
		$xmlOutput .='              <value></value>'."\n";
		$xmlOutput .='            </status>'."\n";

		
		if (array_key_exists('contribute2', $data)){
			echo 'contribute2 COUNT ->'.count($data['contribute2']).'<br/>';
			foreach($data['contribute2'] as $p=>$row){
				//if (is_array($row)) echo 'Array';
				$xmlOutput .='            <contribute>'."\n";
				echo 'contribute2: '.$row['role'].' date:'.$row['date'].' entity:';
				
				$xmlOutput .='              <role>'."\n";
				$xmlOutput .='                <source>LOMv1.0</source>'."\n";
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
		// FIXME: +++
//	$xmlOutput .='              <catalog>'.$repositoryIdentifier.'_'.$setType.'</catalog>'."\n";
//	$xmlOutput .='              <entry>'.$setType.'_'.$tmpId.'</entry>'."\n";
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
				$xmlOutput .='              <source>LOMv1.0</source>'."\n";
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
				
		$xmlOutput .='            <metadataSchema>OE AP v3.0</metadataSchema>'."\n";
		$xmlOutput .='            <language>'.$data['contribute3']['language34'].'</language>'."\n";
		
	//----close metaMetadata tag	
		$xmlOutput .='          </metaMetadata>'."\n";
		
	//----need values for technical: format,size,location,duration ...
	$xmlOutput .='<technical>
	    <format></format>
	    <size></size>
	    <location>';
// FIXME +++ some refactoring here!!!
	if ($setType == 'resource'){
		$location =$CFG->wwwroot.'/mod/resource/view.php?id='.$tmpId;
    }else{
		$location =$CFG->wwwroot.'/course/view.php?id='.$tmpId;
	}
	
$xmlOutput .=$location.'</location>
	    <duration>
	      <duration></duration>
	    </duration>
	  </technical>';
	    
	//----start <educational>
		$xmlOutput .='          <educational>'."\n";
		
		
		
		if (array_key_exists('resource_type', $data)){
			echo 'resource_type COUNT ->'.count($data['resource_type']).'<br/>';
			foreach($data['resource_type'] as $p=>$row){
				//if (is_array($row)) echo 'Array';
				echo 'resource_type: '.$row.'<br/>';
				$xmlOutput .='           <learningResourceType>'."\n";
			$xmlOutput .='             <source>LREv3.0</source>'."\n";
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
		$xmlOutput .='             <source>LREv3.0</source>'."\n";
			$xmlOutput .='             <value>'.$data['educational']['interactivity_level'].'</value>'."\n";
			$xmlOutput .='           </interactivityLevel>'."\n";
			$xmlOutput .='           <semanticDensity>'."\n";
		$xmlOutput .='             <source>LREv3.0</source>'."\n";
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
			$xmlOutput .='             <source>LREv3.0</source>'."\n";
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
			$xmlOutput .='             <source>LREv3.0</source>'."\n";
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
		$xmlOutput .='             <source>LREv3.0</source>'."\n";
			$xmlOutput .='             <value>'.$data['educational']['difficulty'].'</value>'."\n";
			$xmlOutput .='           </difficulty>'."\n";
			$xmlOutput .='           <typicalLearningTime>'."\n";
		$xmlOutput .='             <source>LREv3.0</source>'."\n";
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
			$xmlOutput .='             <source>LREv3.0</source>'."\n";
				$xmlOutput .='             <value>'.$row.' </value>'."\n";
				$xmlOutput .='           </language>'."\n";
			} 
		}else{
			echo 'NO language5<br/>';
			$xmlOutput .='           <language>'."\n";
		$xmlOutput .='             <source>LREv3.0</source>'."\n";
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
			$xmlOutput .='              <source>LOMv1.0</source>'."\n";
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
			$xmlOutput .='              <source>LOMv1.0</source>'."\n";
				$xmlOutput .='              <value></value>'."\n";
				$xmlOutput .='            </cost>'."\n";
				$xmlOutput .='            <copyrightAndOtherRestrictions>'."\n";
			$xmlOutput .='              <source>LOMv1.0</source>'."\n";
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
			$xmlOutput .='                <string language="en">Organic.Edunet Ontology</string>'."\n";
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
			
		echo '----------------------------------------END OF JSON FILE----------------------------------------<br/>';
		echo '                                                                                                <br/>';
		echo '************************************************************************************************<br/>';
		echo '                                                                                                <br/>';
		
		return $xmlOutput;
	}

}

//
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// 
 
$ARG1 = "ParseJson";
$ARG2 = "cid";
$ARG3 = "rid";

$arg2 = (empty($_GET["$ARG2"])) ? 0 : intval(($_GET["$ARG2"]));
$arg3 = (empty($_GET["$ARG3"])) ? 0 : intval(($_GET["$ARG3"]));


// Direct operation, for testing purposes
// http://localhost/dev/agrimoodle/blocks/oai_target/lib/cronlib.php?ParseJson&cid=10
header("Content-type: text/plain");
echo <<<HEAD
NOTE: Direct operation, this should be dissallowed after testing!
EXAMPLE USAGE:
  - http://localhost/dev/agrimoodle/blocks/oai_target/lib/cronlib.php?$ARG1&$ARG2=10
    looks for a course with id=10 and tries to parse the associated JSON file 
    and populate the sql table
  - http://localhost/dev/agrimoodle/blocks/oai_target/lib/cronlib.php?$ARG1&$ARG3=21
    looks for a resource with id=21 and tries to parse the associated JSON file 
    and populate the sql table
--------------------------------------------------------------------------------------

HEAD;

if (is_null($_GET["$ARG1"])) {
    echo "ERROR: No valid action could be parsed from request location. Exiting.";
} elseif ($arg2+$arg3 <=0 ) {
    echo "ERROR: No valid course id (cid) or resource id (rid) could be parsed in request location. Exiting.";
} else {
	if ($arg2>0)	{
		$cl = new cronlib($arg2, "course"); 
		echo $cl->scan_files();
//		print_r($cl);
	} else {
		$cl = new cronlib($arg3, "resource"); 		
		echo $cl->scan_files();
//		print_r($cl);
	} 
}


?>
