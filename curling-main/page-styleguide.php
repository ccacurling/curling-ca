<?php 
/* Template Name: TEST - Styleguide */ 
?>

<html <?php language_attributes(); ?>>

<?php
	set_query_var('header_config', [
		'header_color' => 'red'
	]);
?>
<?php get_header(); ?>

<body class="<?php echo join(' ', get_body_class()); ?>">
    <div class="content">
        <div class="content-wrapper content-fixed">

            <div><span class="highlight">LOREM</span></div>
            <div><h1>Title Heading</h1></div>
            <div><h2>Title Heading 2</h2></div>
            <div><h3>Title Heading 3</h3></div>
            <div><h4>Title Heading 4</h4></div>
            <div><span class="quotes">Short description of the product lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span></div>
            <p>
                Nam porttitor blandit accumsan. Ut <a>vel dictum sem</a>, a pretium dui. In malesuada enim in dolor euismod, id commodo mi consectetur. Curabitur at vestibulum nisi. Nullam vehicula nisi velit. Mauris turpis nisl, molestie ut ipsum et, suscipit vehicula odio. Vestibulum interdum vestibulum felis ac molestie. Praesent aliquet quam et libero dictum, vitae dignissim leo eleifend. In in turpis turpis. Quisque justo turpis, vestibulum non enim nec, tempor mollis mi. Sed vel tristique quam.
            </p>
            <ul>
                <li>Lorem ipsum dolor sit amet,</li>
                <li>Consectetur adipiscing elit, sed do</li>
                <li>Eiusmod tempor incididunt ut</li>
                <li>Labore et Ut enim ad minim</li>
            </ul>
            <div class="btn">LOREM IPSUM AMET</div>
            <div class="btn btn-black">LOREM IPSUM AMET</div>
            <div class="btn btn-yellow">LOREM IPSUM AMET</div>
            <a class="btn-secondary"><span>Read More</span></a>
            <h3>Radio Button</h3>
            <div>
                <label class="checkbox-container">One
                    <input type="radio" checked="checked" name="radio">
                    <span class="radio"></span>
                </label>
                <label class="checkbox-container">Two
                    <input type="radio" name="radio">
                    <span class="radio"></span>
                </label>
                <label class="checkbox-container">Three
                    <input type="radio" name="radio">
                    <span class="radio"></span>
                </label>
                <label class="checkbox-container">Four
                    <input type="radio" name="radio">
                    <span class="radio"></span>
                </label>
                <label class="checkbox-container checkbox-error">Error
                    <input type="radio" name="radio">
                    <span class="radio"></span>
                </label>
            </div>
            <h3>Checkbox</h3>
            <div>
                <label class="checkbox-container">One
                    <input type="checkbox" checked="checked" name="checkbox">
                    <span class="checkbox"></span>
                </label>
                <label class="checkbox-container">Two
                    <input type="checkbox" name="checkbox">
                    <span class="checkbox"></span>
                </label>
                <label class="checkbox-container">Three
                    <input type="checkbox" name="checkbox">
                    <span class="checkbox"></span>
                </label>
                <label class="checkbox-container">Four
                    <input type="checkbox" name="checkbox">
                    <span class="checkbox"></span>
                </label>
                <label class="checkbox-container checkbox-error">Error
                    <input type="checkbox" name="checkbox">
                    <span class="checkbox"></span>
                </label>
                <span class="checkbox-error-message">Can't be blank</span>
            </div>
        </div><!-- .content-wrapper -->
    </div><!-- .content -->
</body>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
<?php echo !WP_DEBUG ?: "<!-- End output from ".basename(__FILE__)."-->"; ?>