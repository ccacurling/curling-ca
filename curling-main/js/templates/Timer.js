jQuery(document).ready(($) => {
  $.fn.blockHeroTimer = function(options) {
    return this.each(function() {
        const $this = jQuery(this);
        let data = $this.data('curling.block-hero-timer');

        if (!data && !$this.hasClass('js-block-hero-timer-init')) {
            data = new BlockHeroTimer($this, typeof options == 'object' && options);
            $this.data('curling.block-hero-timer', data);
        }
    });
  }

  class BlockHeroTimer {
    constructor(element, options) {
      this.element = element;
      
      const unixTime = this.element.data('date');

      const current = new Date();
      const start = new Date(unixTime * 1000);

      if (start - current > 0) {
        this.updateTime(start);
        window.setInterval(() => {
            this.updateTime(start);
        }, 1000);
      }
    }

  updateTime(start) {
        const current = new Date();
        const totalseconds = (start - current) / 1000;
        const days = Math.floor(totalseconds / (3600 * 24));
        const hours = Math.floor((totalseconds - (days * (3600 * 24))) / 3600);
        const minutes = Math.floor((totalseconds - (days * (3600 * 24)) - (hours * 3600)) / 60);
        const seconds = Math.floor(totalseconds - (days * (3600 * 24)) - (hours * 3600) - (minutes * 60));

        this.element.find('.js-days').text(days);
        this.element.find('.js-hours').text(hours);
        this.element.find('.js-minutes').text(minutes);
        this.element.find('.js-seconds').text(seconds);
    }

    inDays(d1, d2) {
      var t2 = d2.getTime();
      var t1 = d1.getTime();

      return parseInt((t2-t1)/(24*3600*1000));
    }

    inWeeks(d1, d2) {
        var t2 = d2.getTime();
        var t1 = d1.getTime();

        return parseInt((t2-t1)/(24*3600*1000*7));
    }

    inMonths(d1, d2) {
        var d1Y = d1.getFullYear();
        var d2Y = d2.getFullYear();
        var d1M = d1.getMonth();
        var d2M = d2.getMonth();

        return (d2M+12*d2Y)-(d1M+12*d1Y);
    }

    inYears(d1, d2) {
        return d2.getFullYear()-d1.getFullYear();
    }
  }
  
  jQuery.fn.blockHeroTimer.Constructor = BlockHeroTimer;
});
