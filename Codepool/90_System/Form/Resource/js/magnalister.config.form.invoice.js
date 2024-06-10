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

(function ($) {
    jqml(document).ready(function () {
        var invoiceMagnalisterGenerator = jqml(".ml-magnalisterInvoiceGenerator");
        var invoiceERPGenerator = jqml(".ml-erpInvoice");
        var invoiceOption = jqml('.magnalisterForm .ml-uploadInvoiceOption');

        invoiceOption.on('change', function () {
            console.log(this.value);
            invoiceERPGenerator.hide();
            invoiceMagnalisterGenerator.hide();
            if (this.value === 'magna') {
                invoiceMagnalisterGenerator.show();
            } else if (this.value === 'erp') {
                invoiceERPGenerator.show();
            }
        });
        invoiceOption.change();

        let invoiceNumberOption = jqml('.magnalisterForm .ml-invoiceNumberOption');
        invoiceNumberOption.on('change', function () {
            var invoiceNumberPrefix = jqml(".ml-invoiceNumberPrefix").closest('tr');
            var invoiceNumberMatching = jqml(".ml-invoiceNumberMatching").closest('tr');
            invoiceNumberPrefix.hide();
            invoiceNumberMatching.hide();
            if (this.value === 'magnalister') {
                invoiceNumberPrefix.show();
            } else if (this.value === 'matching') {
                invoiceNumberMatching.show();
            }
        });
        invoiceNumberOption.change();
        let reversalInvoiceNumberOption = jqml('.magnalisterForm .ml-reversalInvoiceNumberOption');

        reversalInvoiceNumberOption.on('change', function () {
            var invoiceNumberPrefix = jqml(".ml-reversalInvoiceNumberPrefix").closest('tr');
            var invoiceNumberMatching = jqml(".ml-reversalInvoiceNumberMatching").closest('tr');
            invoiceNumberPrefix.hide();
            invoiceNumberMatching.hide();
            if (this.value === 'magnalister') {
                invoiceNumberPrefix.show();
            } else if (this.value === 'matching') {
                invoiceNumberMatching.show();
            }
        });
        reversalInvoiceNumberOption.change();
    });
})(jqml);
