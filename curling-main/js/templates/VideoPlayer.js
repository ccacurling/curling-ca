jQuery(document).ready(function($) {
  jQuery.fn.mediaPlayer = function(options) {
    return this.each(function() {
        var $this = jQuery(this),
            data = $this.data('media.player');

        if (!data && !$this.hasClass('js-hero-container-init')) {
            data = new VideoPlayer($this, typeof options == 'object' && options);
            $this.data('media.player', data);
        }
    });
  }


  class VideoPlayer {
    constructor(element, options) {
      this.mediaPlayer = element;
      this.videoPlayer = this.mediaPlayer.find('.js-video-player');
      this.videoBtnPlay = this.videoPlayer.find('.js-btn-play');
      this.video = this.videoPlayer.find('.js-video');
      this.videoOverlay = this.videoPlayer.find('.js-video-overlay');
      this.content = this.mediaPlayer.find('.js-hero-content');

      if (this.videoOverlay && !this.videoOverlay.hasClass('hidden')) {
        this.videoOverlay.addClass('hidden');
      }

      if (this.video.length > 0) {
        this.video = this.video[0];
      } else {
        this.video = null;
      }
      
      if (this.videoPlayer && this.video) {
        this.videoPlayer.click(() => {
          if (this.video.paused) {
            this.video.play();
            if (this.videoBtnPlay) {
              this.videoBtnPlay.addClass('hidden');
            }
            if (this.videoOverlay) {
              this.videoOverlay.addClass('hidden');
            }
            if (this.content) {
              this.content.addClass('hidden');
            }
          } else {
            this.video.pause();
            if (this.videoBtnPlay) {
              this.videoBtnPlay.removeClass('hidden');
            }
            if (this.videoOverlay) {
              this.videoOverlay.removeClass('hidden');
            }
            if (this.content) {
              this.content.removeClass('hidden');
            }
          }
        });
      }
    }
  }
  
  jQuery.fn.mediaPlayer.Constructor = VideoPlayer;
});