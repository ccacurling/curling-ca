import './templates/CurlingNav.js';
import './templates/CurlingNavMobile.js';
import './templates/ImageCarousel.js';
import './templates/VideoPlayer.js';
import './templates/NewsFeed.js';
import './blocks/block-timer.js';
// import './helper/ajax.js';

jQuery(document).ready(function($) {
  $('.js-curling-nav').curlingNav();
  $('.js-curling-nav-mobile').curlingNavMobile();
  $('.js-hero-container').mediaPlayer();
  $('.js-timer').blockHeroTimer();
  $('.js-image-carousel').imageCarousel();
  $('.js-news-feed').newsFeed();
});
