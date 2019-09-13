// jQuery(document).ready(function($) {
//   const $newsFeeds = $('.block-news-feed');

//   if ($newsFeeds) {
//     $newsFeeds.each((index, element) => {
//       const $newsFeed = $(element);
//       const category = $newsFeed.data('category');

//       if (category) {
//         $.ajax({
//           type: 'POST',
//           url: curling_ajax.ajax_url,
//           data: {
//             'action': 'ajax_request',
//             'page': 1,
//             'n': 3,
//             'category': category
//           },
//           dataType: 'json',
//           success: function(data) {
//             if (data && data.success && data.posts && data.page && data.total) {
//               addPosts($newsFeed, data.posts, data);
//               addPagination($newsFeed, data.page, data.total, data);
//             }
//           }
//         });
//       }
//     });
//   }

//   const addPagination = ($newsFeedContainer, currentPage, totalPages, data) => {

//     if (currentPage === 1 && totalPages === 1) {
//       return;
//     }

//     const pages = [];

//     let hasPrev = false;
//     let hasNext = false;
//     let hasLeftArrow = false;
//     let hasRightArrow = false;
//     const diff = (currentPage === 1 || currentPage === totalPages) ? 2 : 1;

//     for (let i = 1; i < totalPages + 1; ++i) {
//       if (Math.abs(i - currentPage) <= diff) {
//         pages.push({
//           'isCurrent': i === currentPage,
//           'text': i,
//           'large': false
//         });
//       } else if (i < currentPage && !hasPrev) {
//         if (currentPage - diff > 1) {
//           pages.push({
//             'isCurrent': false,
//             'text': 'arrow-left',
//             'large': false
//           });
//           hasLeftArrow = true;
//         }
//         pages.push({
//           'isCurrent': false,
//           'text': 'PREV',
//           'large': true
//         });
//         hasPrev = true;
//       } else if (i > currentPage && !hasNext) {
//         pages.push({
//           'isCurrent': false,
//           'text': 'NEXT',
//           'large': true
//         });
//         hasNext = true;
//         if (currentPage + diff < totalPages) {
//           pages.push({
//             'isCurrent': false,
//             'text': 'arrow-right',
//             'large': false
//           });
//           hasLeftArrow = true;
//         }
//       }
//     }


//     const $newsFeed = $newsFeedContainer.find( '.js-news-feed-items' );

//     let paginationHtml = '<div class="news-feed-pagination">';

//     for (let i = 0; i < pages.length; ++i) {
//       const page = pages[i];
//       paginationHtml += '<a href="#" onclick="testFunction(); return false;"><div class="news-feed-pagination-block' + (page.isCurrent ? ' news-feed-pagination-block-selected' : '') + (page.large ? ' news-feed-pagination-block-large' : '') + '">';
//       if (page.text === 'arrow-left') {
//         paginationHtml += '<img src="' + data['arrowImageLeft'] + '" alt="arrow-right" />'
//       } else if (page.text === 'arrow-right') {
//         paginationHtml += '<img src="' + data['arrowImageRight'] + '" alt="arrow-right" />'
//       } else {
//         paginationHtml += '<span class="news-feed-pagination-text">' + page.text + '</span>';
//       }

//       paginationHtml += '</div></a>';
//     }
//     paginationHtml += '</div>';

//     $newsFeed.append(paginationHtml);
//   }
    
//   const addPosts = ($newsFeedContainer, posts, data) => {
//     const $newsFeed = $newsFeedContainer.find( '.js-news-feed-items' );

//     if ($newsFeed) {
//       for (let i = 0; i < posts.length; ++i) {
//         const post = posts[i];

//         let postHtml = 
//           '<section class="news-feed-item block-news-promo block-news-promo-white">' +
//           '  <div class="news-promo-container news-feed-container ' + (i % 2 === 1 ? 'news-feed-reversed-container' : '') + '">';

//           if (post['thumbnail']) {
//             postHtml +=
//               '<div class="news-feed-thumbnail-container news-promo-thumbnail-container">' +
//               '  <img class="news-feed-thumbnail news-promo-thumbnail" src="' + post['thumbnail'] + '" alt="" />';
//             if (post['caption']) {
//               postHtml +=
//                 '<div class="news-feed-caption-container news-promo-caption-container">' +
//                 '  <div class="news-promo-caption-wrapper">' +
//                 '    <p class="news-promo-caption">' + post['caption'] + '</p>' +
//                 '  </div>' +
//                 '</div>';
//             }
//             postHtml +=
//               '</div>';
//           }

//         postHtml += 
//         '    <div class="news-feed-info news-promo-info">' +
//         '      <h3 class="news-promo-title">' + (post['title'] ? post['title'] : '') + '</h3>' +
//         '      <h4 class="news-promo-date">' + (post['date'] ? post['date'] : '') + '</h4>' +
//         '      <p class="news-feed-excerpt news-promo-excerpt">' + (post['excerpt'] ? post['excerpt'] : '') + '</p>' +
//         '      <a class="news-feed-link news-promo-link btn-link" href="<?php echo get_permalink($promo_post->ID); ?>">' +
//         '        <h4 class="btn-link-text red">Continue Reading</h4>' +
//         '        <img class="btn-link-arrow" src="' + data['arrowImageRed'] + '" alt="arrow-right" />' +
//         '      </a>' +
//         '    </div>' +
//         '  </div>' +
//         '</section>';

//         $newsFeed.append(postHtml);
//       }
//     }
//   }
// });

