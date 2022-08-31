<!-- Modal -->
<?php
use Joomla\CMS\HTML\HTMLHelper;
$id = '';
$font_vars = file_get_contents($_SERVER["DOCUMENT_ROOT"].'/modules/mod_cta_toolbar/assets/css/_variables.scss');
$pos = strpos($font_vars, '$fa-icons: (');
$font_vars = substr($font_vars, $pos);
$lines = explode("\n", $font_vars);
array_splice($lines, 0, 1);
$html = '';
$icon = '';
$stil = 'fa-solid';

$html .= '<div class="ctaIconlistWrapper" >';
$html .= '    <div class="ctaIconOptions">';
$html .= '          <select name="ctaStyleSelect" class="ctaStyleSelect">';
$html .= '                <option value="fa-solid" data-teststil="fa-solid" selected>Solid</option>';
$html .= '                <option value="fa-regular" data-teststil="fa-regular">Regular</option>';
$html .= '                <option value="fa-light" data-teststil="fa-light">Light</option>';
$html .= '                <option value="fa-thin" data-teststil="fa-thin">Thin</option>';
$html .= '                <option value="fa-duotone" data-teststil="fa-duotone">Duotone</option>';
$html .= '                <option value="fa-brands" data-teststil="fa-brands">Brands</option>';
$html .= '            </select>';
$html .= '            <input type="text" name="ctaIconSearch" class="ctaIconSearch search" placeholder="Icon suchen"/>';
$html .= '    </div>';
$html .= '    <div class="ctaIconContent">';
$html .= '      <ul class="ctaIconlistStyle ctaIconlist">';
    foreach($lines as $key => $value)
    {
        if(strpos($value, ':') !== false)
        {
            $t = explode(":", $value);
            $icon = str_replace('$fa-var', 'fa', $t[1]);
            $icon = rtrim($icon, ", ");
            if($icon == ' fa-42-group') { $stil='fa-brands'; }
            $html .= '<li data-icon="' . $icon . '" data-stil="' . $stil . '" data-bs-dismiss="modal" data-objectid="" class=""><i class="' . $stil . ' ' . $icon . '" ></i></li>';
        }
    }
$html .= '        </ul>';
$html .= '    </div>';
$html .= '</div>';

?>

<?php echo HTMLHelper::_(
    'bootstrap.renderModal',
    'cta-modal-box', // selector
    array( // options
        'modal-dialog-scrollable' => true,
        'title'  => 'Icon auswählen',
        'footer' => '',
    ),
     $html
); ?>

<script>
    var jtfUploadFile = function jtfUploadFile(elm, id) {
        var ctaStyleSelect = $('.ctaIconsContainer').find('#cta-modal-box .ctaStyleSelect');



        $(elm).on('click', function() {
            $(ctaStyleSelect).val('fa-solid');
            $('.ctaIconlist li').attr('data-objectid', id);
            $('.ctaIconlist li[data-stil="fa-brands"]').addClass('hide');
            $('.ctaIconlist li[data-stil!="fa-brands"]').removeClass('hide');
            $('.ctaIconlist i').removeClass('fa-brands fa-duotone fa-thin fa-light fa-regular').addClass('fa-solid');
            $('.ctaIconlist li[data-stil!="fa-brands"]').attr('data-stil', 'fa-solid');
            $('.ctaIconSearch').val('');
        });

    };

</script>
<script>
    jQuery(function($) {
        var ctaIconsContainer = $('.ctaIconsContainer');
        var ctaContainer = $(ctaIconsContainer).find('.ctaContainer');
        var ctaStyleSelect = $(ctaIconsContainer).find('#cta-modal-box .ctaStyleSelect');

        var modalButtons =  $(ctaIconsContainer).find('.ctaContainer button');
        $(modalButtons).each(function(index, elm){
            var objectId = $(this).find('input[type="hidden"]').attr('id');
            $(this).parent().find('i').attr('id', 'icon_' + objectId);
            var jtfUploadFile = window.jtfUploadFile || {};
            jtfUploadFile(this, objectId);
        });
        $(ctaStyleSelect).on('change', function (e) {
            e.preventDefault();
            var stil = $(this).val();

            if (stil != 'fa-brands') {
                $('.ctaIconlist li[data-stil="fa-brands"]').addClass('hide');
                $('.ctaIconlist li[data-stil!="fa-brands"]').attr('data-stil', stil);
                $('.ctaIconlist li[data-stil!="fa-brands"]').removeClass('hide');
                $('.ctaIconlist i').removeClass('fa-brands fa-solid fa-duotone fa-thin fa-light fa-regular').addClass(stil);
            } else {
                $('.ctaIconlist li[data-stil!="fa-brands"]').addClass('hide');
                $('.ctaIconlist li[data-stil="fa-brands"]').removeClass('hide');
                $('.ctaIconlist i').removeClass('fa-solid fa-duotone fa-thin fa-light fa-regular').addClass(stil);
            }
        });

        var suche = '';
        var searchStil = '';

        $('.ctaIconSearch').on('input', function (e) {
            e.preventDefault();
            suche = $(this).val();
            searchStil = $('.ctaStyleSelect').val();
            $('.ctaIconlist li').each(function () {
                var icon = $(this).attr('data-icon');
                var iconStil = $(this).attr('data-stil');

                if (icon.includes(suche) && iconStil == searchStil) {
                    $(this).removeClass('hide');
                } else {
                    $(this).addClass('hide');
                }

            });

        });

        $('.ctaIconlist li').on('click', function(e){
            e.preventDefault();
            var dataIcon = $(this).data('icon');
            var dataStil = $(this).data('stil');
            var dataId = $(this).data('objectid');
            $('#icon_' + dataId).attr( 'class', dataIcon + ' ' + dataStil );
            $('#' + dataId).val( dataIcon + ' ' + dataStil );

        });

        document.addEventListener('subform-row-add', function (event) {
            var row = event.target;
            document.formvalidator = new JFormValidator();

            if (!!row.querySelector('.ctaContainer')) {
                var jtfUploadFile = window.jtfUploadFile || {};
                Array.prototype.forEach.call(row.querySelectorAll('.ctaContainer'), function (e) {
                    var modalButtons =  $(e).find('button');

                    $(modalButtons).each(function(index, elm){
                        var objectId = $(this).find('input[type="hidden"]').attr('id');
                        $(this).parent().find('i').attr('id', 'icon_' + objectId);
                        var jtfUploadFile = window.jtfUploadFile || {};
                        jtfUploadFile(this, objectId);
                    });
                });
            }
        });
    });
</script>

