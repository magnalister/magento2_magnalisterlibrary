(function ($) {
    $(document).ready(function () {
        const tabsBox = document.querySelector(".ml-tabs-box");
        let marketplaceDiv = document.querySelector('.ml-wrapper');
        let staticTabsDiv = document.querySelector('#ml-static-tabs')
        let tabLine = document.querySelector('.ml-tabLine');
        let lastScrollTop = 0;
        let previousWindowWidth = window.innerWidth;
        const icons = document.querySelectorAll('.ml-icon');
        const tab = document.querySelector('.ml-tabs-box');

        icons.forEach(icon => {
            icon.addEventListener('click', () => {
                tab.style = "";
                tab.scrollLeft += icon.firstElementChild.classList.contains('ml-arrow-slider-right') ? 150 : -150;
            })
        });

        tab.addEventListener('scroll', (e)=>{
            magnalisterUpdateIcons(e.target.scrollLeft);
        })

        function magnalisterScrollSelectedTabToView() {

            const selected = document.querySelector(".ml-wrapper li.selected");

            if (selected !== null && selected.getBoundingClientRect().bottom > 0) {
                selected.scrollIntoView({behavior: 'instant', block: 'center', inline: 'center'});
            }
            magnalisterCheckSelectedElementInContainer('scrollInView');
        }

        function magnalisterCheckSelectedElementInContainer(movementType) {
            const container = document.querySelector('.ml-wrapper');
            const selectedElement = document.querySelector('.ml-wrapper li.selected a');

            compensateScroll = 0;
            if (movementType === 'scrollLeft') {
                compensateScroll = 150;
            } else if (movementType === 'scrollRight') {
                compensateScroll = -150;
            }

            if (selectedElement) {
                let scrollVal = Math.round(tabsBox.scrollLeft);
                const selectedElementRect = selectedElement.getBoundingClientRect();
                const containerRect = container.getBoundingClientRect();
                let isFirstArrow = 38;
                if (icons[0].classList.contains('ml-hide')) {
                    isFirstArrow = 0;
                }
                let isLastArrow = 0;
                if (!icons[1].classList.contains('ml-hide')) {
                    isLastArrow = 40;
                }
                const insideContainerHorizontally = (selectedElementRect.left >= containerRect.left + isFirstArrow) && (selectedElementRect.right <= containerRect.right - isLastArrow);
                if (insideContainerHorizontally) {
                    selectedElement.style.top = '-9px';
                    selectedElement.style.paddingBottom = '19px';
                } else if (scrollVal > 0 || (scrollVal === 0)) {

                    selectedElement.style.top = '0px';
                    selectedElement.style.paddingBottom = '10px';
                }
            }
        }

        let tableWrap = document.querySelector('#tableWrap');
        let tableWrapPaddingLeft = getComputedStyle(tableWrap).paddingLeft;

        function magnalisterHandleWindowResize() {
            let currentWindowWidth = window.innerWidth;
            let changedWindowWidth = previousWindowWidth - currentWindowWidth;
            let currentTableWrap = document.querySelector('#tableWrap');
            let liWidthAllTabs = 0;
            let liTabs =document.querySelectorAll('.ml-wrapper .ml-tabs-box li');

            for (let i=0; i<liTabs.length; i++) {
                liWidthAllTabs +=  liTabs[i].offsetWidth + 3;
            }

            currentTableWrapPaddingLeft = getComputedStyle(currentTableWrap).paddingLeft;

            let padding = 0;
            if ( parseInt(currentTableWrapPaddingLeft) > parseInt(tableWrapPaddingLeft)) {
                padding = (parseInt(currentTableWrapPaddingLeft) - parseInt(tableWrapPaddingLeft)) * 2;
            } else {
                padding = 0;
            }

            tableWrapPaddingLeft = currentTableWrapPaddingLeft;
            let width;
            if (currentWindowWidth < previousWindowWidth) {
                if(marketplaceDiv.offsetWidth+staticTabsDiv.offsetWidth === tabLine.offsetWidth) {
                    width = marketplaceDiv.offsetWidth - 3 - changedWindowWidth;
                    marketplaceDiv.style.width = width + 'px';
                }
            } else {
                if ((liWidthAllTabs > marketplaceDiv.offsetWidth && currentWindowWidth >800)) {
                    width = marketplaceDiv.offsetWidth - 3 - changedWindowWidth - padding;
                    if (width > liWidthAllTabs) {
                        width = liWidthAllTabs;
                    }
                }
                marketplaceDiv.style.width = width + 'px';

            }

            previousWindowWidth = currentWindowWidth;

            magnalisterScrollSelectedTabToView();
        }

        function magnalisterHandleWindowLoad() {
            let currentWindowWidth = window.innerWidth;
            let prestashop = document.querySelector('.prestashop');
            let woocommerce = document.querySelector('.woocommerce');
            reduceWidth = 0;
            let liWidthAllTabs = 0;

            liTabs =document.querySelectorAll('.ml-wrapper .ml-tabs-box li');

            for (let i=0; i<liTabs.length; i++) {
                liWidthAllTabs +=  liTabs[i].offsetWidth + 3;
            }

            if (prestashop) {
                reduceWidth = document.querySelector('.main-menu').offsetWidth;
                currentWindowWidth -= reduceWidth;
            }
            if (woocommerce) {
                reduceWidth = document.querySelector('#adminmenu').offsetWidth - 20;
                currentWindowWidth -= reduceWidth;
            }

            tableWrapPaddingLeft = document.querySelector('#tableWrap').style.paddingLeft;

            if (currentWindowWidth-2+parseInt(tableWrapPaddingLeft) < marketplaceDiv.offsetWidth + staticTabsDiv.offsetWidth) {
                width = marketplaceDiv.offsetWidth - (marketplaceDiv.offsetWidth+staticTabsDiv.offsetWidth-currentWindowWidth) - 150;

                marketplaceDiv.style.width = (width-3) + 'px';
            }

            if ((marketplaceDiv.offsetWidth + staticTabsDiv.offsetWidth < tabLine.clientWidth) && (marketplaceDiv.offsetWidth < liWidthAllTabs)) {
                width = tabLine.clientWidth-staticTabsDiv.offsetWidth;
                if (width > liWidthAllTabs) {
                    width = liWidthAllTabs+3;
                }
                marketplaceDiv.style.width = (width-3) + 'px';
            }

            if (liWidthAllTabs <= marketplaceDiv.offsetWidth) {
                icons[1].classList.add('ml-hide')
                marketplaceDiv.style.paddingRight = '0';
            } else {
                icons[1].classList.remove('ml-hide')
                marketplaceDiv.style.paddingRight = '3px';
            }

            magnalisterScrollSelectedTabToView();
        }

        function magnalisterUpdateIcons(scrolled_width) {
            const clientWidth = marketplaceDiv.offsetWidth;
            icons[0].classList.toggle('ml-hide', scrolled_width <= 1);
            let liTabs =document.querySelectorAll('.ml-wrapper .ml-tabs-box li');
            liWidthAllTabs = 0;
            for (let i=0; i<liTabs.length; i++) {
                liWidthAllTabs +=  liTabs[i].offsetWidth + 3;
            }
            icons[1].classList.toggle('ml-hide', (liWidthAllTabs) - (clientWidth + scrolled_width) <= 1);
            magnalisterCheckSelectedElementInContainer();
        }

        window.addEventListener('resize', magnalisterHandleWindowResize);
        window.addEventListener('load', magnalisterHandleWindowLoad);
    })
})(jqml);


