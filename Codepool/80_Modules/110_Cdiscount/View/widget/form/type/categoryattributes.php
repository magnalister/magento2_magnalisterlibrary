<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<table class="categoryAttributes" style="width:100%;">
</table>
<script type="text/javascript">
    (function ($) {
        $(document).ready(function () {
            $('.categoryAttributes').closest('.js-field.even').hide();
            var url = $('form.magnalisterForm').attr('action').replace(/^https?:/, window.location.protocol);
            var catID = $('#cdiscount_prepare_apply_form_field_primarycategory').val();
            var itemID = '<?php echo isset($aField['productid']) ? $aField['productid'] : '' ?>';

            if (catID) {              
                 $.ajax({
                    url: url + '&ml[method]=getCategoryAttributes&ml[ajax]=true&ml[categoryid]=' + catID + '&ml[itemid]=' + itemID,
                    type: 'GET',
                    dataType: 'html',
                    success: function(data) {
                        if (typeof JSON.parse(data).Data != 'undefined') {
                            $('.categoryAttributes').closest('.js-field.even').show();
                            $('.categoryAttributes').html(JSON.parse(data).Data);
                        }
                    }
                });
            }
		});
        
        $('#cdiscount_prepare_apply_form_field_primarycategory').change(function() {
            $('.categoryAttributes').closest('.js-field.even').hide();
            var url = $('form.magnalisterForm').attr('action').replace(/^https?:/, window.location.protocol);
            var catID = $('#cdiscount_prepare_apply_form_field_primarycategory').val();
            var itemID = '<?php echo isset($aField['productid']) ? $aField['productid'] : '' ?>';

            $.ajax({
                url: url + '&ml[method]=getCategoryAttributes&ml[ajax]=true&ml[categoryid]=' + catID + '&ml[itemid]=' + itemID,
                type: 'GET',
                dataType: 'html',
                success: function(data) {
                    if (typeof JSON.parse(data).Data != 'undefined') {
                        $('.categoryAttributes').closest('.js-field.even').show();
                        $('.categoryAttributes').html(JSON.parse(data).Data); 
                    }
                }
            });
        });

        $('.categoryAttributes').on('click', '.mlbtn.fullfont.plus', (function(e) {
            if (e.target) {
                var className = $('#' + e.target.id).closest('tr').attr('class');
                var thTitle = $('#' + e.target.id + '_th').html();
                var mandatory = $('input[type="hidden"]#' + e.target.id).val();
                $('#' + e.target.id + '.mlbtn.fullfont.plus').prop('disabled', true);
                addRow(className, thTitle, e.target.id, mandatory);
            }
        }));

        $('.categoryAttributes').on('click', '.mlbtn.fullfont.minus', (function(e) {
            if (e.target) {
                var elementId = newElementId(e.target.id, false);
                $('#' + e.target.id).closest('tr').remove();
                $('input[id*=' + elementId + '][type="button"].mlbtn.fullfont.plus').last().prop('disabled', false);
            }
        }));

        function addRow(className, thTitle, elementId, mandatory) {
            if (className === 'even') {
                className = 'odd';
            } else {
                className = 'even';
            }

            var nextElementId = newElementId(elementId, true);
            var idForClass = newElementId(elementId, false);

            var row =	'<tr class="' + className + '">\n\
                            <th id="' + nextElementId + '_th">' + thTitle + '</th>\n\
                            <td class="input">\n\
                                <input type="text" class="fullwidth" name="ml[field][catAttributes][' + idForClass + '][values][]" id="' + nextElementId + '">\n\
                            </td>\n\
                            <td style="width: 90px">\n\
                                <input id="' + nextElementId + '" type="button" value="+" class="mlbtn fullfont plus"/>\n\
                                <input id="' + nextElementId + '" type="button" value="-" class="mlbtn fullfont minus"/>\n\
                            </td>\n\\n\
                            <input id="' + nextElementId + '" type="hidden" name="ml[field][catAttributes][' + idForClass + '][required]" value="' + mandatory + '"/>\n\
                        </tr>';
            $('#' + elementId).closest('tr').after(row);
        }

        function newElementId(elementId, next) {
            var n = elementId.lastIndexOf('_');
            if (next === true)  {
                var result = parseInt(elementId.substring(n + 1));
                result = result + 1;
                var nextElementId = elementId.substring(0, n) + '_' + result;
                return nextElementId;
            } else {
                return elementId.substring(0, n);
            }						
        }
	})(jqml);
</script>