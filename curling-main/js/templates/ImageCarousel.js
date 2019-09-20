jQuery(document).ready(function($) {
  jQuery.fn.imageCarousel = function(options) {
    return this.each(function() {
        var $this = jQuery(this),
            data = $this.data('image.carousel');

        if (!data && !$this.hasClass('js-image-carousel-init')) {
            data = new ImageCarousel($this, typeof options == 'object' && options);
            $this.addClass('js-image-carousel-init');
            $this.data('image.carousel', data);
        }
    });
  }


  class ImageCarousel {
    constructor(element, options) {
      this.element = element;
      this.sliderFeatured = this.element.find('.js-slider-featured');
      this.slider = this.element.find('.js-slider');

      if (this.sliderFeatured) {
        this.initFeatured();
      }

      if (this.slider) {
        this.initNormal();
      }
    }

    initNormal() {
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
          this.slider.find('.slick-slide').removeClass('level1 level2 level3');
        
          if (nextSlide) {
            // this.addAll(slick, nextSlide - 2, 'level1');
            // this.addAll(slick, nextSlide + 2, 'level1');
            // this.addAll(slick, nextSlide - 1, 'level2');
            // this.addAll(slick, nextSlide + 1, 'level2');
            // this.addAll(slick, nextSlide, 'level3');
          } else {
            this.slider.find('.slick-slide[data-slick-index="0"]').addClass('level3');
            this.slider.find('.slick-slide[data-slick-index="1"]').addClass('level2');
          }

          var i = (nextSlide ? nextSlide : 0) + 1;
          this.pagination.text(i + '/' + slick.slideCount);
        });
      }

      if (this.paginationMobile) {
        this.sliderMobile.on('init reInit beforeChange', (event, slick, currentSlide, nextSlide) => {
          var i = (nextSlide ? nextSlide : 0) + 1;
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
        slidesToShow: this.isCircular ? 3 : 1,
        slidesToScroll: 1,
        centerPadding: 0,
        infinite: this.isCircular ? false : true
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

    initFeatured() {
      this.sliderFeatured.masterslider({
        width: 767,
        height: 488,
        layout: 'partialview',
        space: 0,
        loop: true,
        view: 'wave',
        controls: {
          arrows: { autohide: false },
          slideinfo: { insertTo:'#info' }
        }
    });
    }

    addAll(slick, index, addedClass) {
      this.slider.find('.slick-slide[data-slick-index="' + index + '"]').addClass(addedClass);
      // this.slider.find('.slick-slide[data-slick-index="' + (index + slick.slideCount) + '"]').addClass(addedClass);
      // this.slider.find('.slick-slide[data-slick-index="' + (index - slick.slideCount) + '"]').addClass(addedClass);
    }
  }
  
  jQuery.fn.imageCarousel.Constructor = ImageCarousel;
});
