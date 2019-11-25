jQuery(document).ready(function($) {
  jQuery.fn.newsFeed = function(options) {
    return this.each(function() {
        var $this = jQuery(this),
            data = $this.data('news.feed');

        if (!data && !$this.hasClass('js-news-feed-init')) {
            data = new NewsFeed($this, typeof options == 'object' && options);
            $this.addClass('js-news-feed-init');
            $this.data('news.feed', data);
        }
    });
  }


  class NewsFeed {
    constructor(element, options) {
        this.element = element;

        this.newsFeedItems = this.element.find('.js-news-feed-items');
        this.additionalOptions = this.newsFeedItems.data('options');
        this.page = 1;
        this.n = 4;
        this.total = 1;
        
        console.log(this.additionalOptions);
        if (this.additionalOptions != 'noinitial') {
          this.getAjaxRequest(this.page, this.n);
        } else {
          this.leftArrow = this.newsFeedItems.data('arrow-left');
          this.rightArrow = this.newsFeedItems.data('arrow-right');
          this.total = this.newsFeedItems.data('total');
          this.addPagination(1, this.total, {
            'arrowImageLeft': this.leftArrow,
            'arrowImageRight': this.rightArrow
          });
        }
    }

    getAjaxRequest(page, n) {
      const category = this.element.data('category');
      const lang = this.element.data('lang');

      if (category) {
        $.ajax({
          type: 'POST',
          url: curling_ajax.ajax_url,
          data: {
            'action': 'ajax_news_request',
            'page': page,
            'n': n,
            'lang': lang,
            'category': category
          },
          dataType: 'json',
          success: (data) => {
            console.log(data);
            if (data && data.success && data.posts && data.page && data.total) {
              this.page = page;
              this.n = n;
              this.total = data.total;
              if (this.newsFeedItems) {
                this.newsFeedItems.empty();
              }
              this.addPosts(data.posts, data);
              this.addPagination(data.page, data.total, data);
            }
          }
        });
      }
    }
    
    addPosts(posts, data)  {
      if (this.newsFeedItems) {
        for (let i = 0; i < posts.length; ++i) {
          const post = posts[i];
  
          const $section = $('<section>', {
            class: 'news-feed-item block-news-promo block-news-promo-white'
          });

          const $newsPromoContainer = $('<div>', {
            class: 'news-promo-container news-feed-container ' + (i % 2 === 1 ? 'news-feed-reversed-container' : '')
          });

          let postHtml = '';
          const $newsFeedThumbnailContainer = $('<div>', {
            class: 'news-feed-thumbnail-container news-promo-thumbnail-container'
          });

          if (post['thumbnail']) {
            const $newsFeedThumbnail = $('<img>', {
              class: 'news-feed-thumbnail',
              src: post['thumbnail'],
              alt: ''
            });

            $newsFeedThumbnailContainer.append($newsFeedThumbnail);

            if (post['caption']) {
              const $newsFeedCaptionContainer = $('<div>', {
                class: 'news-feed-caption-container news-promo-caption-container'
              });

              const $newsFeedCaptionWrapper = $('<div>', {
                class: 'news-promo-caption-wrapper'
              });

              const newsFeedCaption = $('<p>', {
                class: 'news-promo-caption'
              }).text(post['caption']);

              $newsFeedCaptionWrapper.append(newsFeedCaption);
              $newsFeedCaptionContainer.append($newsFeedCaptionWrapper);
              $newsFeedThumbnailContainer.append($newsFeedCaptionContainer);
            }
          }
          
          $newsPromoContainer.append($newsFeedThumbnailContainer);
  
          const $newsFeedInfo = $('<div>', {
            class: 'news-feed-info news-promo-info'
          });

          const $newsTitle = $('<h3>', {
            class: 'news-promo-title'
          }).text(post['title'] ? post['title'] : '');

          const $newsDate = $('<h4>', {
            class: 'news-promo-date'
          }).text(post['date'] ? post['date'] : '');

          const $newsExerpt = $('<p>', {
            class: 'news-feed-excerpt news-promo-excerpt'
          }).text(post['excerpt'] ? post['excerpt'] : '');

          const $newsLink = $('<a>', {
            class: 'news-feed-link news-promo-link btn-link',
            href: post['link']
          });

          const $newsLinkButton = $('<h4>', {
            class: 'btn-link-text red',
            href: ''
          }).text('Continue Reading');

          const $newsLinkArrow = $('<img>', {
            class: 'btn-link-arrow',
            src: data['arrowImageRed'],
            alt: 'arrow-right'
          }).text('Continue Reading');

          $newsFeedInfo.append($newsTitle);
          $newsFeedInfo.append($newsDate);
          $newsFeedInfo.append($newsExerpt);

          $newsLink.append($newsLinkButton);
          $newsLink.append($newsLinkArrow);
          $newsFeedInfo.append($newsLink);


          $newsPromoContainer.append($newsFeedInfo);
          $section.append($newsPromoContainer);
  
          this.newsFeedItems.append($section);
        }
      }
    }

    addPagination(currentPage, totalPages, data) {

      if (currentPage === 1 && totalPages === 1) {
        return;
      }
  
      const pages = [];
  
      let hasPrev = false;
      let hasNext = false;
      let hasLeftArrow = false;
      let hasRightArrow = false;
      const diff = (currentPage === 1 || currentPage === totalPages) ? 2 : 1;
  
      for (let i = 1; i < totalPages + 1; ++i) {
        if (Math.abs(i - currentPage) <= diff) {
          pages.push({
            'isCurrent': i === currentPage,
            'text': i,
            'large': false
          });
        } else if (i < currentPage && !hasPrev) {
          if (currentPage - diff > 1) {
            pages.push({
              'isCurrent': false,
              'text': 'arrow-left',
              'large': false
            });
            hasLeftArrow = true;
          }
          pages.push({
            'isCurrent': false,
            'text': 'PREV',
            'large': true
          });
          hasPrev = true;
        } else if (i > currentPage && !hasNext) {
          pages.push({
            'isCurrent': false,
            'text': 'NEXT',
            'large': true
          });
          hasNext = true;
          if (currentPage + diff < totalPages) {
            pages.push({
              'isCurrent': false,
              'text': 'arrow-right',
              'large': false
            });
            hasLeftArrow = true;
          }
        }
      }
      
      
      const $divPagination = $('<div>', {
        class: 'news-feed-pagination'
      });

      for (let i = 0; i < pages.length; ++i) {
        const page = pages[i];

        const $paginationBlock = $('<div>', {
          class: 'news-feed-pagination-block' + (page.isCurrent ? ' news-feed-pagination-block-selected' : '') + (page.large ? ' news-feed-pagination-block-large' : '')
        })

        let $paginationContent;
        if (page.text === 'arrow-left') {
          $paginationContent = $('<img>', {
            src: data['arrowImageLeft'],
            alt: 'arrow-left'
          });
        } else if (page.text === 'arrow-right') {
          $paginationContent = $('<img>', {
            src: data['arrowImageRight'],
            alt: 'arrow-right'
          });
        } else {
          $paginationContent = $('<span>', {
            class: 'news-feed-pagination-text',
            src: data['arrowImageRight'],
            alt: 'arrow-right'
          }).text(page.text);
        }

        $paginationBlock.click(() => {
          let pageNo = this.page;
          switch (page.text) {
            case 'NEXT':
              pageNo++;
              break;
            case 'PREV':
              pageNo--;
              break;
            case 'arrow-left':
              pageNo = 1;
              break;
            case 'arrow-right':
              pageNo = this.total;
              break;
            default:
              pageNo = page.text
              break;
          }
          this.getAjaxRequest(pageNo, this.n);
        })
        
        $paginationBlock.append($paginationContent);
        $divPagination.append($paginationBlock)
      }
  
      this.newsFeedItems.append($divPagination);
    }
  }
  
  jQuery.fn.newsFeed.Constructor = NewsFeed;
});

/*
var getUrlParameter = function getUrlParameter(sParam) {
  var sPageURL = window.location.search.substring(1),
      sURLVariables = sPageURL.split('&'),
      sParameterName,
      i;

  for (i = 0; i < sURLVariables.length; i++) {
      sParameterName = sURLVariables[i].split('=');

      if (sParameterName[0] === sParam) {
          return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
      }
  }
};*/