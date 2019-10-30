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

    pause() {
      this.masterSlider.api.pause();
    }

    resume() {
      this.masterSlider.api.resume();
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
          slideshowDelay: 5,
          overPause: false,
          pauseOnHover: false,
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

        this.isStarted = false;

        this.masterSlider.api.addEventListener(MSSliderEvent.CHANGE_START , () => {
          const $thumb = this.slider.find('.ms-thumbs-cont .ms-thumb-frame').eq(this.masterSlider.api.view.currentSlide.index);
          const $progressbar = $thumb.find('.js-hero-carousel-thumbnail-timer-progress');
          $progressbar.addClass('initializing');
          $progressbar.removeClass('deinitializing');
          this.isStarted = true;
        });
          
        this.masterSlider.api.addEventListener(MSSliderEvent.CHANGE_END , () => {
          // dispatches when the slider's current slide change ends.
          const $thumb = this.slider.find('.ms-thumbs-cont .ms-thumb-frame').eq(this.masterSlider.api.view.currentSlide.index);
          const $progressbar = $thumb.find('.js-hero-carousel-thumbnail-timer-progress');
          $progressbar.removeClass('initializing');

        });

        this.masterSlider.api.addEventListener(MSSliderEvent.WAITING , () => {
          const $thumb = this.slider.find('.ms-thumbs-cont .ms-thumb-frame').eq(this.masterSlider.api.view.currentSlide.index);
          const $progressbar = $thumb.find('.js-hero-carousel-thumbnail-timer-progress');
          const current = this.masterSlider.api.view.currentSlide.index;
          const progress = this.masterSlider.api.currentTime();

          if (this.isStarted) {
            $progressbar.css('width', progress + '%' );
            $progressbar.addClass('in-progress');
          } else {
            if (progress === 0 && !this.isStarted) {
              $progressbar.css('width', '100%' );
              $progressbar.removeClass('in-progress');
              $progressbar.addClass('deinitializing');
            } else {
              $progressbar.css('width', progress + '%' );
            }
          }

          if (this.isStarted) {
            this.isStarted = false;
          }
        });
      });
    }
  }
  
  jQuery.fn.heroCarousel.Constructor = HeroCarousel;
});
