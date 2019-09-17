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

jQuery(document).ready(($) => {

  // Handle on load slick for mobile devices and small desktop windows
  responsivelySlick($, $(window).width());

  // Responsively slick / unslick based on window resize
  $(window).on('resize', () => {
    responsivelySlick($, $(window).width());
  });
});
