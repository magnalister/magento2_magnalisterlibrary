(function($) {
    $(document).ready(function() {
        $('div.magna').on('click', '.keyvaluelist .btn-add', function() {
            var list = $(this).parents('.keyvaluelist');
            $(this).parents('tr').first().after(getTemplate(list));
            reorder(list);
        });

        $('div.magna').on('click', '.keyvaluelist .btn-remove', function() {
            var list = $(this).parents('.keyvaluelist');
            $(this).parents('tr').first().remove();
            if (list.find('tr').length === 2) {
                // if only header and hidden template row exist
                list.find('tr').first().after(getTemplate(list));
            }

            reorder(list);
        });
        
        function getTemplate(list) {
            var template = list.find('.template').clone(true, true);
            template.show();
            template.removeClass('template');
            return template;
        }

        function reorder(list) {
            var name = list.attr('data-name'),
                keys = list.find('tr'),
                i, inputs, row;
            for(i = 0; i < keys.length - 1; i += 1) {
                // skip header row
                row = $(keys.get(i + 1));
                inputs = row.find('input');
                if (inputs.length > 0) {
                    inputs[0].name = 'ml[field][' + name + '][' + i + '][key]';
                    inputs[1].name = 'ml[field][' + name + '][' + i + '][value]';
                }
            }
        }
    });
})(jqml);