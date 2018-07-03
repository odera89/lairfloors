<?php get_header() ?>

	<div class="page-header-blue">
		<div class="blue-bar"></div><!-- .blue-bar -->
		<div class="container">
			<header class="page-header">
				<h1 class="page-title">Accessories</h1>
			</header><!-- .page-header -->
		</div><!-- .container -->
	</div><!-- .page-header-blue -->

	<div class="container">
		<section id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

				<?php if (have_posts()): ?>

				<?php
						// Start the Loop.
						while (have_posts()): the_post();

							/*
							 * Include the post format-specific template for the content. If you want to
							 * use this in a child theme, then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							get_template_part('content', 'accessories');

						endwhile;
						// Previous/next page navigation.
						twentyfourteen_paging_nav();

					else:
						// If no content, include the "No posts found" template.
						get_template_part('content', 'none');

					endif;
				?>
			</div><!-- #content -->
		</section><!-- #primary -->
	</div><!-- .container -->

<?php
get_footer();
