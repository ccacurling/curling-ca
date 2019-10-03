jQuery(document).ready(function($) {
  jQuery.fn.heroCarousel = function(options) {
    return this.each(function() {
        var $this = jQuery(this),
            data = $this.data('hero.carousel');

        if (!data && !$this.hasClass('js-hero-carousel-init')) {
            data = new HeroCarousel($this, typeof options == 'object' && options);
            $this.addClass('js-hero-carousel-init');
            $this.data('hero.carousel', data);
        }
    });
  }


  class HeroCarousel {
    constructor(element, options) {
      this.element = element;
      this.slider = this.element.find('.js-slider');
      this.init();
    }

    init() {
      this.slider.each((i, element) => {
        const $this = $(element);
        $this.masterslider({
          width: 1440,
          height: 700,
          layout: 'fullwidth',
          space: 0,
          loop: true,
          grabCursor: false,
          mouse: false,
          view: 'fade',
          fillMode: 'cover',
          autoplay: true,
          controls: {
            thumblist: {
              margin: 0,
              space: 30,
              autohide: false,
              dir: "h",
              align: 'bottom',
              width: 370,
              height: 140,
              arrows: false,
              type: "tabs",
            }
          }
        });
        this.masterSlider = this.slider.masterslider('slider');

        this.masterSlider.api.addEventListener(MSSliderEvent.WAITING , () => {
          const $caption = this.masterSlider.api.view.currentSlide.$element.find('.js-hero-carousel-caption-text');
          $caption.css('text-overflow', 'ellipsis');
          const $thumb = this.slider.find('.ms-thumbs-cont .ms-thumb-frame').eq(this.masterSlider.api.view.currentSlide.index);
          const $progressbar = $thumb.find('.hero-carousel-thumbnail-timer-progress');
          $progressbar.css('width', this.masterSlider.api.currentTime() + '%' );
        });
      });
    }
  }
  
  jQuery.fn.heroCarousel.Constructor = HeroCarousel;
});
