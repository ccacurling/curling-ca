<?php
add_action('wp_ajax_nopriv_ajax_news_request', 'ajax_news_request');
add_action('wp_ajax_ajax_news_request', 'ajax_news_request');

add_action('wp_ajax_nopriv_ajax_events_request', 'ajax_events_request');
add_action('wp_ajax_ajax_events_request', 'ajax_events_request');

function ajax_news_request() {

    $page = filter_var($_POST['page'], FILTER_SANITIZE_NUMBER_INT);
    $n = filter_var($_POST['n'], FILTER_SANITIZE_NUMBER_INT);
    $category = filter_var($_POST['category'], FILTER_SANITIZE_STRING);

    $page = filter_var($page, FILTER_VALIDATE_INT) ? intval($page) : 1;
    $n = filter_var($n, FILTER_VALIDATE_INT) ? intval($n) : 4;

    $offset = ($page && $n) ? ($page - 1) * $n : 0;

    $args = [
        'category_name' => $category,
        'posts_per_page' => $n,
        'offset' => $offset,
        'orderby' => 'date',
        'order'   => 'DESC',
        'post_status' => 'publish'
    ];

    $args_count = [
      'category_name' => $category,
      'posts_per_page' => -1,
      'fields' => 'ids',
      'no_found_rows' => true,
      'post_status' => 'publish'
    ];

    $query = new WP_Query($args);
    $query_count = new WP_Query($args_count);
    $total = $query_count->post_count;

    $response = [];

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
    
      $response = [ 
          'success' => true, 
          'posts' => $posts,
          'page' => $page,
          'total' => $total_pages,
          'arrowImageRight' => get_stylesheet_directory_uri()."/images/arrow-right-large-gray.svg",
          'arrowImageLeft' => get_stylesheet_directory_uri()."/images/arrow-left-large-gray.svg",
          'arrowImageRed' => get_stylesheet_directory_uri()."/images/arrow-right-large-red.svg"
      ];
    } else {
      $response = [
        'success' => false
      ];
    }

    print json_encode($response);

    exit;
}

function ajax_events_request() {
  $page = filter_var($_POST['page'], FILTER_SANITIZE_NUMBER_INT);
  $n = filter_var($_POST['n'], FILTER_SANITIZE_NUMBER_INT);
  $category = filter_var($_POST['category'], FILTER_SANITIZE_STRING);

  $page = filter_var($page, FILTER_VALIDATE_INT) ? intval($page) : 1;
  $n = filter_var($n, FILTER_VALIDATE_INT) ? intval($n) : 4;

  $offset = ($page && $n) ? ($page - 1) * $n : 0;

  $sites = get_sites();

  $site_list = array_filter($sites, function($site) {
    switch_to_blog($site->blog_id);
    $is_event = get_field( 'is_event', 'Options' );
    restore_current_blog();
    return $is_event;
  });

  // TODO: TEMP!! This is only here to test the pagination functionality of the events feed
  // $site_list = array_merge($site_list, $site_list, $site_list, $site_list, $site_list, $site_list, $site_list, $site_list, $site_list, $site_list, $site_list, $site_list, $site_list, $site_list, $site_list);

  $response = [];

  if (count($site_list) > 0) {
    $posts_slice = array_slice($site_list, $offset, $n);
    $total = count($site_list);
    $total_pages = ceil($total / $n);

    $events = array_map(function($event) {

      switch_to_blog($event->blog_id);
      $start_date_value = get_field( 'event_date_start', 'Options' );
      $end_date_value = get_field( 'event_date_end', 'Options' );
      $timezone = get_field( 'event_timezone', 'Options' );
      $name = get_field( 'event_name', 'Options' );
      $location = get_field( 'event_location_title', 'Options' );
      $timer_link = get_field( 'event_location_page_link', 'Options' );
      $operated_by = get_field( 'event_operated_by', 'Options' );
      $buy_tickets_link = get_field( 'event_buy_tickets_link', 'Options' );
      $draw_schedule_link = get_field( 'event_draw_schedule_link', 'Options' );
      $where_to_watch_link = get_field( 'event_where_to_watch_link', 'Options' );
      $meet_the_teams_link = get_field( 'event_meet_the_teams_link', 'Options' );
      $event_logo = get_field( 'event_logo', 'Options' );

      $start_date_value = $start_date_value ? $start_date_value.' '.$timezone : '2019-01-01 00:00:00 '.$timezone;
      $end_date_value = $end_date_value ? $end_date_value.' '.$timezone : '2019-01-01 00:00:00 '.$timezone;
    
      $start_date = date_create_from_format('Y-m-d H:i:s e', $start_date_value);
      $end_date = date_create_from_format('Y-m-d H:i:s e', $end_date_value);
    
      $start_date_string = $start_date ? $start_date->format('F j') : '';
      $end_date_string = $end_date ? $end_date->format('F j Y') : '';

      $date = $start_date == $end_date ? ($end_date_string ? $end_date_string : $start_date_string) : ($end_date_string ? $start_date_string.'&nbsp;-&nbsp;'.$end_date_string : $start_date_string);

      if ($event_logo) {
        $event_logo = $event_logo['url'];
      }
      $event_page_link = get_home_url();
      restore_current_blog();

      return [
        'date' => $date,
        'name' =>  $name,
        'location' =>  $location,
        'timer_link' =>  $timer_link,
        'operated_by' =>  $operated_by,
        'buy_tickets_link' =>  $buy_tickets_link,
        'draw_schedule_link' =>  $draw_schedule_link,
        'where_to_watch_link' =>  $where_to_watch_link,
        'meet_the_teams_link' =>  $meet_the_teams_link,
        'event_logo' =>  $event_logo,
        'event_page_link' =>  $event_page_link
      ];
    }, $posts_slice);
  
    $response = [ 
      'success' => true, 
      'events' => $events,
      'page' => $page,
      'total' => $total_pages,
      'arrowImageRight' => get_stylesheet_directory_uri()."/images/arrow-right-large-gray.svg",
      'arrowImageLeft' => get_stylesheet_directory_uri()."/images/arrow-left-large-gray.svg",
      'arrowImageRed' => get_stylesheet_directory_uri()."/images/arrow-right-large-red.svg"
    ];
  } else {
    $response = [
      'success' => false
    ];
  }

  print json_encode($response);

  exit;
}
