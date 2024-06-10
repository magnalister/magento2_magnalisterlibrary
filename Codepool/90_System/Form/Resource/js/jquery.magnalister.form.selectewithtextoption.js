(function($) {
    $(document).ready(function() {
        $('.magnalisterForm').on('change', '.ml-selectwithtextoption select', function(event) {
            var eContainer = $(this).parents('.ml-selectwithtextoption');
            var eInput = eContainer.find("input[type='text']");
            var aShowInputValues = eContainer.attr('data-selectwithtextoption').split(' ');
            if ($.inArray($(this).val(), aShowInputValues) !== -1) {
                eInput.show('slide');
            } else {
                eInput.hide('slide');
            }            
        });
        $('.magnalisterForm .ml-selectwithtextoption select').trigger('change');
    });
})(jqml);