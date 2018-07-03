<?php

class Lair_Home_Blue_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'lair_home_blue_widget', // Base ID
			'Home blue', // Name
			array('description' => __('A home blue widget', 'lair'),) // Args
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

		<div class="row">
			<div class="col-md-3">
				<div class="image-wrapper">
					<?php if (!empty($instance['link'])): ?>
						<a href="<?php echo $instance['link'] ?>">
					<?php endif ?>
						<?php if (!empty($instance['image_uri'])): ?>
							<img src="<?php echo $instance['image_uri'] ?>" alt="" title="" />
						<?php endif ?>
					<?php if (!empty($instance['link'])): ?>
						</a>
					<?php endif ?>
				</div><!-- .image-wrapper -->
			</div><!-- .col-md-3 -->
			<div class="col-md-9">
				<div class="blue-content-wrapper">

						<?php if (!empty($instance['title'])): ?>
							<?php echo $args['before_title'] ?>

							<?php if (!empty($instance['link'])): ?>
								<a href="<?php echo $instance['link'] ?>">
							<?php endif ?>

							<?php echo $instance['title'] ?>

							<?php if (!empty($instance['link'])): ?>
								</a>
							<?php endif ?>

							<?php echo $args['after_title'] ?>
						<?php endif ?>

					<div class="blue-content">
						<?php echo wpautop(trim($instance['text'])) ?>
					</div><!-- .blue-content -->
				</div><!-- .blue-content-wrapper -->
			</div><!-- .col-md-9 -->
		</div><!-- .row -->

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
			<label for="<?php echo $this->get_field_id('image_uri'.$i) ?>">Image <?php echo $i ?></label><br />
			<img class="custom_media_image" src="<?php if(!empty($instance['image_uri'.$i])){echo $instance['image_uri'.$i];} ?>" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" />
			<input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name('image_uri'.$i) ?>" id="<?php echo $this->get_field_id('image_uri'.$i) ?>" value="<?php echo $instance['image_uri'.$i] ?>">
			<input type="button" value="<?php _e('Upload Image', 'lair') ?>" class="button custom_media_upload" id="custom_image_uploader_<?php echo $this->get_field_id('image_uri'.$i) ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('link'); ?>">Link:</label>
			<input id="<?php echo $this->get_field_id('link'); ?>" type="text" name="<?php echo $this->get_field_name('link'); ?>" value="<?php echo $instance['link']; ?>" class="widefat" />
		</p>

		<p>
			<div>
				<label for="<?php echo $this->get_field_name('text'); ?>"><?php _e('Text:'); ?></label>
			</div>
			<textarea class="widefat" name="<?php echo $this->get_field_name('text') ?>" id="<?php echo $this->get_field_id('text') ?>" rows="10"><?php echo stripslashes($instance['text']) ?></textarea>
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
		$instance['link'] = $new_instance['link'];
		$instance['image_uri'] = $new_instance['image_uri'];
		$instance['text'] = $new_instance['text'];

		return $instance;
	}

} // class Lair_Home blue_Widget
