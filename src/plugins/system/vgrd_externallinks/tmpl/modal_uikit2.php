<?php
    use Joomla\CMS\Language\Text;
    $warningMessage = $this->params->get('warningtext');
    $btnCancel =  $this->params->get('btnTextCancel');
    $btnOK =  $this->params->get('btnTextOK');
?>


<!-- This is the modal -->
<div id="modalWarning" class="uk-modal">
    <div class="uk-modal-dialog">
        <div class="uk-margin uk-modal-content">
            <h2 class="uk-modal-title"><?= Text::_('PLG_SYS_VGRD_EXTERNALLINKS_WARNING_MESSAGE_HEADLINE'); ?></h2>
            <?= $warningMessage; ?>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-modal-close"><?= $btnCancel; ?></button>
            <button id="visitPage" class="uk-button uk-button-primary"><?= $btnOK; ?></button>
        </div>
    </div>
</div>
</body>
<?php

