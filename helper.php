<?php
/**
 * 				JSolarlog 
 * @version			1.0.0
 * @package			JSolarlog for Joomla!
 * @copyright			Copyright (C) 2013 Dieter Blocher - All rights reserved.
 *
 * @author			Dieter Blocher : info@ctorfab.com
 * @link			http://www.ctorfab.com/
 * @date			2013/03/03
 *
 */
defined('_JEXEC') or die;

class modJSolarlogHelper
{
  static function reorderArray($daten)
  {
    foreach($daten as $aktuellerWert) 
    {
      foreach ($aktuellerWert as $aktuellerSchlüssel => $aktuellerWert) 
      {
	if (is_array($aktuellerWert))
	{
	   foreach ($aktuellerWert as $aktuellerSchlüssel2 => $aktuellerInnererWert) 
	   { 
	      $findMich   = 'new Array(';
	      $pos = strpos($aktuellerInnererWert, $findMich);

	      if ($pos !== false && $pos == 0)
	      {
		$aktuellerInnererWert = ltrim($aktuellerInnererWert, $findMich); 
		$aktuellerInnererWert = trim($aktuellerInnererWert);
		$findMich = ")";
		$aktuellerInnererWert = rtrim($aktuellerInnererWert, $findMich); 
		$aktuellerInnererWert = explode( ',', $aktuellerInnererWert );
	      }
	      else
	      {
		$aktuellerInnererWert = explode( ',', trim(trim($aktuellerInnererWert), '"'));
		
	      }
	      $ret_inner[$aktuellerSchlüssel2] = $aktuellerInnererWert; 
	   }
	   $ret[$aktuellerSchlüssel] = $ret_inner;
	}
	else	
	{
	  $ret[$aktuellerSchlüssel] = trim(trim($aktuellerWert), '"'); 
	}
      }
    }
    return $ret;
  }

  static function reorderMinDayArray($daten)
  {
    $i = 0;
    foreach($daten as $aktuellerWert) 
    {
      foreach ($aktuellerWert as $aktuellerSchlüssel => $aktuellerWert) 
      {
	if (is_array($aktuellerWert))
	{
	  $puffer = trim(trim($aktuellerWert['mi  ']), '"');
	  $puffer = explode( '|', $puffer);
	  $j=0;
	  foreach ($puffer as $pufferWert) 
	  {
	     $zeile[$j++] = explode( ';', $pufferWert);
	  }
	}
      }
      $ret[$i++] = $zeile;
    }
    return $ret;
  }

  static function reorderDaysArray($daten)
  {
    $i = 0;
    foreach($daten as $aktuellerWert) 
    {
      foreach ($aktuellerWert as $aktuellerSchlüssel => $aktuellerWert) 
      {
	if (is_array($aktuellerWert))
	{
	  $puffer = trim(trim($aktuellerWert['dx  ']), '"');
	  $puffer = explode( '|', $puffer);
	  $j=0;
	  foreach ($puffer as $pufferWert) 
	  {
	     $zeile[$j++] = explode( ';', $pufferWert);
	  }
	}
      }
      $ret[$i++] = $zeile;
    }
    return $ret;
  }
 
  static function holeSolarLogDaten_MinCur()
  {
    $datei = 'http://www.spvgg-leidringen.de/solarlog_data/min_cur.js';
    $lines = file ($datei);
    foreach ($lines as $line_num => $line)
    {
      parse_str($line, $daten[$line_num]);
    }
    return modJSolarlogHelper::reorderArray($daten);
  }

  static function holeSolarLogDaten_Days()
  {
    $datei = 'http://www.spvgg-leidringen.de/solarlog_data/days.js';
    $lines = file ($datei);
    foreach ($lines as $line_num => $line)
    {
      parse_str($line, $daten[$line_num]);
    }
    return modJSolarlogHelper::reorderDaysArray($daten);
  }

  static function holeSolarLogDaten_MinDay()
  {
    $datei = 'http://www.spvgg-leidringen.de/solarlog_data/min_day.js';
    $lines = file ($datei);
    foreach ($lines as $line_num => $line)
    {
      parse_str($line, $daten[$line_num]);
    }
    return modJSolarlogHelper::reorderMinDayArray($daten);
  }

  static function holeSolarLogDaten_BaseVars()
  {
    $datei = 'http://www.spvgg-leidringen.de/solarlog_data/base_vars.js';
    $lines = file ($datei);
    foreach ($lines as $line_num => $line)
    {
      parse_str($line, $daten[$line_num]);
    }
    return modJSolarlogHelper::reorderArray($daten);
  }
    
  static function gibMaxWRP($datenBase)
  {
    $maxWRP = 0;
    $WRInfos = $datenBase['WRInfo'];    
    foreach ($WRInfos as $WRNr => $WRInfo)
    {
      if( $WRInfo[11]==0 || ($WRInfo[11]==2 && $WRInfo[14]==0) || $datenBase['AnzahlWR']==1 ) 
      {
	$maxWRP += $datenBase['MaxWRP'][$WRNr][0];
      }
    }
    return $maxWRP;
  }

  static function gibPacDaten($datenBase, $datenMinDay)
  {
    $WRInfos = $datenBase['WRInfo'];
    $j = 0;
    foreach (array_reverse($datenMinDay) as $zeile)
    {
      $Pac["DatumZeit"] = $zeile[0][0];
      $i = 1;
      $puffer = 0;
      foreach ($WRInfos as $WRNr => $WRInfo)
      {
	if( $WRInfo[11]==0 || ($WRInfo[11]==2 && $WRInfo[14]==0) || $datenBase['AnzahlWR']==1 ) 
	{
	  $puffer += $zeile[$i++][0];
	}
      }
      $Pac["Pac"] = $puffer;
      $ret[$j++] = $Pac;
    }
    return $ret;
  }

  static function gibIntervall($datenBase)
  {
    return $datenBase['var_Intervall_'];
  }

  static function gibPacAkt($datenBase)
  {
    return $datenBase['var_Pac'];
  }

  static function gibAnlagenKWP($datenBase)
  {
    return $datenBase['var_AnlagenKWP'];
  }

   static function gibErtrag($datenBase, $days)
  {
    $WRInfos = $datenBase['WRInfo'];
    $j = 0;
    foreach (array_reverse($days) as $zeile)
    {
      $Ertrag["Datum"] = $zeile[0][0];
      $i = 1;
      $puffer = 0;
      foreach ($WRInfos as $WRNr => $WRInfo)
      {
	if( $WRInfo[11]==0 || ($WRInfo[11]==2 && $WRInfo[14]==0) || $datenBase['AnzahlWR']==1 ) 
	{
	  $puffer += $zeile[$i++][0];
	}
      }
      $Ertrag["Summe"] = $puffer;
      $ret = $Ertrag;
    }
    return $ret;
  }

  static function gibWRInfo($datenBase)
  {
    return $datenBase['WRInfo'];
  }

  static function gibTimeStartArray($datenBase)
  {
    $ret = $datenBase['var_time_start_'];
    return modJSolarlogHelper::gibArray($ret);
  }

  static function gibTimeEndeArray($datenBase)
  {
    $ret = $datenBase['var_time_end_'];
    return modJSolarlogHelper::gibArray($ret);
  }

  static function gibDatumsFormat($datenBase)
  {
    return $datenBase['var_DateFormat_'];
  }

  static function gibAktMonat($Ertrag, $datenBase)
  {
    $Datum = $Ertrag['Datum'];
    $DatumsFormat = modJSolarlogHelper::gibDatumsFormat($datenBase);
    $findMich   = 'mm';
    $pos = strpos($DatumsFormat, $findMich);
    return (int)substr($Datum, $pos, 2);
  }

  static function gibMonatsZeiten($AktMonat, $TimeStart, $TimeEnde)
  {
    $start = $TimeStart[$AktMonat-1];
    $ende = $TimeEnde[$AktMonat-1];
    return ($ende - $start);
  }
 
  static function gibArray($ret)
  {
    $findMich   = 'new Array(';
    $pos = strpos($ret, $findMich);

    if ($pos !== false && $pos == 0)
    {
      $ret = ltrim($ret, $findMich); 
      $ret = trim($ret);
      $findMich = ")";
      $ret = rtrim($ret, $findMich); 
      $ret = explode( ',', $ret );
    }
    return $ret;
  }

  static function generiereDaten()
  {
    $basevars = modJSolarlogHelper::holeSolarLogDaten_BaseVars();
    $maxWRP = modJSolarlogHelper::gibMaxWRP($basevars);

    $minday = modJSolarlogHelper::holeSolarLogDaten_MinDay();
    $PacDaten = modJSolarlogHelper::gibPacDaten($basevars, $minday);
    $Intervall = modJSolarlogHelper::gibIntervall($basevars);
    
    $mincur = modJSolarlogHelper::holeSolarLogDaten_MinCur();
    
    $days = modJSolarlogHelper::holeSolarLogDaten_Days();  
    $Ertrag = modJSolarlogHelper::gibErtrag($basevars, $days);
    $AnlagenKWP = modJSolarlogHelper::gibAnlagenKWP($basevars);
    
    $Tagesleistung = floor($Ertrag['Summe']/100)/10;
    $PacAkt = modJSolarlogHelper::gibPacAkt($mincur);
    $Psum =  floor($Ertrag['Summe']/$AnlagenKWP*10)/10;
   
    $TimeStart = modJSolarlogHelper::gibTimeStartArray($basevars);
    $TimeEnde = modJSolarlogHelper::gibTimeEndeArray($basevars);
    
    $AktMonat = modJSolarlogHelper::gibAktMonat($Ertrag, $basevars);

    $MonatsZeiten = modJSolarlogHelper::gibMonatsZeiten(7, $TimeStart, $TimeEnde);
    
    $result["MonatsZeiten"] = $MonatsZeiten;
    $result["Tagesleistung"] = $Tagesleistung;
    $result["PacAkt"] = $PacAkt;
    $result["Psum"] = $Psum;
    $result["PacDaten"] = $PacDaten;
    return $result;
  }

  static function generiereErtragsdaten()
  {
    $daten = modJSolarlogHelper::generiereDaten();
    return $daten;
  }
}
?>