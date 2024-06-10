<?php
/*
 * 888888ba                 dP  .88888.                    dP
 * 88    `8b                88 d8'   `88                   88
 * 88aaaa8P' .d8888b. .d888b88 88        .d8888b. .d8888b. 88  .dP  .d8888b.
 * 88   `8b. 88ooood8 88'  `88 88   YP88 88ooood8 88'  `"" 88888"   88'  `88
 * 88     88 88.  ... 88.  .88 Y8.   .88 88.  ... 88.  ... 88  `8b. 88.  .88
 * dP     dP `88888P' `88888P8  `88888'  `88888P' `88888P' dP   `YP `88888P'
 *
 *                          m a g n a l i s t e r
 *                                      boost your Online-Shop
 *
 * -----------------------------------------------------------------------------
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

if (!class_exists('ML', false))
    throw new Exception();
?>
<input class="fullwidth<?php echo ((isset($aField['required']) && empty($aField['value'])) ? ' ml-error' : '').(isset($aField['cssclasses']) ? ' '.implode(' ', $aField['cssclasses']) : '') ?>"
       type="text" <?php echo isset($aField['id']) ? "id='{$aField['id']}'" : ''; ?>
       name="<?php echo MLHttp::gi()->parseFormFieldName($aField['name']) ?>"
       placeholder="<?php echo isset($aField['placeholder']) ? $aField['placeholder'] : ''; ?>"
    <?php echo(isset($aField['value']) && is_scalar($aField['value']) ? 'value="'.htmlspecialchars($aField['value'], ENT_COMPAT).'"' : '') ?>
    <?php echo isset($aField['maxlength']) ? "maxlength='{$aField['maxlength']}'" : ''; ?>
       style="width: 80%"/>
<?php
if (isset($aField['url'])) {
    $sCssUrl = " href='{$aField['url']}'";
} else {
    $sCssUrl = '';
}

if (isset($aField['target'])) {
    $sCssTarget = " target='{$aField['target']}'";
} else {
    $sCssTarget = '';
}
?>
<a id="fileBrowserButton_<?php echo $aField['id']; ?>" class="mlbtn abutton js-field" name="<?php echo MLHttp::gi()->parseFormFieldName($aField['name']) ?>"
    <?php echo((isset($aField['disabled']) && $aField['disabled']) ? ' disabled="disabled"' : '');
    echo $sCssUrl;
    echo $sCssTarget; ?>>
    <?php echo MLI18n::gi()->get('form_text_choose'); ?>
</a>

<div id="fileBrowser_<?php echo $aField['id']; ?>" class="dialog2" title="<?php echo MLI18n::gi()->form_fileBrowser_headline ?>">
    <table id="catMatch">
        <tbody>
        <tr>
            <td id="ebayCats" class="catView">
                <div class="catView">
                    <!-- placeholder for Content -->
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <div id="messageDialog" class="dialog2"></div>
    <span class="small"><?php echo MLI18n::gi()->form_fileBrowser_information ?></span>
</div>

<script type="text/javascript">
    (function ($) {
        function initiateDirectories() {
            $('#fileBrowser_<?php echo $aField['id']; ?> span.toggle').off('click').on('click', function () {
                var oDir = $(this);
                if (oDir.hasClass('minus')) {
                    oDir.removeClass('minus').addClass('plus');
                    oDir.parent().find('.catelem').each(function () {
                        var toggle = $(this).find('span.toggle');
                        if (toggle.hasClass('tick')) {
                        } else {
                            $(this).remove();
                        }
                    })
                    return;
                }

                // when directory got selected
                if (oDir.hasClass('leaf')) {
                    $('#fileBrowser_<?php echo $aField['id']; ?>').find('span.toggle.tick').removeClass('tick');
                    oDir.addClass('tick');
                    return;
                }

                $.blockUI(blockUILoading);
                var url = '<?php echo MLHttp::gi()->getCurrentUrl(array(
                    'method'     => 'GetDirectories',
                    'blAjax'     => true,
                    'path'       => "{{current_path}}",
                    'configPath' => "{{config_path}}",
                )) ?>';

                $.ajax({
                    'method': 'get',
                    'url': url
                        .replace('{{current_path}}', $(this).data('path'))
                        .replace('{{config_path}}', $('#fileBrowser_<?php echo $aField['id']; ?>').find('span.toggle.tick').data('path')),

                    'success': function (data) {
                        $.unblockUI();
                        if (data == 'error') {

                        } else if (data == 'leaf') {
                            oDir.removeClass('plus').addClass('leaf');
                        } else {
                            oDir.removeClass('plus').addClass('minus');
                            oDir.parent().find('span[class="catname"]').first().append(data);
                            initiateDirectories();
                        }
                    }
                });
            });
        }

        $(document).ready(function () {
            $('#fileBrowserButton_<?php echo $aField['id']; ?>').on('click', function () {
                if ($(this).hasClass('disabled')) {
                    return;
                }
                var oFileBrowser = $('#fileBrowser_<?php echo $aField['id']; ?>'),
                    oFileBrowserButton = $(this);
                $.blockUI(blockUILoading);

                //empty filebrowser
                oFileBrowser.find('div.catView').html('');

                var url = '<?php echo MLHttp::gi()->getCurrentUrl(array(
                    'method'     => 'GetConfiguredBasePath',
                    'blAjax'     => true,
                    'configPath' => "{{config_path}}",
                )) ?>';

                $.ajax({
                    'method': 'get',
                    'url': url
                        .replace('{{config_path}}', oFileBrowserButton.parent().find('input[type="text"]').val()),
                    'success': function (data) {
                        $.unblockUI();
                        if (data == 'error') {
                        } else {
                            oFileBrowser.find('div.catView').append(data);
                            initiateDirectories();
                        }
                    }
                });

                oFileBrowser.jDialog({
                    width: '75%',
                    minWidth: '300px',
                    buttons: {
                <?php echo json_encode(MLI18n::gi()->ML_BUTTON_LABEL_ABORT); ?>:

                function () {
                    $(this).dialog('close');
                }

            ,
                <?php echo json_encode(MLI18n::gi()->ML_BUTTON_LABEL_OK); ?>:

                function () {
                    var path = $('#fileBrowser_<?php echo $aField['id']; ?>').find('span.toggle.tick').data('path');
                    if (path != false) {
                        oFileBrowserButton.parent().find('input[type="text"]').val(path);
                        $(this).dialog('close');
                    }
                }
            },
                open: function (event, ui) {
                    var tbar = $('#ebayCategorySelector').parent().find('.ui-dialog-titlebar');
                    if (tbar.find('.ui-icon-arrowrefresh-1-n').length == 0) {
                        var rlBtn = $(
                            '<a class="ui-dialog-titlebar-close ui-corner-all ui-state-focus ml-js-noBlockUi" ' +
                            'role="button" href="#" style="right: 2em; padding: 0px;">' +
                            '<span class="ui-icon ui-icon-arrowrefresh-1-n">reload</span>' +
                            '</a>'
                        );
                        tbar.append(rlBtn);
                        rlBtn.click(function (event) {
                            event.preventDefault();
                            initEBayCategories(true);
                        });
                    }
                }
            })
                ;
            });
        });
    })(jqml);
</script>
