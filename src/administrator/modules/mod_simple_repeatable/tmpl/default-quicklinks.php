<?php

/**

 * Whykiki Kontakte Nodul

 */

defined( '_JEXEC' ) or die( 'Restricted access' );
$chunkdedIcons = array_chunk($quicklinks, 4);
//var_dump($chunkdedIcons);

?>

    <?php $counter = 0; ?>
    <div class="quicklinksContainer">
        <ul>
            <?php foreach ($quicklinks as $item): ?>
            <?php $counter++; ?>
            <li>
                <a class="" target="<?= $item['target']; ?>" href="<?php echo $item['link']; ?>">
                    <button class="repeatableButton">
                        <i class="fa <?php echo $item['icon']; ?> fa-2x"></i>
                    </button>
                    <h3 class="leistungenTitle"><?php echo $item['titel']; ?></h3>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>



