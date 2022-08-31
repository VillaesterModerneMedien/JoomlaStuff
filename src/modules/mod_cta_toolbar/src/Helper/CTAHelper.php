<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_cta_toolbar
 *
 * @copyright   (C) 2020 Mario Hewera
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Module\CTAToolbar\Site\Helper;

\defined('_JEXEC') or die;

/**
 * Helper for mod_cta_toolbar
 *
 * @since  1.0
 */
class CTAHelper
{
    public static function getContent($params)
    {
        $logos = $params->get('sublogos', '');
        $size = $params->get('size','');
        $sticky = $params->get('sticky','');
        $position = $params->get('position','');
        $spacing = $params->get('spacing','');
        $width = $params->get('width','');
        $height = $params->get('height','');
        $backgroundcolor = $params->get('backgroundcolor','');
        $iconcolor = $params->get('iconcolor','');

        $content = [
            'logos'             =>  $logos,
            'size'              =>  $size,
            'position'          =>  $position,
            'width'             =>  $width,
            'height'            =>  $height,
            'backgroundcolor'   => $backgroundcolor,
            'iconcolor'         =>  $iconcolor,
            'sticky'            =>  $sticky,
            'spacing'           =>  $spacing
        ];
        return $content;
    }

}
