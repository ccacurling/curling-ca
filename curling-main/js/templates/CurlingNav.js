jQuery(document).ready(function($) {
  jQuery.fn.curlingNav = function(options) {
    return this.each(function() {
        var $this = jQuery(this),
            data = $this.data('curling.nav');

        if (!data && !$this.hasClass('js-curling-nav-init')) {
            data = new CurlingNav($this, typeof options == 'object' && options);
            $this.addClass('js-curling-nav-init');
            $this.data('curling.nav', data);
        }
    });
  }


  class CurlingNav {
    constructor(element, options) {
      this.element = element;
      this.menuItems = this.element.find('.nav-menu-primary .menu-item');

      this.menuItems.each((index, element) => {
        const $this = $(element);
        const menu_name = $this.data('menu');

        const $popup = $(`.nav-menu-popup[data-name='${menu_name}']`);
        const $multi = $this.add(`.nav-menu-popup[data-name='${menu_name}']`);
        $multi.mouseenter(() => {
            $this.addClass('active');
            $popup.addClass('active');
            $popup.attr("aria-expanded", "true");
        }).mouseleave(() => {
            $this.removeClass('active');
            $popup.removeClass('active');
            $popup.attr("aria-expanded", "false");
        });
      });
    }
  }
  
  jQuery.fn.curlingNav.Constructor = CurlingNav;
});