<?php

// WIDGET CLASS
class Bizz_Widget_Menu extends WP_Widget {

	/**
	 * Set up the widget's unique name, ID, class, description, and other options.
	 * @since 0.6
	 */
	function Bizz_Widget_Menu() {		
		$widget_ops = array( 'classname' => 'menu', 'description' => __( 'Display your menu items.', 'bizzthemes' ) );
		$control_ops = array( 'width' => 550, 'height' => 350, 'id_base' => "widgets-reloaded-bizz-menu" );
		$this->WP_Widget( "widgets-reloaded-bizz-menu", __( 'Restaurant Menu', 'bizzthemes' ), $widget_ops, $control_ops );
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 * @since 0.6
	 */
	function widget( $args, $instance ) {
		extract( $args );
		
		global $wp_version;

		$args = array();
		
		$args['include'] = isset( $instance['include'] ) ? $instance['include'] : '';
		$args['exclude'] = isset( $instance['exclude'] ) ? $instance['exclude'] : '';
		$args['order'] = $instance['order'];
		$args['orderby'] = $instance['orderby'];
		$args['number'] = $instance['number'];
		$args['parent'] = 0;
		
		$number_meal = (isset($instance['number_meal']) && $instance['number_meal'] != '') ? $instance['number_meal'] : '-1';;
		$menu_columns = $instance['menu_columns'];
		
		$menu_currency = (isset($instance['menu_currency']) && $instance['menu_currency'] != '') ? $instance['menu_currency'] : '$';
		$enable_decimal = (isset( $instance['enable_decimal'] )) ? $instance['enable_decimal'] : false;
		$enable_viewmore = isset( $instance['enable_viewmore'] ) ? $instance['enable_viewmore'] : false;
		$text_viewmore = (isset($instance['text_viewmore']) && $instance['text_viewmore'] != '') ? $instance['text_viewmore'] : 'View more';
		$enable_descriptions = isset( $instance['enable_descriptions'] ) ? $instance['enable_descriptions'] : false;
		$thumb_selflink = isset( $instance['thumb_selflink'] ) ? $instance['thumb_selflink'] : false;
		$thumb_width = intval( $instance['thumb_width'] );
		$thumb_height = intval( $instance['thumb_height'] );
		$thumb_cropp = $instance['thumb_cropp'];
		$error_message = $instance['error_message'];
		
		$widget_id = preg_replace("/[^0-9\.]/", '', $widget_id);
		$widget_id = 'menu'.$widget_id;

		echo $before_widget;
		
		/* MENU OUTPUT: start */
		/*------------------------------------------------------------------*/
		
		echo "<div id=\"menu_area_" . preg_replace("/[^0-9\.]/", '', $widget_id) . "\" class=\"menu_area\">\n";
				
		// menu pdf
		if ( isset($instance['menu_pdf']) && $instance['menu_pdf'] != '' )
			echo '<a href="'.$instance['menu_pdf'].'" class="pdf-menu">Download PDF</a>';

		// widget title
		if ( $instance['title'] )
			echo $before_title . apply_filters( 'widget_title',  $instance['title'], $instance, $this->id_base ) . $after_title;

		$terms = get_terms( 'menutype', $args );
		if ( $terms ) :
		$post_count = 0;	
		foreach ($terms as $term){
					
			// query_posts('post_type=bizz_menu&menutype='.$term->slug);
			$category_link = get_term_link( $term, 'menutype' );  
			
			$post_count++;
			
			// post container
			($post_count % $menu_columns) ? $e_o = '' : $e_o = ' last';
			echo "\t\t\t<div class=\"menu-type bsize-" . $menu_columns . $e_o ."\" id=\"post-" . get_the_ID() . "\">\n"; #wp
			
			// menu table
			echo "\t\t\t\t<table>\n";
?>				
			    <!-- MENU HEAD: start -->
				<thead><tr><th colspan="3">
				<h2>
<?php 
					echo $term->name; 
					if ($term->description != '') { 
?>
						<span class="asterix"><a href="#asterisk-<?php echo $widget_id; ?>-<?php echo $post_count; ?>">&#42;</a></span>
<?php 
					}
					if ($enable_viewmore) {
?>
					<span class="more-link">
						<a href="<?php echo $category_link; ?>" title="More"><?php echo $text_viewmore; ?></a>
					</span>
<?php 
					}
?>
				</h2>
				</th></tr></thead>
				<!-- MENU HEAD: end -->
<?php 
				if ($term->description != '') { 
?>
					<!-- MENU FOOT: start -->
					<tfoot>
						<tr class="cat-info">
							<td  colspan="3"><span id="asterisk-<?php echo $widget_id; ?>-<?php echo $post_count; ?>"></span><?php echo $term->description; ?> &#42;</td>
						</tr>
					</tfoot>
					<!-- MENU FOOT: end -->
<?php 
				} 
?>
				<!-- MENU BODY: start -->
				<tbody>
<?php 
					$query_args = array( 'post_type' => 'bizz_menu', 'menutype' => $term->slug, 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => $number_meal );					
					$the_query = new WP_Query($query_args);
					if ($the_query->have_posts()) : $count = 0;
					while ($the_query->have_posts()) : $the_query->the_post();
						global $post; 
						$postid = get_the_ID();
						$price = get_post_meta($postid,'bizzthemes_price',true);
						$meal_price = ($enable_decimal) ? number_format((double)$price , 2 , '.', ',') : $price;
						$meal_tprice = ( !empty($price) ) ? '<td>'.$menu_currency.$meal_price.'</td>' : '';
						$price2 = get_post_meta($postid,'bizzthemes_price2',true);
						$meal_price2 = ($enable_decimal) ? number_format((double)$price2 , 2 , '.', ',') : $price2;
						$meal_tprice2 = ( !empty($price2) ) ? '<td>'.$menu_currency.$meal_price2.'</td>' : '';
						$price3 = get_post_meta($postid,'bizzthemes_price3',true);
						$meal_price3 = ($enable_decimal) ? number_format((double)$price3 , 2 , '.', ',') : $price3;
						$meal_tprice3 = ( !empty($price3) ) ? '<td>'.$menu_currency.$meal_price3.'</td>' : '';
						$meal_size = get_post_meta($postid,'bizzthemes_size',true);
						$meal_tsize = ( !empty($meal_size) ) ? '<td>'.$meal_size.'</td>' : '';
						$meal_size2 = get_post_meta($postid,'bizzthemes_size2',true);
						$meal_tsize2 = ( !empty($meal_size2) ) ? '<td>'.$meal_size2.'</td>' : '';
						$meal_size3 = get_post_meta($postid,'bizzthemes_size3',true);
						$meal_tsize3 = ( !empty($meal_size3) ) ? '<td>'.$meal_size3.'</td>' : '';
						$pricing = htmlspecialchars('<table><tr>'.$meal_tsize.$meal_tsize2.$meal_tsize3.'</tr><tr>'.$meal_tprice.$meal_tprice2.$meal_tprice3.'</tr></table>');
						$img_link = bizz_image('return=true&width='.$thumb_width.'&height='.$thumb_height.'&class=thumbnail&cropp='.$thumb_cropp.'&selflink='.$thumb_selflink.'');
?>
						<tr id="meal-<?php echo $widget_id; ?>-<?php echo $postid; ?>-<?php echo $count; ?>">
							<td class="image"><?php echo $img_link; ?></td>
							<td class="details">
								<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
								<?php if ($enable_descriptions) { echo apply_filters('bizz_menu_desc', get_the_excerpt()); } ?>
							</td>
							<td class="price">
								<?php echo apply_filters('meal_price', '<a href="'.get_permalink().'" class="pricing" data-html="true" title="'.$pricing.'">'.$menu_currency.$meal_price.'</a><br />'); ?>
							</td>
						</tr>
<?php 
					$count++;
					endwhile; endif;
					wp_reset_query();
?>
				</tbody>
				<!-- MENU BODY: end -->			
<?php				
			echo "\t\t\t\t</table>\n";
			echo "\t\t\t\t</div>\n";
			
			if ($e_o != '')
				echo "\t\t\t\t<div class='single-sep fix'><!----></div>\n";
			
		}
		
		else :
			echo $error_message;
		endif;
		
		echo "</div>\n";
		
		/* MENU OUTPUT: end */
		/*------------------------------------------------------------------*/
		
		echo $after_widget;
		
	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 * @since 0.6
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance = $new_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['orderby'] = $new_instance['orderby'];
		$instance['order'] = $new_instance['order'];
		$instance['number'] = strip_tags( $new_instance['number'] );
		$instance['number_meal'] = strip_tags( $new_instance['number_meal'] );
		$instance['menu_columns'] = $new_instance['menu_columns'];
		$instance['menu_pdf'] = strip_tags( $new_instance['menu_pdf'] );
		$instance['menu_currency'] = strip_tags( $new_instance['menu_currency'] );
		$instance['enable_decimal'] = ( isset( $new_instance['enable_decimal'] ) ? 1 : 0 );
		$instance['enable_viewmore'] = ( isset( $new_instance['enable_viewmore'] ) ? 1 : 0 );
		$instance['text_viewmore'] = strip_tags( $new_instance['text_viewmore'] );
		$instance['enable_descriptions'] = ( isset( $new_instance['enable_descriptions'] ) ? 1 : 0 );
		$instance['thumb_selflink'] = ( isset( $new_instance['thumb_selflink'] ) ? 1 : 0 );
		$instance['thumb_width'] = strip_tags( $new_instance['thumb_width'] );
		$instance['thumb_height'] = strip_tags( $new_instance['thumb_height'] );
		$instance['thumb_cropp'] = $new_instance['thumb_cropp'];
		$instance['error_message'] = strip_tags( $new_instance['error_message'] );

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
			'include' => array(),
			'exclude' => array(),
			'order' => 'DESC',
			'orderby' => 'name',
			'number' => 10,
			'number_meal' => 5,
			'menu_columns' => 1,
			'menu_pdf' => '',
			'menu_currency' => '$',
			'enable_decimal' => true,
			'enable_viewmore' => false,
			'text_viewmore' => 'View more',
			'enable_descriptions' => true,
			'thumb_selflink' => true,
			'thumb_width' => 70,
			'thumb_height' => 70,
			'thumb_cropp' => 'c',
			'error_message' => __( 'Apologies, but no results were found.', 'bizzthemes' )
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$terms = get_terms( 'menutype', 'parent=0' );
		$number_posts = array("0","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20");
		$thumb_cropp = array("c" => "Center", "t" => "Top", "tr" => "Top Right", "tl" => "Top Left", "b" => "Bottom", "bl" => "Bottom Left", "br" => "Bottom Right", "l" => "Left", "r" => "Right");
		$menu_columns = array("1" => "One Column", "2" => "Two Columns", "3" => "Three Columns");
		$order = array( 'ASC' => __( 'Ascending', 'bizzthemes' ), 'DESC' => __( 'Descending', 'bizzthemes' ) );
		$orderby = array( 'count' => __( 'Count', 'bizzthemes' ), 'ID' => __( 'ID', 'bizzthemes' ), 'name' => __( 'Name', 'bizzthemes' ), 'slug' => __( 'Slug', 'bizzthemes' ), 'term_group' => __( 'Term Group', 'bizzthemes' ) );
		
?>

		<div class="bizz-widget-controls columns-3">
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'bizzthemes' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<small class="section">Select Menu Items</small>
		<p>
			<label for="<?php echo $this->get_field_id( 'include' ); ?>">Include</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'include' ); ?>" name="<?php echo $this->get_field_name( 'include' ); ?>[]" size="4" multiple="multiple">
<?php 
				foreach ( $terms as $term ) {
?>
					<option value="<?php echo $term->term_id; ?>" <?php echo ( in_array( $term->term_id, (array) $instance['include'] ) ? 'selected="selected"' : '' ); ?>><?php echo esc_attr( $term->name ); ?></option>
<?php 
				} 
?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'exclude' ); ?>">Exclude</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'exclude' ); ?>" name="<?php echo $this->get_field_name( 'exclude' ); ?>[]" size="4" multiple="multiple">
<?php 
				foreach ( $terms as $term ) {
?>
					<option value="<?php echo $term->term_id; ?>" <?php echo ( in_array( $term->term_id, (array) $instance['exclude'] ) ? 'selected="selected"' : '' ); ?>><?php echo esc_attr( $term->name ); ?></option>
<?php 
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
		</div>
		
		<div class="bizz-widget-controls columns-3">
		<small class="section">Menu Display Options</small>
		<p>
			<label for="<?php echo $this->get_field_id( 'menu_columns' ); ?>">Columns?</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'menu_columns' ); ?>" name="<?php echo $this->get_field_name( 'menu_columns' ); ?>">
				<?php foreach ( $menu_columns as $option_value => $option_label ) { ?>
					<option value="<?php echo $option_value; ?>" <?php selected( $instance['menu_columns'], $option_value ); ?>><?php echo $option_label; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">Max number of terms</label>
			<input type="text" class="widefat code" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number_meal' ); ?>">Max number of meals per term</label>
			<input type="text" class="widefat code" id="<?php echo $this->get_field_id( 'number_meal' ); ?>" name="<?php echo $this->get_field_name( 'number_meal' ); ?>" value="<?php echo $instance['number_meal']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'menu_currency' ); ?>">Currency symbol</label>
			<input type="text" class="widefat code" id="<?php echo $this->get_field_id( 'menu_currency' ); ?>" name="<?php echo $this->get_field_name( 'menu_currency' ); ?>" value="<?php echo $instance['menu_currency']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'enable_decimal' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['enable_decimal'], true ); ?> id="<?php echo $this->get_field_id( 'enable_decimal' ); ?>" name="<?php echo $this->get_field_name( 'enable_decimal' ); ?>" /> <?php _e( 'Enable decimal points?', 'bizzthemes'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'enable_viewmore' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['enable_viewmore'], true ); ?> id="<?php echo $this->get_field_id( 'enable_viewmore' ); ?>" name="<?php echo $this->get_field_name( 'enable_viewmore' ); ?>" /> <?php _e( 'Enable View more link?', 'bizzthemes'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'text_viewmore' ); ?>"><?php _e( 'View More... text', 'bizzthemes' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'text_viewmore' ); ?>" name="<?php echo $this->get_field_name( 'text_viewmore' ); ?>" value="<?php echo $instance['text_viewmore']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'enable_descriptions' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['enable_descriptions'], true ); ?> id="<?php echo $this->get_field_id( 'enable_descriptions' ); ?>" name="<?php echo $this->get_field_name( 'enable_descriptions' ); ?>" /> <?php _e( 'Enable meal descriptions?', 'bizzthemes'); ?></label>
		</p>
		<p>
			<div class="wid_upload_wrap">
			    <label for="<?php echo $this->get_field_id( 'menu_pdf' ); ?>"><?php _e( 'Upload menu in PDF format:', 'bizzthemes' ); ?></label>
				<div class="wid_upload_button" id="<?php echo $this->get_field_id('menu_pdf'); ?>">Choose File</div>
			    <input type="text" class="widefat wid_upload_input" id="<?php echo $this->get_field_id('menu_pdf'); ?>" name="<?php echo $this->get_field_name('menu_pdf'); ?>" value="<?php echo $instance['menu_pdf']; ?>" />
			</div>
		</p>
		</div>

		<div class="bizz-widget-controls columns-3 column-last">
		<small class="section">Post Thumbnail Options</small>
		<p>
			<label for="<?php echo $this->get_field_id( 'thumb_selflink' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['thumb_selflink'], true ); ?> id="<?php echo $this->get_field_id( 'thumb_selflink' ); ?>" name="<?php echo $this->get_field_name( 'thumb_selflink' ); ?>" /> <?php _e( 'Link thumbnails to images?', 'bizzthemes'); ?></label>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'thumb_width' ); ?>">Thumbnail Width</label>
			<input type="text" class="widefat code" id="<?php echo $this->get_field_id( 'thumb_width' ); ?>" name="<?php echo $this->get_field_name( 'thumb_width' ); ?>" value="<?php echo $instance['thumb_width']; ?>" />
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'thumb_height' ); ?>">Thumbnail Height</label>
			<input type="text" class="widefat code" id="<?php echo $this->get_field_id( 'thumb_height' ); ?>" name="<?php echo $this->get_field_name( 'thumb_height' ); ?>" value="<?php echo $instance['thumb_height']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'thumb_cropp' ); ?>">Crop Position</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'thumb_cropp' ); ?>" name="<?php echo $this->get_field_name( 'thumb_cropp' ); ?>">
				<?php foreach ( $thumb_cropp as $option_value => $option_label ) { ?>
					<option value="<?php echo $option_value; ?>" <?php selected( $instance['thumb_cropp'], $option_value ); ?>><?php echo $option_label; ?></option>
				<?php } ?>
			</select>
		</p>
		<small class="section">Error Message</small>
		<p>
			<textarea class="widefat <?php echo $this->get_field_id('error_message'); ?>" id="<?php echo $this->get_field_id('error_message'); ?>" name="<?php echo $this->get_field_name('error_message'); ?>" type="text" cols="10" rows="3"><?php echo esc_attr($instance['error_message']); ?></textarea>
		</p>
		</div>
		<div style="clear:both;">&nbsp;</div>
	<?php
	}
}

// REGISTER WIDGET
register_widget( 'Bizz_Widget_Menu' );

/**
 * Make filter to allow offset with pagination
 */
function bizz_menu_post_limit($limit) {
	global $paged, $myoffset, $mypppage;
	if (empty($paged)) {
		$paged = 1;
	}
	$postperpage = intval($mypppage);
	$pgstrt = ((intval($paged) -1) * $postperpage) + $myoffset . ', ';
	$limit = 'LIMIT '.$pgstrt.$postperpage;
	return $limit;
} //end function my_post_limit