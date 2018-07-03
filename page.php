<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header() ?>

<div id="main-content" class="main-content">

<?php
	if (is_front_page() && twentyfourteen_has_featured_posts()) {
		// Include the featured content template.
		get_template_part('featured-content');
	}
?>
	<div class="page-header-blue">
		<div class="blue-bar"></div><!-- .blue-bar -->
		<div class="container entry-header-wrapper <?php echo (has_post_thumbnail() ? 'page_has_header_img' : ''); ?>">
			<?php
				// Page thumbnail and title.
				twentyfourteen_post_thumbnail(1140, 300);
				the_title('<header class="entry-header clearfix"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->');
			?>
		</div><!-- .container -->
	</div><!-- .page-header-blue -->

	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-4">
				<div class="sidebar">
					<?php dynamic_sidebar('sidebar-1') ?>
				</div><!-- .sidebar -->
			</div><!-- .col-md-3 col-sm-4 -->
			<div class="col-md-9 col-sm-8">
				<div id="primary" class="content-area">
					<div id="content" class="site-content" role="main">

						<?php
							// Start the Loop.
							while (have_posts()): the_post();

								// Include the page content template.
								get_template_part('content', 'page');

								// If comments are open or we have at least one comment, load up the comment template.
								if (comments_open() || get_comments_number()) {
									comments_template();
								}
							endwhile;
						?>

					</div><!-- #content -->
				</div><!-- #primary -->
			</div><!-- .col-md-9 col-sm-8 -->
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- #main-content -->

<?php
get_footer();
