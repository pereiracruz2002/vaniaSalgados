<?php

/* LOAD and REGISTER ALL WIDGETS from WIDGETS FOLDER */
/*------------------------------------------------------------------*/
add_action( 'widgets_init', 'bizz_load_widgets' );
	
function bizz_load_widgets() {

	/* Load each widget file. */
	$preview_template = _preview_theme_template_filter();
	if(!empty($preview_template)){
		$bizz_widgets_dir = WP_CONTENT_DIR . "/themes/".$preview_template."/lib_theme/widgets/";
	}
	else {
    	$bizz_widgets_dir = WP_CONTENT_DIR . "/themes/".get_option('template')."/lib_theme/widgets/";
    }
    if (@is_dir($bizz_widgets_dir)) {
		$bizz_widgets_dh = opendir($bizz_widgets_dir);
		while (($bizz_widgets_file = readdir($bizz_widgets_dh)) !== false) {
			if(strpos($bizz_widgets_file,'.php') && $bizz_widgets_file != "widget-blank.php")
				include_once($bizz_widgets_dir . $bizz_widgets_file);
		}
		closedir($bizz_widgets_dh);
	}

}

/* REGISTER WIDGETIZED GRID */
/*------------------------------------------------------------------*/

if ( function_exists('bizz_register_grids') ){
	bizz_register_grids(array(
		'id' => 'header_area',
		'name' => 'Header Area',
		'container' => 'container_16',
		'show' => 'true',
		'grids' => array(
			'header_one' => array(
				'name' => __('Header 1', 'bizzthemes'),
				'class' => 'grid_4',
				'columns' => '3',
				'before_grid' => '',
				'after_grid' => '',
				'tree' => ''
			),
			'header_two' => array(
				'name' => __('Header 2', 'bizzthemes'),
				'class' => 'grid_9',
				'columns' => '7',
				'before_grid' => '',
				'after_grid' => '',
				'tree' => ''
			),
			'header_three' => array(
				'name' => __('Header 3', 'bizzthemes'),
				'class' => 'grid_3 last',
				'columns' => '2',
				'before_grid' => '',
				'after_grid' => '',
				'tree' => ''
			)
		)
	));
	bizz_register_grids(array(
		'id' => 'featured_area',
		'name' => 'Featured Area',
		'container' => 'container_12',
		'show' => 'true',
		'grids' => array(
			'featured_full' => array(
				'name' => __('Featured', 'bizzthemes'),
				'class' => 'grid_12',
				'before_grid' => '',
				'after_grid' => '',
				'tree' => ''
			)
		)
	));
	bizz_register_grids(array(
		'id' => 'main_area',
		'name' => 'Main Area',
		'container' => 'container_12',
		'show' => 'true',
		'grids' => array(
			'main_one' => array(
				'name' => __('Content', 'bizzthemes'),
				'class' => 'grid_8',
				'columns' => '8',
				'before_grid' => '',
				'after_grid' => '',
				'tree' => ''
			),
			'main_two' => array(
				'name' => __('Sidebar', 'bizzthemes'),
				'class' => 'grid_4 last',
				'columns' => '4',
				'before_grid' => '',
				'after_grid' => '',
				'tree' => ''
			)
		)
	));
	bizz_register_grids(array(
		'id' => 'footer_area',
		'name' => 'Footer Area',
		'container' => 'container_12',
		'show' => 'true',
		'grids' => array(
			'footer_one' => array(
				'name' => __('Footer 1', 'bizzthemes'),
				'class' => 'grid_4',
				'before_grid' => '',
				'after_grid' => '',
				'tree' => ''
			),
			'footer_two' => array(
				'name' => __('Footer 2', 'bizzthemes'),
				'class' => 'grid_4',
				'before_grid' => '',
				'after_grid' => '',
				'tree' => ''
			),
			'footer_three' => array(
				'name' => __('Footer 3', 'bizzthemes'),
				'class' => 'grid_4 last',
				'before_grid' => '',
				'after_grid' => apply_filters('bizz_footer_logo', bizz_footer_branding( true )),
				'tree' => ''
			)
		)
	));
}

