import './templates/CurlingNav.js';
import './templates/CurlingNavMobile.js';
import './templates/ImageCarousel.js';
import './templates/VideoPlayer.js';
import './templates/NewsFeed.js';
import './templates/ScheduleLinks.js';
import './blocks/block-timer.js';

jQuery(document).ready(function($) {
  $('.js-curling-nav').curlingNav();
  $('.js-curling-nav-mobile').curlingNavMobile();
  $('.js-hero-container').mediaPlayer();
  $('.js-timer').blockHeroTimer();
  $('.js-image-carousel').imageCarousel();
  $('.js-news-feed').newsFeed();
  $('.js-schedule-links').scheduleLinks();
  $('.text-callouts-group').slick({
    //Options go here - look into breakpoints 1170px
  });
});
