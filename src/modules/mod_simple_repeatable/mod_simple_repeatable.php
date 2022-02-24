<?php

/**

 * Bootstrap 3.3.1 Carousel // Simple Joomla Slider Module

 *

 * @package    Whykiki

 * @subpackage Modules

 * @link http://dev.joomla.org/component/option,com_jd-wiki/Itemid,31/id,tutorials:modules/

 * @license        GNU/GPL, see LICENSE.php

 * mod_easy_Swiper is free software. This version may have been modified pursuant

 * to the GNU General Public License, and as distributed it includes or

 * is derivative of works licensed under the GNU General Public License or

 * other free or open source software licenses.

 */

 /**

 * @author      Christian Schuelling

 * @package     Joomla!

 * @subpackage  Simple Joomla Slider Module

 * @link        http://whykiki.de

 * @email       info@whykiki.de

 * @copyright   Christian Schuelling

 *

 * Copyright (C) 2014 Christian Schuelling

 * Weitergabe oder Nutzung in eigenen Templates ausdrücklich untersagt!!!

**/



// no direct access

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;

defined( '_JEXEC' ) or die( 'Restricted access' );



// Include the helper.


JLoader::register('ModSimpleRepeatable', __DIR__ . '/helper.php');

// *************************************************************************************
// add Files JS and CSS
// *************************************************************************************


$basis = JURI::base( true );
$doc = Factory::getDocument();

$fileloading = $params->get('fileloading');

$markenlogos = ModSimpleRepeatable::getMarkenlogos($params);
$moduleHeadline = str_replace('[shy]', '&shy;',  $params->get('module_headline'));
$module->title = str_replace('[DE]','', $module->title);
$module->title = str_replace('[EN]','', $module->title);
$module->title = trim($module->title);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

switch($fileloading){
	// Image menu
	case 0:
		$quicklinks = ModSimpleRepeatable::getMarkenlogos($params);
		require( ModuleHelper::getLayoutPath( 'mod_simple_repeatable',$params->get('layout', 'default-markenlogos') ) );
		break;
}
?>
