jQuery(document).ready(function($) {
  jQuery.fn.eventsFeed = function(options) {
    return this.each(function() {
        var $this = jQuery(this),
            data = $this.data('events.feed');

        if (!data && !$this.hasClass('js-events-feed-init')) {
            data = new EventsFeed($this, typeof options == 'object' && options);
            $this.addClass('js-events-feed-init');
            $this.data('events.feed', data);
        }
    });
  }


  class EventsFeed {
    constructor(element, options) {
        this.element = element;

        this.eventsFeedItems = this.element.find('.js-events-feed-items');
        this.page = 1;
        this.n = 4;
        this.total = 1;
        
        this.getAjaxRequest(this.page, this.n);
    }

    getAjaxRequest(page, n) {
      const category = this.element.data('category');

      if (category) {
        $.ajax({
          type: 'POST',
          url: curling_ajax.ajax_url,
          data: {
            'action': 'ajax_events_request',
            'page': page,
            'n': n
          },
          dataType: 'json',
          success: (data) => {
            if (data && data.success && data.events && data.page && data.total) {
              this.page = page;
              this.n = n;
              this.total = data.total;
              if (this.eventsFeedItems) {
                this.eventsFeedItems.empty();
              }
              this.addPosts(data.events);
              this.addPagination(data.page, data.total, data);
            }
          }
        });
      }
    }
    
    addPosts(events)  {
      if (this.eventsFeedItems) {
        const $wrapper = $('<div>', {
          class: 'block-event-wrapper'
        });

        for (let i = 0; i < events.length; ++i) {
          const event = events[i];
  
          const $itemWrapper = $('<div>', {
            class: 'block-event-feed-item-wrapper'
          });

          const $section = $('<div>', {
            class: 'block-event-info block-event-info-row'
          });

          const $topContainer = $('<div>', {
            class: 'event-info-top-container'
          });

          if (event.event_logo) {
            $topContainer.append($('<img>', {
              class: 'event-info-top-image',
              src: event.event_logo,
              alt: 'Event Logo'
            }));
          }

          $section.append($topContainer);

          const $bottomContainer = $('<div>', {
            class: 'block-event-info-details gray'
          });

          const detailTopContainer = $('<div>', {
            class: 'block-event-info-detail-top-container'
          })

          if (event.name) {
            detailTopContainer.append($('<h3>', {
              class: 'block-event-sponsor-header'
            }).text(event.name));
          }

          if (event.operated_by) {
            detailTopContainer.append($('<h3>', {
              class: 'block-event-sponsor-operated-by'
            }).text(`Operated by ${event.operated_by}`));
          }

          if (event.date) {
            detailTopContainer.append($('<h4>', {
              class: 'block-event-sponsor-date'
            }).text(event.date));
          }

          if (event.location) {
            detailTopContainer.append($('<h4>', {
              class: 'block-event-sponsor-location'
            }).text(event.location));
          }

          $bottomContainer.append(detailTopContainer);

          const detailBottomContainer = $('<div>', {
            class: 'event-info-bottom-container'
          })

          if (event.buy_tickets_link) {
            detailBottomContainer.append($('<a>', {
              class: 'block-event-sponsor-tickets-btn btn btn-red',
              href: event.buy_tickets_link,
              target: 'blank'
            }).text('Buy Tickets'));
          }

          const sponsorLinkContainer = $('<div>', {
            class: 'block-event-sponsor-links-container'
          });

          if (event.event_page_link) {
            sponsorLinkContainer.append($('<a>', {
              class: 'block-event-sponsor-link subdomain red arrow-right-large-red',
              href: event.event_page_link,
              target: 'blank'
            }).text('More Information'));
          }

          if (event.draw_schedule_link) {
            sponsorLinkContainer.append($('<a>', {
              class: 'block-event-sponsor-link subdomain red arrow-right-large-red',
              href: event.draw_schedule_link,
              target: 'blank'
            }).text('Event Schedule'));
          }

          if (event.meet_the_teams_link) {
            sponsorLinkContainer.append($('<a>', {
              class: 'block-event-sponsor-link subdomain red arrow-right-large-red',
              href: event.meet_the_teams_link,
              target: 'blank'
            }).text('Meet the teams'));
          }

          detailBottomContainer.append(sponsorLinkContainer);

          $bottomContainer.append(detailBottomContainer);

          $section.append($bottomContainer);

          $itemWrapper.append($section);

          $wrapper.append($itemWrapper);
        }

        this.eventsFeedItems.append($wrapper);
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
        class: 'events-feed-pagination'
      });

      for (let i = 0; i < pages.length; ++i) {
        const page = pages[i];

        const $paginationBlock = $('<div>', {
          class: 'events-feed-pagination-block' + (page.isCurrent ? ' events-feed-pagination-block-selected' : '') + (page.large ? ' events-feed-pagination-block-large' : '')
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
            class: 'events-feed-pagination-text',
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
  
      this.eventsFeedItems.append($divPagination);
    }
  }
  
  jQuery.fn.eventsFeed.Constructor = EventsFeed;
});