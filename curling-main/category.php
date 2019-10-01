<?php
/**
 * The template for displaying a category page
 */
?>

<?php
  $category = get_queried_object();
  
  $page = 1;
  $n = 4;
  $category_slug = $category->slug;

  $offset = ($page && $n) ? ($page - 1) * $n : 0;

  $args = [
      'category_name' => $category_slug,
      'posts_per_page' => $n,
      'offset' => $offset,
      'orderby' => 'date',
      'order'   => 'DESC',
      'post_status' => 'publish'
  ];

  $args_count = [
    'category_name' => $category_slug,
    'posts_per_page' => -1,
    'fields' => 'ids',
    'no_found_rows' => true,
    'post_status' => 'publish'
  ];

  $query = new WP_Query($args);
  $query_count = new WP_Query($args_count);
  $total = $query_count->post_count;

  $total_pages = 0;
  $posts = [];

  if ($query) {
    $total_pages = ceil($total / $n);

    $posts = array_map(function($post) {
      $promo_thumbnail = get_the_post_thumbnail_url( $post, 'large' );
      $promo_date = $post->post_date;
      $promo_image_caption = get_field( 'featured_image_caption', $post );

      $date = date_create_from_format('Y-m-d H:i:s', $promo_date);
      $date_string = $date->format('F j, Y');

      $link = get_permalink($post);

      return [
        'ID' => $post->ID,
        'title' => $post->post_title,
        'excerpt' => $post->post_excerpt,
        'date' => $date_string,
        'thumbnail' => $promo_thumbnail,
        'caption' => $promo_image_caption,
        'link' => $link
      ];
    }, $query->posts);
  }

  $featured_post = null;
  if (count($posts) > 0) {
    $featured_post = get_post($posts[0]['ID']);
  }

  $image = get_image($featured_post);

  $headline = $featured_post ? $featured_post->post_title : '';
  $date = $featured_post ? get_the_date('M j, Y', $featured_post) : '';
  $body = $featured_post ? $featured_post->post_excerpt : '';
  $caption = $featured_post ? get_field( 'featured_image_caption', $featured_post ) : '';
  $link = $featured_post ? [ 'url' => get_post_permalink($featured_post), 'target' => '_self', 'title' => 'Continue Reading' ] : '';

  $post_type = $featured_post ? get_post_type( $featured_post->ID ) : null;

  function get_image($featured_post) {
    if ($featured_post) {
      $image = get_field( 'hero_image', $featured_post->ID);
      if ($image) {
        return $image['url'];
      } else if (has_post_thumbnail( $featured_post, 'large' )) {
        return get_the_post_thumbnail_url( $featured_post, 'large' );
      } else {
        $image = get_field( 'hero_image' );
        if ($image) {
          return $image['url'];
        }
      }
    }
    $image = get_field( 'hero_image' );
    if ($image) {
      return $image['url'];
    } else {
      return null;
    }
  }
?>

<?php
  get_header();
?>

<?php 
    if ($featured_post) {
  ?>
    <section class="block-hero block-hero-large block-hero-main js-hero-container">
      <div class="hero-media-container">
      <?php
        if ($image) {
      ?>
        <img class="hero-background-image" src="<?php echo $image; ?>" alt="Background" />
      <?php
        }
      ?>

      <?php 
        if ($post_type) {
      ?>
        <div class="hero-post-type-container-mobile">
            <span class="hero-post-type"><?php echo $post_type; ?></span>
        </div>
      <?php
        }
      ?>
      <?php
        if ($caption) {
      ?>
        <div class="hero-caption-container-mobile">
          <div class="hero-caption-wrapper-mobile">
            <p class="hero-caption"><?php echo $caption; ?></p>
          </div>
        </div>
      <?php 
        }
      ?>

      </div>
      <?php
        if (!$image && is_admin()) {
      ?>
        <div class="block-admin-error block-hero-no-image-container">
          <h3 class="block-hero-no-image-message">Add hero image</h3>
        </div>
      <?php
        } else {
      ?>
        <div class="block-hero-inner centre js-hero-content">
          <?php 
            if ($post_type) {
          ?>
            <div class="hero-post-type-container">
                <span class="hero-post-type"><?php echo $post_type; ?></span>
            </div>
          <?php
            }
          ?>
          <div class="hero-title-container <?php echo !$post_type ? 'hero-no-post-type' : ''; ?>">
            <h2 class="hero-title">
              <?php echo $headline; ?>
            </h2>
          </div>
          <?php
            if ($date) {
          ?>
            <div class="hero-date-container">
              <h4 class="hero-date"><?php echo $date; ?></h4>
            </div>
          <?php
            }
          ?>
          <div class="hero-body-container">
            <?php
              if ($body) {
            ?>
              <p class="hero-body"><?php echo $body ?></p>
            <?php
              }
            ?>
          </div>
          <?php
            if ($link) {
          ?>
            <div class="hero-link-container">
              <a class="btn-secondary hero-link" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title'] ?></a>
            </div>
          <?php
            }
          ?>
        </div>
      <?php
        }
      ?>
      <?php
        if ($caption) {
      ?>
        <div class="hero-caption-container">
          <p class="hero-caption"><?php echo $caption; ?></p>
        </div>
      <?php 
        }
      ?>
    </section>
  <?php
    }
  ?>

<div class="content-post content content-full-wrapper content-anchor">
  <section class="block-news-feed js-news-feed" data-category="<?php echo $category ? $category->slug : ''; ?>">
    <div class="news-feed-title-container">
      <h3><?php echo $category ? $category->name : ''; ?></h3>
    </div>
    <div class="js-news-feed-items" data-options="noinitial"
      data-arrow-left="<?php echo get_stylesheet_directory_uri()."/images/arrow-left-large-gray.svg"; ?>"
      data-arrow-right="<?php echo get_stylesheet_directory_uri()."/images/arrow-right-large-gray.svg"; ?>"
      data-total="<?php echo $total_pages; ?>">
      
      <?php
        $i = 0;
        foreach ($posts as $key => $post) {
          $post_title = $post['title'];
          $post_excerpt = $post['excerpt'];
          $post_date = $post['date'];
          $post_thumbnail = $post['thumbnail'];
          $post_link = $post['link'];
          $post_caption = $post['caption'];
      ?>
        <section class="news-feed-item block-news-promo block-news-promo-white">
          <div class="news-promo-container news-feed-container <?php echo $i % 2 === 0 ? 'news-feed-reversed-container' : ''; ?>">
            <div class="news-feed-thumbnail-container news-promo-thumbnail-container">
              <?php
                if ($post_thumbnail) {
              ?>
                <img class="news-feed-thumbnail" src="<?php echo $post_thumbnail; ?>" alt="">
              <?php
                }
                if ($post_caption) {
              ?>
                <div class="news-feed-caption-container news-promo-caption-container">
                  <div class="news-promo-caption-wrapper">
                    <p class="news-promo-caption"><?php echo $post_caption; ?></p>
                  </div>
                </div>
              <?php
                }
              ?>
            </div>
            <div class="news-feed-info news-promo-info">
              <?php
                if ($post_title) {
              ?>
                <h3 class="news-promo-title"><?php echo $post_title; ?></h3>
              <?php
                }
              ?>
              <?php
                if ($post_date) {
              ?>
                <h4 class="news-promo-date"><?php echo $post_date; ?></h4>
              <?php
                }
              ?>
              <p class="news-feed-excerpt news-promo-excerpt">
              </p>
              <?php
                if ($post_link) {
              ?>
              <a class="news-feed-link news-promo-link btn-link" href="<?php echo $post_link; ?>">
                <h4 class="btn-link-text red" href="">Continue Reading</h4>
                <img class="btn-link-arrow" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right-large-red.svg"; ?>" alt="arrow-right">
              </a>
              <?php
                }
              ?>
            </div>
          </div>
        </section>
      <?php
          $i++;
        }
      ?>
    </div>
  </section>
</div>
<?php
  get_footer();
?>