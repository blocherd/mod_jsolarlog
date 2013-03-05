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

//get Helper
require_once( dirname(__FILE__).DS.'helper.php' );

//get base_vars
$basevars = modJSolarlogHelper::holeSolarLogDaten_BaseVars();
//get days
$days = modJSolarlogHelper::holeSolarLogDaten_Days();
//get min_cur
$mincur = modJSolarlogHelper::holeSolarLogDaten_MinCur();
//get min_day
$minday = modJSolarlogHelper::holeSolarLogDaten_MinDay();

//put it into the template
require( JModuleHelper::getLayoutPath('mod_jsolarlog') );
?> 
