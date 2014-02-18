<?php

/* Custom Post Types */
/*------------------------------------------------------------------*/
require_once (BIZZ_LIB_THEME . '/cpt/post-type-slider.php'); #slider post type
require_once (BIZZ_LIB_THEME . '/cpt/post-type-menu.php'); #menu post type

/* WooCommerce support */
/*------------------------------------------------------------------*/
add_theme_support( 'woocommerce' );

/* Extra Profile Fields */
/*------------------------------------------------------------------*/
add_action( 'show_user_profile', 'bizz_extra_user_profile_fields' );
add_action( 'edit_user_profile', 'bizz_extra_user_profile_fields' );
function bizz_extra_user_profile_fields( $user ) {
?>
	<h3><?php _e("Extra profile information", "bizzthemes"); ?></h3>
	<table class="form-table">
	<tr>
		<th><label for="phone"><?php _e("Phone"); ?></label></th>
		<td>
			<input type="text" name="phone" id="phone" class="regular-text" value="<?php echo esc_attr( get_the_author_meta( 'phone', $user->ID ) ); ?>" /><br />
			<span class="description"><?php _e("Please enter your phone."); ?></span>
		</td>
	</tr>
	</table>
<?php
}

add_action( 'personal_options_update', 'bizz_save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'bizz_save_extra_user_profile_fields' );
function bizz_save_extra_user_profile_fields( $user_id ) {
  $saved = false;
  if ( current_user_can( 'edit_user', $user_id ) ) {
    update_user_meta( $user_id, 'phone', $_POST['phone'] );
    $saved = true;
  }
  return true;
}

/* Extra Profile Roles */
/*------------------------------------------------------------------*/
add_role('chef', 'Chef', array(
    'read' => true, // True allows that capability
    'edit_posts' => true,
    'delete_posts' => true,
));
add_role('staff', 'Staff', array(
    'read' => true, // True allows that capability
    'edit_posts' => true,
    'delete_posts' => false,
));

/* Include Bootstrap. */
/*------------------------------------------------------------------*/
add_filter('bizz_bootstrap', 'enable_bizz_bootstrap');
function enable_bizz_bootstrap() {
	return true;
}

/* Set the content width based on the theme's design and stylesheet. */
/*------------------------------------------------------------------*/
if ( ! isset( $content_width ) )
	$content_width = 580;
	

/* header.php file */
/*------------------------------------------------------------------*/
add_action('header_html_build', 'add_header_html_build');
function add_header_html_build() {
	global $bizz_registered_grids;
	
	bizz_html_header();

	$grid_logic = array(
		'header_area' => $bizz_registered_grids['header_area']
	);

	echo bizz_html_build(false, false, $grid_logic);
	
	echo '
	<div id="main_area" class="clearfix">
		<div class="container_12 clearfix">
	';
}

/* sidebar.php file */
/*------------------------------------------------------------------*/
add_action('sidebar_html_build', 'add_sidebar_html_build');
function add_sidebar_html_build() {

	$grid_logic = array(
		'sidebar_area' => array(
			'id' => 'sidebar_area',
			'name' => __('Sidebar Area', 'bizzthemes'),
			'container' => '',
			'before_container' => '',
			'after_container' => '',
			'show' => 'true',
			'grids' => array(
				'main_two' => array(
					'class' => 'grid_4 last',
					'before_grid' => '',
					'after_grid' => '',
					'tree' => ''
				)
			)
		)
	);
	
	echo bizz_html_build(false, false, $grid_logic);
	
}

/* footer.php file */
/*------------------------------------------------------------------*/
add_action('footer_html_build', 'add_footer_html_build');
function add_footer_html_build() {
	global $bizz_registered_grids;
	
	echo '
		</div><!-- /.container_12 -->
	</div><!-- /#main_area -->
	';

	$grid_logic = array(
		'footer_area' => $bizz_registered_grids['footer_area']
	);

	echo bizz_html_build(false, false, $grid_logic);
	
	bizz_html_footer();
}

/* WooCommerce */
/*------------------------------------------------------------------*/
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

/* JigoShop */
/*------------------------------------------------------------------*/
remove_action( 'jigoshop_before_main_content', 'jigoshop_output_content_wrapper', 10 );
remove_action( 'jigoshop_after_main_content', 'jigoshop_output_content_wrapper_end', 10);
add_action( 'jigoshop_before_main_content', 'my_theme_wrapper_start', 10 );
add_action( 'jigoshop_after_main_content', 'my_theme_wrapper_end', 10 );

function my_theme_wrapper_start() {
	echo '<div class="grid_8">';
	echo '<div class="main_one widget">';
}
function my_theme_wrapper_end() {
	echo '</div>';
	echo '</div>';
}


/* DEFAULT LAYOUT OPTIONS */
/*------------------------------------------------------------------*/

// set default layouts
$default_layouts_array = '{"theme_id":"restaurant","frame_version":"7.9.1.2","options_id":"layouts","options_value":{"all_widgets":[{"option_name":"widget_meta","option_value":{"2":[],"3":{"title":""},"_multiwidget":1},"type":"widget"},{"option_name":"widget_text","option_value":{"2":[],"3":{"title":"","text":"For reservations call<h1>+1 800 559 6580<\/h1>","filter":false},"_multiwidget":1},"type":"widget"},{"option_name":"widget_recent-comments","option_value":{"2":{"title":"","number":5},"_multiwidget":1},"type":"widget"},{"option_name":"widget_rss","option_value":{"2":[],"_multiwidget":1},"type":"widget"},{"option_name":"widget_widgets-reloaded-bizz-archives","option_value":{"2":{"title":"Archives","limit":"","type":"monthly","format":"html","before":"","after":"","show_post_count":0},"_multiwidget":1},"type":"widget"},{"option_name":"widget_widgets-reloaded-bizz-authors","option_value":{"2":[],"_multiwidget":1},"type":"widget"},{"option_name":"widget_widgets-reloaded-bizz-bookmarks","option_value":{"2":[],"3":{"title_li":"Bookmarks","category_order":"ASC","category_orderby":"count","class":"linkcat","limit":"","order":"ASC","orderby":"id","search":"","between":"","link_before":"<span>","link_after":"<\/span>","categorize":1,"hide_invisible":1,"category":null,"include":null,"exclude":null,"exclude_category":null,"show_private":0,"show_rating":0,"show_updated":0,"show_images":0,"show_name":0,"show_description":0},"_multiwidget":1},"type":"widget"},{"option_name":"widget_widgets-reloaded-bizz-calendar","option_value":{"2":[],"_multiwidget":1},"type":"widget"},{"option_name":"widget_widgets-reloaded-bizz-categories","option_value":{"2":[],"3":{"title":"Categories","taxonomy":"category","style":"list","order":"ASC","orderby":"name","depth":"","number":"","exclude_tree":"","child_of":"","current_category":"","search":"","feed":"","feed_type":"","feed_image":"","hierarchical":1,"hide_empty":1,"include":[],"exclude":[],"use_desc_for_title":0,"show_last_update":0,"show_count":0},"_multiwidget":1},"type":"widget"},{"option_name":"widget_bizz-comments-loop","option_value":{"2":[],"3":{"type":"all","comment_header":"h3","comment_meta":"[author] [date before=\"| \"] [link before=\"| \"] [edit before=\"| \"]","max_depth":"5","enable_pagination":true,"enable_reply":true,"comment_moderation":"Your comment is awaiting moderation.","reply_text":"Reply","login_text":"Log in to Reply","password_text":"Password Protected","pass_protected_text":"is password protected. Enter the password to view comments.","sing_comment_text":"comment","plu_comment_text":"comments","sing_trackback_text":"trackback","plu_trackback_text":"trackbacks","sing_pingback_text":"pingback","plu_pingback_text":"pingbacks","sing_ping_text":"ping","plu_ping_text":"pings","no_text":"No","to_text":"to","reverse_top_level":false,"comments_closed":""},"_multiwidget":1},"type":"widget"},{"option_name":"widget_widgets-reloaded-bizz-c-form","option_value":{"2":[],"_multiwidget":1},"type":"widget"},{"option_name":"widget_widgets-reloaded-bizz-flickr","option_value":{"2":[],"_multiwidget":1},"type":"widget"},{"option_name":"widget_widgets-reloaded-bizz-logo","option_value":{"2":[],"3":{"custom_logo":"def_logo","upload_logo":"","custom_link":"http:\/\/"},"_multiwidget":1},"type":"widget"},{"option_name":"widget_widgets-reloaded-bizz-loop","option_value":{"2":[],"3":{"post_date":1,"post_comments":1,"thumb_width":"150","thumb_height":"150","thumb_align":"alignright","post_columns":"1","read_more":1,"read_more_text":"Continue reading","enable_pagination":1,"post_author":0,"post_categories":0,"post_tags":0,"post_edit":0,"thumb_display":0,"thumb_single":0,"remove_posts":0,"full_posts":0,"ajax_pagination":0},"_multiwidget":1},"type":"widget"},{"option_name":"widget_widgets-reloaded-bizz-nav-menu","option_value":{"2":[],"3":{"title":"","menu":"101","container":"div","container_id":"","container_class":"","menu_id":"","menu_class":"nav-menu","depth":"0","before":"","after":"","link_before":"","link_after":"","fallback_cb":"wp_page_menu","walker":"","use_desc_for_title":0,"vertical":0},"_multiwidget":1},"type":"widget"},{"option_name":"widget_widgets-reloaded-bizz-pages","option_value":{"2":[],"4":{"title":"Pages","sort_order":"ASC","sort_column":"post_title","depth":"","number":"","offset":"","child_of":"","exclude_tree":"","meta_key":"","meta_value":"","link_before":"","link_after":"","show_date":"","date_format":"F j, Y","hierarchical":1},"_multiwidget":1},"type":"widget"},{"option_name":"widget_bizz-query-posts","option_value":{"2":[],"4":{"title":"","post_status":["publish"],"post_type":["post"],"post_mime_type":[""],"meta_key":"","meta_value":"","meta_compare":"","order":"DESC","orderby":"date","enable_pagination":1,"ajax_pagination":1,"posts_per_page":"12","offset":"0","year":"","monthnum":"","w":"","day":"","hour":"","minute":"","second":"","caller_get_posts":1,"show_entry_title":1,"wp_link_pages":1,"entry_title":"h2","read_more":1,"read_more_text":"Continue reading","entry_container":"div","error_message":"Apologies, but no results were found.","post_date":1,"post_comments":1,"thumb_width":"150","thumb_height":"150","thumb_align":"alignright","post_columns":"1","post_parent":"","author":"","post":"","page":"","attachment":"","bizz_slider":"","bizz_menu":"","category":"","post_tag":"","slidertype":"","slidertags":"","menutype":"","menutags":"","post_author":0,"post_categories":0,"post_tags":0,"post_edit":0,"thumb_display":0,"remove_posts":0,"full_posts":0,"p":""},"_multiwidget":1},"type":"widget"},{"option_name":"widget_widgets-reloaded-bizz-richtext","option_value":{"2":[],"_multiwidget":1},"type":"widget"},{"option_name":"widget_widgets-reloaded-bizz-search","option_value":{"2":[],"3":{"title":"","search_text":""},"_multiwidget":1},"type":"widget"},{"option_name":"widget_widgets-reloaded-bizz-tags","option_value":{"2":{"title":"Tags","taxonomy":"post_tag","link":"view","format":"flat","order":"ASC","orderby":"name","number":"45","largest":"22","smallest":"8","unit":"pt","separator":"","child_of":"","parent":"","search":"","name__like":"","hide_empty":1,"include":[],"exclude":[],"pad_counts":0},"_multiwidget":1},"type":"widget"},{"option_name":"widget_twitter","option_value":{"2":[],"3":{"account":"BizzThemes","title":"Twitter Updates","show":3,"hidereplies":false,"beforetimesince":"","twitter_follow":"Follow Us on Twitter"},"_multiwidget":1},"type":"widget"},{"option_name":"widget_widgets-reloaded-bizz-menu","option_value":{"2":[],"3":{"title":"Restaurant Menu","order":"ASC","orderby":"name","menu_columns":"2","number":"10","number_meal":"5","menu_currency":"$","enable_viewmore":1,"text_viewmore":"View more","enable_descriptions":1,"menu_pdf":"http:\/\/localhost\/restaurant-pro\/wp-content\/uploads\/2010\/12\/Foodilicious-Menu.pdf","thumb_selflink":1,"thumb_width":"80","thumb_height":"80","thumb_cropp":"c","error_message":"Apologies, but no results were found."},"4":{"title":"","order":"DESC","orderby":"name","menu_columns":"2","number":"10","number_meal":"5","menu_currency":"$","text_viewmore":"View more","enable_descriptions":1,"menu_pdf":"","thumb_selflink":1,"thumb_width":"70","thumb_height":"70","thumb_cropp":"c","error_message":"Apologies, but no results were found.","enable_decimal":0,"enable_viewmore":0},"_multiwidget":1},"type":"widget"},{"option_name":"widget_widgets-reloaded-bizz-slider","option_value":{"2":[],"3":{"title":"","before":"","after":"","sliderheight":"","buttonheight":"150","ico_back":"","ico_fwd":"","post_type":"bizz_slider","order":"DESC","orderby":"date","number":"5","autoheight":1,"speed":"0","autoplay":"0","autorestart":"0","include":[],"exclude":[],"crossfade":0,"bigtarget":0,"pagination":0,"slidetitle":0},"_multiwidget":1},"type":"widget"},{"option_name":"widget_widget_tabs_widget","option_value":{"2":[],"_multiwidget":1},"type":"widget"}],"widget_posts":[{"post_title":"all","post_excerpt":"is_front_page","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:28:\"widgets-reloaded-bizz-menu-4\";s:9:\"condition\";s:13:\"is_front_page\";s:4:\"item\";s:3:\"all\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"post","post_excerpt":"is_singular","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:20:\"bizz-comments-form-3\";s:9:\"condition\";s:11:\"is_singular\";s:4:\"item\";s:4:\"post\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"post","post_excerpt":"is_singular","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:20:\"bizz-comments-loop-3\";s:9:\"condition\";s:11:\"is_singular\";s:4:\"item\";s:4:\"post\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"all","post_excerpt":"is_front_page","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:30:\"widgets-reloaded-bizz-slider-3\";s:9:\"condition\";s:13:\"is_front_page\";s:4:\"item\";s:3:\"all\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"all","post_excerpt":"is_index","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:29:\"widgets-reloaded-bizz-pages-4\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"all","post_excerpt":"is_index","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:28:\"widgets-reloaded-bizz-loop-3\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"all","post_excerpt":"is_index","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:6:\"meta-3\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"all","post_excerpt":"is_index","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:33:\"widgets-reloaded-bizz-bookmarks-3\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"all","post_excerpt":"is_index","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:34:\"widgets-reloaded-bizz-categories-3\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"all","post_excerpt":"is_index","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:6:\"meta-4\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"all","post_excerpt":"is_index","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:30:\"widgets-reloaded-bizz-search-3\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"all","post_excerpt":"is_index","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:32:\"widgets-reloaded-bizz-nav-menu-3\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"all","post_excerpt":"is_index","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:28:\"widgets-reloaded-bizz-logo-3\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"all","post_excerpt":"is_front_page","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:28:\"widgets-reloaded-bizz-menu-4\";s:9:\"condition\";s:13:\"is_front_page\";s:4:\"item\";s:3:\"all\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"post","post_excerpt":"is_singular","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:20:\"bizz-comments-form-3\";s:9:\"condition\";s:11:\"is_singular\";s:4:\"item\";s:4:\"post\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"post","post_excerpt":"is_singular","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:20:\"bizz-comments-loop-3\";s:9:\"condition\";s:11:\"is_singular\";s:4:\"item\";s:4:\"post\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"all","post_excerpt":"is_front_page","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:30:\"widgets-reloaded-bizz-slider-3\";s:9:\"condition\";s:13:\"is_front_page\";s:4:\"item\";s:3:\"all\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"all","post_excerpt":"is_index","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:29:\"widgets-reloaded-bizz-pages-4\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"all","post_excerpt":"is_index","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:28:\"widgets-reloaded-bizz-loop-3\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"all","post_excerpt":"is_index","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:6:\"meta-3\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"all","post_excerpt":"is_index","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:33:\"widgets-reloaded-bizz-bookmarks-3\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"all","post_excerpt":"is_index","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:34:\"widgets-reloaded-bizz-categories-3\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"all","post_excerpt":"is_index","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:6:\"meta-4\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"all","post_excerpt":"is_index","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:30:\"widgets-reloaded-bizz-search-3\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"all","post_excerpt":"is_index","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:32:\"widgets-reloaded-bizz-nav-menu-3\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"},{"post_title":"all","post_excerpt":"is_index","post_status":"publish","post_type":"bizz_widget","post_content":"a:5:{s:9:\"widget-id\";s:28:\"widgets-reloaded-bizz-logo-3\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";s:6:\"parent\";s:5:\"false\";s:4:\"show\";s:4:\"true\";}","post_content_filtered":"restaurant","type":"widgets"}],"grid_posts":[{"post_title":"all","post_excerpt":"is_front_page","post_status":"publish","post_type":"bizz_grid","post_content":"a:4:{s:11:\"header_area\";a:6:{s:2:\"id\";s:11:\"header_area\";s:4:\"name\";s:11:\"Header Area\";s:9:\"container\";s:12:\"container_16\";s:4:\"show\";s:4:\"true\";s:9:\"condition\";s:13:\"is_front_page\";s:4:\"item\";s:3:\"all\";}s:13:\"featured_area\";a:6:{s:2:\"id\";s:13:\"featured_area\";s:4:\"name\";s:13:\"Featured Area\";s:9:\"container\";s:12:\"container_12\";s:4:\"show\";s:4:\"true\";s:9:\"condition\";s:13:\"is_front_page\";s:4:\"item\";s:3:\"all\";}s:9:\"main_area\";a:6:{s:2:\"id\";s:9:\"main_area\";s:4:\"name\";s:9:\"Main Area\";s:9:\"container\";s:12:\"container_12\";s:4:\"show\";s:5:\"false\";s:9:\"condition\";s:13:\"is_front_page\";s:4:\"item\";s:3:\"all\";}s:11:\"footer_area\";a:6:{s:2:\"id\";s:11:\"footer_area\";s:4:\"name\";s:11:\"Footer Area\";s:9:\"container\";s:12:\"container_12\";s:4:\"show\";s:4:\"true\";s:9:\"condition\";s:13:\"is_front_page\";s:4:\"item\";s:3:\"all\";}}","post_content_filtered":"restaurant","type":"grids"},{"post_title":"all","post_excerpt":"is_index","post_status":"publish","post_type":"bizz_grid","post_content":"a:4:{s:11:\"header_area\";a:6:{s:2:\"id\";s:11:\"header_area\";s:4:\"name\";s:11:\"Header Area\";s:9:\"container\";s:12:\"container_16\";s:4:\"show\";s:4:\"true\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";}s:13:\"featured_area\";a:6:{s:2:\"id\";s:13:\"featured_area\";s:4:\"name\";s:13:\"Featured Area\";s:9:\"container\";s:12:\"container_12\";s:4:\"show\";s:5:\"false\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";}s:9:\"main_area\";a:6:{s:2:\"id\";s:9:\"main_area\";s:4:\"name\";s:9:\"Main Area\";s:9:\"container\";s:12:\"container_12\";s:4:\"show\";s:4:\"true\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";}s:11:\"footer_area\";a:6:{s:2:\"id\";s:11:\"footer_area\";s:4:\"name\";s:11:\"Footer Area\";s:9:\"container\";s:12:\"container_12\";s:4:\"show\";s:4:\"true\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";}}","post_content_filtered":"restaurant","type":"grids"},{"post_title":"all","post_excerpt":"is_front_page","post_status":"publish","post_type":"bizz_grid","post_content":"a:4:{s:11:\"header_area\";a:6:{s:2:\"id\";s:11:\"header_area\";s:4:\"name\";s:11:\"Header Area\";s:9:\"container\";s:12:\"container_16\";s:4:\"show\";s:4:\"true\";s:9:\"condition\";s:13:\"is_front_page\";s:4:\"item\";s:3:\"all\";}s:13:\"featured_area\";a:6:{s:2:\"id\";s:13:\"featured_area\";s:4:\"name\";s:13:\"Featured Area\";s:9:\"container\";s:12:\"container_12\";s:4:\"show\";s:4:\"true\";s:9:\"condition\";s:13:\"is_front_page\";s:4:\"item\";s:3:\"all\";}s:9:\"main_area\";a:6:{s:2:\"id\";s:9:\"main_area\";s:4:\"name\";s:9:\"Main Area\";s:9:\"container\";s:12:\"container_12\";s:4:\"show\";s:5:\"false\";s:9:\"condition\";s:13:\"is_front_page\";s:4:\"item\";s:3:\"all\";}s:11:\"footer_area\";a:6:{s:2:\"id\";s:11:\"footer_area\";s:4:\"name\";s:11:\"Footer Area\";s:9:\"container\";s:12:\"container_12\";s:4:\"show\";s:4:\"true\";s:9:\"condition\";s:13:\"is_front_page\";s:4:\"item\";s:3:\"all\";}}","post_content_filtered":"restaurant","type":"grids"},{"post_title":"all","post_excerpt":"is_index","post_status":"publish","post_type":"bizz_grid","post_content":"a:4:{s:11:\"header_area\";a:6:{s:2:\"id\";s:11:\"header_area\";s:4:\"name\";s:11:\"Header Area\";s:9:\"container\";s:12:\"container_16\";s:4:\"show\";s:4:\"true\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";}s:13:\"featured_area\";a:6:{s:2:\"id\";s:13:\"featured_area\";s:4:\"name\";s:13:\"Featured Area\";s:9:\"container\";s:12:\"container_12\";s:4:\"show\";s:5:\"false\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";}s:9:\"main_area\";a:6:{s:2:\"id\";s:9:\"main_area\";s:4:\"name\";s:9:\"Main Area\";s:9:\"container\";s:12:\"container_12\";s:4:\"show\";s:4:\"true\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";}s:11:\"footer_area\";a:6:{s:2:\"id\";s:11:\"footer_area\";s:4:\"name\";s:11:\"Footer Area\";s:9:\"container\";s:12:\"container_12\";s:4:\"show\";s:4:\"true\";s:9:\"condition\";s:8:\"is_index\";s:4:\"item\";s:3:\"all\";}}","post_content_filtered":"restaurant","type":"grids"}],"sidebars_widgets":[{"option_name":"sidebars_widgets","option_value":{"wp_inactive_widgets":["meta-2","text-2","text-3","recent-comments-2","rss-2","widgets-reloaded-bizz-archives-2","widgets-reloaded-bizz-authors-2","widgets-reloaded-bizz-bookmarks-2","widgets-reloaded-bizz-calendar-2","widgets-reloaded-bizz-categories-2","widgets-reloaded-bizz-c-form-2","widgets-reloaded-bizz-flickr-2","widgets-reloaded-bizz-pages-2","bizz-query-posts-2","bizz-query-posts-4","widgets-reloaded-bizz-richtext-2","widgets-reloaded-bizz-tags-2","twitter-2","twitter-3","widgets-reloaded-bizz-menu-2","widgets-reloaded-bizz-menu-3","widgets-reloaded-bizz-slider-2","widget_tabs_widget-2"],"sidebar-1":["widgets-reloaded-bizz-nav-menu-2","widgets-reloaded-bizz-logo-3"],"sidebar-2":["widgets-reloaded-bizz-search-2","widgets-reloaded-bizz-nav-menu-3"],"sidebar-3":["widgets-reloaded-bizz-logo-2","widgets-reloaded-bizz-search-3"],"sidebar-4":["widgets-reloaded-bizz-loop-2","bizz-comments-loop-2","widgets-reloaded-bizz-slider-3","widgets-reloaded-bizz-menu-4"],"sidebar-5":["widgets-reloaded-bizz-loop-3","bizz-comments-loop-3"],"sidebar-6":["widgets-reloaded-bizz-pages-4"],"sidebar-7":["meta-3"],"sidebar-8":["widgets-reloaded-bizz-categories-3"],"sidebar-9":["widgets-reloaded-bizz-bookmarks-3"],"array_version":3},"type":"sidebars_widgets"}]}}';


	
