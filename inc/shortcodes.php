<?php

function lair_contact_details_shortcode($atts, $content) {
	ob_start();
	?>

	<span class="contact-details row">
		<span class="col-md-3 col-md-offset-3 col-sm-5 col-sm-offset-1">
			<?php if (is_array($atts) && array_key_exists('text', $atts)): ?>
				<span class="text"><strong><?php echo $atts['text'] ?></strong></span>
			<?php endif ?>
			<span class="phone-email">
				<?php if (is_array($atts) && array_key_exists('phone', $atts)): ?>
					<span class="phone"><?php echo $atts['phone'] ?></span>
				<?php endif ?>
				<?php if (is_array($atts) && array_key_exists('localphone', $atts)): ?>
					<span class="tel"><?php echo $atts['localphone'] ?></span>
				<?php endif ?>
				<?php if (is_array($atts) && array_key_exists('fax', $atts)): ?>
					<span class="fax"><?php echo $atts['fax'] ?></span>
				<?php endif ?>
				<?php if (is_array($atts) && array_key_exists('email', $atts)): ?>
					<a href="mailto:<?php echo urlencode($atts['email']) ?>" class="email"><?php echo $atts['email'] ?></a>
				<?php endif ?>

			</span><!-- .phone-email -->
		</span><!-- .col-md-3 col-md-offset-3 col-sm-5 col-sm-offset-1 -->

		<span class="col-md-6 col-sm-6">
			<span class="address"><?php echo nl2br(trim(preg_replace('/<br\s*\/?>/', '', $content))) ?></span><!-- .address -->

		</span><!-- .col-md-6 col-sm-6 -->
		<span class="col-sm-4 col-sm-offset-4 line"></span><!-- .col-sm-4 col-sm-offset-4 line -->

	</span><!-- .contact-details row -->
		<?php /* if (is_array($atts) && array_key_exists('fax', $atts) && array_key_exists('localphone', $atts)): ?>
			<span class="row">
				<span class="col-md-3 col-md-offset-3 col-sm-5 col-sm-offset-1">

						<strong>Local Phone: <?php echo $atts['localphone'] ?></strong>

					<!-- .phone-email -->
				</span><!-- .col-md-3 col-md-offset-3 col-sm-5 col-sm-offset-1 -->
				<span class="col-md-6 col-sm-6">
					<strong>Fax: <?php echo $atts['fax'] ?></strong>
				</span><!-- .col-md-6 col-sm-6 -->

			</span>

		<?php endif */?>

	<?php
	$ret = ob_get_clean();
	return $ret;
}
add_shortcode('contact-details', 'lair_contact_details_shortcode');


function lair_media_shortcode($atts, $content) {
	$extensions = array(
		'dwg',
		'doc',
		'pdf',
		'pic',
		'video'
	);

	ob_start();
	?>

	<span class="media-details clearfix">
		<span><?php echo $content ?></span>
		<span class="links pull-right clearfix">
			<?php foreach ($atts as $k => $v): if (false !== in_array($k, $extensions)) ?>
				<a class="<?php echo $k ?>" href="<?php echo $atts[$k] ?>" title="<?php echo $k ?>" target="_new">&nbsp;</a>
			<?php endforeach ?>
		</span><!-- .links -->
	</span><!-- .media-details clearfix -->

	<?php
	$ret = ob_get_clean();
	return $ret;
}
add_shortcode('media', 'lair_media_shortcode');


function lair_button_shortcode($atts, $content) {
	ob_start();
	?>

	<a class="button" <?php if (is_array($atts) && array_key_exists('link', $atts)): ?>href="<?php echo $atts['link'] ?>"<?php endif ?>><?php echo $content ?></a><!-- .button -->

	<?php
	$ret = ob_get_clean();
	return $ret;
}
add_shortcode('button', 'lair_button_shortcode');


function lair_grey_shortcode($atts, $content) {
	ob_start();
	?>

	<div class="gray">
		<?php echo $content ?>
	</div><!-- .gray -->

	<?php
	$ret = ob_get_clean();
	return $ret;
}
add_shortcode('grey', 'lair_grey_shortcode');


function lair_img_with_blue_shortcode($atts, $content) {
	ob_start();
	?>

	<?php if (is_array($atts) && array_key_exists('link', $atts)): ?>
		<a class="img-with-blue <?php echo $atts['class']; ?>" href="<?php echo $atts['link'] ?>">
	<?php else: ?>
		<span class="img-with-blue">
	<?php endif ?>
		<?php if (is_array($atts) && array_key_exists('text', $atts) && !empty($atts['text'])): ?>
			<span class="blue"><?php echo $atts['text'] ?></span>
		<?php endif ?>
		<?php if (is_array($atts) && array_key_exists('img', $atts)): ?>
			<img src="<?php echo $atts['img'] ?>" alt="" />
		<?php endif ?>
		<span class="text"><?php echo $content ?></span>
	<?php if (is_array($atts) && array_key_exists('link', $atts)): ?>
		</a>
	<?php else: ?>
		</span><!-- .img-with-blue -->
	<?php endif ?>

	<?php
	$ret = ob_get_clean();
	return $ret;
}
add_shortcode('img-with-blue', 'lair_img_with_blue_shortcode');

remove_shortcode('gallery');
add_shortcode('gallery', 'lair_gallery_shortcode');

function lair_gallery_shortcode($atts) {
	global $post;

	if (!empty($atts['ids'])) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		# if (empty($atts['orderby'])) {
		# 	$atts['orderby'] = 'post__in';
		# }
		$atts['include'] = $atts['ids'];
	}

	extract(shortcode_atts(array(
		'orderby' => 'menu_order ASC, ID ASC',
		'include' => '',
		'id' => $post->ID,
		'itemtag' => 'dl',
		'icontag' => 'dt',
		'captiontag' => 'dd',
		'columns' => 3,
		'size' => 'medium',
		'link' => 'file'
	), $atts));


	$args = array(
		'post_type' => 'attachment',
		'post_status' => 'inherit',
		'post_mime_type' => 'image',
		'orderby' => $orderby
	);

	if (!empty($include)) {
		$args['include'] = $include;
	} else {
		$args['post_parent'] = $id;
		$args['numberposts'] = -1;
	}

	$images = get_posts($args);

	ob_start();

	?>
	<div class="row">
		<div class="col-md-4">
			<ul class="lair-gallery-list">
				<?php $i=0; foreach ($images as $image): ?>
					<?php
						if($i==0) $first_img = $image;
						$description = !empty($image->post_content) ? $image->post_content : $image->post_title;
						$description = $image->post_title;
					?>

					<li class="lair-gallery-item <?php echo ($i==0) ? 'lair-gallery-item-current' : '' ?>"><a href="#gallery-img-<?php echo $image->ID ?>" title="<?php echo $image->post_content ?>"><?php echo $description ?></a></li><!-- .lair-gallery-item -->
				<?php
						$i++; endforeach ?>
			</ul><!-- .lair-gallery-list -->
		</div><!-- .col-md-4 -->
		<div class="col-md-8">
			<div id="gallery-main-pic">
				<?php echo wp_get_attachment_image($first_img->ID, 'lair-gallery-big'); 
				if (!empty($first_img->post_content)) {
					echo '<div class="project-desc">'.$first_img->post_content.'</div>';
				}
				?>
			</div>
			<div class="row">
				<div class="lair-gallery">
					<?php
					// echo '<pre>';
					// print_r($images);
					// // die('---end debug---');		
					// echo '</pre>';
					foreach ($images as $k => $image) {
						$caption = $image->post_excerpt;

						$description = $image->post_content;
						/*if ('' === $description) {
							$description = $image->post_title;
						}*/

						$image_alt = get_post_meta($image->ID, '_wp_attachment_image_alt', true);
					?>

					<div class="col-md-4 <?php if (0 === $k % 3): ?>gallery-item-clear<?php endif ?>">
						<div class="lair-gallery-item gallery-size-<?php echo $atts['columns'] ?>">
							<?php $img = wp_get_attachment_image_src($image->ID, 'lair-gallery-big') ?>
							<!--  data-lightbox="lair-gallery-<?php echo $id ?>" -->
							<a id="gallery-img-<?php echo $image->ID ?>"  href="<?php echo $img[0] ?>" title="<?php echo $description ?>"><?php echo wp_get_attachment_image($image->ID, $size) ?></a>
						</div><!-- .lair-gallery-item -->
					</div><!-- .col-md-4 -->

					<?php
					}
					?>
				</div><!-- .lair-gallery -->
			</div><!-- .row -->
		</div><!-- .col-md-8 -->
	</div><!-- .row -->


	<?php

	$ret = ob_get_clean();
	return $ret;

}

// HALF COLUMN
function col2_code( $atts, $content = null ) {
	return '<div class="col-md-6">' . "\n" . do_shortcode($content) . "\n" . '</div>';
}
add_shortcode('col2', 'col2_code');

// row
function row_code( $atts, $content = null ) {
	return '<div class="row">' . "\n" . do_shortcode($content) . "\n" . '</div>';
}
add_shortcode('row', 'row_code');

