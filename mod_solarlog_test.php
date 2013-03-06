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

//$datei['min_cur.js'] = 'http://www.spvgg-leidringen.de/solarlog_data/min_cur.js';
//$datei['base_vars.js'] = 'http://www.spvgg-leidringen.de/solarlog_data/base_vars.js';
//$datei['min_day.js'] = 'http://www.spvgg-leidringen.de/solarlog_data/min_day.js';
//$datei['days.js'] = 'http://www.spvgg-leidringen.de/solarlog_data/days.js';


$datei['min_cur.js'] = 'http://www.solarlog-home0.de/etter.eu/min_cur.js';
$datei['base_vars.js'] = 'http://www.solarlog-home0.de/etter.eu/base_vars.js';
$datei['min_day.js'] = 'http://www.solarlog-home0.de/etter.eu/min_day.js';
$datei['days.js'] = 'http://www.solarlog-home0.de/etter.eu/days.js';


//print_r($datei);
$daten = modJSolarlogHelper::generiereErtragsdaten($datei);
//print_r($daten);
$diagramm = erzeugeDiagramDaten($daten);


echo "<div style=\"position:absolute; top:0px; left:0px; width:180px; height:60px ;background-color:#000000\" id='balken'>\n";

foreach ($diagramm as $value) 
{
  echo "$value\n";
}
echo "</div>";
echo "</div>";
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

function erzeugeDiagramDaten($daten)
{
  $PacDaten = $daten['PacDaten'];
  $MaxWRP = $daten['MaxWRP'];
  $Intervall = 300;
  $PacSumme = 0;
  
  foreach ($PacDaten as $nummer => $aktuellerWert) 
  {
      $PacSumme = $aktuellerWert["Pac"];
      $y = $PacSumme/$MaxWRP*55;
      if( $y>1 )
      {
	$y = floor($y);
	$w = floor($Intervall/300);
	$ret[] = "<img style=\"float:left; margin:0;\" src=\"http://www.spvgg-leidringen.de/solarlog_data/y.gif\" width=\"$w\" height=\"$y\">";
      }
  }
  return $ret;
}
?>