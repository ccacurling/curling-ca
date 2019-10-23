import './templates/Accordion.js';
import './templates/CurlingNav.js';
import './templates/CurlingNavMobile.js';
import './templates/ImageCarousel.js';
import './templates/HeroCarousel.js';
import './templates/VideoPlayer.js';
import './templates/NewsFeed.js';
import './templates/EventsFeed.js';
import './templates/ScheduleLinks.js';
import './templates/FindClub.js';
import './templates/Timer.js';
import './templates/CTRS.js';
import './templates/SearchHandler.js';
import './templates/TemplateSwitcher';

jQuery(document).ready(function($) {
  $('.js-curling-nav').curlingNav();
  $('.js-curling-nav-mobile').curlingNavMobile();
  $('.js-hero-container').mediaPlayer();
  $('.js-timer').blockHeroTimer();
  $('.js-image-carousel').imageCarousel();
  $('.js-hero-carousel').heroCarousel();
  $('.js-news-feed').newsFeed();
  $('.js-events-feed').eventsFeed();
  $('.js-schedule-links').scheduleLinks();
  $('.js-accordion').accordion();
  $('.js-slick').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    speed: 500,
    cssEase: 'linear',
    dots: true,
  });

  // Handle on load slick for mobile devices and small desktop windows
  responsivelySlick($, $(window).width());

  // Responsively slick / unslick based on window resize
  $(window).on('resize', () => {
    responsivelySlick($, $(window).width());
  });

  function responsivelySlick($, windowWidth) {
    const $textCalloutsGroupSlicked = $('.text-callouts-group.slick-initialized');
  
    // Slick if window width is smaller than 1170px
    if (windowWidth < 1170 && $textCalloutsGroupSlicked.length === 0) {
      $('.text-callouts-group').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        dots: true,
        centerMode: true,
      });
    // Else unslick if slick initialized
    } else if (windowWidth >= 1170 && $textCalloutsGroupSlicked.length > 0) {
      $('.text-callouts-group').slick('unslick'); // Unslick
    } else {
      // Do nothing
    }
  }
});

