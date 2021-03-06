jQuery(document).ready(function($) {
  jQuery.fn.curlingNavMobile = function(options) {
    return this.each(function() {
        var $this = jQuery(this),
            data = $this.data('curling.mobilenav');

        if (!data && !$this.hasClass('js-curling-mobilenav-init')) {
            data = new CurlingNavMobile($this, typeof options == 'object' && options);
            $this.addClass('js-curling-mobilenav-init');
            $this.data('curling.mobilenav', data);
        }
    });
  }


  class CurlingNavMobile {
    constructor(element, options) {
      this.element = element;
      this.topMenu = this.element.find('.js-cta-topmenu-mobile');
      this.hamburger = this.element.find('.js-cta-menu-mobile-hamburger');

      this.menuLists = this.element.find('.js-cta-menu-list-mobile');
      this.popouts = this.element.find('.js-cta-popout-mobile')
      this.navTitle = this.element.find('.js-nav-title-mobile');

      if (this.navTitle) {
        this.navTitle.click(() => {
          this.topMenu.toggleClass('active');
          if (this.topMenu.hasClass('active')) {
            this.hidePopupsMobile();
            this.showPopupMobile(0);
          } else {
            this.hidePopupsMobile();
          }
        });
      }

      this.hamburger.click(() => {
        this.topMenu.toggleClass('active');
        if (this.topMenu.hasClass('active')) {
          this.hidePopupsMobile();
          this.showPopupMobile(0);
        } else {
          this.hidePopupsMobile();
        }
      });

      this.menuLists.each((index, element) => {
          const $this = $(element);
          $this.find('.js-cta-menu-item-mobile').click(() => {
            const link = $this.data('link');
            if ($this.hasClass('active')) {
              if (link) {
                window.location = link;
              }
            } else {
              this.hideMenusMobile();
              $this.toggleClass('active');
              $this.attr("aria-expanded", "true");
            }
          })
      });

      this.menuLists.each((index, element) => {
        const $this = $(element);
        $this.find('.js-cta-menu-subitem-mobile').click((e) => {
          const $target = $(e.currentTarget);
          const id = $target.data('id');
          this.hidePopupsMobile();
          if (!this.showPopupMobile(id)) {
            this.topMenu.removeClass('active');
          }
        })
      });

      this.popouts.each((index, element) => {
        const $this = $(element);
        $this.find('.js-cta-subnav-back').click((e) => {
            const $target = $(e.currentTarget);
            const id = $this.data('parent');
            this.hidePopupsMobile();
            this.showPopupMobile(id);
        })
      });
    }

    showPopupMobile(id) {
      const popups = this.element.find('.js-cta-popout-mobile[data-id="' + id + '"]');
      if (popups.length > 0) {
        popups.addClass('active');
        popups.attr("aria-expanded", "true");
        return true;
      } else {
        return false;
      }
    }
  
    hidePopupsMobile() {
      $('.js-cta-popout-mobile').each((index, element) => {
          const $this = $(element);
          $this.removeClass('active');
          $this.attr("aria-expanded", "false");
      });
    }

    hideMenusMobile() {
      $('.js-cta-menu-list-mobile').each((index, element) => {
        const $this = $(element);
        $this.removeClass('active');
        $this.attr("aria-expanded", "false");
      });
    }
  }
  
  jQuery.fn.curlingNavMobile.Constructor = CurlingNavMobile;
});
