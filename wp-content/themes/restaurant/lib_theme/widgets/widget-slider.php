<?php

// WIDGET CLASS
class Bizz_Widget_Slider extends WP_Widget {

	/**
	 * Set up the widget's unique name, ID, class, description, and other options.
	 * @since 0.6
	 */
	function Bizz_Widget_Slider() {		
		$widget_ops = array( 'classname' => 'slider', 'description' => __( 'Displaying any of your posts inside slider.', 'bizzthemes' ) );
		$control_ops = array( 'width' => 550, 'height' => 350, 'id_base' => "widgets-reloaded-bizz-slider" );
		$this->WP_Widget( "widgets-reloaded-bizz-slider", __( 'Slider', 'bizzthemes' ), $widget_ops, $control_ops );
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 * @since 0.6
	 */
	function widget( $args, $instance ) {
		extract( $args );

		$args = array();

		$args['before'] = $instance['before'];
		$args['after'] = $instance['after'];
		
		$args['post_type'] = $instance['post_type'];
		$args['include'] = isset( $instance['include'] ) ? $instance['include'] : '';
		$args['exclude'] = isset( $instance['exclude'] ) ? $instance['exclude'] : '';
		$args['order'] = $instance['order'];
		$args['orderby'] = $instance['orderby'];
		$args['number'] = intval( $instance['number'] );
				
		$args['speed'] = $instance['speed'];
		$args['autoheight'] = isset( $instance['autoheight'] ) ? $instance['autoheight'] : false;
		$args['pagination'] = isset( $instance['pagination'] ) ? $instance['pagination'] : false;
		$args['slidetitle'] = isset( $instance['slidetitle'] ) ? $instance['slidetitle'] : false;
		$args['autoplay'] = $instance['autoplay'];
		
		$args['sliderheight'] = isset( $instance['sliderheight'] ) ? intval($instance['sliderheight']) : 300;
		
		$widget_id = preg_replace("/[^0-9\.]/", '', $widget_id);
		$widget_id = 'loopedSlider'.$widget_id;

		echo $before_widget;
		
		// get included slides		
		$count = 0;
		$slide_args = array(
		    'post_type'     => $args['post_type'],
			'include'       => $args['include'],
			'exclude'       => $args['exclude'],
			'order'         => $args['order'],
			'orderby'       => $args['orderby'],
			'numberposts'   => $args['number']
		); 
		$islide = get_posts( $slide_args );
		
		/* before widget */
		if ( !empty($instance['before']) )
			echo $instance['before'];

		/* widget title */
		$before_stitle = "\t\t\t<div class=\"slider-title\">\n";
		$after_stitle = "\t\t\t</div>\n";
		if ( $instance['title'] )
			echo $before_stitle . $before_title . apply_filters( 'widget_title',  $instance['title'], $instance, $this->id_base ) . $after_title . $after_stitle;
			
?>					
<div id="<?php echo $widget_id; ?>" class="clearfix loopedSlider flexslider loading">

    <div class="slider-inner slides" style="min-height:<?php echo stripslashes($args['sliderheight']); ?>px;">
<?php
	global $post;
	foreach ($islide as $post) {
		setup_postdata($post);
		$count++;
		if ( $post->post_type != 'revision' && $post->post_type != 'nav_menu_item' && $post->post_type != 'bizz_widget' && $post->post_type != 'bizz_grid' ){
			$hide_title = get_post_meta($post->ID, 'bizzthemes_hide_title', true);
?>
			<div id="slide-<?php echo $count; ?>" class="slide">
<?php
				if ( !$args['slidetitle'] && !$hide_title ){
?>
					<h3 class="stitle"><?php the_title(); ?></h3>
<?php
				}
?>
				<div class="format_text">
				<div class="fix"></div>
				<?php the_content(); ?>
				<div class="fix"></div>
				</div><!-- /.format_text -->
			</div><!-- /.slide -->
<?php					
		}
	}
?>
	</div><!-- /.slider-inner -->
	<input type="hidden" class="slider-id" name="slider-id" value="<?php echo $widget_id; ?>" />
	<input type="hidden" class="slider-speed" name="slider-speed" value="<?php echo $args['speed']; ?>" />
    <input type="hidden" class="slider-autoheight" name="slider-autoheight" value="<?php echo $args['autoheight']; ?>" />
    <input type="hidden" class="slider-pagination" name="slider-pagination" value="<?php echo $args['pagination']; ?>" />
	<input type="hidden" class="slider-autoplay" name="slider-autoplay" value="<?php echo $args['autoplay']; ?>" />
	
</div><!-- /#loopedSlider -->

<?php 
        if ( !empty($instance['after']) )
			echo $instance['after'];

		echo $after_widget;
	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 * @since 0.6
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $new_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['post_type'] = $new_instance['post_type'];
		if ( $instance['post_type'] !== $old_instance['post_type'] ) {
			$instance['include'] = array();
			$instance['exclude'] = array();
		}
		$instance['orderby'] = $new_instance['orderby'];
		$instance['order'] = $new_instance['order'];
		$instance['number'] = strip_tags( $new_instance['number'] );

		$instance['before'] = strip_tags( $new_instance['before'] );
		$instance['after'] = strip_tags( $new_instance['after'] );
		$instance['speed'] = strip_tags( $new_instance['speed'] );
		$instance['autoheight'] = ( isset( $new_instance['autoheight'] ) ? 1 : 0 );
		$instance['pagination'] = ( isset( $new_instance['pagination'] ) ? 1 : 0 );
		$instance['slidetitle'] = ( isset( $new_instance['slidetitle'] ) ? 1 : 0 );
		$instance['autoplay'] = strip_tags( $new_instance['autoplay'] );
		$instance['sliderheight'] = strip_tags( $new_instance['sliderheight'] );

		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 * @since 0.6
	 */
	function form( $instance ) {

		//Defaults
		$defaults = array(
			'title' => '',
			'before' => '',
			'after' => '',
			'post_type' => 'bizz_slider',
			'include' => '',
			'exclude' => '',
			'order' => 'DESC',
			'orderby' => 'date',
			'number' => 5,
			'speed' => 7000,
			'autoheight' => true,
			'pagination' => false,
			'slidetitle' => false,
			'autoplay' => false,
			'sliderheight' => '300'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$post_types = get_post_types('','names');
		$posts = get_posts( array( 'post_type' => $instance['post_type'], 'post_status' => 'publish', 'post_mime_type' => '', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => -1 ) );

		$num_array['0'] = 'Disable';
		for ($i = 500; $i <= 15000; $i += 500){
			$num_array[$i] = $i.' ms';
		}
		$order = array( 'ASC' => __( 'Ascending', 'bizzthemes' ), 'DESC' => __( 'Descending', 'bizzthemes' ) );
		$orderby = array(
		    'author' => __( 'Author', 'bizzthemes' ), 
			'category' => __( 'Category', 'bizzthemes' ),
			'content' => __( 'Content', 'bizzthemes' ),
			'date' => __( 'Date', 'bizzthemes' ),
			'ID' => __( 'ID', 'bizzthemes' ),
			'menu_order' => __( 'Menu order', 'bizzthemes' ),
			'mime_type' => __( 'Mime type (attachments)', 'bizzthemes' ),
			'modified' => __( 'Modified date', 'bizzthemes' ),
			'name' => __( 'Name', 'bizzthemes' ),
			'parent' => __( 'Parent ID', 'bizzthemes' ),
			'rand' => __( 'Randomly', 'bizzthemes' ),
			'status' => __( 'Status', 'bizzthemes' ),
			'title' => __( 'Title', 'bizzthemes' ),
			'category' => __( 'Category', 'bizzthemes' ),
		);
		
?>

		<div class="bizz-widget-controls columns-3">
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'bizzthemes' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<small class="section">Select Slides</small>
		<p>
			<label for="<?php echo $this->get_field_id( 'post_type' ); ?>">Post Type</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>">
				<option value="any" <?php selected( $instance['post_type'], 'any' ); ?>>All post types</option>
<?php 
				foreach ( $post_types as $post_type ) { 
				    if ( $post_type != 'revision' && $post_type != 'nav_menu_item' && $post_type != 'bizz_widget' && $post_type != 'bizz_grid' ){
?>
					<option value="<?php echo $post_type; ?>" <?php selected( $instance['post_type'], $post_type ); ?>><?php echo $post_type; ?></option>
<?php
				    }
				}
?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'include' ); ?>">Include slides</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'include' ); ?>" name="<?php echo $this->get_field_name( 'include' ); ?>[]" size="4" multiple="multiple">
<?php 
				foreach ( $posts as $post ) {
				    if ( $post->post_type != 'revision' && $post->post_type != 'nav_menu_item' && $post->post_type != 'bizz_widget' && $post->post_type != 'bizz_grid' ){
?>
					<option value="<?php echo $post->ID; ?>" <?php echo ( in_array( $post->ID, (array) $instance['include'] ) ? 'selected="selected"' : '' ); ?>><?php echo esc_attr( $post->post_title ); ?></option>
<?php 
				    }
				} 
?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'exclude' ); ?>">Exclude slides</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'exclude' ); ?>" name="<?php echo $this->get_field_name( 'exclude' ); ?>[]" size="4" multiple="multiple">
<?php 
				foreach ( $posts as $post ) {
				    if ( $post->post_type != 'revision' && $post->post_type != 'nav_menu_item' && $post->post_type != 'bizz_widget' && $post->post_type != 'bizz_grid' ){
?>
					<option value="<?php echo $post->ID; ?>" <?php echo ( in_array( $post->ID, (array) $instance['exclude'] ) ? 'selected="selected"' : '' ); ?>><?php echo esc_attr( $post->post_title ); ?></option>
<?php 
				    }
				} 
?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'order' ); ?>">Order</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>">
				<?php foreach ( $order as $option_value => $option_label ) { ?>
					<option value="<?php echo $option_value; ?>" <?php selected( $instance['order'], $option_value ); ?>><?php echo $option_label; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>">Order by</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
				<?php foreach ( $orderby as $option_value => $option_label ) { ?>
					<option value="<?php echo $option_value; ?>" <?php selected( $instance['orderby'], $option_value ); ?>><?php echo $option_label; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">Limit (-1 removes the limit)</label>
			<input type="text" class="widefat code" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
		</p>
		</div>

		<div class="bizz-widget-controls columns-2 column-last">
		<small class="section">Slider Settings</small>
		<p>
			<label for="<?php echo $this->get_field_id( 'before' ); ?>">Before slider (any HTML)</label>
			<input type="text" class="widefat code" id="<?php echo $this->get_field_id( 'before' ); ?>" name="<?php echo $this->get_field_name( 'before' ); ?>" value="<?php echo $instance['before']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'after' ); ?>">After slider (any HTML)</label>
			<input type="text" class="widefat code" id="<?php echo $this->get_field_id( 'after' ); ?>" name="<?php echo $this->get_field_name( 'after' ); ?>" value="<?php echo $instance['after']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'sliderheight' ); ?>">Slider height (px)</label>
			<input type="text" class="widefat code" id="<?php echo $this->get_field_id( 'sliderheight' ); ?>" name="<?php echo $this->get_field_name( 'sliderheight' ); ?>" value="<?php echo $instance['sliderheight']; ?>" />
		</p>
		<small class="section">Animation Settings</small>
		<p>
			<label for="<?php echo $this->get_field_id( 'autoheight' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['autoheight'], true ); ?> id="<?php echo $this->get_field_id( 'autoheight' ); ?>" name="<?php echo $this->get_field_name( 'autoheight' ); ?>" /> <?php _e( 'Auto height adjustment?', 'bizzthemes'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'pagination' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['pagination'], true ); ?> id="<?php echo $this->get_field_id( 'pagination' ); ?>" name="<?php echo $this->get_field_name( 'pagination' ); ?>" /> <?php _e( 'Add pagination?', 'bizzthemes'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'slidetitle' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['slidetitle'], true ); ?> id="<?php echo $this->get_field_id( 'slidetitle' ); ?>" name="<?php echo $this->get_field_name( 'slidetitle' ); ?>" /> <?php _e( 'Hide slide titles?', 'bizzthemes'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'autoplay' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['autoplay'], true ); ?> id="<?php echo $this->get_field_id( 'autoplay' ); ?>" name="<?php echo $this->get_field_name( 'autoplay' ); ?>" /> <?php _e( 'Auto play?', 'bizzthemes'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'speed' ); ?>">Sliding speed</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'speed' ); ?>" name="<?php echo $this->get_field_name( 'speed' ); ?>">
				<?php foreach ( $num_array as $option_value => $option_label ) { ?>
					<option value="<?php echo $option_value; ?>" <?php selected( $instance['speed'], $option_value ); ?>><?php echo $option_label; ?></option>
				<?php } ?>
			</select>
		</p>
		</div>
		<div style="clear:both;">&nbsp;</div>
	<?php
	}
}

// INITIATE WIDGET
register_widget( 'Bizz_Widget_Slider' );