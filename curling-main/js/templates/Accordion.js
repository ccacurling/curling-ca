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
      this.id = element.data('id');
      this.trigger = this.accordion.find(`.js-accordion-trigger[data-id="${this.id}"]`);
      this.content = this.accordion.children(`.js-accordion-content[data-id="${this.id}"]`);

      if (this.trigger) {
        this.trigger.click(() => {
          this.accordion.toggleClass('active');

          const $text = this.trigger.find(`.js-accordion-trigger-text[data-id="${this.id}"]`);
          
          if ($text) {
            const show = $text.data('trigger-show');
            const hide = $text.data('trigger-hide');
            if (this.accordion.hasClass('active') && hide) {
              $text.text(hide);
            } else if (!this.accordion.hasClass('active') && show) {
              $text.text(show);
            }
          }
        })
      }
    }
  }
  
  jQuery.fn.accordion.Constructor = Accordion;
});