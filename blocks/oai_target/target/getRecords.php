<?php

	$dbhost    = 'localhost';
	$dbname    = 'agrimoodle';
	$dbuser    = 'root';
	$dbpass    = '';
	$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
	mysql_select_db($dbname);
	mysql_set_charset('utf8',$conn);
	
	
	$sql = 'SELECT lom_record FROM oai_records';
	
	$result = mysql_query($sql)
				or die('Query failed. ' . mysql_error());
	
	$row = mysql_fetch_row($result);

	echo $row[0]; 
	
	mysql_close($conn);
		
		
?>