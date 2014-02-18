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
function bizz_slides_post_types_icons() {
?>
	<style type="text/css" media="screen">
        #menu-posts-bizz_slider .wp-menu-image, #menu-posts-bizzslider .wp-menu-image {
			background: url(<?php echo get_template_directory_uri() ?>/lib_theme/cpt/icons-slider.png) no-repeat 6px -17px !important;
		}
		#menu-posts-bizzslider:hover .wp-menu-image, #menu-posts-bizzslider.wp-has-current-submenu .wp-menu-image {
			background-position:6px 7px!important;
		}
    </style>
<?php 
}
add_action( 'admin_head', 'bizz_slides_post_types_icons' );

/* Custom Post Type init */
/*------------------------------------------------------------------*/
function bizz_slides_post_types_init() {

	register_post_type( 'bizz_slider',
        array(
        	'label' 				=> __('Slides', 'bizzthemes'),
			'labels' 				=> array(	
				'name' 					=> __('Slides', 'bizzthemes'),
				'singular_name' 		=> __('Slides', 'bizzthemes'),
				'add_new' 				=> __('Add New', 'bizzthemes'),
				'add_new_item' 			=> __('Add New Slide', 'bizzthemes'),
				'edit' 					=> __('Edit', 'bizzthemes'),
				'edit_item' 			=> __('Edit Slide', 'bizzthemes'),
				'new_item' 				=> __('New Slide', 'bizzthemes'),
				'view_item'				=> __('View Slide', 'bizzthemes'),
				'search_items' 			=> __('Search Slides', 'bizzthemes'),
				'not_found' 			=> __('No Slides found', 'bizzthemes'),
				'not_found_in_trash' 	=> __('No Slides found in trash', 'bizzthemes'),
				'parent' 				=> __('Parent Slide', 'bizzthemes' ),
			),
            'description' => __( 'This is where you can create new slides for your site.', 'bizzthemes' ),
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'hierarchical' => false,
            'rewrite' => array( 'slug' => 'slider', 'with_front' => false ),
            'query_var' => true,
            'has_archive' => 'slides',
            'supports' => array(	
				'title', 
				'editor',
				'revisions', 
				'page-attributes'	
			),
			'taxonomies' => array(	
				'slidertype',
				'slidertags'
			),
        )
    );
	
	// Register custom slidertype taxonomy
	register_taxonomy( "slidertype", 
		array(
			'bizz_slider'	
		), 
		array(	
			'hierarchical' 		=> true, 
			'label' 			=> 'Slide Categories', 
			'labels' 			=> array(	
				'name' 				=> __('Slide Categories'),
				'singular_name' 	=> __('Slide Category'),
				'search_items' 		=> __('Search Slide Categories'),
				'popular_items' 	=> __('Popular Slide Categories'),
				'all_items' 		=> __('All Slide Categories'),
				'parent_item' 		=> __('Parent Slide Category'),
				'parent_item_colon' => __('Parent Slide Category:'),
				'edit_item' 		=> __('Edit Slide Category'),
				'update_item'		=> __('Update Slide Category'),
				'add_new_item' 		=> __('Add New Slide Category'),
				'new_item_name' 	=> __('New Slide Category Name')	
			),  
			'public' 			=> true,
			'show_ui' 			=> true,
			'rewrite' 			=> array(
				'slug' => 'slide_cats'	
			)	
		)
	);
	
	// Register custom slidertags taxonomy
	register_taxonomy( "slidertags", 
		array(
			'bizz_slider'	
		), 
		array(	
			'hierarchical' 		=> false, 
			'label' 			=> 'Slide Tags', 
			'labels' 			=> array(	
				'name' 				=> __('Slide Tags'),
				'singular_name' 	=> __('Slide Tag'),
				'search_items' 		=> __('Search Slide Tags'),
				'popular_items' 	=> __('Popular Slide Tags'),
				'all_items' 		=> __('All Slide Tags'),
				'parent_item' 		=> __('Parent Slide Tag'),
				'parent_item_colon' => __('Parent Slide Tag:'),
				'edit_item' 		=> __('Edit Slide Tag'),
				'update_item'		=> __('Update Slide Tag'),
				'add_new_item' 		=> __('Add New Slide Tag'),
				'new_item_name' 	=> __('New Slide Tag Name')	
			),  
			'public' 			=> true,
			'show_ui' 			=> true,
			'rewrite' 			=> array(
				'slug' => 'slide_tags'	
			)	
		)
	);

}
add_action( 'init', 'bizz_slides_post_types_init' );

/* Columns for post types */
/*------------------------------------------------------------------*/
function bizz_slides_edit_columns($columns){
	$columns = array(
		"cb" 					=> "<input type=\"checkbox\" />",
		"title" 				=> "Slide Title",
		"bizz_slider_thumbnail" => "Slide Thumbnail",
		"bizz_slider_type" 		=> "Slide Category",
	);
	return $columns;
}
add_filter('manage_edit-bizz_slides_columns','bizz_slides_edit_columns');

function bizz_slides_custom_columns($column){
	global $post;
	switch ($column){
		case "bizz_slider_thumbnail":
			bizz_image('key=thumbnail&width=100&height=100&class=thumbnail');
		break;
		case "bizz_slider_type":
			$slidertypes = get_the_terms($post->ID, "slidertype");
			$slidertypes_html = array();
			if ($slidertypes) {
				foreach ($slidertypes as $slidertype)
					array_push($slidertypes_html, '<a href="' . get_term_link($slidertype->slug, "slidertype") . '">' . $slidertype->name . '</a>');
				
				echo implode($slidertypes_html, ", ");
			}
			else {
				_e('None', 'bizzthemes');
			}
		break;
	}
}
add_action('manage_posts_custom_column', 'bizz_slides_custom_columns', 2);

/* Post type demo posts */
/*------------------------------------------------------------------*/
function bizz_slides_demo_posts() {
	
	if (get_option('bizz_install_complete') != 'true') {

		// INSERT POSTS
		$demo_post = array(
				"post_title"	=>	'Slider Example 3',
				"post_status"	=>	'publish',
				"post_type"	    =>	'bizz_slider',
				"post_content"	=>	'
		At vero eos et accusamus et iusto odio dignissimos ducimus qui  blanditiis praesentium voluptatum deleniti atque corrupti quos dolores  et quas molestias excepturi sint occaecati cupiditate non provident,  similique sunt in culpa qui officia deserunt mollitia animi, id est  laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita  distinctio. Nam libero tempore, cum soluta nobis est eligendi optio  cumque nihil impedit quo minus id quod maxime placeat facere possimus,  omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem  quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet  ut et voluptates repudiandae sint et molestiae non recusandae. Itaque  earum rerum hic tenetur a sapiente delectus, ut aut reiciendis  voluptatibus maiores alias consequatur aut perferendis doloribus  asperiores repellat.
				'
		);
		wp_insert_post( $demo_post );
		
		$demo_post = array(
				"post_title"	=>	'Slider Example 2',
				"post_status"	=>	'publish',
				"post_type"	    =>	'bizz_slider',
				"post_content"	=>	'
		Id ius dicam aeterno. Et graece saperet euripidis eum, tota labores luptatum eum eu. Usu te brute volutpat, ex scripta intellegebat pro. An per dictas omnium fastidii. Cu nam percipit forensibus.

		Cu has erat idque democritum. Eu his meis numquam, his in bonorum eloquentiam. Meliore vivendum explicari ius ea. His te integre meliore adolescens, sonet dolorem scriptorem ius id.

		Dicit altera efficiendi an duo. Vis no libris bonorum lobortis, facete bonorum nec et, ne enim eruditi sea. Sed audiam debitis an, dicta putant malorum vix et. No quo quod tractatos reprehendunt, mea mundi mollis accumsan ex, inani vivendo signiferumque te sed. Est perpetua reprimique ex, at dicit choro suscipiantur pri, ei vidisse eloquentiam quo.
				'
		);
		wp_insert_post( $demo_post );
		
		$demo_post = array(
				"post_title"	=>	'Slider Example 1',
				"post_status"	=>	'publish',
				"post_type"	    =>	'bizz_slider',
				"post_content"	=>	'
		Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Quisque sed felis. Aliquam sit amet felis. Mauris semper, velit semper laoreet dictum, quam diam dictum urna, nec placerat elit nisl in quam.

		Etiam augue pede, molestie eget, rhoncus at,  convallis ut, eros. Aliquam pharetra. Nulla in tellus eget odio  sagittis blandit. Mauris semper, velit semper laoreet dictum, quam diam dictum urna, nec placerat elit nisl in quam.

		Dicit altera efficiendi an duo. Vis no libris bonorum lobortis, facete bonorum nec et, ne enim eruditi sea. Sed audiam debitis an, dicta putant malorum vix et. No quo quod tractatos reprehendunt, mea mundi mollis accumsan ex, inani vivendo signiferumque te sed. Est perpetua reprimique ex, at dicit choro suscipiantur pri, ei vidisse eloquentiam quo.
				'
		);
		wp_insert_post( $demo_post );
		
		//installation complete
		update_option('bizz_install_complete', 'true');
	}
	
}
add_action( 'init', 'bizz_slides_demo_posts' );

/* Custom Post Type Metabox Setup */
/*------------------------------------------------------------------*/
add_filter( 'bizz_meta_boxes', 'bizz_slider_metaboxes' );
function bizz_slider_metaboxes( $meta_boxes ) {
	$prefix = 'bizzthemes_';
	
	$meta_boxes[] = array(
		'id' => 'bizzthemes_slider_meta',
		'title' => __('Slide Details', 'bizzthemes'),
		'pages' => array( 'bizz_slider' ), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => __('Hide title', 'bizzthemes'),
				'desc' => __('Hide title for this slide', 'bizzthemes'),
				'id' => $prefix . 'hide_title',
				'type' => 'checkbox'
			),
		)
	);
		
	return $meta_boxes;
}

