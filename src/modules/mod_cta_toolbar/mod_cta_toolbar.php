<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_feed
 *
 * @copyright   (C) 2005 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Module\CTAToolbar\Site\Helper\CTAHelper;


$helper = CTAHelper::getContent($params);

require ModuleHelper::getLayoutPath('mod_cta_toolbar', $params->get('layout', 'default'));
