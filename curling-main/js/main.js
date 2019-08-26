jQuery(document).ready(function($) {
    $('.nav-menu-primary .menu-item').each((index, element) => {
        const $this = $(element);
        const menu_name = $this.data('menu');
        const $popup = $(`.nav-menu-popup[data-name='${menu_name}']`);
        const $multi = $this.add(`.nav-menu-popup[data-name='${menu_name}']`);
        $multi.mouseenter(() => {
            $this.addClass('active');
            $popup.addClass('active');
        }).mouseleave(() => {
            $this.removeClass('active');
            $popup.removeClass('active');
        });
    });

    $('.menu-item-mobile').each((index, element) => {
        const $this = $(element);
        $this.children('.menu-item-container-mobile').click((event) => {
            const $target = $(event.currentTarget);
            if ($this) {
                const id = $target.data('id');
                if (id) {
                    switchMenu(id, $this);
                } else {
                    $this.toggleClass('active');
                }
            }
        });
    });

    $('.header-mobile').each((index, element) => {
        const $this = $(element);
        $this.find('.menu-hamburger-mobile').click((event) => {
            if ($this) {
                $this.toggleClass('active');
                if ($this.hasClass('active')) {
                    resetMenuMobile(true);   
                }
            }
        });
    });

    $('.menu-nav-popout-item').each((index, element) => {
        const $this = $(element);
        const parent = $this.data('parent');
        $this.find('.nav-menu-top-right-mobile').click((event) => {
            console.log(parent);
            if (parent !== undefined && parent !== null && parent >= 0) {
                switchMenu(parent, $this);
            }
        });
    });

    function resetMenuMobile(fromMainMenu) {
        $('.nav-menu-popout-mobile .menu-nav-popout-item').removeClass('active');
        if (fromMainMenu) {
            $('.nav-menu-popout-mobile .menu-nav-popout-item[data-id="0"]').addClass('active');
        }
    }

    function resetMenuItemsMobile($currentItem) {
        $currentItem.find('.menu-item-mobile').removeClass('active');
    }

    function switchMenu(id, $currentItem) {
        resetMenuMobile();
        if ($currentItem) {
            resetMenuItemsMobile($currentItem);
        }
        const $activeMenu = $('.nav-menu-popout-mobile .menu-nav-popout-item[data-id="' + id + '"]');
        if ($activeMenu.length > 0) {
            $activeMenu.addClass('active');
        } else {
            $('.header-mobile').removeClass('active');
        }

    }
});
