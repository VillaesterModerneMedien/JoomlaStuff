<?php

// Display
foreach (['title', 'meta', 'content', 'link'] as $key) {
    if (!$element["show_{$key}"]) { $props[$key] = ''; }
}

if (!$element['show_image']) { $props['image'] = $props['icon'] = ''; }

// Resets
if ($props['icon'] && !$props['image']) { $element['panel_card_image'] = ''; }

// New logic shortcuts
$element['has_panel_card_image'] = $props['image'] && $element['panel_card_image'] && $element['image_align'] != 'between';
$element['has_content_padding'] = $props['image'] && $element['panel_content_padding'] && $element['image_align'] != 'between';

// If link is not set use the default image for the lightbox
if (!$props['link'] && $element['lightbox']) {
    $props['link'] = $props['image'];
}

// Panel/Card
$el = $this->el($props['link'] && $element['panel_link'] ? 'a' : 'div', [

    'class' => [
        'el-item',
        'uk-margin-auto uk-width-{item_maxwidth}',
        'uk-panel {@!panel_style}',
        'uk-card uk-{panel_style} [uk-card-{panel_size}]',
        'uk-card-hover {@!panel_style: |card-hover} {@panel_link}' => $props['link'],
        'uk-card-body {@panel_style} {@!has_panel_card_image}',
        'uk-margin-remove-first-child' => (!$element['panel_style'] && !$element['has_content_padding']) || ($element['panel_style'] && !$element['has_panel_card_image']),
        'uk-flex {@panel_style} {@has_panel_card_image} {@image_align: left|right}', // Let images cover the card height if the cards have different heights
        'uk-transition-toggle {@image_transition} {@panel_link}' => $props['image'],
    ],

]);

// Image align
$grid = $this->el('div', [

    'class' => [
        'uk-child-width-expand',
        $element['panel_style'] && $element['has_panel_card_image']
            ? 'uk-grid-collapse uk-grid-match'
            : ($element['image_grid_column_gap'] == $element['image_grid_row_gap']
                ? 'uk-grid-{image_grid_column_gap}'
                : '[uk-grid-column-{image_grid_column_gap}] [uk-grid-row-{image_grid_row_gap}]'),
        'uk-flex-middle {@image_vertical_align}',
    ],

    'uk-grid' => true,
]);

$cell_image = $this->el('div', [

    'class' => [
        'uk-width-{image_grid_width}[@{image_grid_breakpoint}]',
        'uk-flex-last[@{image_grid_breakpoint}] {@image_align: right}',
    ],

]);

// Content
$content = $this->el('div', [

    'class' => [
        'uk-card-body uk-margin-remove-first-child {@panel_style} {@has_panel_card_image}',
        'uk-padding[-{!panel_content_padding: |default}] uk-margin-remove-first-child {@!panel_style} {@has_content_padding}',
        // 1 Column Content Width
        'uk-container uk-container-{panel_content_width}' => $props['image'] && $element['image_align'] == 'top' && !$element['panel_style'] && !$element['panel_content_padding'] && !$element['item_maxwidth'] && (!$element['grid_default'] || $element['grid_default'] == '1') && (!$element['grid_small'] || $element['grid_small'] == '1') && (!$element['grid_medium'] || $element['grid_medium'] == '1') && (!$element['grid_large'] || $element['grid_large'] == '1') && (!$element['grid_xlarge'] || $element['grid_xlarge'] == '1'),
    ],

]);

$cell_content = $this->el('div', [

    'class' => [
        'uk-margin-remove-first-child' => (!$element['panel_style'] && !$element['has_content_padding']) || ($element['panel_style'] && !$element['has_panel_card_image']),

    ],

]);

// Link
$link = include "{$__dir}/template-link.php";

// Card media
if ($element['panel_style'] && $element['has_panel_card_image']) {
    $props['image'] = $this->el('div', ['class' => [
        'uk-card-media-{image_align}',
        'uk-cover-container{@image_align: left|right}',
    ]], $props['image'])->render($element);
}

?>

<div class="itemContainer" style="background: <?= $props['color'] ?>;">
    <a href="<?= $props['link']; ?>">
        <div class="gridContent">
            <?= $content($element, $this->render("{$__dir}/template-content", compact('props', 'link'))) ?>
        </div>
        <div class="itemOverlay" style="background: url(<?= $props['image'] ?>); background-size: cover; "></div>
    </a>
</div>


