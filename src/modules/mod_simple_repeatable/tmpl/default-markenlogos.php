<?php

/**

 * Whykiki Kontakte Nodul

 */

defined( '_JEXEC' ) or die( 'Restricted access' );

?>
    <style>
        .markenlogosLink svg {
            width: <?= $markenlogos['size'];?> !important;
        }
    </style>
    <?php $counter = 0; ?>
    <div class="markenlogosContainer uk-visible@m">
        <ul>
            <?php foreach ($markenlogos['items'] as $item): ?>
            <?php $counter++; ?>
            <li>
                <a class="markenlogosLink" href="<?php echo $item['link']; ?>">
                    <img src="<?= $item['logo']; ?>" alt="<?= $item['logo']; ?>" width="90px" height="90px"/>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>



