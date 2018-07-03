<article id="post-<?php the_ID() ?>" <?php post_class() ?>>
	<?php if (has_post_thumbnail(get_the_ID())): ?>
		<div class="product-thumb" style="background-image: url('<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail'); echo $image[0] ?>')"></div>
	<?php endif ?>
		<div class="entry-title" <?php if (!has_post_thumbnail(get_the_ID())) {
			// echo 'style="margin-bottom:110px;"';
			echo 'style="margin-bottom:175px;"';
		} ?>>
			<h1><?php the_title() ?></h1>
			<div class="middle"><?php echo get_post_meta(get_the_ID(), 'title_extra1', true) ?></div><!-- .middle -->
			<div class="bottom"><?php echo get_post_meta(get_the_ID(), 'title_extra2', true) ?></div><!-- .bottom -->
		</div><!-- .entry-title -->
	<div class="row">
		<div class="col-sm-3">
			<div class="sidebar product-sidebar">
				<?php dynamic_sidebar('accessories') ?>
			</div><!-- .sidebar product-sidebar -->
		</div><!-- .col-sm-3 -->
		<div class="col-sm-9">
			<div class="product-right-content">
				<header class="entry-header">
					<?php if (in_array('category', get_object_taxonomies(get_post_type())) && twentyfourteen_categorized_blog()): ?>
					<div class="entry-meta">
						<span class="cat-links"><?php echo get_the_category_list(_x(', ', 'Used between list items, there is a space after the comma.', 'twentyfourteen')) ?></span>
					</div>
					<?php endif ?>

					<div class="entry-meta">
					</div><!-- .entry-meta -->
				</header><!-- .entry-header -->

				<?php if (is_search()): ?>
				<div class="entry-summary">
					<?php the_excerpt() ?>
				</div><!-- .entry-summary -->
				<?php else: ?>
				<div class="entry-content">
					<?php
						the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'twentyfourteen'));
						wp_link_pages(array(
							'before'      => '<div class="page-links"><span class="page-links-title">'.__('Pages:', 'twentyfourteen').'</span>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
						));
					?>
				</div><!-- .entry-content -->
				<?php endif ?>

				<?php the_tags('<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>') ?>
			</div><!-- .product-right-content -->
		</div><!-- .col-sm-9 -->
	</div><!-- .row -->
</article><!-- #post-## -->
