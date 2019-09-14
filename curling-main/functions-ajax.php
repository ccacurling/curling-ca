<?php
add_action('wp_ajax_nopriv_ajax_request', 'ajax_handle_request');
add_action('wp_ajax_ajax_request', 'ajax_handle_request');

function ajax_handle_request(){

    $page = filter_var($_POST['page'], FILTER_SANITIZE_NUMBER_INT);
    $n = filter_var($_POST['n'], FILTER_SANITIZE_NUMBER_INT);
    $category = filter_var($_POST['category'], FILTER_SANITIZE_STRING);

    $page = filter_var($page, FILTER_VALIDATE_INT) ? intval($page) : 1;
    $n = filter_var($n, FILTER_VALIDATE_INT) ? intval($n) : 4;

    $offset = ($page && $n) ? ($page - 1) * $n : 0;

    $args = [
        'category_name' => $category
    ];

    $query = new WP_Query($args);

    $response = [];

    if ($query) {
      $posts_slice = array_slice($query->posts, $offset, $n);
      $total = count($query->posts);
      $total_pages = ceil($total / $n);

      $posts = array_map(function($post) {
        $promo_thumbnail = get_the_post_thumbnail_url( $post, 'large' );
        $promo_date = $post->post_date;
        $promo_image_caption = get_field( 'featured_image_caption', $post );

        $date = date_create_from_format('Y-m-d H:i:s', $promo_date);
        $date_string = $date->format('F j, Y');

        return [
          'ID' => $post->ID,
          'title' => $post->post_title,
          'excerpt' => $post->post_excerpt,
          'date' => $date_string,
          'thumbnail' => $promo_thumbnail,
          'caption' => $promo_image_caption
        ];
      }, $posts_slice);
    
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
