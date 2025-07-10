<?php
/**
 * crossroads_theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package crossroads_theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function crossroads_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on crossroads_theme, use a find and replace
		* to change 'crossroads_theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'crossroads_theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'crossroads_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'crossroads_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function crossroads_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'crossroads_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'crossroads_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function crossroads_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'crossroads_theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'crossroads_theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'crossroads_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function crossroads_theme_scripts() {
	wp_enqueue_style( 'crossroads_theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'crossroads_theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'crossroads_theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'crossroads_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

require get_template_directory() . '/inc/cpt.php';
/**
 * Enqueue Google Fonts (Urbanist and Inter) for the theme.
 */
function crossroads_enqueue_google_fonts() {
    // Enqueue Urbanist font
    wp_enqueue_style(
        'google-font-urbanist', // Unique handle for the stylesheet
        'https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap',
        array(), // No dependencies
        null // Use null for version as Google Fonts handles its own versioning
    );

    // Enqueue Inter font
    wp_enqueue_style(
        'google-font-inter', // Unique handle for the stylesheet
        'https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap',
        array(), // No dependencies
        null // Use null for version
    );
}
add_action( 'wp_enqueue_scripts', 'crossroads_enqueue_google_fonts' );
/**
 * Add fonts.
 */
function crossroads_add_editor_styles() {
    add_theme_support( 'editor-styles' );
    // Enqueue Urbanist for the editor
    wp_enqueue_style(
        'google-font-urbanist-editor',
        'https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap',
        array(),
        null
    );

    // Enqueue Inter for the editor
    wp_enqueue_style(
        'google-font-inter-editor',
        'https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap',
        array(),
        null
    );
}
add_action( 'after_setup_theme', 'crossroads_add_editor_styles' );

function crossroads_enqueue_block_editor_assets() {
    wp_enqueue_style(
        'google-font-urbanist-editor-assets',
        'https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'google-font-inter-editor-assets',
        'https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap',
        array(),
        null
    );
}
add_action( 'enqueue_block_editor_assets', 'crossroads_enqueue_block_editor_assets' );
/**
 * Load CSS.
 */
function crossroads_enqueue_styles() {
	wp_enqueue_style('plugins-css', get_template_directory_uri() . '/assets/css/plugins.css');
  wp_enqueue_style('critical-css', get_template_directory_uri() . '/assets/css/critical.css');
  wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
	wp_enqueue_style('swiper-css', get_template_directory_uri() . '/assets/css/swiper.css');
  wp_enqueue_style('custom-css', get_template_directory_uri() . '/assets/css/style.css');
	wp_enqueue_style('custom-mobile.css', get_template_directory_uri() . '/assets/css/style-mobile.min.css');

}
add_action('wp_enqueue_scripts', 'crossroads_enqueue_styles');
/**
 * Load JS.
 */
function crossroads_enqueue_scripts() {
    wp_enqueue_script('jquery');

    wp_enqueue_script('plugins-js', get_template_directory_uri() . '/assets/js/plugins.js', ['jquery'], null, true);
	wp_enqueue_script('designesia-js', get_template_directory_uri() . '/assets/js/designesia.min.js', ['jquery', 'plugins-js'], null, true);
    wp_enqueue_script('swiper-js', get_template_directory_uri() . '/assets/js/swiper.js', ['jquery'], null, true);
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/custom.js', ['jquery', 'designesia-js'], null, true);
}
add_action('wp_enqueue_scripts', 'crossroads_enqueue_scripts');
/**
 * Font Awesome
 */
function crossroads_enqueue_fontawesome() {
  wp_enqueue_style(
    'font-awesome',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css',
    [],
    '6.0.0'
  );
}
add_action('wp_enqueue_scripts', 'crossroads_enqueue_fontawesome');
/**
 * Config
 */
if (function_exists('acf_add_options_page')) {
  acf_add_options_page([
    'page_title' => 'Website Settings',
    'menu_title' => 'Website Settings',
    'menu_slug'  => 'site-settings',
    'capability' => 'edit_posts',
    'redirect'   => false
  ]);
}
/**
 * header menu
 */
function crossroads_register_menus() {
  register_nav_menus([
    'main_menu'   => 'Main Menu',
    'footer_menu' => 'Footer Menu'
  ]);
}
add_action('after_setup_theme', 'crossroads_register_menus');

/**
 * add a class to all subpages
 */
function add_custom_body_class($classes) {
  if (!is_front_page() && !is_home()) {
    $classes[] = 'subpage';
  }
  return $classes;
}
add_filter('body_class', 'add_custom_body_class');
/**
 * create dyamic navbar
 */
class Services_Menu_Walker extends Walker_Nav_Menu {

    /**
     * Starts the list of the current level of the tree.
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param int    $depth Depth of the current menu item.
     * @param array  $args   An array of arguments.
     */
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        // Add a class for sub-menus, useful for styling
        $output .= '<ul class="sub-menu depth-' . esc_attr($depth) . '">';
    }

    /**
     * Ends the list of the current level of the tree.
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param int    $depth Depth of the current menu item.
     * @param array  $args   An array of arguments.
     */
    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</ul>';
    }

    /**
     * Starts the element output.
     *
     * @param string  $output Used to append additional content (passed by reference).
     * @param WP_Post $item   Menu item data object.
     * @param int     $depth  Depth of menu item. Used for padding.
     * @param array   $args   An array of arguments.
     * @param int     $id     Current item ID.
     */
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $title   = esc_html($item->title);
        $url     = esc_url($item->url);
        $classes = implode(' ', $item->classes ?? []);

        // Check if this is the "Services" menu item at the top level (depth 0)
        // This allows you to create a "Services" menu item in Appearance > Menus
        // and have this walker dynamically populate its children.
        if (stripos($title, 'Services') !== false && $depth === 0) {
            // Start the main "Services" parent menu item
            $output .= '<li class="menu-item-has-children has-child ' . esc_attr($classes) . '">';
            // Link to the main services archive page
            $output .= '<a class="menu-item" href="' . home_url('/services/') . '">' . $title . '</a>';
            // Add a dropdown icon for mobile/responsive menus
            $output .= '<span><i class="fas fa-chevron-down d-flex d-lg-none"></i></span>';
            
            // Start the sub-menu for service categories
            $output .= '<ul class="sub-menu">';

            // Get top-level service categories
            $categories = get_terms([
                'taxonomy'   => 'service-category',
                'hide_empty' => false,
                // 'orderby'    => 'name', // Default alphabetical order
                // For custom order, use 'orderby' => 'meta_value_num' and 'meta_key' => 'term_order_field_name'
                // after implementing a custom field for term order.
                // Or, if using a plugin like "Category Order and Taxonomy Terms Order", it might
                // automatically adjust the default query or provide a specific 'orderby' value.
                'parent'     => 0, // Only get top-level categories
            ]);

            if (!empty($categories) && !is_wp_error($categories)) {
                foreach ($categories as $cat) {
                    // Start a list item for each service category
                    $output .= '<li class="has-child">';
                    // Correct URL for service category archive: /services/{category-slug}/
                    $output .= '<a href="' . home_url('/services/' . $cat->slug . '/') . '">' . esc_html($cat->name) . '</a>';
                    // Add a dropdown icon for mobile/responsive menus
                    $output .= '<span><i class="fas fa-chevron-down d-flex d-lg-none"></i></span>';
                    
                    // Start the sub-menu for services within this category
                    $output .= '<ul class="sub-menu">';

                    // Get services (posts) associated with this category and its children
                    $services = get_posts([
                        'post_type'      => 'service',
                        'post_status'    => 'publish',
                        'posts_per_page' => -1, // Get all services
                        'orderby'        => 'menu_order', // Order by 'Order' field in post editor
                        'order'          => 'ASC',
                        'tax_query'      => [[
                            'taxonomy'         => 'service-category',
                            'field'            => 'term_id',
                            'terms'            => $cat->term_id, // Get posts directly in this category
                            'include_children' => true, // Also include posts in child categories
                        ]],
                    ]);

                    if ($services) {
                        foreach ($services as $service) {
                            // Link to individual service post
                            $output .= '<li><a href="' . get_permalink($service->ID) . '">' . esc_html($service->post_title) . '</a></li>';
                        }
                    } else {
                        // Optional: Display a message if no services are found for a category
                        // $output .= '<li><a href="#">No services in this category</a></li>';
                    }

                    $output .= '</ul></li>'; // End service category sub-menu and list item
                }
            } else {
                $output .= '<li><a href="#">No service categories found</a></li>';
            }

            $output .= '</ul></li>'; // End main "Services" sub-menu and list item

        } else {
            // Render regular menu items (not the special "Services" item)
            $output .= '<li class="' . esc_attr($classes) . '">';
            $output .= '<a class="menu-item" href="' . $url . '">' . $title . '</a>';
            // If the item has children, you might want to add the dropdown span here too
            if (in_array('menu-item-has-children', $item->classes ?? [])) {
                $output .= '<span><i class="fas fa-chevron-down d-flex d-lg-none"></i></span>';
            }
            // The Walker handles the sub-level <ul> and </ul> tags automatically for regular items
        }
    }

    /**
     * Ends the element output.
     *
     * @param string  $output Used to append additional content (passed by reference).
     * @param WP_Post $item   Menu item data object.
     * @param int     $depth  Depth of menu item. Used for padding.
     * @param array   $args   An array of arguments.
     */
    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= '</li>';
    }
}
/**
 * listener to change slug when a post name is changed
 */
add_action('save_post', function ($post_id) {
    // Only run for 'team' post type
    if (get_post_type($post_id) !== 'team') return;

    // Don't run on autosave or quick edit
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Get current slug and title
    $post = get_post($post_id);
    $current_slug = $post->post_name;
    $new_slug = sanitize_title($post->post_title);

    // Only update if slug doesn't match title and wasn't manually changed
    if ($current_slug !== $new_slug && !isset($_POST['post_name'])) {
        wp_update_post([
            'ID' => $post_id,
            'post_name' => $new_slug,
        ]);
    }
});
/**
 * patterns
 */
add_action('init', function () {
  // Register the pattern category once
  register_block_pattern_category('custom', [
    'label' => __('Custom Patterns', 'crossroads_theme'),
  ]);

  // Register both patterns
  register_block_pattern(
    'crossroads_theme/welcome-section',
    require get_template_directory() . '/patterns/welcome-section.php'
  );

  register_block_pattern(
    'crossroads_theme/why-choose-us',
    require get_template_directory() . '/patterns/why-choose-us.php'
  );
});

function enqueue_pattern_padding_remover_script() {
    // Check if the script should be loaded only on specific pages/posts if needed
    // For now, it will load on all pages.
    wp_enqueue_script(
        'pattern-padding-remover',
        get_template_directory_uri() . '/assets/js/pattern-padding-remover.js',
        array('jquery'), // Add jQuery as a dependency if you use it, otherwise remove.
        filemtime(get_template_directory() . '/assets/js/pattern-padding-remover.js'), // Cache busting
        true // Load in the footer
    );
}
add_action('wp_enqueue_scripts', 'enqueue_pattern_padding_remover_script');

