jQuery(document).ready(function($) {
  jQuery.fn.scheduleLinks = function(options) {
    return this.each(function() {
        var $this = jQuery(this),
            data = $this.data('schedule.links');

        if (!data && !$this.hasClass('js-schedule-links-init')) {
            data = new ScheduleLinks($this, typeof options == 'object' && options);
            $this.addClass('js-schedule-links-init');
            $this.data('schedule.links', data);
        }
    });
  }


  class ScheduleLinks {
    constructor(element, options) {
      this.element = element;

      this.links = [];

      $('body').find('.js-schedule').each((index, element) => {
        const $this = $(element);
        const title = $this.find('.js-schedule-title').text();
        const id = 'draw-schedule-' + index;
        $this.attr('id', id);

        this.links.push({
          id: '#' + id,
          title: title
        })
      });

      for (let i = 0; i < this.links.length; ++i) {
        const link = this.links[i];

        const $linkHtml = $('<a>', {
          class: 'schedule-link-item clear',
          href: link.id,
        }).append($('<p>', {
          class: 'schedule-link-text inverted'
        }).text(link.title));

        this.element.append($linkHtml);
      }
    }
  }
  
  jQuery.fn.scheduleLinks.Constructor = ScheduleLinks;
});