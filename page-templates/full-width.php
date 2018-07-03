<?php
/**
 * Template Name: Full Width
 *
 */

get_header() ?>

<div id="main-content" class="main-content">

	<div class="page-header-blue">
		<div class="blue-bar"></div><!-- .blue-bar -->
		<div class="container entry-header-wrapper">
			<?php
				// Page thumbnail and title.
				twentyfourteen_post_thumbnail(1140, 300);
				the_title('<header class="entry-header clearfix"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->');
			?>
		</div><!-- .container -->
	</div><!-- .page-header-blue -->

	<div class="container">
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
	</div><!-- .container -->
</div><!-- #main-content -->

<?php
get_footer();
