<?php
/*
* +----------------------------------------------------------------------+
* | PHP Version 4                                                        |
* +----------------------------------------------------------------------+
* | Copyright (c) 2013 Agro-Know Technologies                            |
* |                                                                      |
* | dc_lom.php -- Utilities for the OAI Data Provider                    |
* |                                                                      |
* | This is free software; you can redistribute it and/or modify it under|
* | the terms of the GNU General Public License as published by the      |
* | Free Software Foundation; either version 2 of the License, or (at    |
* | your option) any later version.                                      |
* | This software is distributed in the hope that it will be useful, but |
* | WITHOUT  ANY WARRANTY; without even the implied warranty of          |
* | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the         |
* | GNU General Public License for more details.                         |
* | You should have received a copy of the GNU General Public License    |
* | along with  software; if not, write to the Free Software Foundation, |
* | Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA         |
* |                                                                      |
* +----------------------------------------------------------------------+
* | Derived from work by U. Mόller, HUB Berlin, 2002                     |
* |     and from work by Heinrich Stamerjohanns, 2005                    | 
* |                                                                      |
* | Written by Tasos Koutoumanos, May 2012                               |
* |            tafkey@about.me                                           |
* +----------------------------------------------------------------------+
*/



// please change to the according metadata prefix you use 
$prefix = 'oai_lom';

$output .= 
'   <metadata>'."\n";
$output .= metadataHeader($prefix);

$output .= $record['lom_record'];

// FIXME: this is a hack, Marinos pls. fix!
$output .= '</lom>';          
// '     </'.$prefix.';
// if (isset($METADATAFORMATS[$prefix]['record_prefix'])) {
  // $output .= ':'.$METADATAFORMATS[$prefix]['record_prefix'];
// }
$output .= ">\n";
$output .= 
'   </metadata>'."\n";
?>
