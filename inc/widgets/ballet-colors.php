<?php

class Lair_Ballet_Colors extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'lair_ballet_colors', // Base ID
			'Ballet Colors', // Name
			array('description' => __('Ballet colors widget', 'lair'),) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance) {
		echo $args['before_widget'];
		?>
		
			<a href="#<?php echo $instance['bg_uri'];?>" title="<?php echo $instance['title']; ?>" class="barel_color" data-name="<?php echo $instance['title']; ?>" data-class="<?php echo sanitize_title($instance['title']); ?>">
				<img src="<?php echo $instance['image_uri']; ?>" alt="" />
				<span class="border_hover"></span>
				<span class="title"><?php echo $instance['title']; ?></span>
			</a>

			<!-- load the big images -->
			<div class="load-big-images"><img src="<?php echo $instance['bg_uri'];?>" alt="" /></div>


		<?php
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance) {
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id('title'); ?>" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('image_uri'.$i) ?>">Color preview <?php echo $i ?></label><br />
			<img class="custom_media_image" src="<?php if(!empty($instance['image_uri'.$i])){echo $instance['image_uri'.$i];} ?>" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" />
			<input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name('image_uri'.$i) ?>" id="<?php echo $this->get_field_id('image_uri'.$i) ?>" value="<?php echo $instance['image_uri'.$i] ?>">
			<input type="button" value="<?php _e('Upload Image', 'lair') ?>" class="button custom_media_upload" id="custom_image_uploader_<?php echo $this->get_field_id('image_uri'.$i) ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('bg_uri'.$i) ?>">Color on barel <?php echo $i ?></label><br />
			<img class="custom_media_image" src="<?php if(!empty($instance['bg_uri'.$i])){echo $instance['bg_uri'.$i];} ?>" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" />
			<input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name('bg_uri'.$i) ?>" id="<?php echo $this->get_field_id('bg_uri'.$i) ?>" value="<?php echo $instance['bg_uri'.$i] ?>">
			<input type="button" value="<?php _e('Upload Image', 'lair') ?>" class="button custom_media_upload_bg" id="custom_image_uploader_<?php echo $this->get_field_id('bg_uri'.$i) ?>"/>
		</p>



		<script type="text/javascript">
			jQuery(document).ready(function(){
				function media_upload(button_class) {
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
								self.siblings('.custom_media_id').val(attachment.id);
								self.siblings('.custom_media_url').val(attachment.url);
								self.siblings('.custom_media_image').attr('src',attachment.url).css('display','block');
							} else {
								return _orig_send_attachment.apply(button_id, [props, attachment]);
							}
						}
						wp.media.editor.open(button);
						return false;
					});
				}
				media_upload('.custom_media_upload');
				media_upload('.custom_media_upload_bg');
			});
		</script>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update($new_instance, $old_instance) {
		$instance = array();

		$instance['title'] = $new_instance['title'];
		$instance['image_uri'] = $new_instance['image_uri'];
		$instance['bg_uri'] = $new_instance['bg_uri'];

		return $instance;
	}

} // class Lair_Home blue_Widget
