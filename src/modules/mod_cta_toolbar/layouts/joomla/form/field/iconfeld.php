<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   (C) 2016 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

extract($displayData);
/**
 * Layout variables
 * -----------------

 * @var   string   $class           Classes for the input.
 * @var   boolean  $hidden          Is this field hidden in the form?
 * @var   string   $id              DOM id of the field.
 * @var   string   $label           Label of the field.
 * @var   string   $name            Name of the input field.
 * @var   string   $value           Value attribute of the field.
 * @var   array    $inputType       Options available for this field.
 */


$attributes = array(
	!empty($class) ? 'class="form-control ' . $class . '"' : 'class="form-control"',
);

$app = Factory::getApplication();
/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $app->getDocument()->getWebAssetManager();
$wa->registerAndUseStyle('mod_cta_toolbar', './modules/mod_cta_toolbar/assets/css/all.min.css');
$wa->registerAndUseStyle('mod_cta_toolbar_custom', './modules/mod_cta_toolbar/assets/css/custom.css');

$icondata = explode(",", $value);
if (count($icondata) > 1)
{
    $iconklasse = $icondata[0] . ' ' . $icondata[1];
}
else
{
    $iconklasse = $icondata[0];
}

?>
    <div class="ctaContainer">
        <i class="<?= $iconklasse; ?>"></i>
        <button
                type="button"
                class="btn btn-sm btn-info w5rem mb-1 ctaModalButton"
                data-bs-id="<?php echo $id; ?>"
                data-bs-toggle="modal"
                data-bs-target="#cta-modal-box"
        >
            Icon auswählen
            <input
                    type="hidden"
                    name="<?php echo $name; ?>"
                    id="<?php echo $id; ?>"
                    value="<?php echo htmlspecialchars($value, ENT_COMPAT, 'UTF-8'); ?>"
                <?php echo implode(' ', $attributes); ?>
            >
        </button>

    </div>









