<?php //Pleiades17 Premium Theme functions and definitions

function pleiades17_setup() {
	
	// Make theme available for translation
	load_theme_textdomain('pleiades17');
	
	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');
	
	//Let WordPress manage the document title.
	add_theme_support('title-tag');
	
	// POST THUMBNAILS
	add_theme_support('post-thumbnails');
	add_image_size('pleiades17-featured-image', 2000, 1200, true);
	add_image_size('pleiades17-thumbnail-avatar', 100, 100, true);
	
	// NAVIGATION
	register_nav_menus(array(
		'top'    => __('Top Menu', 'pleiades17'),
		'social' => __('Social Links Menu', 'pleiades17'),
	));
	
	// HTML5 support
	add_theme_support('html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	));

	// POST FORMATS
	add_theme_support('post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	));

	// Custom Logo.
	add_theme_support('custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	));

	// Selective Refresh for widgets VERIFY
	add_theme_support('customize-selective-refresh-widgets');

	// Visual Editor Styles
	add_editor_style(array('assets/css/editor-style.css'));

	add_theme_support('starter-content', array(
		'widgets' => array(
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),
			'sidebar-2' => array(	
				'text_business_info',
			),
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),
		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x('Espresso', 'Theme starter content', 'pleiades17'),
				'file' => 'assets/images/espresso.jpg',
			),
			'image-sandwich' => array(
				'post_title' => _x('Sandwich', 'Theme starter content', 'pleiades17'),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x('Coffee', 'Theme starter content', 'pleiades17'),
				'file' => 'assets/images/coffee.jpg',
			),
		),
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),
		'nav_menus' => array(
			'top' => array(
				'name' => __('Top Menu', 'pleiades17'),
				'items' => array(
					'page_home',
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
			'social' => array(
				'name' => __('Social Links Menu', 'pleiades17'),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	)); //add_theme_support('starter-content'...)
} //function pleiades17_setup()
add_action('after_setup_theme', 'pleiades17_setup');

// MIN CONTENT WITH
function pleiades17_content_width() {
	$content_width = 700;
	if (pleiades17_is_frontpage()) {
		$content_width = 1120;
	}
	$GLOBALS['content_width'] = apply_filters('pleiades17_content_width', $content_width);
}
add_action('after_setup_theme', 'pleiades17_content_width', 0);

// WIDGET AREAS
function pleiades17_widgets_init() {
	register_sidebar(array(
		'name'          => __('Sidebar', 'pleiades17'),
		'id'            => 'sidebar-1',
		'description'   => __('Add widgets here to appear in your sidebar.', 'pleiades17'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));

	register_sidebar(array(
		'name'          => __('Footer 1', 'pleiades17'),
		'id'            => 'sidebar-2',
		'description'   => __('Add widgets here to appear in your footer.', 'pleiades17'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar(array(
		'name'          => __('Footer 2', 'pleiades17'),
		'id'            => 'sidebar-3',
		'description'   => __('Add widgets here to appear in your footer.', 'pleiades17'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action('widgets_init', 'pleiades17_widgets_init');

// REPLACES "[...]" with ... and "Continue reading"
function pleiades17_excerpt_more($link) {
	if (is_admin()) {
		return $link;
	}
	$link = sprintf('<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url(get_permalink( get_the_ID())),
		sprintf(__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'pleiades17'), get_the_title(get_the_ID()))
	);
	return ' &hellip; ' . $link;
}
add_filter('excerpt_more', 'pleiades17_excerpt_more');

// JAVASCRIPT DETECTION
function pleiades17_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action('wp_head', 'pleiades17_javascript_detection', 0);

// DISPLAY CUSTOM CSS COLORS (disabled for now)
/*function pleiades17_colors_css_wrap() {
	if ('custom' !== get_theme_mod('colorscheme') && !is_customize_preview()) {
		return;
	}
	require_once(get_parent_theme_file_path('/inc/color-patterns.php'));
	$hue = absint(get_theme_mod('colorscheme_hue', 250));
?>
	<style type="text/css" id="custom-theme-colors" <?php if (is_customize_preview()) { echo 'data-hue="' . $hue . '"'; } ?>>
		<?php echo pleiades17_custom_colors_css(); ?>
	</style>
<?php }
add_action('wp_head', 'pleiades17_colors_css_wrap');*/

/********************************************************
****************** STYLES & SCRIPTS *********************
********************************************************/

function pleiades17_scripts() {

	// MAIN CSS style.css
	wp_enqueue_style('pleiades17-style', get_stylesheet_uri());

	// Internet Explorer 8 specific stylesheet
	wp_enqueue_style('pleiades17-ie8', get_theme_file_uri('/assets/css/ie8.css'), array('pleiades17-style'), '1.0');
	wp_style_add_data('pleiades17-ie8', 'conditional', 'lt IE 9');

	// HTML5 shiv
	wp_enqueue_script('html5', get_theme_file_uri('/assets/js/html5.js'), array(), '3.7.3');
	wp_script_add_data('html5', 'conditional', 'lt IE 9');

	// SKIP LINK FOCUS
	wp_enqueue_script('pleiades17-skip-link-focus-fix', get_theme_file_uri('/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true);

	// SVG
	$pleiades17_l10n = array(
		'quote' => pleiades17_get_svg(array('icon' => 'quote-right')),
	);

	// NAVIGATION
	if (has_nav_menu('top')) {
		wp_enqueue_script('pleiades17-navigation', get_theme_file_uri('/assets/js/navigation.js'), array(), '1.0', true);
		$pleiades17_l10n['expand']    = __('Expand child menu', 'pleiades17');
		$pleiades17_l10n['collapse']  = __('Collapse child menu', 'pleiades17');
		$pleiades17_l10n['icon']      = pleiades17_get_svg(array('icon' => 'angle-down', 'fallback' => true));
	}

	// GLOBAL ScreenReaderText
	wp_enqueue_script('pleiades17-global', get_theme_file_uri('/assets/js/global.js'), array('jquery'), '1.0', true);

	// ScrollTo
	wp_enqueue_script('jquery-scrollto', get_theme_file_uri('/assets/js/jquery.scrollTo.js'), array('jquery'), '2.1.2', true);

	// Skip Link Focus
	wp_localize_script('pleiades17-skip-link-focus-fix', 'pleiades17ScreenReaderText', $pleiades17_l10n);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'pleiades17_scripts');

// Custom image sizes attribute (enhance responsive image functionality)
function pleiades17_content_image_sizes_attr($sizes, $size) {
	$width = $size[0];
	if (740 <= $width) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}
	if (is_active_sidebar('sidebar-1') || is_archive() || is_search() || is_home() || is_page()) {
		if (!(is_page() && 'one-column' === get_theme_mod('page_options')) && 767 <= $width) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}
	return $sizes;
}
add_filter('wp_calculate_image_sizes', 'pleiades17_content_image_sizes_attr', 10, 2);

// Filter the `sizes` value in the header image markup
function pleiades17_header_image_tag($html, $header, $attr) {
	if (isset($attr['sizes'])) {
		$html = str_replace($attr['sizes'], '100vw', $html);
	}
	return $html;
}
add_filter('get_header_image_tag', 'pleiades17_header_image_tag', 10, 3);

// Add custom image sizes attribute to enhance responsive image functionality
function pleiades17_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if (is_archive() || is_search() || is_home()) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}
	return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'pleiades17_post_thumbnail_sizes_attr', 10, 3);

// Use front-page.php when Front page displays is set to a static page
function pleiades17_front_page_template($template) {
	return is_home() ? '' : $template;
}
add_filter('frontpage_template',  'pleiades17_front_page_template');

// Implement the Custom Header feature
require get_parent_theme_file_path('/inc/custom-header.php');

// Template Tags
require get_parent_theme_file_path('/inc/template-tags.php');

// Template Functions
require get_parent_theme_file_path('/inc/template-functions.php');

// Customizer
require get_parent_theme_file_path('/inc/customizer.php');

// SVG icons functions and filters.
require get_parent_theme_file_path('/inc/icon-functions.php');



