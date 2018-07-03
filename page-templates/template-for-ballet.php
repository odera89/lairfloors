<?php
/**
 * Template Name: Template for ballet
 *
 */

get_header() ?>

<div id="main-content" class="main-content template-for-ballet">

	<div class="container">
		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
				<div class="entry-title">
					<h1><?php the_title() ?></h1>
					<div class="middle"><?php echo get_post_meta(get_the_ID(), 'title_extra1', true) ?></div><!-- .middle -->
					<div class="bottom"><?php echo get_post_meta(get_the_ID(), 'title_extra2', true) ?></div><!-- .bottom -->
				</div><!-- .entry-title -->

				<div class="ballet-barre-colors">
					<div class="bbc-top"></div>
					<div class="bbc-bottom">
						<!-- <div class="text">Roll over to<br> view color</div> -->
						<?php dynamic_sidebar('ballet-colors'); ?>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="row">
					<div class="col-sm-3">
						<div class="sidebar product-sidebar">
							<?php dynamic_sidebar('product') ?>
						</div><!-- .sidebar product-sidebar -->
					</div><!-- .col-sm-3 -->
					<div class="col-sm-9">
						<div class="product-right-content">

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
						</div><!-- .product-right-content -->
					</div><!-- .col-sm-9 -->
				</div><!-- .row -->


			</div><!-- #content -->
		</div><!-- #primary -->
	</div><!-- .container -->
</div><!-- #main-content -->

<?php
get_footer();
