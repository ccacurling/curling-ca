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
});