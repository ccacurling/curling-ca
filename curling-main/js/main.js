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
import './blocks/block-timer.js';
import './blocks/block-text-callouts-group';

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
});

