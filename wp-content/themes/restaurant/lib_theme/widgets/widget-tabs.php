<?php

// WIDGET CLASS
class Tabs_widget extends WP_Widget {

   function Tabs_widget() {
	//Constructor
	
		$widget_ops = array('classname' => 'widget tabs_widget', 'description' => 'Tabs widget containing the Popular posts, Latest Posts, Recent comments and a Tag cloud.' );
		$control_ops = array('width' => 400);
		$this->WP_Widget('widget_tabs_widget', 'Tabs', $widget_ops, $control_ops);
	}
 
	function widget($args, $instance) {
	    extract( $args );
		
		$args = array();

		$args['wid_number'] = $instance['wid_number']; 
		$args['wid_thumb'] = $instance['wid_thumb']; 
		$args['wid_trans1'] = $instance['wid_trans1'];
		$args['wid_trans2'] = $instance['wid_trans2'];
		$args['wid_trans3'] = $instance['wid_trans3'];
		$args['wid_trans4'] = $instance['wid_trans4'];
		
		echo $before_widget;
		
		?>

 		<div class="widtabs">
           
            <ul class="tabs clearfix">
                <li class="popular"><a href="#tab-pop"><?php _e($instance['wid_trans1']); ?></a></li>
                <li class="latest"><a href="#tab-latest"><?php _e($instance['wid_trans2']); ?></a></li>
                <li class="comments"><a href="#tab-comm"><?php _e($instance['wid_trans3']); ?></a></li>
                <li class="tags"><a href="#tab-tags"><?php _e($instance['wid_trans4']); ?></a></li>
            </ul>
            
            <div class="fix"></div>
            
            <div class="inside">
			
                <ul id="tab-pop" class="list">            
                    <?php if ( function_exists('bizz_tabs_popular') ) bizz_tabs_popular($instance['wid_number'], $instance['wid_thumb']); ?>                    
                </ul>
                <ul id="tab-latest" class="list">
                    <?php if ( function_exists('bizz_tabs_latest') ) bizz_tabs_latest($instance['wid_number'], $instance['wid_thumb']); ?>                    
                </ul>	
                <ul id="tab-comm" class="list">
                    <?php if ( function_exists('bizz_tabs_comments') ) bizz_tabs_comments($instance['wid_number'], $instance['wid_thumb']); ?>                    
                </ul>	
                <div id="tab-tags" class="list">
                    <?php wp_tag_cloud('smallest=12&largest=20'); ?>
                </div>
				
            </div><!-- /.inside -->
			
        </div><!-- /.widtabs -->
    
        <?php
		 
		echo $after_widget;
   }
   
   function update($new_instance, $old_instance) {
	//save the widget
	
		$instance = $old_instance;
		$instance['wid_number'] = strip_tags($new_instance['wid_number']);
		$instance['wid_thumb'] = strip_tags($new_instance['wid_thumb']);
		$instance['wid_trans1'] = strip_tags($new_instance['wid_trans1']);
		$instance['wid_trans2'] = strip_tags($new_instance['wid_trans2']);
		$instance['wid_trans3'] = strip_tags($new_instance['wid_trans3']);
		$instance['wid_trans4'] = strip_tags($new_instance['wid_trans4']);
 
		return $instance;
	}
 
	function form($instance) {
	//widgetform in backend
		
		//Defaults
		$defaults = array(
			'wid_number' => '5',
			'wid_thumb' => '35',  
			'wid_trans1' => 'Popular',
			'wid_trans2' => 'Latest',
			'wid_trans3' => 'Comments',
			'wid_trans4' => 'Tags'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		
	?>
	
		<p><label for="<?php echo $this->get_field_id('wid_number'); ?>">Total number of posts to show: <input class="widefat" id="<?php echo $this->get_field_id('wid_number'); ?>" name="<?php echo $this->get_field_name('wid_number'); ?>" type="text" value="<?php echo esc_attr($instance['wid_number']); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('wid_thumb'); ?>">Thumbnail Size (0=disable): <input class="widefat" id="<?php echo $this->get_field_id('wid_thumb'); ?>" name="<?php echo $this->get_field_name('wid_thumb'); ?>" type="text" value="<?php echo esc_attr($instance['wid_thumb']); ?>" /></label></p>
		<p>
			<label><span class="translate">Translations</span></label>
		</p>
		<p>
			<label class="tog"><b>Tab Name Translations</b>: </label>
			<input class="widefat spb tog" id="<?php echo $this->get_field_id('wid_trans1'); ?>" name="<?php echo $this->get_field_name('wid_trans1'); ?>" type="text" value="<?php echo esc_attr($instance['wid_trans1']); ?>" />
			<input class="widefat spb tog" id="<?php echo $this->get_field_id('wid_trans2'); ?>" name="<?php echo $this->get_field_name('wid_trans2'); ?>" type="text" value="<?php echo esc_attr($instance['wid_trans2']); ?>" />
			<input class="widefat spb tog" id="<?php echo $this->get_field_id('wid_trans3'); ?>" name="<?php echo $this->get_field_name('wid_trans3'); ?>" type="text" value="<?php echo esc_attr($instance['wid_trans3']); ?>" />
			<input class="widefat spb tog" id="<?php echo $this->get_field_id('wid_trans4'); ?>" name="<?php echo $this->get_field_name('wid_trans4'); ?>" type="text" value="<?php echo esc_attr($instance['wid_trans4']); ?>" />
		</p>
	        
	<?php
	
	}

}

// INITIATE WIDGET
register_widget('Tabs_widget');
