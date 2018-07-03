<?php

class Lair_Text_CSS_Class extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'lair_text_css_class', // Base ID
			'Text CSS Class', // Name
			array('description' => __('A text widget with css class input', 'lair'),) // Args
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
		<div class="<?php echo $instance['css_class']; ?>">
			<?php if (!empty($instance['title'])):
					echo $args['before_title'].$instance['title'].$args['after_title'];
				  endif;
				  echo wpautop(trim($instance['text']));
			?>
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
			<div>
				<label for="<?php echo $this->get_field_name('text'); ?>"><?php _e('Text:'); ?></label>
			</div>
			<textarea class="widefat" name="<?php echo $this->get_field_name('text') ?>" id="<?php echo $this->get_field_id('text') ?>" rows="10"><?php echo stripslashes($instance['text']) ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('css_class'); ?>">CSS Class:</label>
			<input id="<?php echo $this->get_field_id('css_class'); ?>" type="text" name="<?php echo $this->get_field_name('css_class'); ?>" value="<?php echo $instance['css_class']; ?>" class="widefat" />
		</p>


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
		$instance['text'] = $new_instance['text'];
		$instance['css_class'] = $new_instance['css_class'];

		return $instance;
	}

} // class Lair_Home blue_Widget
