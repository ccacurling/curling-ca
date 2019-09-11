jQuery(document).ready(function($) {
  jQuery.fn.imageCarousel = function(options) {
    return this.each(function() {
        var $this = jQuery(this),
            data = $this.data('image.carousel');

        if (!data && !$this.hasClass('js-image-carousel-init')) {
            data = new ImageCarousel($this, typeof options == 'object' && options);
            $this.data('image.carousel', data);
        }
    });
  }


  class ImageCarousel {
    constructor(element, options) {
      this.element = element;

      this.slider = this.element.find('.js-slider');
      this.sliderMobile = this.element.find('.js-slider-mobile');

      this.isCircular = this.slider.hasClass('js-slider-circular');

      this.navMobile = this.element.find('.js-carousel-mobile-nav');
      this.paginationMobile = this.element.find('.js-carousel-mobile-nav-pagination');
      this.arrowPrevMobile = this.element.find('.js-carousel-mobile-nav-prev');
      this.arrowNextMobile = this.element.find('.js-carousel-mobile-nav-next');

      this.nav = this.element.find('.js-carousel-nav');
      this.pagination = this.element.find('.js-carousel-nav-pagination');
      this.arrowPrev = this.element.find('.js-carousel-nav-prev');
      this.arrowNext = this.element.find('.js-carousel-nav-next');
     
      if (this.pagination) {
        this.slider.on('init reInit beforeChange', (event, slick, currentSlide, nextSlide) => {
          var i = (currentSlide ? currentSlide : 0) + 1;
          this.pagination.text(i + '/' + slick.slideCount);
        });
      }

      if (this.paginationMobile) {
        this.sliderMobile.on('init reInit beforeChange', (event, slick, currentSlide, nextSlide) => {
          var i = (currentSlide ? currentSlide : 0) + 1;
          this.paginationMobile.text(i + '/' + slick.slideCount);
        });
      }
      
      if (this.navMobile && this.sliderMobile.children().length <= 1) {
        this.navMobile.addClass('hidden');
      }

      if (this.nav && this.slider.children().length <= 1) {
        this.nav.addClass('hidden');
      }
      
      this.carouselMobile = this.sliderMobile.slick();
      this.carousel = this.slider.slick({
        centerMode: this.isCircular,
        slidesToShow: this.isCircular ? 1 : 1,
        slidesToScroll: 1,
      });

      if (this.carouselMobile && this.arrowPrevMobile) {
        this.arrowPrevMobile.click(() => {
          this.sliderMobile.slick('slickPrev');
        });
      }

      if (this.carouselMobile && this.arrowNextMobile) {
        this.arrowNextMobile.click(() => {
          this.sliderMobile.slick('slickNext');
        });
      }

      if (this.carousel && this.arrowPrev) {
        this.arrowPrev.click(() => {
          this.slider.slick('slickPrev');
        });
      }

      if (this.carousel && this.arrowNext) {
        this.arrowNext.click(() => {
          this.slider.slick('slickNext');
        });
      }
    }
  }
  
  jQuery.fn.imageCarousel.Constructor = ImageCarousel;
});
