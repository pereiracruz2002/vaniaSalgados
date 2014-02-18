<?php

/*

  FILE STRUCTURE:

- Custom Post Type icons
- Custom Post Type init
- Columns for post types
- Post type demo posts
- Custom Post Type Metabox Setup

*/

/* Custom Post Type icons */
/*------------------------------------------------------------------*/
function bizz_menus_post_types_icons() {
?>
	<style type="text/css" media="screen">
        #menu-posts-bizz_menu .wp-menu-image {
			background: url(<?php bloginfo('template_url') ?>/lib_theme/cpt/icons-menu.png) no-repeat 6px -17px !important;
		}
		#menu-posts-bizz_menu:hover .wp-menu-image, #menu-posts-bizz_menu.wp-has-current-submenu .wp-menu-image {
			background-position:6px 7px!important;
		}
    </style>
<?php 
}
add_action( 'admin_head', 'bizz_menus_post_types_icons' );

/* Custom Post Type init */
/*------------------------------------------------------------------*/
function bizz_menus_post_types_init() {

	register_post_type( 'bizz_menu',
        array(
        	'label' 				=> __('Menu Items'),
			'labels' 				=> array(	
				'name' 					=> __('Menu Items'),
				'singular_name' 		=> __('Menu Items'),
				'add_new' 				=> __('Add New'),
				'add_new_item' 			=> __('Add New Meal'),
				'edit' 					=> __('Edit'),
				'edit_item' 			=> __('Edit Meal'),
				'new_item' 				=> __('New Meal'),
				'view_item'				=> __('View Meal'),
				'search_items' 			=> __('Search Menu'),
				'not_found' 			=> __('No Meals found'),
				'not_found_in_trash' 	=> __('No Meals found in trash'),
				'parent' 				=> __('Parent Slide', 'bizzthemes' ),
			),
            'description' => __( 'This is where you can create new menus for your site.', 'bizzthemes' ),
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'hierarchical' => false,
            'rewrite' => array( 'slug' => 'menu', 'with_front' => false ),
            'query_var' => true,
            'has_archive' => 'menus',
            'supports' => array(	
				'title', 
				'editor', 
				'comments', 
				'page-attributes',
				'thumbnail'
			),
			'taxonomies' => array(	
				'menutype',
				'menutags'
			),
        )
    );
	
	// Register custom menutype taxonomy
	register_taxonomy( "menutype", 
		array(
			'bizz_menu'	
		), 
		array(	
			'hierarchical' 		=> true, 
			'label' 			=> 'Meal Categories', 
			'labels' 			=> array(	
				'name' 				=> __('Meal Categories'),
				'singular_name' 	=> __('Meal Category'),
				'search_items' 		=> __('Search Meal Categories'),
				'popular_items' 	=> __('Popular Meal Categories'),
				'all_items' 		=> __('All Meal Categories'),
				'parent_item' 		=> __('Parent Meal Category'),
				'parent_item_colon' => __('Parent Meal Category:'),
				'edit_item' 		=> __('Edit Meal Category'),
				'update_item'		=> __('Update Meal Category'),
				'add_new_item' 		=> __('Add New Meal Category'),
				'new_item_name' 	=> __('New Meal Category Name')	
			),  
			'public' 			=> true,
			'show_ui' 			=> true,
			'rewrite' 			=> array(
				'slug' => 'meal_cats'	
			)	
		)
	);
	
	// Register custom menutags taxonomy
	register_taxonomy( "menutags", 
		array(
			'bizz_menu'	
		), 
		array(	
			'hierarchical' 		=> false, 
			'label' 			=> 'Meal Tags', 
			'labels' 			=> array(	
				'name' 				=> __('Meal Tags'),
				'singular_name' 	=> __('Meal Tag'),
				'search_items' 		=> __('Search Meal Tags'),
				'popular_items' 	=> __('Popular Meal Tags'),
				'all_items' 		=> __('All Meal Tags'),
				'parent_item' 		=> __('Parent Meal Tag'),
				'parent_item_colon' => __('Parent Meal Tag:'),
				'edit_item' 		=> __('Edit Meal Tag'),
				'update_item'		=> __('Update Meal Tag'),
				'add_new_item' 		=> __('Add New Meal Tag'),
				'new_item_name' 	=> __('New Meal Tag Name')	
			),  
			'public' 			=> true,
			'show_ui' 			=> true,
			'rewrite' 			=> array(
				'slug' => 'meal_tags'	
			)	
		)
	);

}
add_action( 'init', 'bizz_menus_post_types_init' );

/* Columns for post types */
/*------------------------------------------------------------------*/
function bizz_menus_edit_columns($columns){
	$columns = array(
		"cb" 					=> "<input type=\"checkbox\" />",
		"title" 				=> "Meal Title",
		"bizz_menu_thumbnail" 	=> "Meal Thumbnail",
		"bizz_menu_price" 		=> "Meal Price",
		"bizz_menu_type" 		=> "Meal Category",
		"comments" 				=> '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>',
	);
	return $columns;
}
add_filter('manage_edit-bizz_menus_columns','bizz_menus_edit_columns');

function bizz_menus_custom_columns($column){
	global $post;
	switch ($column){
		case "bizz_menu_thumbnail":
			bizz_image('key=thumbnail&width=100&height=100&class=thumbnail');
		break;
		case "bizz_menu_price":
			$custom = get_post_custom();
			$price = $custom["bizzthemes_price"][0];
			$meal_price = number_format($price , 2 , '.', ',');
			
			$output = '';

			if (has_tag('special') ) { echo '<strong>'; _e('On Special', 'bizzthemes'); echo '</strong><br />'; }
			if ($price != '') { echo $meal_price; }
			
			break;
		case "bizz_menu_type":
			$menutypes = get_the_terms($post->ID, "menutype");
			$menutypes_html = array();
			if ($menutypes) {
				foreach ($menutypes as $menutype)
					array_push($menutypes_html, '<a href="' . get_term_link($menutype->slug, "menutype") . '">' . $menutype->name . '</a>');
				
				echo implode($menutypes_html, ", ");
			}
			else {
				_e('None', 'bizzthemes');;
			}
		break;
	}
}
add_action('manage_posts_custom_column', 'bizz_menus_custom_columns', 2);

/* Post type demo posts */
/*------------------------------------------------------------------*/
function bizz_menus_demo_posts() {
	
	if (get_option('bizz_install_complete') != 'true') {

		$menu_items = array(
			'starters'	=> 'Starters',
			'mains' 	=> 'Mains',
			'desserts' 	=> 'Desserts',
			'salads' 	=> 'Salads'
		);
		$taxonomy = 'menutype';
		//loop and create terms
		foreach ($menu_items as $key => $value) {
			$id = term_exists($key, $taxonomy);
			if ($id > 0) {
				update_option('bizz_'.$key.'_term_id',$id['term_id']);
			} 
			else {
				$term = wp_insert_term($value, $taxonomy);
				if ( !is_wp_error($term) ) {
					update_option('bizz_'.$key.'_term_id',$term['term_id']);
				}
			}
		}
		//installation complete
		update_option('bizz_install_complete', 'true');
	}
	
}
add_action( 'init', 'bizz_menus_demo_posts' );

/* Custom Post Type Metabox Setup */
/*------------------------------------------------------------------*/
add_filter( 'bizz_meta_boxes', 'bizz_menu_metaboxes' );
function bizz_menu_metaboxes( $meta_boxes ) {
	$prefix = 'bizzthemes_';
	
	$meta_boxes[] = array(
		'id' => 'bizzthemes_menu_meta',
		'title' => __('Menu Details', 'bizzthemes'),
		'pages' => array( 'bizz_menu' ), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => __('Meal Price', 'bizzthemes'),
				'desc' => __('Enter meal price without currency symbol.', 'bizzthemes'),
				'id' => $prefix . 'price',
				'type' => 'text_small'
			),
			array(
				'name' => __('Meal Size', 'bizzthemes'),
				'desc' => __('Enter meal size.', 'bizzthemes'),
				'id' => $prefix . 'size',
				'type' => 'text_small'
			),
			array(
				'name' => __('Meal Price 2', 'bizzthemes'),
				'desc' => __('Enter meal price without currency symbol.', 'bizzthemes'),
				'id' => $prefix . 'price2',
				'type' => 'text_small'
			),
			array(
				'name' => __('Meal Size 2', 'bizzthemes'),
				'desc' => __('Enter meal size.', 'bizzthemes'),
				'id' => $prefix . 'size2',
				'type' => 'text_small'
			),
			array(
				'name' => __('Meal Price 3', 'bizzthemes'),
				'desc' => __('Enter meal price without currency symbol.', 'bizzthemes'),
				'id' => $prefix . 'price3',
				'type' => 'text_small'
			),
			array(
				'name' => __('Meal Size 3', 'bizzthemes'),
				'desc' => __('Enter meal size.', 'bizzthemes'),
				'id' => $prefix . 'size3',
				'type' => 'text_small'
			),
		)
	);
		
	return $meta_boxes;
}

