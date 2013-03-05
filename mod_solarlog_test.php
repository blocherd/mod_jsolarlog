<?php
/**
 * 				JSolarlog 
 * @version			1.0.0
 * @package			JSolarlog for Joomla!
 * @copyright			Copyright (C) 2013 Dieter Blocher - All rights reserved.
 *
 * @author			Dieter Blocher : info@ctorfab.com
 * @link			http://www.ctorfab.com/
 *
 */
const _JEXEC="_JEXEC";
require_once('helper.php');

modJSolarlogHelper::generiereErtragsdaten();

//get base_vars
//$basevars = modJSolarlogHelper::holeSolarLogDaten_BaseVars();
//get days
//$days = modJSolarlogHelper::holeSolarLogDaten_Days();
//get min_cur
//$mincur = modJSolarlogHelper::holeSolarLogDaten_MinCur();
//get min_day
//$minday = modJSolarlogHelper::holeSolarLogDaten_MinDay();

//print_r($basevars);
//print_r($days);
//print_r($mincur);
//print_r($minday);

//echo $basevars['Firmware'];
//if(in_array('var_Firmware_', $basevars))
//{
//  echo $basevars["var_Firmware_"];
//}
//else
//{
//  echo "var_Firmware_ nicht im Array!";
//}

//var_dump($basevars);
//echo $basevars;
//echo '\n';
//$findMich = '=';
//$meinString =
//$pos = strpos($meinString, $findMich);
?>