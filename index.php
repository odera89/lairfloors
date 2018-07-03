<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header() ?>
	
	<?php dynamic_sidebar('video') ?>
	
	<?php /*
	<div class="home-slider">
		<div class="slider">
			<?php dynamic_sidebar('slider') ?>

			<div class="slider-progress">
				<div class="completed"></div><!-- .completed -->
				<div class="slider-prev" data-slide="0"></div><!-- .slider-prev -->
				<div class="slider-next" data-slide="0"></div><!-- .slider-next -->
			</div>
		</div>
	</div>
	*/ ?>
	<div class="home-text">
		<div class="container">
			<?php dynamic_sidebar('home-text') ?>
		</div><!-- .container -->
	</div><!-- .home-text -->

	<?php /* ?>
	<div class="home-blue">
		<div class="container">
			<?php dynamic_sidebar('home-blue') ?>
		</div><!-- .container -->
	</div><!-- .home-blue -->*/ ?>

	<div class="home-products-list">
		<?php dynamic_sidebar('home-products'); ?>
	</div>

<?php
get_footer();
