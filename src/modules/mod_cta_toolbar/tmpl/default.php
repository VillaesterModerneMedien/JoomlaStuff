<?php

use Joomla\CMS\Factory;

$app = Factory::getApplication();
/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $app->getDocument()->getWebAssetManager();
$wa->registerAndUseStyle('mod_cta_toolbar', './modules/mod_cta_toolbar/assets/css/all.min.css');
$wa->registerAndUseStyle('mod_cta_toolbar_custom', './modules/mod_cta_toolbar/assets/css/custom.css');



?>

<div id="wrapperfront"
     class="<?=
         $helper['position']
         .' '.$helper['sticky']
         .' '.$helper['spacing']; ?>"
     style="<?=
        'width:'.$helper['width'].';'
        .' height:'.$helper['height'].';'
        .' background-color:'.$helper['backgroundcolor'].';'; ?>"
>

    <?php foreach ($helper['logos'] as $logo):?>
        <a href="<?= $logo->url; ?>" target="<?= $logo->target; ?>">
            <i class="<?=  $logo->icon ?>"
               style="<?=
               'font-size:'.$helper['size'].';'
               .' color:'.$helper['iconcolor'].';'; ?>"
            ></i>
        </a>
    <?php endforeach;?>

</div>