<?php
    use Joomla\CMS\Language\Text;

    $warningMessage = $this->params->get('warningtext');
    $btnCancel =  $this->params->get('btnTextCancel');
    $btnOK =  $this->params->get('btnTextOK');
?>

<div id="modalWarning" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title"><?= Text::_('PLG_SYS_VGRD_EXTERNALLINKS_WARNING_MESSAGE_HEADLINE'); ?></h2>
        <?= $warningMessage; ?>
        <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button"><?= $btnCancel; ?></button>
            <button id="visitPage" class="uk-button uk-button-primary" type="button"><?= $btnOK; ?></button>
         </p>
    </div>
</div>
</body>

