<?php

$el = $this->el('div', [

    'uk-accordion' => [
        'multiple: {multiple};',
        'collapsible: {0};' => $props['collapsible'] ? 'true' : 'false',
    ],

]);

?>

<?= $el($props, $attrs) ?>

    <?php foreach ($children as $child) :

        $content = $this->el('div', [

            'class' => [
                'uk-accordion-content',
                'uk-margin-remove-first-child' => !$child->props['image'] || !in_array($props['image_align'], ['left', 'right']),
            ],

        ]);

    ?>
    <div class="el-item custom-accordeon">

            <a class="el-title uk-accordion-title" href="#">
                <span class="custom-icon" uk-icon="<?= $child->props['icon'] ?>"></span>
                <?= $child->props['title'] ?>
            </a>


        <?= $content($props) ?>
            <?= $builder->render($child, ['element' => $props]) ?>
        <?= $content->end() ?>
        
    </div>
    <?php endforeach ?>

</div>