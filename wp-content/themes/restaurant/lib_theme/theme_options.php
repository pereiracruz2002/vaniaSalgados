<?php

/* GLOBAL DESIGN OPTIONS */
/*------------------------------------------------------------------*/
add_action( 'init', 'bizz_theme_options' );
function bizz_theme_options() {
	global $shortname, $bizz_package, $alt_stylesheets, $options, $design;

	$design[] = array(	'type' => 'maintabletop');

		////// General Styling

		$design[] = array(	'name' => 'General Styling',
							'type' => 'heading');
						
			$design[] = array(	'name' => 'Layout Control',
								'toggle' => 'true',
								'type' => 'subheadingtop');
								
				$design[] = array(	'name' => 'Predefined Skins',
									'desc' => 'Please select the CSS skin for your website here. CSS skin files are located in your theme skins folder.',
									'id' => $shortname.'_alt_stylesheet',
									'std' => array(
										'value' => '', 
										'css' => ''
									),
									'type' => 'select',
									'show_option_none' => true,
									'options' => $alt_stylesheets);
									
				$design[] = array(	'name' => 'Hide custom.css',
									'label' => 'Hide Custom Stylesheet',
									'desc' => sprintf(__('Custom.css file allows you to make custom design changes using CSS. You have option to create your own css skin in skins folder or to simply enable and <a href="%s/wp-admin/theme-editor.php">edit custom.css file</a>.<span class="important">Check this option to disable custom.css file output.</span>', 'bizzthemes'), site_url()),
									'id' => $shortname.'_custom_css',
									'std' => array(
										'value' => false, 
										'css' => ''
									),
									'type' => 'checkbox');	
									
				$design[] = array(	'name' => 'Hide layout.css',
									'label' => 'Hide Design Control Tweaks',
									'desc' => 'If you want to hide all CSS design tweaks you&#8217;ve created using theme design control panel, check this option.',
									'id' => $shortname.'_layout_css',
									'std' => array(
										'value' => false, 
										'css' => ''
									),
									'type' => 'checkbox');
						
			$design[] = array(	'type' => 'subheadingbottom');	

			$design[] = array(	'name' => 'Body Background',
								'toggle' => 'true',
								'type' => 'subheadingtop');
									
				$design[] = array(  'name' => '<code>body</code> background',
									'desc' => 'Specify <code>body</code> background properties. <span class="important">Uploading image is optional, so you may only choose background color if you like.</span>',
									'id' => $shortname.'_body_img_prop',
									'std' => array(
										'background-image' => '',
										'background-color' => '',
										'background-repeat' => '', 
										'background-position' => '', 
										'css' => 'body'
									),
									'type' => 'bgproperties');
						
			$design[] = array(	'type' => 'subheadingbottom');
			
			$design[] = array(	'name' => 'Body Links',
								'toggle' => 'true',
								'type' => 'subheadingtop');
									
				$design[] = array(  'name' => '<code>a</code> link text color',
									'desc' => 'Pick a custom link color to be applied to <code>body</code> text links.',
									'id' => $shortname.'_c_links',
									'std' => array(
										'color' => '', 
										'css' => 'a'
									),
									'type' => 'color');
									
				$design[] = array(  'name' => '<code>a:hover</code> link text color',
									'desc' => 'Pick a custom onhover link color to be applied to <code>body</code> text links.',
									'id' => $shortname.'_c_links_onhover',
									'std' => array(
										'color' => '', 
										'css' => 'a:hover'
									),
									'type' => 'color');
						
			$design[] = array(	'type' => 'subheadingbottom');
			
			$design[] = array(	'name' => 'Body Text',
								'toggle' => 'true',
								'type' => 'subheadingtop');
									
				$design[] = array(  'name' => '<code>body</code> fonts (all)',
									'desc' => 'Select the typography you want for all of your texts. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_general',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '',
										'color' => '',
										'css' => 'body'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => '<code>H1</code> fonts',
									'desc' => 'Select the typography you want for your text, displayed inside <code>H1</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_h1',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => 'h1'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => '<code>H2</code> fonts',
									'desc' => 'Select the typography you want for your text, displayed inside <code>H2</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_h2',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => 'h2'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => '<code>H3</code> fonts',
									'desc' => 'Select the typography you want for your text, displayed inside <code>H3</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_h3',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => 'h3'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => '<code>H4</code> fonts',
									'desc' => 'Select the typography you want for your text, displayed inside <code>H4</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_h4',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => 'h4'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => '<code>H5</code> fonts',
									'desc' => 'Select the typography you want for your text, displayed inside <code>H5</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_h5',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => 'h5'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => '<code>H6</code> fonts',
									'desc' => 'Select the typography you want for your text, displayed inside <code>H6</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_h6',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => 'h6'
									),
									'type' => 'typography');
						
			$design[] = array(	'type' => 'subheadingbottom');
			
			$design[] = array(	'name' => 'Body Input Fields',
								'toggle' => 'true',
								'type' => 'subheadingtop');
									
				$design[] = array(  'name' => 'Inputs fonts',
									'desc' => 'Select the typography you want for your <code>input, textarea</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_inputs',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => 'input, textarea'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => 'Inputs background color',
									'desc' => 'Specify <code>input, textarea</code> background color.',
									'id' => $shortname.'_bg_inputs',
									'std' => array(
										'background-color' => '', 
										'css' => 'input, textarea'
									),
									'type' => 'background-color');
									
				$design[] = array(  'name' => 'Inputs border',
									'desc' => 'Specify border properties to be applied to <code>input, textarea</code> tags.',
									'id' => $shortname.'_b_inputs',
									'std' => array(
										'border-position' => 'border',
										'border-width' => '', 
										'border-style' => '', 
										'border-color' => '',
										'css' => 'input, textarea'
									),
									'type' => 'border');
									
				$design[] = array(  'name' => 'Inputs <code>:focus</code> background color',
									'desc' => 'Specify <code>input:focus, textarea:focus</code> background color.',
									'id' => $shortname.'_bg_inputs_focus',
									'std' => array(
										'background-color' => '', 
										'css' => 'input:focus, textarea:focus'
									),
									'type' => 'background-color');
									
				$design[] = array(  'name' => 'Inputs <code>:focus</code> border',
									'desc' => 'Specify border properties to be applied to <code>input:focus, textarea:focus</code> tags.',
									'id' => $shortname.'_b_inputs_focus',
									'std' => array(
										'border-position' => 'border',
										'border-width' => '', 
										'border-style' => '', 
										'border-color' => '',
										'css' => 'input:focus, textarea:focus'
									),
									'type' => 'border');
									
				$design[] = array(  'name' => 'Submit button fonts',
									'desc' => 'Select the typography you want for your <code>input[type=&#34;submit&#34;], a.button</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_inputs_submit',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => 'input[type=&#34;submit&#34;], a.button'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => 'Submit button background',
									'desc' => 'Specify <code>input[type=&#34;submit&#34;], a.button</code> background color.',
									'id' => $shortname.'_bg_inputs_submit',
									'std' => array(
										'background-color' => '', 
										'css' => 'input[type=&#34;submit&#34;], a.button'
									),
									'type' => 'background-color');
									
				$design[] = array(  'name' => 'Submit button <code>:hover</code> fonts',
									'desc' => 'Select the typography you want for your <code>input[type=&#34;submit&#34;]:hover, a.button:hover</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_inputs_submit_hover',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => 'input[type=&#34;submit&#34;]:hover, a.button:hover'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => 'Submit button <code>:hover</code> background',
									'desc' => 'Specify <code>input[type=&#34;submit&#34;]:hover, a.button:hover</code> background color.',
									'id' => $shortname.'_bg_inputs_submit_hover',
									'std' => array(
										'background-color' => '', 
										'css' => 'input[type=&#34;submit&#34;]:hover, a.button:hover'
									),
									'type' => 'background-color');
						
			$design[] = array(	'type' => 'subheadingbottom');
			
			$design[] = array(	'name' => 'Body Images',
								'toggle' => 'true',
								'type' => 'subheadingtop');
									
				$design[] = array(  'name' => 'Image caption fonts',
									'desc' => 'Select the typography you want for your <code>.wp-caption</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_imgcaption',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => '.wp-caption'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => 'Image caption background color',
									'desc' => 'Specify <code>.wp-caption</code> background color.',
									'id' => $shortname.'_bg_imgcaption',
									'std' => array(
										'background-color' => '', 
										'css' => '.wp-caption'
									),
									'type' => 'background-color');
									
				$design[] = array(  'name' => 'Image caption border',
									'desc' => 'Specify border properties to be applied to <code>.wp-caption</code> tags.',
									'id' => $shortname.'_b_imgcaption',
									'std' => array(
										'border-position' => 'border',
										'border-width' => '', 
										'border-style' => '', 
										'border-color' => '',
										'css' => '.wp-caption'
									),
									'type' => 'border');
									
				$design[] = array(  'name' => 'Image thumbnail background color',
									'desc' => 'Specify <code>.post_box img.thumbnail</code> background color.',
									'id' => $shortname.'_bg_imgthumb',
									'std' => array(
										'background-color' => '', 
										'css' => '.wp-caption'
									),
									'type' => 'background-color');
									
				$design[] = array(  'name' => 'Image thumbnail border',
									'desc' => 'Specify border properties to be applied to <code>.post_box img.thumbnail</code> tags.',
									'id' => $shortname.'_b_imgthumb',
									'std' => array(
										'border-position' => 'border',
										'border-width' => '', 
										'border-style' => '', 
										'border-color' => '',
										'css' => '.post_box img.thumbnail'
									),
									'type' => 'border');
						
			$design[] = array(	'type' => 'subheadingbottom');
								
		$design[] = array(	'type' => 'maintablebreak');
		
		////// Specific Widget Styling

		$design[] = array(	'name' => 'Content &amp; Comments',
							'type' => 'heading');
									
			$design[] = array(	'name' => 'Typography',
								'toggle' => 'true',
								'type' => 'subheadingtop');
									
				if ($bizz_package != 'ZnJlZQ=='){
				
				$design[] = array(  'name' => 'Main post headline',
									'desc' => 'Select the typography you want for your <code>.headline_area h1, .headline_area h2</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_content_title',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => '.headline_area h1, .headline_area h2'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => 'Archive post headline',
									'desc' => 'Select the typography you want for your <code>.headline_area h1 a, .headline_area h2 a</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_content_title_a',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => '.headline_area h1 a, .headline_area h2 a'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => 'Post meta',
									'desc' => 'Select the typography you want for your <code>.headline_meta a</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_post_meta',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => '.headline_meta a'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => 'Post content',
									'desc' => 'Select the typography you want for your <code>.format_text</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_post_text',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => '.format_text'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => 'Post content links',
									'desc' => 'Select the typography you want for your <code>.format_text a</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_post_text_a',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => '.format_text a'
									),
									'type' => 'typography');
									
				} else {
				
				$design[] = array(	"name" => "To use these options, please <a href='" . $bloghomeurl . "wp-admin/admin.php?page=bizz-license'>Upgrade to Standard or Agency Theme Package</a>.",
									"type" => "help");
				
				}
						
			$design[] = array(	'type' => 'subheadingbottom');
			
			$design[] = array(	'name' => 'Continue Reading',
								'toggle' => 'true',
								'type' => 'subheadingtop');
									
				if ($bizz_package != 'ZnJlZQ=='){
				
				$design[] = array(  'name' => 'Font',
									'desc' => 'Select the typography you want for your <code>span.read-more a</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_rmore_a',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => 'span.read-more a'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => 'Background color',
									'desc' => 'Specify <code>span.read-more a</code> background color.',
									'id' => $shortname.'_bg_rmore',
									'std' => array(
										'background-color' => '', 
										'css' => 'span.read-more a'
									),
									'type' => 'background-color');
									
				$design[] = array(  'name' => 'Background <code>:hover</code> color',
									'desc' => 'Specify <code>span.read-more a:hover</code> background color.',
									'id' => $shortname.'_bg_rmore',
									'std' => array(
										'background-color' => '', 
										'css' => 'span.read-more a:hover'
									),
									'type' => 'background-color');
									
				} else {
				
				$design[] = array(	"name" => "To use these options, please <a href='" . $bloghomeurl . "wp-admin/admin.php?page=bizz-license'>Upgrade to Standard or Agency Theme Package</a>.",
									"type" => "help");
				
				}
						
			$design[] = array(	'type' => 'subheadingbottom');
			
			$design[] = array(	'name' => 'Pagination',
								'toggle' => 'true',
								'type' => 'subheadingtop');
									
				if ($bizz_package != 'ZnJlZQ=='){
				
				$design[] = array(  'name' => 'Top border',
									'desc' => 'Specify border properties to be applied to <code>.pagination_area, .loopedSlider ul.pagination</code> tags.',
									'id' => $shortname.'_b_pagination',
									'std' => array(
										'border-position' => 'border-top',
										'border-width' => '', 
										'border-style' => '', 
										'border-color' => '',
										'css' => '.pagination_area, .loopedSlider ul.pagination'
									),
									'type' => 'border');
									
				$design[] = array(  'name' => 'Font',
									'desc' => 'Select the typography you want for your <code>ul.lpag li a, .loopedSlider ul.pagination li a</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_pagination_a',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => 'ul.lpag li a, .loopedSlider ul.pagination li a'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => 'Active background color',
									'desc' => 'Specify <code>ul.lpag li.active a, ul.lpag li.current span, .loopedSlider ul.pagination li.current a</code> background color.',
									'id' => $shortname.'_bg_pagination_active',
									'std' => array(
										'background-color' => '', 
										'css' => 'ul.lpag li.active a, ul.lpag li.current span, .loopedSlider ul.pagination li.current a'
									),
									'type' => 'background-color');
									
				$design[] = array(  'name' => 'Active background font',
									'desc' => 'Select the typography you want for your <code>ul.lpag li.active a, ul.lpag li.current span</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_pagination_active',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => 'ul.lpag li.active a, ul.lpag li.current span, .loopedSlider ul.pagination li.current a'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => 'Link <code>:hover</code> background color',
									'desc' => 'Specify <code>ul.lpag li a:hover, .loopedSlider ul.pagination li a:hover</code> background color.',
									'id' => $shortname.'_bg_pagination_a_hover',
									'std' => array(
										'background-color' => '', 
										'css' => 'ul.lpag li a:hover, .loopedSlider ul.pagination li a:hover'
									),
									'type' => 'background-color');
									
				} else {
				
				$design[] = array(	"name" => "To use these options, please <a href='" . $bloghomeurl . "wp-admin/admin.php?page=bizz-license'>Upgrade to Standard or Agency Theme Package</a>.",
									"type" => "help");
				
				}
						
			$design[] = array(	'type' => 'subheadingbottom');
			
			$design[] = array(	'name' => 'Comments',
								'toggle' => 'true',
								'type' => 'subheadingtop');
									
				if ($bizz_package != 'ZnJlZQ=='){
				
				$design[] = array(  'name' => 'Comment header meta font',
									'desc' => 'Select the typography you want for your <code>#comments .comment .text-right .comm-reply, #comments .comment .text-right .comm-reply a</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_comment_meta',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => '#comments .comment .text-right .comm-reply, #comments .comment .text-right .comm-reply a'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => 'Comment content font',
									'desc' => 'Select the typography you want for your <code>#comments .comment .text-right .comment-entry</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_comment_content',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => '#comments .comment .text-right .comment-entry'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => 'Author reply border',
									'desc' => 'Specify border properties to be applied to <code>#comments .comment.bypostauthor .text-right .comm-reply</code> tags.',
									'id' => $shortname.'_b_comment_author',
									'std' => array(
										'border-position' => 'border',
										'border-width' => '', 
										'border-style' => '', 
										'border-color' => '',
										'css' => '#comments .comment.bypostauthor .text-right .comm-reply'
									),
									'type' => 'border');
									
				} else {
				
				$design[] = array(	"name" => "To use these options, please <a href='" . $bloghomeurl . "wp-admin/admin.php?page=bizz-license'>Upgrade to Standard or Agency Theme Package</a>.",
									"type" => "help");
				
				}
						
			$design[] = array(	'type' => 'subheadingbottom');
														
		$design[] = array(	'type' => 'maintablebreak');
								
	$design[] = array(	'type' => 'maintablebottom');
		
	$design[] = array(	'type' => 'maintabletop');
		
		////// General widget styling

		$design[] = array(	'name' => 'General Widget Styling',
							'type' => 'heading');
						
			$design[] = array(	'name' => 'Title',
								'toggle' => 'true',
								'type' => 'subheadingtop');
								
				if ($bizz_package != 'ZnJlZQ=='){
									
				$design[] = array(  'name' => '<code>H3</code> title font',
									'desc' => 'Select the typography you want for your <code>.widget h3</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_wid_title',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => '.widget h3'
									),
									'type' => 'typography');
									
				} else {
				
				$design[] = array(	"name" => "To use these options, please <a href='" . $bloghomeurl . "wp-admin/admin.php?page=bizz-license'>Upgrade to Standard or Agency Theme Package</a>.",
									"type" => "help");
				
				}
						
			$design[] = array(	'type' => 'subheadingbottom');
			
			$design[] = array(	'name' => 'Content',
								'toggle' => 'true',
								'type' => 'subheadingtop');
									
				if ($bizz_package != 'ZnJlZQ=='){
				
				$design[] = array(  'name' => 'Content font',
									'desc' => 'Select the typography you want for your <code>.widget</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_wid_content',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => '.widget'
									),
									'type' => 'typography');
									
				} else {
				
				$design[] = array(	"name" => "To use these options, please <a href='" . $bloghomeurl . "wp-admin/admin.php?page=bizz-license'>Upgrade to Standard or Agency Theme Package</a>.",
									"type" => "help");
				
				}
						
			$design[] = array(	'type' => 'subheadingbottom');
			
		$design[] = array(	'type' => 'maintablebreak');
		
		////// Header Area Styling

		$design[] = array(	'name' => 'Header Area',
							'type' => 'heading');
									
			$design[] = array(	'name' => 'General Styling',
								'toggle' => 'true',
								'type' => 'subheadingtop');
									
				if ($bizz_package != 'ZnJlZQ=='){
				
				$design[] = array(  'name' => 'Area background',
									'desc' => 'Specify <code>#header_area</code> background properties. <span class="important">Uploading image is optional, so you may only choose background color if you like.</span>',
									'id' => $shortname.'_bg_header_area',
									'std' => array(
										'background-image' => '',
										'background-color' => '',
										'background-repeat' => '', 
										'background-position' => '', 
										'css' => '#header_area'
									),
									'type' => 'bgproperties');
									
				$design[] = array(  'name' => 'Area font',
									'desc' => 'Select the typography you want for your <code>#header_area .widget</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_header_area',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => '#header_area .widget'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => 'Area widget title',
									'desc' => 'Select the typography you want for your <code>#header_area .widget h3</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_header_area_title',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => '#header_area .widget h3'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => '<code>a</code> link text color',
									'desc' => 'Pick a custom link color to be applied to <code>#header_area a</code> text links.',
									'id' => $shortname.'_c_header_area_a',
									'std' => array(
										'color' => '', 
										'css' => '#header_area a'
									),
									'type' => 'color');
									
				} else {
				
				$design[] = array(	"name" => "To use these options, please <a href='" . $bloghomeurl . "wp-admin/admin.php?page=bizz-license'>Upgrade to Standard or Agency Theme Package</a>.",
									"type" => "help");
				
				}
															
			$design[] = array(	'type' => 'subheadingbottom');
			
			$design[] = array(	'name' => 'Navigation Menu Widget',
								'toggle' => 'true',
								'type' => 'subheadingtop');
									
				if ($bizz_package != 'ZnJlZQ=='){
				
				$design[] = array(  'name' => '<code>a</code> link text color',
									'desc' => 'Pick a custom link color to be applied to <code>#header_area .nav-menu a</code> text links.',
									'id' => $shortname.'_c_header_area_menu_a',
									'std' => array(
										'color' => '', 
										'css' => '#header_area .nav-menu a'
									),
									'type' => 'color');
									
				$design[] = array(  'name' => 'Item <code>a:hover</code> background color',
									'desc' => 'Pick a custom link color to be applied to <code>#header_area .nav-menu li:hover</code> text links.',
									'id' => $shortname.'_bg_header_area_menu_a_hover',
									'std' => array(
										'background-color' => '', 
										'css' => '#header_area .nav-menu li:hover'
									),
									'type' => 'background-color');
									
				$design[] = array(  'name' => 'Active item <code>a</code> background color',
									'desc' => 'Pick a custom link color to be applied to <code>#header_area .nav-menu li.current-menu-item a</code> text links.',
									'id' => $shortname.'_bg_header_area_menu_active',
									'std' => array(
										'background-color' => '', 
										'css' => '#header_area .nav-menu li.current-menu-item a'
									),
									'type' => 'background-color');
									
				$design[] = array(  'name' => 'Active item <code>a</code> text color',
									'desc' => 'Pick a custom link color to be applied to <code>.widget .nav-menu li.current-menu-item a</code> text links.',
									'id' => $shortname.'_c_header_area_menu_active',
									'std' => array(
										'color' => '', 
										'css' => '.widget .nav-menu li.current-menu-item a, .widget .nav-menu li.current-menu-item a:hover'
									),
									'type' => 'color');
									
				$design[] = array(  'name' => 'Dropdown <code>a</code> link text color',
									'desc' => 'Pick a custom link color to be applied to <code>#header_area .nav-menu li ul li a, #header_area .nav-menu li ul li.current-menu-item li a</code> text links.',
									'id' => $shortname.'_c_header_area_menu_dropdown_a',
									'std' => array(
										'color' => '', 
										'css' => '#header_area .nav-menu li ul li a, #header_area .nav-menu li ul li.current-menu-item li a'
									),
									'type' => 'color');
									
				$design[] = array(  'name' => 'Dropdown Item <code>a:hover</code> background color',
									'desc' => 'Pick a custom link color to be applied to <code>#header_area .nav-menu li ul li:hover</code> text links.',
									'id' => $shortname.'_bg_header_area_menu_a_hover_dropdown',
									'std' => array(
										'background-color' => '', 
										'css' => '#header_area .nav-menu li ul li:hover'
									),
									'type' => 'background-color');
									
				} else {
				
				$design[] = array(	"name" => "To use these options, please <a href='" . $bloghomeurl . "wp-admin/admin.php?page=bizz-license'>Upgrade to Standard or Agency Theme Package</a>.",
									"type" => "help");
				
				}
															
			$design[] = array(	'type' => 'subheadingbottom');
														
		$design[] = array(	'type' => 'maintablebreak');	    
		
		////// Main Area

		$design[] = array(	'name' => 'Main Area',
							'type' => 'heading');
									
			$design[] = array(	'name' => 'General Styling',
								'toggle' => 'true',
								'type' => 'subheadingtop');
									
				if ($bizz_package != 'ZnJlZQ=='){
				
				$design[] = array(  'name' => 'Area background',
									'desc' => 'Specify <code>#main_area</code> background properties. <span class="important">Uploading image is optional, so you may only choose background color if you like.</span>',
									'id' => $shortname.'_bg_main_area',
									'std' => array(
										'background-image' => '',
										'background-color' => '',
										'background-repeat' => '', 
										'background-position' => '', 
										'css' => '#main_area'
									),
									'type' => 'bgproperties');
																							
				$design[] = array(	'name' => '-------------------------------------------------:[ grid styling ]:-------------------------------------------------',
									'type' => 'help');
									
				$design[] = array(  'name' => 'Boxed grids background',
									'desc' => 'Specify <code>#main_area .content_wide, #main_area .content_narrow</code> background properties. <span class="important">Uploading image is optional, so you may only choose background color if you like.</span>',
									'id' => $shortname.'_bg_main_area_boxes',
									'std' => array(
										'background-image' => '',
										'background-color' => '',
										'background-repeat' => '', 
										'background-position' => '', 
										'css' => '#main_area .content_wide, #main_area .content_narrow'
									),
									'type' => 'bgproperties');
									
				$design[] = array(  'name' => 'Boxed grids font',
									'desc' => 'Select the typography you want for your <code>#main_area .widget</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_main_area_boxes',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => '#main_area .widget'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => 'Boxed grids <code>a</code> link font',
									'desc' => 'Select the typography you want for your <code>#main_area .widget a</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_main_area_boxes_a',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => '#main_area .widget a'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => 'Boxed grids widget title',
									'desc' => 'Select the typography you want for your <code>#main_area .widget h3</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_main_area_boxes_title',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => '#main_area .widget h3'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => 'Boxed grids widget top border',
									'desc' => 'Specify border properties to be applied to <code>#main_area .widget</code> tags.',
									'id' => $shortname.'_b_main_area_boxes_sep',
									'std' => array(
										'border-position' => 'border-top',
										'border-width' => '', 
										'border-style' => '', 
										'border-color' => '',
										'css' => '#main_area .widget'
									),
									'type' => 'border');
									
				$design[] = array(  'name' => 'Boxed grids widget right border',
									'desc' => 'Specify border properties to be applied to <code>.content_wide</code> tags.',
									'id' => $shortname.'_b_main_area_boxes_sep_r',
									'std' => array(
										'border-position' => 'border-right',
										'border-width' => '', 
										'border-style' => '', 
										'border-color' => '',
										'css' => '.content_wide'
									),
									'type' => 'border');
									
				} else {
				
				$design[] = array(	"name" => "To use these options, please <a href='" . $bloghomeurl . "wp-admin/admin.php?page=bizz-license'>Upgrade to Standard or Agency Theme Package</a>.",
									"type" => "help");
				
				}
															
			$design[] = array(	'type' => 'subheadingbottom');
																	
		$design[] = array(	'type' => 'maintablebreak');
		
		////// Footer Area Styling

		$design[] = array(	'name' => 'Footer Area',
							'type' => 'heading');
									
			$design[] = array(	'name' => 'General Styling',
								'toggle' => 'true',
								'type' => 'subheadingtop');
									
				if ($bizz_package != 'ZnJlZQ=='){
				
				$design[] = array(  'name' => 'Area background',
									'desc' => 'Specify <code>#footer_area</code> background properties. <span class="important">Uploading image is optional, so you may only choose background color if you like.</span>',
									'id' => $shortname.'_bg_footer_area',
									'std' => array(
										'background-image' => '',
										'background-color' => '',
										'background-repeat' => '', 
										'background-position' => '', 
										'css' => '#footer_area'
									),
									'type' => 'bgproperties');
																								
				$design[] = array(	'name' => '-------------------------------------------------:[ grid styling ]:-------------------------------------------------',
									'type' => 'help');
									
				$design[] = array(  'name' => 'Boxed grids background',
									'desc' => 'Specify <code>#footer_area .footer_one, #footer_area .footer_two, #footer_area .footer_three</code> background properties. <span class="important">Uploading image is optional, so you may only choose background color if you like.</span>',
									'id' => $shortname.'_bg_footer_area_boxes',
									'std' => array(
										'background-image' => '',
										'background-color' => '',
										'background-repeat' => '', 
										'background-position' => '', 
										'css' => '#footer_area .footer_one, #footer_area .footer_two, #footer_area .footer_three'
									),
									'type' => 'bgproperties');
									
				$design[] = array(  'name' => 'Boxed grids font',
									'desc' => 'Select the typography you want for your <code>#footer_area .widget</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_footer_area_boxes',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => '#footer_area .widget'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => 'Boxed grids <code>a</code> link font',
									'desc' => 'Select the typography you want for your <code>#footer_area .widget a</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_footer_area_boxes_a',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => '#footer_area .widget a'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => 'Boxed grids widget title',
									'desc' => 'Select the typography you want for your <code>#footer_area .widget h3</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
									'id' => $shortname.'_f_footer_area_boxes_title',
									'std' => array(
										'font-size' => '', 
										'font-family' => '', 
										'font-style' => '', 
										'font-variant' => '',
										'font-weight' => '', 
										'color' => '',
										'css' => '#footer_area .widget h3'
									),
									'type' => 'typography');
									
				$design[] = array(  'name' => 'Boxed grids widget top border',
									'desc' => 'Specify border properties to be applied to <code>#footer_area .widget</code> tags.',
									'id' => $shortname.'_b_footer_area_boxes_sep',
									'std' => array(
										'border-position' => 'border-top',
										'border-width' => '', 
										'border-style' => '', 
										'border-color' => '',
										'css' => '#footer_area .widget'
									),
									'type' => 'border');
									
				$design[] = array(  'name' => 'Boxed grids widget right border',
									'desc' => 'Specify border properties to be applied to <code>#footer_area .footer_one. #footer_area .footer_two</code> tags.',
									'id' => $shortname.'_b_footer_area_boxes_sep_r',
									'std' => array(
										'border-position' => 'border-right',
										'border-width' => '', 
										'border-style' => '', 
										'border-color' => '',
										'css' => '#footer_area .footer_one, #footer_area .footer_two'
									),
									'type' => 'border');
									
				} else {
				
				$design[] = array(	"name" => "To use these options, please <a href='" . $bloghomeurl . "wp-admin/admin.php?page=bizz-license'>Upgrade to Standard or Agency Theme Package</a>.",
									"type" => "help");
				
				}
															
			$design[] = array(	'type' => 'subheadingbottom');
																	
		$design[] = array(	'type' => 'maintablebreak');
								
	$design[] = array(	'type' => 'maintablebottom');


	/* GLOBAL THEME OPTIONS */
	/*------------------------------------------------------------------*/
				
	do_action( 'bizz_add_options' );

}
	