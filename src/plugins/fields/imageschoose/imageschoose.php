<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Fields.Text
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Factory;
use Joomla\CMS\Filesystem\Folder;

defined('_JEXEC') or die;

JLoader::import('components.com_fields.libraries.fieldsplugin', JPATH_ADMINISTRATOR);

/**
 * Fields Text Plugin
 *
 * @since  3.7.0
 */
class PlgFieldsImageschoose extends FieldsPlugin
{

    public function onBeforeCompileHead()
    {
        $app = Factory::getApplication();

        if ($app->isClient('administrator'))
        {
            JHtml::_('jquery.framework');
            $doc = Factory::getDocument();
            $doc->addStyleSheet('../plugins/fields/imageschoose/assets/imageschoose.css');
            $doc->addScript('../plugins/fields/imageschoose/assets/imageschoose.js');
        }

    }

}
