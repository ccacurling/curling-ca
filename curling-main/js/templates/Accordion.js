jQuery(document).ready(function($) {
  jQuery.fn.accordion = function(options) {
    return this.each(function() {
        var $this = jQuery(this),
            data = $this.data('curling.accordion');

        if (!data && !$this.hasClass('js-accordion-init')) {
            data = new Accordion($this, typeof options == 'object' && options);
            $this.addClass('js-accordion-init');
            $this.data('curling.accordion', data);
        }
    });
  }


  class Accordion {
    constructor(element, options) {
      this.accordion = element;
      this.trigger = this.accordion.find('.js-accordion-trigger');
      this.content = this.accordion.find('.js-accordion-content');

      if (this.trigger) {
        this.trigger.click(() => {
          this.accordion.toggleClass('active');
        })
      }
    }
  }
  
  jQuery.fn.accordion.Constructor = Accordion;
});