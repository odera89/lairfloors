<?php

class Lair_Home_Product_List_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'lair_home_product_list_widget', // Base ID
			'Home Product', // Name
			array('description' => __('A home product widget', 'lair'),) // Args
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

		// set up bg
		if (!empty($instance['bg_uri'])):
			$bg = 'url('.$instance['bg_uri'].') repeat-x center top';
		else:
			$bg = '#FFF';
		endif;

		// set up img
		if (!empty($instance['image_uri'])):
			$img = '<img src="'.$instance['image_uri'].'" alt="'.$instance['title'].'" class="home-pl-image" />';
		else:
			$img = '';
		endif;

		?>
		<div class="home-product" style="background: <?php echo $bg; ?>; background-size: cover;">
			<div class="container">
				
				<div class="row">
					<?php if($instance['position'] == 'left') { ?>
						<div class="col-md-4 short-col">
							<?php 
								if (!empty($instance['link']) && !empty($instance['image_uri'])) {
									echo '<a href="'.$instance['link'].'"/>';
								}
								
								echo $img; 

								if (!empty($instance['link']) && !empty($instance['image_uri'])) {
									echo '</a>';
								}
							?>
						</div>
					<?php } ?>
					<div class="col-md-7 <?php echo ($instance['position'] == 'left' ? 'col-md-offset-1' : ''); ?> long-col" style="color: <?php echo $instance['color']; ?>">
						<?php if (!empty($instance['title'])):
								echo $args['before_title'].$instance['title'].$args['after_title'];
							  endif;
						?>
						<div class="text">
							<?php 
								echo wpautop(trim($instance['text']));

								if (!empty($instance['link'])):
								 	echo '<a href="'.$instance['link'].'" class="custom-btn-01" style="color:'.$instance['button_text_color'].'; background: '.$instance['color'].';" />'.$instance['button'].' <span>&rsaquo;</span></a>';
								endif;
							?>

						</div>
					</div>
					<?php if($instance['position'] == 'right' || $instance['position'] == '') { ?>
						<div class="col-md-4 col-md-offset-1 short-col">
							<?php 
								if (!empty($instance['link']) && !empty($instance['image_uri'])) {
									echo '<a href="'.$instance['link'].'"/>';
								}
								
								echo $img; 

								if (!empty($instance['link']) && !empty($instance['image_uri'])) {
									echo '</a>';
								}
							?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>


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
			<label for="<?php echo $this->get_field_id('bg_uri'.$i) ?>">Background <?php echo $i ?></label><br />
			<img class="custom_media_image" src="<?php if(!empty($instance['bg_uri'.$i])){echo $instance['bg_uri'.$i];} ?>" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" />
			<input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name('bg_uri'.$i) ?>" id="<?php echo $this->get_field_id('bg_uri'.$i) ?>" value="<?php echo $instance['bg_uri'.$i] ?>">
			<input type="button" value="<?php _e('Upload Image', 'lair') ?>" class="button custom_media_upload_bg" id="custom_image_uploader_<?php echo $this->get_field_id('bg_uri'.$i) ?>"/>
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
		<p>
			<label for="<?php echo $this->get_field_id('button'); ?>">Button:</label>
			<input id="<?php echo $this->get_field_id('button'); ?>" type="text" name="<?php echo $this->get_field_name('button'); ?>" value="<?php echo $instance['button']; ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('button_text_color'); ?>">Button Text Color:</label>
			<input id="<?php echo $this->get_field_id('button_text_color'); ?>" type="text" name="<?php echo $this->get_field_name('button_text_color'); ?>" value="<?php echo $instance['button_text_color']; ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('color'); ?>">Color:</label>
			<input id="<?php echo $this->get_field_id('color'); ?>" type="text" name="<?php echo $this->get_field_name('color'); ?>" value="<?php echo $instance['color']; ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('position'); ?>">Position:</label>
			<input id="<?php echo $this->get_field_id('position'); ?>" type="text" name="<?php echo $this->get_field_name('position'); ?>" value="<?php echo $instance['position']; ?>" class="widefat" />
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
		$instance['link'] = $new_instance['link'];
		$instance['image_uri'] = $new_instance['image_uri'];
		$instance['bg_uri'] = $new_instance['bg_uri'];
		$instance['text'] = $new_instance['text'];
		$instance['button'] = $new_instance['button'];
		$instance['button_text_color'] = $new_instance['button_text_color'];
		$instance['color'] = $new_instance['color'];
		$instance['position'] = $new_instance['position'];

		return $instance;
	}

} // class Lair_Home blue_Widget
