<?php
extract($displayData);
?>

<ul class="vgrdWeatherContainer">
    <li><span class="weatherIcon"><i class="fal fa-<?= $icon; ?>"></i></span> <?= $stadt; ?>, <?= $temp; ?>°C - <?= $desc; ?> </li>
</ul>
