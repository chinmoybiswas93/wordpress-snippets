<?php

/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

if (!function_exists('insurigo_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */

    define('insurigo_THEME_DIR', get_template_directory());
    define('insurigo_THEME_URI', get_template_directory_uri());
    define('insurigo_THEME_SUB_DIR', insurigo_THEME_DIR . '/inc/');
    define('insurigo_THEME_CSS_DIR', insurigo_THEME_URI . '/css/');
    define('insurigo_THEME_JS_DIR', insurigo_THEME_URI . '/js/');

    function insurigo_setup()
    {
        /*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on insurigo, use a find and replace
	 * to change 'insurigo' to the name of your theme in all the template files.
	 */
        load_theme_textdomain('insurigo', get_template_directory() . '/languages');


        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');
        /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
        add_theme_support('title-tag');

        function insurigo_change_excerpt($text)
        {
            $pos = strrpos($text, '[');
            if ($pos === false) {
                return $text;
            }

            return rtrim(substr($text, 0, $pos)) . '...';
        }
        add_filter('get_the_excerpt', 'insurigo_change_excerpt');


        // Limit Excerpt Length by number of Words
        function insurigo_custom_excerpt($limit)
        {
            $excerpt = explode(' ', get_the_excerpt(), $limit);
            if (count($excerpt) >= $limit) {
                array_pop($excerpt);
                $excerpt = implode(" ", $excerpt) . '...';
            } else {
                $excerpt = implode(" ", $excerpt);
            }
            $excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
            return $excerpt;
        }
        function content($limit)
        {
            $content = explode(' ', get_the_content(), $limit);
            if (count($content) >= $limit) {
                array_pop($content);
                $content = implode(" ", $content) . '...';
            } else {
                $content = implode(" ", $content);
            }
            $content = preg_replace('/[.+]/', '', $content);
            $content = apply_filters('the_content', $content);
            $content = str_replace(']]>', ']]&gt;', $content);
            return $content;
        }

        /*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary Menu', 'insurigo'),
        ));
        /*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('insurigo_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ));

        //add support posts format
        add_theme_support('post-formats', array(
            'aside',
            'gallery',
            'audio',
            'video',
            'image',
            'quote',
            'link',
        ));

        add_theme_support('align-wide');
    }

endif;
add_action('after_setup_theme', 'insurigo_setup');


/**
 *Custom Image Size
 */

add_image_size('insurigo_portfolio-slider', 520, 640, true);
add_image_size('insurigo_addom_team_round_style', 500, 500, true);
add_image_size('insurigo_porfolio-single-size', 1200, 500, true);
add_image_size('insurigo_blog-list-grid', 625, 556, true);
add_image_size('insurigo_blog-list-grid2', 416, 415, true);


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function insurigo_content_width()
{
    $GLOBALS['content_width'] = apply_filters('insurigo_content_width', 640);
}
add_action('after_setup_theme', 'insurigo_content_width', 0);

/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 *  Enqueue scripts and styles.
 */
require_once get_template_directory() . '/inc/template-scripts.php';



/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/template-functions.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/template-sidebar.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/customizer.php';

// TGM Plugin Activation
if (is_admin()) {
    require_once get_template_directory() . '/framework/class-tgm-plugin-activation.php';
    require_once get_template_directory() . '/framework/tgm-config.php';
}


/**
 * Customizer additions.
 */
require_once insurigo_THEME_SUB_DIR . '/customizer/includes.php';
require_once get_template_directory() . '/framework/custom.php';




/**
 * Registers an editor stylesheet for the theme.
 */
function insurigo_theme_add_editor_styles()
{
    add_editor_style('css/custom-editor-style.css');
}
add_action('admin_init', 'insurigo_theme_add_editor_styles');



//------------------------------------------------------------------------
//Organize Comments form field
//-----------------------------------------------------------------------
function insurigo_wpb_move_comment_field_to_bottom($fields)
{
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter('comment_form_fields', 'insurigo_wpb_move_comment_field_to_bottom');

add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    }
    return $title;
});


function insurigo_comment_textarea_placeholder($args)
{
    $replace_comment = __('Comment*', 'insurigo');
    $args['comment_field']        = str_replace('<textarea', '<textarea placeholder="' . $replace_comment . '"', $args['comment_field']);
    return $args;
}
add_filter('comment_form_defaults', 'insurigo_comment_textarea_placeholder');

/**
 * Comment Form Fields Placeholder
 *
 */
function insurigo_comment_form_fields($fields)
{
    $replace_author = __('Name*', 'insurigo');
    $replace_email = __('Email*', 'insurigo');
    $website_url = __('Website', 'insurigo');
    foreach ($fields as &$field) {
        $field = str_replace('id="author"', 'id="author" placeholder="' . $replace_author . '"', $field);
        $field = str_replace('id="email"', 'id="email" placeholder="' . $replace_email . '"', $field);
        $field = str_replace('id="url"', 'id="url" placeholder="' . $website_url . '"', $field);
    }
    return $fields;
}
add_filter('comment_form_default_fields', 'insurigo_comment_form_fields');




function hederScripts()
{
?>
    <script>
        var lastScrollTop = 0;
        var screenHeight = window.innerHeight * 0.2; // 20% of the screen height

        window.addEventListener("scroll", function() {
            var currentScroll = window.pageYOffset || document.documentElement.scrollTop;

            if (currentScroll > lastScrollTop && currentScroll > screenHeight) {
                // Scroll down and scrolled more than 20% of screen height
                document.querySelector('.gps-header').classList.add('hide');
            } else {
                // Scroll up or not scrolled down enough
                document.querySelector('.gps-header').classList.remove('hide');
            }

            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
        }, false);

        // 		service // 		
        // Function to toggle the overflow property of the description element
        function toggleOverflow(description) {

            console.log(description);

            if (description.style.overflow === 'hidden') {
                description.style.overflow = 'visible';
            } else {
                description.style.overflow = 'hidden';
            }

        }

        function addSeeMoreButtons() {
            // Get a reference to all elements with the class "service-desc .description"
            var elements = document.querySelectorAll(".service-desc .description");
            console.log(elements);

            // Iterate through each element
            elements.forEach(function(description) {
                // Create a "See More" button element
                var button = document.createElement("button");
                button.textContent = "See More";
                button.classList.add("see-more-btn");

                // Append the button to the container
                description.parentNode.appendChild(button);

                // Add event listener to the button
                button.addEventListener("click", function(e) {
                    // 		var description = document.querySelectorAll('.service-desc .description');
                    //       toggleOverflow(description);
                    e.target.parentElement.classList.toggle("MoreTxt");
                    if (button.textContent === "See More") {
                        button.textContent = "See Less";
                    } else {
                        button.textContent = "See More";
                    }
                    console.log(e.target.parentElement);
                });
            });
        }

        // Call the function after a delay of 2000 milliseconds (2 seconds)
        setTimeout(addSeeMoreButtons, 2000);
    </script>

<?php
}
add_action('wp_footer', 'hederScripts', 9999);
