<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<table class="categoryAttributes" style="width:100%;">
</table>
<script type="text/javascript">
    (function ($) {
        $(document).ready(function () {
            $('.categoryAttributes').closest('.js-field.even').hide();
            var url = $('form.magnalisterForm').attr('action').replace(/^https?:/, window.location.protocol);
            var catID = $('#priceminister_prepare_apply_form_field_primarycategory').val();
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
        
        $('#priceminister_prepare_apply_form_field_primarycategory').change(function() {
            $('.categoryAttributes').closest('.js-field.even').hide();
            var url = $('form.magnalisterForm').attr('action').replace(/^https?:/, window.location.protocol);
            var catID = $('#priceminister_prepare_apply_form_field_primarycategory').val();
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
                var attributeName = newElementId(e.target.id, false, false);
                var className = $('#' + e.target.id).closest('tr').attr('class');
                var thTitle = $('#' + e.target.id + '_th').html();
                $('#' + e.target.id + '.mlbtn.fullfont.plus')[0].disabled = 'true';

                if (attributeName === 'additional_categories') {
                    addAdditionalCategoriesRow(className, thTitle, e.target.id);
                } else {
                    var mandatory = $('input[type="hidden"]#' + e.target.id).val();
                    addRow(className, thTitle, e.target.id, mandatory);
                }
            }
        }));

        $('.categoryAttributes').on('click', '.mlbtn.fullfont.minus', (function(e) {
            if (e.target) {
                var elementId = newElementId(e.target.id, false, false);
                if (elementId === 'additional_categories') {
                    var className = $('#' + e.target.id).closest('tr').attr('class');
                    $('#' + e.target.id).parents('tr .' + className).remove();
                } else {
                    $('#' + e.target.id).closest('tr').remove();
                }
                $('input[id*=' + elementId + '][type="button"].mlbtn.fullfont.plus').last()[0].style.display = 'inline-block';
            }
        }));

        function addRow(className, thTitle, elementId, mandatory) {
            var url = $('form.magnalisterForm').attr('action').replace(/^https?:/, window.location.protocol);
            if (className === 'even') {
                className = 'odd';
            } else {
                className = 'even';
            }

            var idForClass = newElementId(elementId, false, false);
            var key = newElementId(elementId, false, true);

            $.ajax({
                url: url + '&ml[method]=getCategoryAttribute&ml[ajax]=true&ml[class]=' + className + '&ml[title]=' + thTitle + '&ml[name]='
                            + idForClass + '&ml[key]=' + key + '&ml[mandatory]=' + mandatory,
                type: 'GET',
                dataType: 'html',
                success: function(data) {
                    if (typeof JSON.parse(data).Data != 'undefined') {
                        var html = JSON.parse(data).Data;
                        $('#' + elementId).closest('tr').after(html);
                    }
                }
            });
        }
        
        function addAdditionalCategoriesRow(className, thTitle, elementId) {
            var url = $('form.magnalisterForm').attr('action').replace(/^https?:/, window.location.protocol);
            var idForClass = newElementId(elementId, false, false);
            var key = newElementId(elementId, false, true);
            var classSelector;
            if (className === 'even') {
                className = 'odd';
                classSelector = 'even';
            } else {
                className = 'even';
                classSelector = 'odd';
            }
            
            $.ajax({
                url: url + '&ml[method]=getCategoryAdditionalCategories&ml[ajax]=true&ml[className]=' + className + '&ml[thTitle]=' + thTitle + '&ml[elementId]=' + idForClass + '&ml[key]=' + key,
                type: 'GET',
                dataType: 'html',
                success: function(data) {
                    if (typeof JSON.parse(data).Data != 'undefined') {
                        var html = JSON.parse(data).Data;
                        $('#' + elementId).closest('tr').after(html);
                    }
                }
            });
        }
        
        function newElementId(elementId, next, key) {
            var n = elementId.lastIndexOf('_');
            var result = parseInt(elementId.substring(n + 1));
            result = result + 1;
            if (next === true)  {
                return elementId.substring(0, n) + '_' + result;
            } else if (key === true) {
                return result;
            }

            return elementId.substring(0, n);
        }
	})(jqml);
</script>