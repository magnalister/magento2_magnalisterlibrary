<?php
if (!class_exists('ML', false))
    throw new Exception();
    $aField['value'] = (isset($aField['value']) && is_array($aField['value'])) ? $aField['value'] : array();

    if (!isset($aField['cssclass'])) {
        $aField['cssclass'] = array();
    }

    if (!empty($aField['classes']) && is_array($aField['classes'])) {
        // in most cases it's a string so convert to array for merging below
        if (is_string($aField['cssclass'])) {
            $aField['cssclass'] = array($aField['cssclass']);
        }
        $aField['cssclass'] = array_merge($aField['cssclass'], $aField['classes']);
    }

$aField['multiple'] = true;
$aField['type'] = 'select';
$this->includeType($aField);

if (isset($aField['limit'])) { ?>
    <script type="text/javascript">
        (function ($) {
            $(document).ready(function () {
                var last_valid_selection = null;
                $('select[name="<?php echo MLHTTP::gi()->parseFormFieldName($aField['name']);?>[]"]').change(function (event) {
                    var selectValue = $(this).val();
                    if (typeof (selectValue) != "undefined" && selectValue !== null &&
                        selectValue.length > <?php echo $aField['limit']?>) {
                    $(this).val(last_valid_selection);
                } else {
                    last_valid_selection = $(this).val();
                }
            });
        });
    })(jqml);
</script>
<?php
}
?>

