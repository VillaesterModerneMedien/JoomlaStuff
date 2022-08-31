<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_breadcrumbs
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Factory;
defined('_JEXEC') or die;

$document = Factory::getDocument();
$renderer = $document->loadRenderer('modules');
$position1 = $params->get('builderposition');
$options = array('style' => 'section');
$module1 = $renderer->render($position1, $options, null);
echo $module1;