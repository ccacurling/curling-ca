import './templates/CurlingNav.js';
import './templates/CurlingNavMobile.js';

import './blocks/block-timer.js';

jQuery(document).ready(function($) {
  $('.js-curling-nav').curlingNav();
  $('.js-curling-nav-mobile').curlingNavMobile();

  $('.block-timer').blockHeroTimer();
});
