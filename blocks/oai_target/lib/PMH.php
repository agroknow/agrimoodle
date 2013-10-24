<?php

// require_once 'XML/Serializer.php';

$DS = DIRECTORY_SEPARATOR;
$PDIR = $DS . '..';

require_once(dirname(__FILE__) . $PDIR . $PDIR . $PDIR . $DS . 'config.php');

include_once dirname(__FILE__) . $PDIR . $DS . "common.php";
include_once dirname(__FILE__) . $DS . "Course.php";

class PMH {

    function __construct($course_id, $verb) {

//        $Course = new Course();
        // if the course is not registered or
        // the course is registered but the block is not active
//        if (!$Course->is_registered($course_id) or !$Course->uses_oai_target_block($course_id)) {
//            echo get_string('pmh_not_enabled', 'block_oai_target');
//            return;
//        }

        if ($verb == "Identify") {
            header("Content-Type: application/rss+xml");
            echo oai_pmh_header($verb);
            echo do_verb_identify();
            echo oai_pmh_footer($verb);
        }
        else if ($verb == "ListIdentifiers") {
            header("Content-Type: application/rss+xml");
            echo oai_pmh_header($verb);
            echo do_verb_list_identifiers();
            echo oai_pmh_footer($verb);
        }
        else if ($verb == "GetRecord") {
            header("Content-Type: application/rss+xml");
            echo oai_pmh_header($verb);
            echo do_verb_get_record("123-XXX");
            echo oai_pmh_footer($verb);
        }
        else if ($verb == "GetSql") {
            header("Content-type: text/html");
            echo do_verb_sql();

        }


//        $course_info = $Course->get_course_info($course_id);
//        $course_registration = $Course->get_registration($course_id);
//        print_r("here");
//        if ($course_registration->notify_by_pmh != 1)
//            return;
//        // here
//        $now = date("D, d M Y H:i:s T");
//        $output = "<?xml version=\"1.0\"  encoding=\"UTF-8\"> <<--- put a ? before the >
//<OAI-PMH xmlns=\"http://www.openarchives.org/OAI/2.0/\"
//         xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
//         xsi:schemaLocation=\"http://www.openarchives.org/OAI/2.0/
//         http://www.openarchives.org/OAI/2.0/OAI-PMH.xsd\">
//<responseDate>$now</responseDate>
//<request verb=\"ListRecords\" from=\"2000-01-01\"
//         metadataPrefix=\"oai_rfc1807\">
//         http://an.oa.org/OAI-script</request>
//<ListRecords>
//  <record>
//    <header>
//      <identifier>oai:agrimoodle.org:hep-th/0901001</identifier>
//      <datestamp>2009-12-25</datestamp>
//    </header>
//    <metadata>
//      <title>$course_info->fullname</title>
//        <link>$CFG->wwwroot/course/view.php?id=$course_id</link>
//    <description>$course_info->summary</description>
//    <language>en-us</language>
//    <pubDate>$now</pubDate>
//    <lastBuildDate>$now</lastBuildDate>
//    <docs>$CFG->wwwroot/course/view.php?id=$course_id</docs>
//    <webMaster>webmaster@agrimoodle.org</webMaster>
//    </metadata>
//  </record>
//";
//
//        // get the last 20 entries form the block logs
//        $logs = $Course->get_logs($course_id, 20);
//
//        if (!isset($logs) or !is_array($logs) or count($logs) == 0) {
//            $output .= '<title>' . get_string('rss_empty_title', 'block_oai_target') . '</title>';
//            $output .= '<description>' . get_string('rss_empty_description', 'block_oai_target') . '</description>';
//            $output .= "</item>";
//        }
//        else {
//            foreach ($logs as $log) {
//                $output .= "
//  <record>
//    <header>
//";
//                if ($log->action == 'deleted')
//                    $output .= "      <identifier>DELETED!!!</identifier>";
//                else
//                    $output .= "      <identifier>$CFG->wwwroot/mod/$log->type/view.php?id=$log->module_id</identifier>";
//                $output .= "
//    </header>
//    <metadata>
//";
//                $output .= '      <title>' . get_string($log->type, 'block_oai_target') . '</title>';
//                $output .= "
//      <link>$CFG->wwwroot/mod/$log->type/view.php?id=$log->module_id</link>
//      <description>";
//                $output .= get_string($log->type, 'block_oai_target') . ': ';
//                $output .= $log->name;
//                $output .= "</description>
//    </metadata>
//  </record>";
//            }
//        }
//        $output .= "
//</ListRecords>
//</OAI-PMH>";
//        header("Content-Type: application/rss+xml");
//        echo $output;
    }

}

function oai_pmh_header($verb) {
    $now = date("Y-m-d\TH:i:s\Z");
    $output = <<<XML
<OAI-PMH xmlns=\"http://www.openarchives.org/OAI/2.0/\"
     xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
     xsi:schemaLocation=\"http://www.openarchives.org/OAI/2.0/
     http://www.openarchives.org/OAI/2.0/OAI-PMH.xsd\">
  <responseDate>$now</responseDate>
XML;
}

function oai_pmh_footer($verb) {
    return "</OAI-PMH>";
}

/*
 * http://www.openarchives.org/OAI/openarchivesprotocol.html#Identify
 * Arguments: None
 * Response Format: (+ mandatory | - optional)
 *   + repositoryName
 *   + baseURL
 *   + protocolVersion
 *   + earliestDatestamp
 *   + deletedRecord      (no ; transient ; persistent)
 *   + granularity        (YYY-MM-DD and YYYY-MM-DDThh:mm:ssZ)
 *   + adminEmail         (one or more)
 *   - compression
 *   - description
 */

function do_verb_identify() {
    $baseurl = new moodle_url("/");

    <<<XML
  <request verb='Identify'></request>
  <Identify>
    <repositoryName>AgriMoodle Test Repository</repositoryName>
    <baseURL>$baseurl</baseURL>
    <protocolVersion>2.0</protocolVersion>
    <adminEmail>somebody@agroknow.gr</adminEmail>
    <adminEmail>anybody@agroknow.gr</adminEmail>
    <earliestDatestamp>2012-08-01T12:00:00Z</earliestDatestamp>
    <deletedRecord>no</deletedRecord>
    <granularity>YYYY-MM-DD</granularity>
 </Identify>
XML;
}


function do_verb_list_identifiers() {

    global $CFG, $DB;

    $baseurl = new moodle_url("/");
    $datestamp = date("Y-m-d");
    // FIXME: make this configurable (3 minutes for now)
    $expiration = date("Y-m-d\TH:i:s\Z", time() + 60 * 3);

    $d = DIRECTORY_SEPARATOR;
    $base = $CFG->dirroot.$d.'lom'.$d;

/*
        if (file_exists($base.'complete'.$d.$id.'.json')) {
            return 'complete';
        } else if (file_exists($base.'partial'.$d.$id.'.json')) {
            return 'partial';
        }
        return 'not_started';
*/

    $output = <<<XML
 <request verb='ListIdentifiers' from='2012-08-01'
          metadataPrefix='organic.edunet'
          base='$base'
          set='agrimoodle:test'>$baseurl</request>
 <ListIdentifiers>"
XML;

    $lom_files = array();
//    $dirite = new RecursiveDirectoryIterator($base);
//    $iteite = new RecursiveIteratorIterator($dirite);
//    $sep = preg_quote(DIRECTORY_SEPARATOR, '|');
//    $regite = new RegexIterator($iteite, '|'.$sep.'complete'.$sep.'.*\.lom$|');
//    foreach ($regite as $path => $element) {
//        $key = dirname(dirname($path));
//        $value = trim(str_replace('/', '_', str_replace($CFG->dirroot, '', $key)), '_');
//        $lom_files[$key] = $value;
//    }
//    ksort($lom_files);

    $dirIter = new RecursiveDirectoryIterator($base, RecursiveDirectoryIterator::KEY_AS_PATHNAME);
    $recIter = new RecursiveIteratorIterator($dirIter, RecursiveIteratorIterator::CHILD_FIRST);
    foreach ($recIter as $info) {
        if (($info->isFile()) && fnmatch("*json", $info->getFilename())) {
//            $lom_files[$i] = $info->getPathname();
//            $i++;
            $lom_files[$info->getFilename()] = $info->getPathname();
        }
    }
    
    foreach ($lom_files as $lom => $lompath) {
        $output .= <<<XML
   <header>
    <identifier>oai:agrimoodle.org:test/2012-$lom</identifier>
    <datestamp>$datestamp</datestamp>
    <setSpec>agrimoodle:test</setSpec>
   </header>"
XML;
    }

    $output .= <<<XML
   <resumptionToken expirationDate='$expiration' completeListSize='6' cursor='0'>xxx45abttyz</resumptionToken>
 </ListIdentifiers>
XML;

    return $output;
}

// FIXME don't forget to remove!!!
function do_verb_sql() {
    global $CFG;
    $d = DIRECTORY_SEPARATOR;
    $base = $CFG->dirroot.$d.'lom'.$d;
    $output = "<html><body>";
    
    $lom_files = array();

    $dirIter = new RecursiveDirectoryIterator($base, RecursiveDirectoryIterator::KEY_AS_PATHNAME);
    $recIter = new RecursiveIteratorIterator($dirIter, RecursiveIteratorIterator::CHILD_FIRST);
    foreach ($recIter as $info) {
        if (($info->isFile()) && fnmatch("*json", $info->getFilename())) {
            $lom_files[$info->getFilename()] = $info->getPathname();
        }
    }
//-----marinos patch start here 
//-- conection to DB - maybe could be in external file as dbconfig or something
	$dbhost    = 'localhost';
	$dbname    = 'agrimoodle';
	$dbuser    = 'root';
	$dbpass    = '';
		
	$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
	mysql_select_db($dbname);
	mysql_set_charset('utf8_unicode_ci',$conn);
//-----marinos patch ends here
	
    $output .= "<ul>";
    foreach ($lom_files as $lom => $lompath) {
        $output .= "<li>$lom<ul><li>$lompath</li><pre>";
        $output .= json_to_xml(file_get_contents($lompath));
//-----marinos patch start here
//-- create SQL command html output for debug
//-- use function json_to_xml() (allready exist) to parse json and create xml
		$output .= "SQL COMMAND-> INSERT INTO agrimoodle.oai_records SET serial= 'foo', provider='foo', url='foo', enterdate='foo', oai_identifier='foo', oai_set='foo', datestamp='null', deleted='',lom_record='".json_to_xml(file_get_contents($lompath))."';";
        $output .= "</pre></ul></li>";

//-- send SQL command to mysql to execute
//-- use function json_to_xml() (allready exist) to parse json and create xml		
		$sqlInsert = "INSERT INTO agrimoodle.oai_records SET serial= 'foo', provider='foo', url='foo', enterdate='foo', oai_identifier='foo', oai_set='foo', datestamp='null', deleted='',lom_record='".json_to_xml(file_get_contents($lompath))."';";
		$result = mysql_query($sqlInsert)
				or die('Query failed. ' . mysql_error());
//-----marinos patch ends here
   }
//-----marinos patch start here
// -- close db connection 
   mysql_close($conn);
//-----marinos patch ends here
   
   $output .= "</ul></body></html>";
   return $output;
}



/*
 * ARGUMENTS:
 *  + identifier      :
 *  + metadataPrefix  :
 * ERRORS:
 *  - badArgument
 *  - cannotDisseminateFormat
 *  - idDoesNotExist
 * RESPONSE:
 *  + record (in appropriate format)
 */

function do_verb_get_record($identifier) {
    $baseurl = new moodle_url("/");
    $output = <<<XML
 <request verb='GetRecord' identifier='$identifier'
           metadataPrefix='agrimoodle'>$baseurl</request>
  <GetRecord>
   <record>
    <header>
      <identifier>$identifier</identifier>
      <datestamp>2001-12-14</datestamp>
      <setSpec>XXXXXXX</setSpec>
    </header>
    <metadata>
XML;
    $output .= json_to_xml("{\"title\":[{\"value\":\"Introduction to Blogs\",\"language\":\"en\"}],\"language13\":[\"fr\"],\"description\":[[{\"value\":\"This is an introduction to blogs.\",\"language\":\"en\"}]],\"keyword\":[[{\"value\":\"\",\"language\":\"en\"}]],\"contribute2\":[{\"role\":\"initiator\",\"date\":\"07\/27\/2012\",\"entity\":[{\"firstname\":\"\",\"lastname\":\"\",\"email\":\"\",\"organization\":\"AA\"}]}],\"contribute3\":{\"language34\":\"\",\"0\":{\"role\":\"creator\",\"date\":\"07\/27\/2012\",\"entity\":[{\"firstname\":\"Admin\",\"lastname\":\"User\",\"email\":\"tkout@agroknow.gr\",\"organization\":\"\"}]}},\"educational\":{\"interactivity_level\":\"\",\"semantic_density\":\"\",\"typical_age\":\"\",\"difficulty\":\"\",\"learning_time\":\"\"},\"description5\":[[{\"value\":\"\",\"language\":\"en\"}]],\"cc\":\"by_nd\",\"classification_details\":[\"energy_crops_cultivation\"]}");
    $output .= <<<XML
    </metadata>
  </record>
 </GetRecord>
XML;

    return $output;
}

function json_to_xml($json) {

//-----marinos patch start here
// -- this maybe not be used if XML_Serializer() workd for u.
	$data = json_decode($json, true);
		
	$json = $data;

	// creating object of SimpleXMLElement
	$xml_json = new SimpleXMLElement("<json></json>");
//-- use array_to_xml function (new function) to get xml. 
	array_to_xml($json,$xml_json);
	$xmlstring = $xml_json->asXML();
//-- my function return some unacceptable tag name <0> so use str_replace() to replace them with item0  
	$xmlstring1rstRplc = str_replace("<0>", "<item0>", $xmlstring);
	$xmlstring2ndRplc = str_replace("</0>", "</item0>", $xmlstring1rstRplc);
	return $xmlstring2ndRplc;
//-----marinos patch ends here

	$obj = json_decode($json,true);
	
    // An array of serializer options
    $serializer_options = array(
        'addDecl' => TRUE,
        'encoding' => 'ISO-8859-1',
        'indent' => '  ',
        'rootName' => 'json',
        'mode' => 'simplexml'
    );
	
    $serializer = new XML_Serializer($serializer_options);
//    $foo = PEAR::raiseError('Just a test', 1234);

    //var_dump($obj);
    if ($serializer->serialize($obj)) {
        return $serializer->getSerializedData();
    }
    else {
        return null;
    }
//    return toXML($obj);
}


//-----marinos patch start here
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
//-----marinos patch ends here


function toXML($xmlArray, $elmName = 'graph', $elmCloseTag = "", $level = 0) {
    $xmlString = "";
    if (is_array($xmlArray)) {
        $strXmlAttributes = "";
        $key_xml = "";
        $keysXmlArray = array_keys($xmlArray);
        $curLevel = $level + 1;
        if (in_array(self::attribute, $keysXmlArray)) {
            if (isset($xmlArray[self::attribute])) {
                if (is_array($xmlArray[self::attribute])) {
                    foreach ($xmlArray[self::attribute]
                    as $xmlArrayKey => $xmlArrayValue) {
                        $strXmlAttributes .= sprintf(' %s="%s"', $xmlArrayKey, addslashes($xmlArrayValue));
                    }
                }
            }
            unset($xmlArray[self::attribute]);
        }
        if (in_array(self::textNode, $keysXmlArray)) {
            if (isset($xmlArray[self::textNode])) {
                if ($xmlArray[self::textNode]) {
                    $key_xml = $xmlArray[self::textNode];
                }
                if (strlen($ky_xml)) {
                    $key_xml = sprintf("<![CDATA[%s]]>", $key_xml);
                }
                else {
                    $key_xml = "";
                }
            }
            unset($xmlArray[self::textNode]);
        }
        $keysXmlArray = array_keys($xmlArray);
        if ($elmCloseTag) {
            $indent = str_repeat(" ", $level * 5);
            $xmlString .="\n" . $indent .
                    "<" . $elmCloseTag . $strXmlAttributes . ">" .
                    $key_xml;
        }
        if (is_array($xmlArray) && count($xmlArray) > 0
                && count($keysXmlArray) > 0) {
            reset($xmlArray);
            foreach ($keysXmlArray as $key) {
                $altKey = $altKeyXml = $xmlArray[$key];
                $check = false;
                foreach (array_keys($altKeyXml) as $j => $p) {
                    if (is_numeric($j)) {
                        $check = true;
                        $xmlString.= $this->_toXML(
                                $altKeyXml[$j], "", $key, $curLevel
                        );
                        unset($altKeyXml[$j]);
                    }
                }
                if ($check) {
                    $altKey = $altKeyXml;
                }
                if ($altKey) {
                    $xmlString .= $this->_toXML($altKey, "", $key, $curLevel);
                }
            }
        }
        if ($elmCloseTag) {
            $xmlString.= (count($xmlArray) > 0 ? "\n" . $indent : "") .
                    "</" . $elmCloseTag . ">";
        }
    }
    else {
        $xmlString = var_dump($xmlArray);
    }
    return $xmlString;
}

$verb = $_GET['verb'];

//$course_id = intval($_GET['id']);
// if course id not valid exit

if (empty($verb)) {
    print_r("Invalid verb!");
    exit;
}

new PMH(10, $verb);
?>