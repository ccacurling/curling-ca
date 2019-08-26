'use strict';

jQuery(document).ready(function ($) {
  $('.block-timer').each(function (index, element) {
    var $this = $(element);
    var unixTime = $this.data('date');
    var start = new Date(unixTime * 1000);
    updateTime($this, start);
    window.setInterval(function () {
      updateTime($this, start);
    }, 1000);
  });

  function updateTime($this, start) {
    var current = new Date();
    var totalseconds = (start - current) / 1000;
    var days = Math.floor(totalseconds / (3600 * 24));
    var hours = Math.floor((totalseconds - days * (3600 * 24)) / 3600);
    var minutes = Math.floor((totalseconds - days * (3600 * 24) - hours * 3600) / 60);
    var seconds = Math.floor(totalseconds - days * (3600 * 24) - hours * 3600 - minutes * 60);
    $this.find('.js-days').text(days);
    $this.find('.js-hours').text(hours);
    $this.find('.js-minutes').text(minutes);
    $this.find('.js-seconds').text(seconds);
  }
});
