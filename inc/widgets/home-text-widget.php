<?php

class Lair_Home_Text_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'lair_home_text_widget', // Base ID
			'Home text', // Name
			array('description' => __('A home text widget', 'lair'),) // Args
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
		if (!empty($instance['title'])) {
			//echo '<div class="col-md-4"><h3 class="widget-title"><span>'.$instance['title'].'</span></h3></div>';
		}
		?>
		<div class="col-md-4"><div class="left_col"><?php echo wpautop(trim($instance['left_column'])) ?></div></div>
		<div class="col-md-8">
			<div class="text-content">
				<?php echo wpautop(trim($instance['text'])) ?>
			</div><!-- .text-content -->
		</div><!-- .col-md-8 -->

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
				<label for="<?php echo $this->get_field_name('left_column'); ?>"><?php _e('Left Column:'); ?></label>
			</div>
			<textarea class="widefat" name="<?php echo $this->get_field_name('left_column') ?>" id="<?php echo $this->get_field_id('left_column') ?>" rows="10"><?php echo stripslashes($instance['left_column']) ?></textarea>
		</p>
		<p>
			<div>
				<label for="<?php echo $this->get_field_name('text'); ?>"><?php _e('Text:'); ?></label>
			</div>
			<textarea class="widefat" name="<?php echo $this->get_field_name('text') ?>" id="<?php echo $this->get_field_id('text') ?>" rows="10"><?php echo stripslashes($instance['text']) ?></textarea>
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
		$instance['left_column'] = $new_instance['left_column'];
		$instance['text'] = $new_instance['text'];
		$instance['title'] = $new_instance['title'];

		return $instance;
	}

} // class Lair_Home text_Widget
