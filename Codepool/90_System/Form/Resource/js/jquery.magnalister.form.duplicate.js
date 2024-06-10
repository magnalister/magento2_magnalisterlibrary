(function($) {
    $(document).ready(function() {
        $('.magnalisterForm').on('click', '.duplicate>div>span button', function(event) {
            var sData = $(this).attr('data-ajax-additional');
            var parsedSData = JSON.parse(sData);
            // we count the rows based on given duplicate div id
            // this count is needed during the adding or removing of the rows
            // this was implemented 15.09.2021 because the count of the rows was wrong
            // and the adding and removing process did not work
            parsedSData.numOfRows = $("#"+ parsedSData.divId +" > div").length;
            $(this).trigger({
                type: "duplicate",
                ajaxAdditional: JSON.stringify(parsedSData)
            });
        });
        $('.magnalisterForm').on('change', '.duplicate input[type="radio"].ml-js-form-duplicate-radiogroup', function(event) {
            var eContainer = $(this).parentsUntil('.duplicate').parent();
            var eRadios = eContainer.find('input[type="radio"].ml-js-form-duplicate-radiogroup');
            console.log(eRadios.length);
            var eRadio = eRadios.filter(':checked');
            if (eRadio.length === 1) {
                eContainer.find('input[type!="radio"].ml-js-form-duplicate-radiogroup').val('');
                eRadio.siblings('input[type!="radio"].ml-js-form-duplicate-radiogroup').val(eRadio.val());
            } else if (eRadios.length !== 0) {
                eRadios.removeAttr('checked');
                eRadios.first().prop('checked', true).trigger('change');
            }
        });
        $('.magnalisterForm .duplicate input[type="radio"].ml-js-form-duplicate-radiogroup').trigger('change');
    });
})(jqml);