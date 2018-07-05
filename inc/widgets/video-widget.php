<?php

class Lair_Video_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'lair_video_widget', // Base ID
			'Video', // Name
			array('description' => __('A Video Widget', 'lair'),) // Args
		);
	}

	/**
	 * How to display the widget on the screen.
	 */

	function widget($args, $instance) {

		extract($args);

		/* Before widget (defined by themes). */
		echo $before_widget;
		/* Display the widget title if one was input (before and after defined by themes). */
		static $contor ;
		if (!isset($contor)) {
			$contor = 1;
		} else {
			$contor++;
		}
		$link = $instance['link'];
		?>
			<!-- <div style="width: 100%; height: 800px;" data-vide-bg="mp4: <?php // echo $instance['video_uri'] ?>, poster: <?php echo $instance['image_uri'] ?>" data-vide-options="posterType: jpg, loop: false, muted: false, position: 0% 0%"></div> -->

			<div class="video-container">
				<video poster="<?php echo $instance['image_uri'] ?>" autoplay muted loop class="vidbacking">
					<source src="<?php echo $instance['video_uri'] ?>" type="video/mp4">
				</video>
				<div class="content">
					<div class="inner-content">
						<ul id="video-slideshow">
						<?php echo nl2br($instance['text']) ?>
						</ul>
					</div>
				</div>
			</div>


			<?php /*
			<div class="slide">
				<?php if ($contor == 1): ?>
					<div class="cod_slide_bg"></div>
				<?php endif ?>
				<div class="img" style="background-image: url('<?php echo $instance['image_uri'] ?>')"></div><!-- .img -->

				<?php if (!empty($instance['text'])): ?>
					<div class="container caption-wrapper">
						<div class="caption col-md-5 col-md-offset-7">
							<?php echo nl2br($instance['text']) ?>
						</div><!-- .caption -->
					</div><!-- .caption-wrapper -->
				<?php endif ?>


				<?php if(!empty($link)): ?>
					<a class="" href="<?php echo $link ?>">
				<?php endif ?>
				<?php if(!empty($link)): ?>
					</a>
				<?php endif ?>
			</div>
			*/ ?>
			<!-- .slide -->
		<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	function form($instance) {

		/* Set up some default widget settings. */
		# $defaults = array('title' => __(''), 'link' => __(''), 'image_uri' => __(''),);
		# $instance = wp_parse_args((array) $instance, $defaults);

		?>

		<p>
			<label for="<?php echo $this->get_field_id('text') ?>">Text:</label>
			<textarea class="widefat" name="<?php echo $this->get_field_name('text') ?>" id="<?php echo $this->get_field_id('text') ?>" rows="8"><?php echo stripslashes($instance['text']) ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('video_uri'.$i) ?>">Video URL <?php echo $i ?></label><br />
			<video width="400" controls><source src="<?php if(!empty($instance['video_uri'.$i])){echo $instance['video_uri'.$i];} ?>" type="video/mp4" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block">Your browser does not support HTML5 video.</video>

			<input type="text" class="widefat custom_media_video_url" name="<?php echo $this->get_field_name('video_uri'.$i) ?>" id="<?php echo $this->get_field_id('video_uri'.$i) ?>" value="<?php echo $instance['video_uri'.$i] ?>">
			<input type="button" value="<?php _e('Upload Video', 'lair') ?>" class="button custom_media_upload_video" id="custom_image_uploader_<?php echo $this->get_field_id('video_uri'.$i) ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('image_uri'.$i) ?>">Image <?php echo $i ?></label><br />
			<img class="custom_media_image" src="<?php if(!empty($instance['image_uri'.$i])){echo $instance['image_uri'.$i];} ?>" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" />
			<input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name('image_uri'.$i) ?>" id="<?php echo $this->get_field_id('image_uri'.$i) ?>" value="<?php echo $instance['image_uri'.$i] ?>">
			<input type="button" value="<?php _e('Upload Image', 'lair') ?>" class="button custom_media_upload" id="custom_image_uploader_<?php echo $this->get_field_id('image_uri'.$i) ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('link'.$i) ?>">Link <?php echo $i ?>:</label>
			<input id="<?php echo $this->get_field_id('link'.$i) ?>" type="text" name="<?php echo $this->get_field_name('link'.$i) ?>" value="<?php echo $instance['link'.$i] ?>" class="widefat" />
		</p>


		<script type="text/javascript">
			jQuery(document).ready(function(){
				function media_upload(button_class, video=false) {
					var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;

					jQuery('body').on('click',button_class, function(e) {
						var button_id ='#'+jQuery(this).attr('id');
						/* console.log(button_id); */
						var self = jQuery(this);
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = jQuery(button_id);
						// var id = button.attr('id').replace('_button', '');
						_custom_media = true;
						wp.media.editor.send.attachment = function(props, attachment){
							if (_custom_media ) {
								if(!video) {
									self.siblings('.custom_media_id').val(attachment.id);
									self.siblings('.custom_media_url').val(attachment.url);
									self.siblings('.custom_media_image').attr('src',attachment.url).css('display','block');
								} else {
									self.siblings('.custom_media_video_url').val(attachment.url);
									self.siblings('.custom_media_video').attr('src',attachment.url).css('display','block');
								}
							} else {
								return _orig_send_attachment.apply(button_id, [props, attachment]);
							}
						}
						wp.media.editor.open(button);
						return false;
					});
				}
				media_upload('.custom_media_upload');
				media_upload('.custom_media_upload_video', true);
			});
		</script>

	<?php
	}

	/**
	 * Update the widget settings.
	 */

	function update($new_instance, $old_instance) {
		$instance = array();

		$instance['text'] = $new_instance['text'];
		$instance['video_uri'] = $new_instance['video_uri'];
		$instance['image_uri'] = $new_instance['image_uri'];
		$instance['link'] = $new_instance['link'];

		return $instance;
	}
}
