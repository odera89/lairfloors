<?php

class Lair_Image_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'lair_image_widget', // Base ID
			'Image', // Name
			array('description' => __('An Image Widget', 'lair'),) // Args
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

		$link = $instance['link'];
		?>

			<?php if (!empty($instance['title'])): ?>
				<?php echo $before_title.$instance['title'].$after_title ?>
			<?php endif ?>
			<div class="image">

				<?php if(!empty($link)): ?>
					<a class="" href="<?php echo $link ?>">
				<?php endif ?>

					<img src="<?php echo $instance['image_uri'] ?>" />

				<?php if(!empty($link)): ?>
					</a>
				<?php endif ?>
			</div><!-- .image -->
		<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	function form($instance) {

		/* Set up some default widget settings. */
		$defaults = array('title' => __(''), 'link' => __(''), 'image_uri' => __(''),);
		$instance = wp_parse_args((array) $instance, $defaults);

		?>

		<p>
			<label for="<?php echo $this->get_field_id('title') ?>">Title:</label>
			<input id="<?php echo $this->get_field_id('title') ?>" type="text" name="<?php echo $this->get_field_name('title') ?>" value="<?php echo $instance['title'] ?>" class="widefat" />
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
				function media_upload(button_class) {
					var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;
					jQuery('body').on('click', button_class, function(e) {
						var button_id ='#'+jQuery(this).attr('id');
						/* console.log(button_id); */
						var self = jQuery(this);
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = jQuery(button_id);
						// var id = button.attr('id').replace('_button', '');
						_custom_media = true;
						wp.media.editor.send.attachment = function(props, attachment){
							if (_custom_media) {
								self.siblings('.custom_media_id').val(attachment.id);
								self.siblings('.custom_media_url').val(attachment.url);
								self.siblings('.custom_media_image').attr('src', attachment.url).css('display', 'block');
							} else {
								return _orig_send_attachment.apply(button_id, [props, attachment]);
							}
						}
						wp.media.editor.open(button);
						return false;
					});
				}
				media_upload('.custom_media_upload');
			});
		</script>

	<?php
	}

	/**
	 * Update the widget settings.
	 */

	function update($new_instance, $old_instance) {
		$instance = array();

		$instance['title'] = $new_instance['title'];
		$instance['image_uri'] = $new_instance['image_uri'];
		$instance['link'] = $new_instance['link'];

		return $instance;
	}
}
