<!-- HTML -->
        <div class="brand-pagination ml-js-noBlockUi">
            <a href="#" onclick="event.preventDefault(); showPage('1')" id="brand-page-first" class="brand-pagination-link ml-js-noBlockUi"><?php echo MLI18n::gi()->get('Productlist_Pagination_sFirstPage') ?></a>
            <?php $totalPages = ceil(count($aField['values']) / $paginationPerPage);
                $page = 1;
                while ($page <= $totalPages) { ?>
                    <a href="#" onclick="event.preventDefault(); showPage('<?php echo $page; ?>')" id="brand-page<?php echo $page; ?>"  class="brand-pagination-link ml-js-noBlockUi"><?php echo $page; ?></a>
                    <?php $page++;
                }
             ?>
            <a href="#" onclick="event.preventDefault(); showPage(<?php echo ceil(count($aField['values']) / $paginationPerPage); ?>)" id="brand-page-last" class="brand-pagination-link ml-js-noBlockUi"><?php echo MLI18n::gi()->get('Productlist_Pagination_sLastPage') ?></a>
        </div>
<!-- End HTML -->
<!-- Script -->
        <script>
            var show = document.getElementsByClassName('brand-page1');
            var currentPage = 1;
            for (var k = 0; k < show.length; k++) {
                show[k].style.display = 'table-row';
            }
            document.getElementById('brand-page1').setAttribute("disabled","disabled");
            document.getElementById('brand-page-first').setAttribute("disabled","disabled");

            function showPage(id) { 
                var totalNumberOfPages = <?php echo ceil(count($aField['values']) / $paginationPerPage); ?>;

                for (var i = 1; i < (totalNumberOfPages + 1); i++) {
                    var hide = document.getElementsByClassName('brand-page'+i);
                    document.getElementById('brand-page-first').removeAttribute("disabled");
                    document.getElementById('brand-page-last').removeAttribute("disabled");
                    document.getElementById('brand-page'+i).removeAttribute("disabled");
                    for (var j = 0; j < hide.length; j++) {
                        hide[j].style.display = 'none';
                    }
                }

                var show = document.getElementsByClassName('brand-page'+id);
                document.getElementById('brand-page'+id).setAttribute("disabled","disabled");
                if (id == 1) document.getElementById('brand-page-first').setAttribute("disabled","disabled");
                if (id == totalNumberOfPages) document.getElementById('brand-page-last').setAttribute("disabled","disabled");
                for (var k = 0; k < show.length; k++) {
                    show[k].style.display = 'table-row';
                }
            }
        </script>
<!-- End Script -->
<!-- Style -->
        <style>
            .brand-pagination {
                text-align: right;
                background: none repeat scroll 0 0 #F3F3F3;
                border-bottom: 1px solid #AAAAAA;
                border-top: 1px solid #AAAAAA;
                padding: 2px 5px;
                margin-bottom: 4px;
                margin-top: 4px;
            }

            .brand-pagination a {
                background: none;
                border: none;
                outline: none;
                cursor: pointer;
                color: gray; text-decoration: none; font-size: 13.33px; padding: 1px 6px;
            }

            .brand-pagination a[disabled] {
                color: inherit;
                cursor: inherit;
            }
        </style>
<!-- END Style -->
