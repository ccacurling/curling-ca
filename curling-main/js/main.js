import './templates/CurlingNav.js';
import './templates/CurlingNavMobile.js';
import './templates/ImageCarousel.js';
import './templates/VideoPlayer.js';
import './blocks/block-timer.js';

jQuery(document).ready(function($) {
  $('.js-curling-nav').curlingNav();
  $('.js-curling-nav-mobile').curlingNavMobile();

  $('.js-hero-container').mediaPlayer();

  $('.block-timer').blockHeroTimer();

  $('.js-image-carousel').imageCarousel();
});
