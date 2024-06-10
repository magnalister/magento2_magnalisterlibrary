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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

(function($) {
    function checkVCSOption(optionCase) {
        var select = jqml('.magnalisterForm #amazon_config_vcs_field_amazonvcs_invoice');
        var selectedOption = '';

        select.children('option').each(function() {
            // in case of select vcs
            if (optionCase == 'vcs') {
                if (this.value != 'off' && this.value != '') {
                    jqml(this).prop('disabled', true);
                } else {
                    jqml(this).prop('disabled', false);
                }
            }
            // in case of select vcs-lite
            if (optionCase == 'vcs-lite') {
                if (this.value == 'off') {
                    jqml(this).prop('disabled', true);
                } else {
                    jqml(this).prop('disabled', false);
                }
            }
            if (optionCase == 'off') {
                if (this.value == 'magna') {
                    jqml(this).prop('disabled', true);
                } else {
                    jqml(this).prop('disabled', false);
                }
            }

            if (jqml(this).prop('selected') && !jqml(this).prop('disabled')) {
                selectedOption = this.value;
            }
        });

        // select the preselected value or set to "please choose"
        select.val(selectedOption);
    }

    function enableVCSInvoiceGeneration(enable, cls) {
        jqml(cls).find('input, select, textarea').prop('disabled', !enable);
    }

    function checkVCSInvoiceNumberOption(optionCase) {
        if(optionCase === 'magnalister') {
            jqml(".magnalisterForm #amazon_config_vcs_field_amazonvcsinvoice_invoiceprefix").closest('tr').show();
            jqml(".magnalisterForm #amazon_config_vcs_field_amazonvcsinvoice_invoicenumber_matching").closest('tr').hide();
        } else {
            jqml(".magnalisterForm #amazon_config_vcs_field_amazonvcsinvoice_invoiceprefix").closest('tr').hide();
            jqml(".magnalisterForm #amazon_config_vcs_field_amazonvcsinvoice_invoicenumber_matching").closest('tr').show();
        }
    }

    function checkVCSReversalInvoiceNumberOption(optionCase) {
        if(optionCase === 'magnalister') {
            jqml(".magnalisterForm #amazon_config_vcs_field_amazonvcsinvoice_reversalinvoiceprefix").closest('tr').show();
            jqml(".magnalisterForm #amazon_config_vcs_field_amazonvcsinvoice_reversalinvoicenumber_matching").closest('tr').hide();
        } else {
            jqml(".magnalisterForm #amazon_config_vcs_field_amazonvcsinvoice_reversalinvoiceprefix").closest('tr').hide();
            jqml(".magnalisterForm #amazon_config_vcs_field_amazonvcsinvoice_reversalinvoicenumber_matching").closest('tr').show();
        }
    }

    function changeFbaOptionsStatus (status) {
        $("#amazon_config_orderimport_field_orderstatus_fba").prop("disabled", status);
        $("#amazon_config_orderimport_field_orderimport_fbashippingmethod").prop("disabled", status);
        $("#amazon_config_orderimport_field_orderimport_fbapaymentmethod").prop("disabled", status);
    }

    function disableGetTokenButton (status) {
        $("#requestToken").prop("disabled", status);
    }

    jqml(document).ready(function() {

        var siteField = $("#amazon_config_account_field_site");

        if (siteField.val() === "0"){
            disableGetTokenButton(true)
        }

        siteField.change(function() {
            if ($("#amazon_config_account_field_site").val() === "0"){
                disableGetTokenButton(true)
            } else {
                disableGetTokenButton(false)
            }
        });

        var invoiceDiv = jqml(".magnalisterForm #amazon_config_vcs_fieldset_amazonvcsinvoice");
        var invoiceOption = jqml('.magnalisterForm #amazon_config_vcs_field_amazonvcs_invoice');

        if (invoiceOption.val() != 'magna') {
            enableVCSInvoiceGeneration(false, invoiceDiv);
        }

        invoiceOption.on('change', function() {
            if (this.value == 'magna') {
                enableVCSInvoiceGeneration(true, invoiceDiv);
            } else {
                enableVCSInvoiceGeneration(false, invoiceDiv);
            }
        });

        var vcsOption = jqml(".magnalisterForm #amazon_config_vcs_field_amazonvcs_option");
        checkVCSOption(vcsOption.val());

        vcsOption.on('change', function() {
            checkVCSOption(vcsOption.val());
            invoiceOption.trigger('change');
        });

        var vcsInvoiceNumberOption = jqml(".magnalisterForm #amazon_config_vcs_field_amazonvcsinvoice_invoicenumberoption");
        if(vcsInvoiceNumberOption.length > 0) {
            checkVCSInvoiceNumberOption(vcsInvoiceNumberOption.val());
            vcsInvoiceNumberOption.on('change', function () {
                checkVCSInvoiceNumberOption(vcsInvoiceNumberOption.val());

            });
        }
        var vcsReversalInvoiceNumberOption = jqml(".magnalisterForm #amazon_config_vcs_field_amazonvcsinvoice_reversalinvoicenumberoption");
        if(vcsReversalInvoiceNumberOption.length > 0) {
            checkVCSReversalInvoiceNumberOption(vcsReversalInvoiceNumberOption.val());
            vcsReversalInvoiceNumberOption.on('change', function () {
                checkVCSReversalInvoiceNumberOption(vcsReversalInvoiceNumberOption.val());
            });
        }

        var dontImportFbaOrders = jqml("#amazon_config_orderimport_field_orderimport_fbablockimport");
        if (typeof dontImportFbaOrders[0] !== 'undefined') {
            if (dontImportFbaOrders[0].checked) {
                changeFbaOptionsStatus(true);
            } else {
                changeFbaOptionsStatus(false);
            }
        }
        $("#amazon_config_orderimport_field_orderimport_fbablockimport").change(function () {
            if (this.checked) {
                changeFbaOptionsStatus(true);
            } else {
                changeFbaOptionsStatus(false);
            }
        })
    });
})(jqml);
