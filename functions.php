<?php
/**
 * JHT functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, jht_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'jht_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */


if ( !session_id() )
	add_action( 'init', 'session_start' );


/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

if ( ! isset( $tubcats ) )
	$tubcats = array();

/** Tell WordPress to run jht_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'jht_setup' );

if ( ! function_exists( 'jht_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override jht_setup() in a child theme, add your own jht_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since JHT 1.0
 */
function jht_setup() {
	// This theme uses post thumbnails (a LOT)
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'home-slide', 1600, 501, true );
	add_image_size( 'home-feature', 359, 205, true );
	add_image_size( 'background', 1600, 839, true );
	add_image_size( 'catlanding', 230, 250, true );
	add_image_size( 'overhead', 257, 257, false );
	add_image_size( 'overhead-large', 352, 352, false );
	add_image_size( 'overhead-medium', 290, 290, false );
	add_image_size( 'three-quarter', 357, 285, true );
	add_image_size( 'one-half-th', 475, 335, true );
	add_image_size( 'three-quarter-compare', 184, 147, true );
	add_image_size( 'three-quarter-nav', 150, 120, false );
	//add_image_size( 'navfeature', 140, 120, true );
	add_image_size( 'options-small-thumbs', 29, 28, true );
	add_image_size( 'options-medium-thumbs', 35, 40, true );
	add_image_size( 'right-thumbs', 61, 62, true );
	add_image_size( 'feature-option', 213, 213, true );
	add_image_size( 'gallery-main', 642, 428, true );
	add_image_size( 'gallery-thumb', 100, 66, true );
	add_image_size( 'jet', 140, 140, true );
	add_image_size( 'jet-thumb', 70, 70, true );
	add_image_size( 'jet-image', 640, 390, true );
	add_image_size( 'warranty', 117, 118, true );
	add_image_size( 'accthm', 150, 120, false );
	add_image_size( 'accimg', 257, 257, false );
	add_image_size( 'component', 284, 206, true );
	add_image_size( 'blog-large', 661, 495, true );
	add_image_size( 'video-thumb', 57, 37, true );
	add_image_size( 'navright', 237, 248, true );

	/*
	 *This theme uses wp_nav_menu() in one location?
	 */
	register_nav_menus( array(
		'ftline1' => __( 'Footer Line 1', 'jht' ),
		'ftline2' => __( 'Footer Line 2', 'jht' ),
		'ftres' => __( 'Footer Resources', 'jht' ),
		'acc' => __( 'Accessories', 'jht' ),
		'deal' => __( 'Landing Side menu', 'jht' ),
	) );
	// add custom actions
	add_action( 'init', 'jht_init' );
	add_action( 'admin_init', 'jht_admin_init' );
	add_action( 'widgets_init', 'jht_widgets_init' );
	add_action( 'save_post', 'jht_meta_save');
	add_action( 'admin_menu', 'jht_admin_menu_cleanup');
	add_action( 'wp_print_scripts', 'jht_add_scripts');
	add_action( 'wp_print_styles', 'jht_add_styles');
	add_action( 'login_head', 'jht_custom_login_logo' );
	add_action( 'login_headerurl', 'jht_custom_login_url' );

	add_action( 'wp_enqueue_scripts', 'jht_enqueued_scripts' );
	
	// cleanup some
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	$bye = array( 'rsd_link', 'wlwmanifest_link', 'wp_generator' );
	foreach ( $bye as $b ) remove_action( 'wp_head', $b );
	
	// add custom filters
	add_filter( 'wp_page_menu_args', 'jht_page_menu_args' );
	add_filter( 'excerpt_length', 'jht_excerpt_length' );
	add_filter( 'excerpt_more', 'jht_auto_excerpt_more' );
	add_filter( 'get_the_excerpt', 'jht_custom_excerpt_more' );	
	add_filter( 'body_class', 'jht_body_class' );
	add_filter( 'embed_oembed_html', 'jht_embed', 10, 3);
	
	remove_filter( 'pre_get_posts', 'wptouch_custom_posts_pre_get_posts', 11 );
	
	global $tubcats;
	jht_tub_collection_setup();
}
endif;

if ( ! function_exists( 'jht_checksharethis' ) ):
function jht_checksharethis($a) {
	if ( is_tax('jht_acc_cat') || is_singular('jht_acc') ) {
		return '';
	}
	if ( is_page() ) {
		if ( !is_page(3888) && !is_page_template('page-truckload.php') ) { //anything else to remove ShareThis from?
			return '';
		}
	}
	return $a;
}
add_filter('pre_option_st_widget', 'jht_checksharethis');
endif;


if ( ! function_exists( 'jht_page_menu_args' ) ):
/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since JHT 1.0
 */
function jht_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
endif;


if ( ! function_exists( 'jht_excerpt_length' ) ):
/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since JHT 1.0
 * @return int
 */
function jht_excerpt_length( $length ) {
	return 40;
}
endif;

if ( ! function_exists( 'jht_continue_reading_link' ) ):
/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since JHT 1.0
 * @return string "Continue Reading" link
 */
function jht_continue_reading_link() {
	if ( is_search() ) {
		return ' <a href="'. get_permalink() . '">' . __( 'More Info', 'jht' ) . '</a>';
	}
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'jht' ) . '</a>';
}
endif;




if ( ! function_exists( 'jht_auto_excerpt_more' ) ):
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and jht_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since JHT 1.0
 * @return string An ellipsis
 */
function jht_auto_excerpt_more( $more ) {
	return ' &hellip;' . jht_continue_reading_link();
}
endif;



if ( ! function_exists( 'jht_custom_excerpt_more' ) ):
/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since JHT 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function jht_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= jht_continue_reading_link();
	}
	return $output;
}
endif;



if ( ! function_exists( 'jht_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own jht_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since JHT 1.0
 */
function jht_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'jht' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'jht' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'jht' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'jht' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'jht' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'jht' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override jht_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since JHT 1.0
 * @uses register_sidebar
 */
function jht_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'fbar promo popup', 'jht' ),
		'id' => 'fbar-promo',
		'description' => __( 'Promo Popup Block in the floating footer bar', 'jht' ),
		'before_widget' => '<div class="promo">',
		'after_widget' => '<a href="#x" class="x">close X</a></div>',
		'before_title' => '<div style="display:none">',
		'after_title' => '</div>',
	) );
	register_sidebar( array(
		'name' => __( 'Truckload - Upcoming List', 'jht' ),
		'id' => 'truckload-upcoming-list',
		'description' => __( 'Unordered list of upcoming Truckload event locations. Displayed on hot tubs Home Page.', 'jht' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<div style="display:none">',
		'after_title' => '</div>',
	) );
}

if ( ! function_exists( 'jht_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since JHT 1.0
 */
function jht_posted_on() {
	/*  Old method was to show blog posts by author...
	$linkit = ( get_the_author_meta('googleplus') ) ? '<a href="'.get_the_author_meta('googleplus').'">' : '';
	$unlinkit = ( $linkit ) ? '</a>' : '';
	echo 'Added by ' . $linkit . get_the_author() . $unlinkit;
	edit_post_link( __( 'Edit', 'jht' ), ' : <span class="edit-link">', '</span>' );
	*/
	the_date( 'F j, Y', 'Posted on ', '', true );
}
endif;

if ( ! function_exists( 'jht_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since JHT 1.0
 */
function jht_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'jht' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'jht' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'jht' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

if ( ! function_exists( 'jht_cleanclass' ) ):
function jht_cleanclass( $classes, $ar = array('page'), $keepers = array('admin-bar') ) {
	$keepers = apply_filters('jht_cleanclass_keepers', $keepers);
	foreach ( $classes as $k => $v ) {
		if ( !in_array($v, $keepers) ) unset($classes[$k]);
	}
	
	return array_merge($classes, $ar);
}
endif;
if ( ! function_exists( 'jht_body_class' ) ):
/**
 * adds some additional classes to the <body> based on what page we're on
 * @param array of classes to add to the <body> tag
 * @since JHT 1.0
 */
function jht_body_class($classes) {
	global $wp_query;
	$post = $wp_query->post;
	$jht_popup = get_post_meta($post->ID, 'jht_popup');
	$nopop = (array_key_exists( 0, $jht_popup ) ? $jht_popup[0] : null); //$jht_popup[0]
	$jht_form = get_post_meta($post->ID, 'jht_form');
	$form_type = (array_key_exists( 0, $jht_form ) ? $jht_form[0] : null); //$jht_form[0]
	$jht_ppcoption = get_post_meta($post->ID, 'jht_newppc_options');
	$ppcoption = (array_key_exists( 0, $jht_ppcoption ) ? $jht_ppcoption[0] : null); //$jht_ppcoption[0];

	switch ( $wp_query->query_vars['post_type'] ) {
		case 'jht_tub':
			$classes = jht_cleanclass( $classes, array('hot-tub-detail') );
			//$classes[] = 'jlx';
			break;
		case 'jht_cat':
			$classes = jht_cleanclass( $classes, array('hot-tub-landing') );
			//$classes[] = 'five-six';
			break;
		case 'jht_acc':
			$classes = jht_cleanclass( $classes );
			break;
	}
	if ( isset($nopop['popup'])) {
		if ( $nopop['popup'] == 'Yes' ) {
			$classes[] = 'nopop';
		}
	}
	if (isset($form_type['form'])) {
		if ( $form_type['form'] == 'other' ) {
			$classes[] = 'form';
		}
		if ( $form_type['form'] == 'Brochure' ) {
			$classes[] = 'brochure';
			$classes[] = 'form';
		}
		if ( $form_type['form'] == 'BuyersGuide' ) {
			$classes[] = 'buyersguide';
			$classes[] = 'brochure';
			$classes[] = 'form';
		}
		if ( $form_type['form'] == 'Quote' ) {
			$classes[] = 'quote';
			$classes[] = 'form';
		}
		if ( $form_type['form'] == 'TradeIn' ) {
			$classes[] = 'tradein';
			$classes[] = 'form';
		}
		if ( $form_type['form'] == 'Truckload' ) {
			$classes[] = 'truckload';
			$classes[] = 'form';
		}
	}
	if ( isset($ppcoption['color'])) {
		if ( $ppcoption['color'] == 'black' ) {
			$classes[] = 'ppc-black';
		}
		if ( $ppcoption['color'] == 'white' ) {
			$classes[] = 'ppc-white';
		}
	}
	
	if ( is_page() ) {
		// check for featured
		if ( has_post_thumbnail() && !is_page_template('page-buyersguide.php') ) {
			$classes[] = 'bighero';
		}
		if ( is_page_template('page-buyersguide.php') ) {
			$classes[] = 'noshadowl';
			$classes[] = 'form';
		}
		
		foreach ( $classes as $k => $v ) {
			if ( ( substr($v, 0, 8) == 'page-id-' ) || ( substr($v, 0, 14) == 'page-template-' ) ) unset($classes[$k]);
		}

		if ( is_page_template('page-quote-ppc.php') || is_page_template('page-quote-special-promo.php') ) {
			$classes[] = 'newppc';
		}
		if ( is_page_template('page-quote-special-promo.php') ) {
			$classes[] = 'special-promo';
		}

		/* progo direct ppc pages */
		if ( is_page_template('page-direct.php') ) {
			$classes[] = 'direct';
			$classes[] = 'direct-default';
		}
		if ( is_page_template('page-directtwo.php') ) {
			$classes[] = 'direct';
			$classes[] = 'direct2';
		}
		if ( is_page_template('page-directcanada.php') ) {
			$classes[] = 'direct';
			$classes[] = 'canada';
		}
		if ( is_page_template('page-directthanks.php') ) {
			$classes[] = 'direct';
			$classes[] = 'direct-thanks';
		}
		if ( is_page_template('page-directthankscanada.php') ) {
			$classes[] = 'direct';
			$classes[] = 'direct-thankscanada';
		}
		
		// To block pop-ups from page, add template file-name to this section:
		if ( is_page_template( 'page-newlanding1.php' ) 
			|| is_page_template( 'page-newlanding1b.php' ) 
			|| is_page_template( 'page-newlanding2.php' ) 
			|| is_page_template( 'page-twoColForm.php' ) 
			|| is_page_template( 'page-mobile.php') 
			) {
				$classes[] = 'nopop';
		}

		if ( is_page_template( 'page-brochure.php' ) 
			|| is_page_template( 'page-newlanding1.php' ) 
			|| is_page_template( 'page-buyersguide.php' )
			|| is_page_template( 'page-buyersguide-graphic.php' )
			|| is_page_template( 'page-newlanding1b.php' ) 
			|| is_page_template( 'page-newlanding2.php' ) 
			|| is_page_template( 'page-twoColForm.php' ) 
			|| is_page_template( 'page-jacuzzi-brochure-onepart.php' ) 
			) {
				$classes[] = 'brochure';
				$classes[] = 'form';
		}
		
		if ( is_page_template( 'page-truckload.php' ) ) {
			foreach ( $classes as $k => $v ) {
				if ( in_array( $v, array( 'page', 'page-template', 'bighero' ) ) ) {
					unset($classes[$k]);
				}
			}
			$classes[] = 'hot-tub-landing';
			$classes[] = 'form';
		}
		
		if ( is_page_template( 'page-quote.php' ) || is_page_template( 'page-appt.php' ) ) {
			$classes[] = 'quote';
			$classes[] = 'form';
		}

		if ( is_page_template( 'page-tradein.php' ) ) {
			$classes[] = 'tradein';
			$classes[] = 'form';
		}
		
		if ( is_page_template( 'page-about.php' ) ) {
			$classes[] = 'about';
			$classes[] = 'bighero';
		}
		
		if ( is_page_template( 'page-ee.php' ) ) {
			$classes[] = 'ee';
			$classes[] = 'bighero';
		}
		
		if ( is_page_template( 'page-noside.php' ) ) {
			$classes[] = 'noside';
		}
		
		if ( is_page_template( 'page-builder.php' ) ) {
			$classes[] = 'bb';
			$classes[] = 'bighero';
		}
		
		if ( is_page_template( 'page-hydrotherapy.php' ) ) {
			$classes[] = 'hydrotherapy';
			$classes[] = 'bighero';
		}

		if ( is_page_template( 'page-ownerscorner.php' ) || is_page_template( 'page-warranty.php' ) ) {
			$classes[] = 'oc';
			$classes[] = 'bighero';
		}
		
		if ( is_page_template( 'page-showcase.php' ) ) {
			$classes[] = 'showcase';
		}
		
		if ( is_page_template( 'page-video.php' ) ) {
			$classes[] = 'video-showcase';
		}
		
		if ( is_page_template( 'page-deals.php' ) ) {
			$classes[] = 'dir';
			$classes[] = 'dir1';
		}
		if ( is_page_template( 'page-deals-a.php' ) ) {
			//$classes[] = 'dir';
			$classes[] = 'dir-a';
		}
		
		if ( is_page_template( 'page-deals-b.php' ) ) {
			$classes[] = 'dir';
			$classes[] = 'dir-b';
		}
		if ( is_page_template( 'page-deals-c.php' ) ) {
			$classes[] = 'dir';
			$classes[] = 'dir-b';
			$classes[] = 'dir-c';
		}
		if ( is_page_template( 'page-mobile.php') ) {
			$classes[] = 'mobile';
		}
	}
	
	if ( is_home()  || is_singular('post') || ( is_archive() && !is_tax('jht_acc_cat')) ) {
		$classes[] = 'page';
		if ( in_array('blog', $classes) == false ) $classes[] = 'blog';
	}
	
	if ( is_tax('jht_acc_cat') ) {
		$classes = jht_cleanclass($classes);
	}
	
	if ( is_404() ) {
		foreach ( $classes as $k => $v ) {
			if ( $v == 'page' ) unset($classes[$k]);
		}
	}
	
	return $classes;
}
endif;

function jht_init() {
	register_post_type( 'jht_tub',
		array(
			'labels' => array(
				'name' => 'Hot Tubs',
				'singular_name' => 'Hot Tub',
				'add_new' => 'Add New Hot Tub',
				'add_new_item' => 'Add New Hot Tub',
				'edit_item' => 'Edit Hot Tub',
				'new_item' => 'New Hot Tub',
				'view_item' => 'View Hot Tub',
				'search_items' => 'Search Hot Tubs',
				'not_found' =>  'No tubs found',
				'not_found_in_trash' => 'No tubs found in Trash', 
				'parent_item_colon' => '',
				'menu_name' => 'Hot Tubs'
			),
			'public' => true,
			//'exclude_from_search' => true,
			'show_in_menu' => true,
			//'menu_position' => 7,
			'menu_icon' => get_bloginfo('template_url') .'/images/icons/admin_tub.png',
			'supports' => array('title','editor','thumbnail','page-attributes','revisions', 'custom-fields'),
			'register_meta_box_cb' => 'jht_tub_metaboxes',
			'rewrite' => array(
				'slug' => '%collection%',
				'with_front' => false
			),
			//'has_archive'=>true
		)
	);
	
	register_post_type( 'jht_cat',
		array(
			'labels' => array(
				'name' => 'Hot Tub Collections',
				'singular_name' => 'Collection',
				'add_new_item' => 'Add New Collection',
				'edit_item' => 'Edit Collection',
				'new_item' => 'New Collection',
				'view_item' => 'View Collection',
				'search_items' => 'Search Collections',
				'not_found' =>  'No Collection Found',
				'not_found_in_trash' => 'No Collections found in Trash', 
				'parent_item_colon' => '',
				'menu_name' => 'Collections'
			),
			'public' => true,
			//'exclude_from_search' => true,
			'show_in_menu' => 'edit.php?post_type=jht_tub',
			'hierarchical' => true,
			'supports' => array('title','editor','thumbnail','revisions','page-attributes', 'custom-fields'),
			'register_meta_box_cb' => 'jht_cat_metaboxes',
			'rewrite' => array(
				'slug' => '%jht_none%',
				'with_front' => false,
			),
			//'has_archive'=>true
		)
	);
	
	register_post_type( 'jht_color',
		array(
			'labels' => array(
				'name' => 'Acrylic Shell Colors',
				'singular_name' => 'Color',
				'add_new_item' => 'Add New Color',
				'edit_item' => 'Edit Color',
				'new_item' => 'New Color',
				'search_items' => 'Search Colors',
				'not_found' =>  'No Color Found',
				'not_found_in_trash' => 'No Colors found in Trash', 
				'parent_item_colon' => '',
				'menu_name' => 'Shell Colors'
			),
			'public' => true,
			'exclude_from_search' => true,
			'show_in_menu' => 'edit.php?post_type=jht_tub',
			'supports' => array('title','thumbnail','page-attributes'),
			'rewrite' => array(
				'slug' => 'color',
				'with_front' => false,
			),
			//'has_archive'=>true
		)
	);
	
	register_post_type( 'jht_cabinetry',
		array(
			'labels' => array(
				'name' => 'Cabinetry',
				'singular_name' => 'Cabinetry',
				'add_new_item' => 'Add New Cabinetry',
				'edit_item' => 'Edit Cabinetry',
				'new_item' => 'New Cabinetry',
				'search_items' => 'Search Cabinetry',
				'not_found' =>  'No Cabinetry Found',
				'not_found_in_trash' => 'No Cabinetry found in Trash', 
				'parent_item_colon' => '',
				'menu_name' => 'Cabinetry'
			),
			'public' => true,
			'exclude_from_search' => true,
			'show_in_menu' => 'edit.php?post_type=jht_tub',
			'supports' => array('title','thumbnail','page-attributes'),
			'rewrite' => array(
				'slug' => 'cabinetry',
				'with_front' => false,
			),
			//'has_archive'=>true
		)
	);
	
	register_post_type( 'jht_feat',
		array(
			'labels' => array(
				'name' => 'Features &amp; Options',
				'singular_name' => 'Feature',
				'add_new_item' => 'Add New Feature',
				'edit_item' => 'Edit Feature',
				'new_item' => 'New Feature',
				'search_items' => 'Search Feature &amp; Options',
				'not_found' =>  'No feature found',
				'not_found_in_trash' => 'No feature found in Trash', 
				'parent_item_colon' => '',
				'menu_name' => 'Features &amp; Options'
			),
			'public' => true,
			'exclude_from_search' => true,
			'show_in_menu' => 'edit.php?post_type=jht_tub',
			'supports' => array('title','editor','thumbnail','page-attributes'),
			'rewrite' => array(
				'slug' => 'features',
				'with_front' => false,
			),
			//'has_archive'=>true
		)
	);
	register_post_type( 'jht_jet',
		array(
			'labels' => array(
				'name' => 'Jets',
				'singular_name' => 'Jet',
				'add_new_item' => 'Add New Jet',
				'edit_item' => 'Edit Jet',
				'new_item' => 'New Jet',
				'search_items' => 'Search Jets',
				'not_found' =>  'No jet found',
				'not_found_in_trash' => 'No jet found in Trash', 
				'parent_item_colon' => '',
				'menu_name' => 'Jets'
			),
			'public' => true,
			'exclude_from_search' => true,
			'show_in_menu' => 'edit.php?post_type=jht_tub',
			'supports' => array('title','editor','thumbnail','page-attributes'),
			'rewrite' => array(
				'slug' => 'jets',
				'with_front' => false,
			),
			//'has_archive'=>true
		)
	);
	register_post_type( 'jht_warranty',
		array(
			'labels' => array(
				'name' => 'Warranties',
				'singular_name' => 'Warranty',
				'add_new_item' => 'Add New Warranty',
				'edit_item' => 'Edit Warranty',
				'new_item' => 'New Warranty',
				'search_items' => 'Search Warranties',
				'not_found' =>  'No warranties found',
				'not_found_in_trash' => 'No warranties found in Trash', 
				'parent_item_colon' => '',
				'menu_name' => 'Warranties'
			),
			'public' => true,
			'exclude_from_search' => true,
			'show_in_menu' => 'edit.php?post_type=jht_tub',
			'supports' => array('title','editor','thumbnail','page-attributes','revisions'),
			'rewrite' => array(
				'slug' => 'warranties',
				'with_front' => false,
			),
			//'has_archive'=>true
		)
	);
	// more FEATURED IMAGES functionality
	if (class_exists('MultiPostThumbnails')) {
		// jht_cat
		$thumb = new MultiPostThumbnails(array(
			'label' => 'Background Image',
			'id' => 'background-image',
			'post_type' => 'jht_cat',
			)
		);
		$thumb = new MultiPostThumbnails(array(
			'label' => 'Nav Rollover Image',
			'id' => 'nav-rollover',
			'post_type' => 'jht_cat',
			)
		);
		// jht_tub
		$thumb = new MultiPostThumbnails(array(
			'label' => 'Background Image',
			'id' => 'background-image',
			'post_type' => 'jht_tub',
			)
		);
		$thumb = new MultiPostThumbnails(array(
			'label' => 'Large Three-Quarter View',
			'id' => 'three-quarter',
			'post_type' => 'jht_tub',
			)
		);
		$thumb = new MultiPostThumbnails(array(
			'label' => 'Large Overhead',
			'id' => 'overhead-large',
			'post_type' => 'jht_tub',
			)
		);
		$thumb = new MultiPostThumbnails(array(
			'label' => 'Nav Rollover Image',
			'id' => 'nav-rollover',
			'post_type' => 'jht_tub',
			)
		);
	}
	
	register_post_type( 'jht_vid',
		array(
			'labels' => array(
				'name' => 'Videos',
				'singular_name' => 'Video',
				'add_new' => 'Add New Video',
				'add_new_item' => 'Add New Video',
				'edit_item' => 'Edit Video',
				'new_item' => 'New Video',
				'view_item' => 'View Video',
				'search_items' => 'Search Videos',
				'not_found' =>  'No Videos found',
				'not_found_in_trash' => 'No Videos found in Trash', 
				'parent_item_colon' => '',
				'menu_name' => 'Videos'
			),
			'public' => true,
			//'exclude_from_search' => true,
			'show_in_menu' => true,
			//'menu_position' => 7,
			'menu_icon' => get_bloginfo('template_url') .'/images/icons/admin_vid.png',
			'supports' => array('title','page-attributes','revisions'),
			'register_meta_box_cb' => 'jht_vid_metaboxes',
			'taxonomies' => array( 'jht_vid_cat' ),
			'rewrite' => array(
				'slug' => 'video-gallery',
				'with_front' => false
			),
			//'has_archive'=>true
		)
	);
	$labels = array(
		'name' => _x( 'Video Categories', 'taxonomy general name' ),
		'singular_name' => _x( 'Video Category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Video Categories' ),
		'all_items' => __( 'All Video Categories' ),
		'parent_item' => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item' => __( 'Edit Video Category' ), 
		'update_item' => __( 'Update Category' ),
		'add_new_item' => __( 'Add New Video Category' ),
		'new_item_name' => __( 'New Category Name' ),
		'menu_name' => __( 'Categories' ),
	); 	
	
	register_taxonomy('jht_vid_cat',array('jht_vid'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'cat' ),
	));
	
	
	register_post_type( 'jht_acc',
		array(
			'labels' => array(
				'name' => 'Accessories',
				'singular_name' => 'Accessory',
				'add_new' => 'Add New Accessory',
				'add_new_item' => 'Add New Accessory',
				'edit_item' => 'Edit Accessory',
				'new_item' => 'New Accessory',
				'view_item' => 'View Accessory',
				'search_items' => 'Search Accessories',
				'not_found' =>  'No Accessories found',
				'not_found_in_trash' => 'No Accessories found in Trash', 
				'parent_item_colon' => '',
				'menu_name' => 'Accessories'
			),
			'public' => true,
			//'exclude_from_search' => true,
			'show_in_menu' => true,
			//'menu_position' => 7,
			'menu_icon' => get_bloginfo('template_url') .'/images/icons/admin_accessory.png',
			'supports' => array('title','editor','thumbnail','page-attributes','revisions'),
			//'register_meta_box_cb' => 'jht_vid_metaboxes',
			'taxonomies' => array( 'jht_acc_cat' ),
			'rewrite' => array(
				'slug' => 'accessories',
				'with_front' => false,
			),
			//'has_archive'=>true
		)
	);
	$labels = array(
		'name' => _x( 'Accessory Categories', 'taxonomy general name' ),
		'singular_name' => _x( 'Accessory Category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Accessory Categories' ),
		'all_items' => __( 'All Accessory Categories' ),
		'parent_item' => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item' => __( 'Edit Accessory Category' ), 
		'update_item' => __( 'Update Category' ),
		'add_new_item' => __( 'Add New Accessory Category' ),
		'new_item_name' => __( 'New Accessory Category Name' ),
		'menu_name' => __( 'Categories' ),
	); 	
	
	register_taxonomy('jht_acc_cat',array('jht_acc'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array(
			'slug' => 'accessories',
			'with_front' => false,
		),
	));
	
	register_post_type( 'jht_sale',
		array(
			'labels' => array(
				'name' => 'Sales',
				'singular_name' => 'Sale',
				'add_new' => 'Add New Sale',
				'add_new_item' => 'Add New Sale',
				'edit_item' => 'Edit Sale',
				'new_item' => 'New Sale',
				'view_item' => 'View Sale',
				'search_items' => 'Search Sales',
				'not_found' =>  'No Sales found',
				'not_found_in_trash' => 'No Sales found in Trash', 
				'parent_item_colon' => '',
				'menu_name' => 'Sales'
			),
			'public' => true,
			'exclude_from_search' => true,
			'show_in_menu' => true,
			//'menu_position' => 7,
			'menu_icon' => get_bloginfo('template_url') .'/images/icons/admin_truck.png',
			'supports' => array('title','editor','revisions'),
			'rewrite' => array(
				'slug' => 'truckload-sales',
				'with_front' => false
			),
			'taxonomies' => array( 'jht_sales_cat' ),
			//'has_archive'=>true
		)
	);
	
	$labels = array(
		'name' => _x( 'Sales Categories', 'taxonomy general name' ),
		'singular_name' => _x( 'Sales Category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Sales Categories' ),
		'all_items' => __( 'All Sales Categories' ),
		'parent_item' => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item' => __( 'Edit Sales Category' ), 
		'update_item' => __( 'Update Category' ),
		'add_new_item' => __( 'Add New Sales Category' ),
		'new_item_name' => __( 'New Sales Category Name' ),
		'menu_name' => __( 'Categories' ),
	); 	
	
	register_taxonomy('jht_sales_cat',array('jht_sale'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array(
			'slug' => 'hot-tub-sales',
			'with_front' => false,
		),
	));
}

function jht_tub_metaboxes() {
	add_meta_box("jht_features_metabox", "Features &amp; Options", "jht_features_metabox", "jht_tub", "normal", "high");
	add_meta_box("jht_cats_metabox", "Collections", "jht_cats_metabox", "jht_tub", "side", "core");
	add_meta_box("jht_specs_metabox", "Specifications", "jht_specs_metabox", "jht_tub", "normal", "high");
	add_meta_box("jht_jets_metabox", "Jets", "jht_jets_metabox", "jht_tub", "normal", "high");
	add_meta_box("jht_war_metabox", "Warranty", "jht_war_metabox", "jht_tub", "side", "core");
}

function jht_cat_metaboxes() {
	add_meta_box("jht_cat_metabox", "Additional Info", "jht_cat_metabox", "jht_cat", "normal", "high");
}

function jht_vid_metaboxes() {
	add_meta_box("jht_vid_metabox", "Video Info", "jht_vid_metabox", "jht_vid", "normal", "high");
}

function jht_checks( $tub_id, $opt_name, $ptype, $showlang = false ) {
	global $polylang;
	if ( $showlang ) {
		if ( empty( $polylang ) ) {
			$showlang = false;
		}
	}
	
	$custom = get_post_meta($tub_id, $opt_name);
	$tub_cats = $custom[0];
	if($tub_cats=='') $tub_cats = array();
	
	$postargs = array(
		'numberposts' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'post_type' => $ptype,
	);
	
	if ( $opt_name == 'jht_cats' ) {
		$postargs['exclude'] = 8;
	}
	
	
	$allcats = get_posts( $postargs );
	
	$hierarchical_check = is_post_type_hierarchical($ptype);
	
	echo '<ul>';
	foreach ( $allcats as $c ) {
		if ( $c->post_parent == '' ) {
			echo '<li><label><input type="checkbox" name="'. esc_attr($opt_name) .'[]" value="'. $c->ID .'"'. (in_array($c->ID,$tub_cats) ? ' checked="checked"' : '') .' /> '. esc_attr($c->post_title);
			if ( $showlang ) echo ' ('. $polylang->get_post_language($c->ID)->slug .')';
			echo '</label>';
			if ( $hierarchical_check ) {
				$subcats = get_posts( array(
					'numberposts' => -1,
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'post_type' => $ptype,
					'post_parent' => $c->ID,
				));
				if ( count($subcats) > 0 ) {
					echo '<ul style="padding-left:2em">';
					
					foreach ( $subcats as $s ) {
						echo '<li><label><input type="checkbox" name="'. esc_attr($opt_name) .'[]" value="'. $s->ID .'"'. (in_array($s->ID,$tub_cats) ? ' checked="checked"' : '') .' /> '. esc_attr($s->post_title);
						if ( $showlang ) echo ' ('. $polylang->get_post_language($c->ID)->slug .')';
						echo '</label></li>';
					}
					
					echo '</ul>';
				}
			}
			echo '</li>';
		}
	}
    echo '</ul>';
}

function jht_jets( $tub_id ) {
	$custom = get_post_meta($tub_id, 'jht_jets');
	$tub_jets = $custom[0];
	if($tub_jets=='') $tub_jets = array();
	
	$jets = get_posts( array(
		'numberposts' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'post_type' => 'jht_jet',
	));
	
	echo '<table>';
	foreach ( $jets as $j ) {
		echo '<tr><td><label for="jht_jets['. $j->ID .']">'. str_replace("PowerPro ","", esc_attr($j->post_title)) .'</label></td><td><input type="text" name="jht_jets['. $j->ID .']" value="'. (isset($tub_jets[$j->ID]) ? absint($tub_jets[$j->ID]) : '0') .'" class="jetcount" /></td></tr>';
	}
    echo '</table>';
	?>
    <script type="text/javascript">
	jQuery(function($) {
		$('#jht_jets_metabox .jetcount').blur(function() {
			var jc = 0;
			$('#jht_jets_metabox .jetcount').each(function() {
				jc += parseInt($(this).val(),10);
			});
			$('#jht_jets_metabox h3.hndle span').html('Jets ('+jc+')');
		}).eq(0).trigger('blur');
	});
	</script>
    <?php
}

function jht_cats_metabox() {
	global $post;
	jht_checks($post->ID, 'jht_cats', 'jht_cat', true);
}

function jht_war_metabox() {
	global $post;
	jht_checks($post->ID, 'jht_wars', 'jht_warranty');
}

function jht_jets_metabox() {
	global $post;
	jht_jets( $post->ID );
}

function jht_cat_metabox() {
	global $post;
	$custom = get_post_meta($post->ID,'jht_info');
	$info = $custom[0];
	if($info=='') $info = array(
		'navheadline' => ''
	);
	?>
    <p><label for="jht_info[navheadline]"><strong>Nav Headline (optional)</strong></label><br />
    <input type="text" name="jht_info[navheadline]" size="160" value="<?php echo esc_attr($info['navheadline']); ?>" /></p>
    <?php
}

function jht_vid_metabox() {
	global $post;
	$custom = get_post_meta($post->ID,'jht_info');
	$info = $custom[0];
	if($info=='') $info = array(
		'url' => '',
		'dur' => ''
	);
	?>
    <p><label for="jht_info[url]"><strong>YouTube URL</strong></label><br />
    <input type="text" name="jht_info[url]" size="160" value="<?php echo esc_attr($info['url']); ?>" /></p>
    <p><label for="jht_info[dur]"><strong>Duration</strong></label><br />
    <input type="text" name="jht_info[dur]" size="10" value="<?php echo esc_attr($info['dur']); ?>" /></p>
    <?php
}

function jht_nopopup_metabox() {
	global $post;
	$custom = get_post_meta($post->ID,'jht_popup');
	$info = $custom[0];
	if( $info=='') $info = array();
	?>
    <p><label for="jht_popup[popup]"><input type="checkbox" name="jht_popup[popup]" value="Yes"<?php echo isset($info['popup']) ? ( $info['popup'] == 'Yes' ? ' checked="checked"' : '' ) : '' ?> /> Exclude this page from using pop-ups?</label></p>
    <?php
}

function jht_menuoptions_metabox() {
	global $post;
	$custom = get_post_meta($post->ID,'jht_menuoption');
	$info = $custom[0];
	if( $info=='') $info = array();
	?>
    <p>
    	<label for="jht_menuoption[top]"><input type="checkbox" name="jht_menuoption[top]" value="No"<?php echo isset($info['top']) ? ( $info['top'] == 'No' ? ' checked="checked"' : '' ) : '' ?> /> Exclude <b>Top</b> menu?</label><br />
    	<label for="jht_menuoption[main]"><input type="checkbox" name="jht_menuoption[main]" value="No"<?php echo isset($info['main']) ? ( $info['main'] == 'No' ? ' checked="checked"' : '' ) : '' ?> /> Exclude <b>Main</b> menu?</label><br />
    	<label for="jht_menuoption[silver]"><input type="checkbox" name="jht_menuoption[silver]" value="No"<?php echo isset($info['silver']) ? ( $info['silver'] == 'No' ? ' checked="checked"' : '' ) : '' ?> /> Exclude <b>Silver</b> menu?</label><br />
    	<label for="jht_menuoption[ctafoot]"><input type="checkbox" name="jht_menuoption[ctafoot]" value="No"<?php echo isset($info['ctafoot']) ? ( $info['ctafoot'] == 'No' ? ' checked="checked"' : '' ) : '' ?> /> Exclude <b>CTA Blocks</b> menu?</label><br />
    	<label for="jht_menuoption[black]"><input type="checkbox" name="jht_menuoption[black]" value="No"<?php echo isset($info['black']) ? ( $info['black'] == 'No' ? ' checked="checked"' : '' ) : '' ?> /> Exclude <b>Black Footer</b> menu?</label><br />
    	<label for="jht_menuoption[foot]"><input type="checkbox" name="jht_menuoption[foot]" value="No"<?php echo isset($info['foot']) ? ( $info['foot'] == 'No' ? ' checked="checked"' : '' ) : '' ?> /> Exclude <b>Bottom Footer</b> menu?</label><br />
    </p>
    <?php
}


// header display option for new page-quote-ppc.php / page-quote-special-promo.php page
function jht_ppc_options_metabox() {
	global $post;
	$custom = get_post_meta($post->ID,'jht_newppc_options');
	$info = $custom[0];
	if( $info=='') $info = array();
	?>
	<style>
	label[for*="jht_newppc_options"] { display: inline-block; width: 140px; vertical-align: top; }
	label[for*="jht_newppc_options[color]"] { width: 100px; }
	input[name*="jht_newppc_options[text_bullet_icon]"] { margin-top: -40px !important; }
	span.ppc-icon { display: inline-block; width: 50px; height: 50px; background: url("<?php echo get_template_directory_uri(); ?>/images/icons/ppc-icons.png") no-repeat 0 0; }
	span.ppc-icon.learn { background-position: 0 0; }
	span.ppc-icon.locate { background-position: -50px 0; }
	span.ppc-icon.price { background-position: -100px 0; }
	</style>
    <p>
    	Select Header Color Option<br />
    	<label for="jht_newppc_options[color]"><input type="radio" name="jht_newppc_options[color]" value="black"<?php echo isset($info['color']) ? ( $info['color'] !== 'white' ? ' checked="checked"' : '' ) : '' ?> />Black</label>
    	<label for="jht_newppc_options[color]"><input type="radio" name="jht_newppc_options[color]" value="white"<?php echo isset($info['color']) ? ( $info['color'] == 'white' ? ' checked="checked"' : '' ) : '' ?> />White</label><br />
	</p>
	<hr />
	<p>
		<label for="jht_newppc_options[headline]">Headline Text</label><input type="text" name="jht_newppc_options[headline]" value="<?php echo $info['headline']; ?>" size="60" maxlength="255" /><br />
		<label for="jht_newppc_options[title]">Title Text Override</label><input type="text" name="jht_newppc_options[title]" value="<?php echo $info['title']; ?>" size="60" maxlength="255" /><br />
		<label for="jht_newppc_options[text_main]">Main header body text</label><textarea name="jht_newppc_options[text_main]" cols="60" rows="3"><?php echo $info['text_main']; ?></textarea><br />
		<label for="jht_newppc_options[text_bullet][1]">Bullet Point #1</label><input type="text" name="jht_newppc_options[text_bullet][1]" value="<?php echo $info['text_bullet'][1]; ?>" size="60" maxlength="255" /><br />
		<label for="jht_newppc_options[text_bullet_icon][1]"></label>
			<input type="radio" name="jht_newppc_options[text_bullet_icon][1]" value="learn" <?php if ( $info['text_bullet_icon'][1] == 'learn' ) echo ' checked="checked" '; ?> /><span class="ppc-icon learn"></span>
			<input type="radio" name="jht_newppc_options[text_bullet_icon][1]" value="locate" <?php if ( $info['text_bullet_icon'][1] == 'locate' ) echo ' checked="checked" '; ?> /><span class="ppc-icon locate"></span>
			<input type="radio" name="jht_newppc_options[text_bullet_icon][1]" value="price" <?php if ( $info['text_bullet_icon'][1] == 'price' ) echo ' checked="checked" '; ?> /><span class="ppc-icon price"></span>
			<input type="radio" name="jht_newppc_options[text_bullet_icon][1]" value="none" <?php if ( $info['text_bullet_icon'][1] == 'none' ) echo ' checked="checked" '; ?> />None<br />
		<label for="jht_newppc_options[text_bullet][2]">Bullet Point #2</label><input type="text" name="jht_newppc_options[text_bullet][2]" value="<?php echo $info['text_bullet'][2]; ?>" size="60" maxlength="255" /><br />
		<label for="jht_newppc_options[text_bullet_icon][2]"></label>
			<input type="radio" name="jht_newppc_options[text_bullet_icon][2]" value="learn" <?php if ( $info['text_bullet_icon'][2] == 'learn' ) echo ' checked="checked" '; ?> /><span class="ppc-icon learn"></span>
			<input type="radio" name="jht_newppc_options[text_bullet_icon][2]" value="locate" <?php if ( $info['text_bullet_icon'][2] == 'locate' ) echo ' checked="checked" '; ?> /><span class="ppc-icon locate"></span>
			<input type="radio" name="jht_newppc_options[text_bullet_icon][2]" value="price" <?php if ( $info['text_bullet_icon'][2] == 'price' ) echo ' checked="checked" '; ?> /><span class="ppc-icon price"></span>
			<input type="radio" name="jht_newppc_options[text_bullet_icon][2]" value="none" <?php if ( $info['text_bullet_icon'][2] == 'none' ) echo ' checked="checked" '; ?> />None<br />
		<label for="jht_newppc_options[text_bullet][3]">Bullet Point #3</label><input type="text" name="jht_newppc_options[text_bullet][3]" value="<?php echo $info['text_bullet'][3]; ?>" size="60" maxlength="255" /><br />
		<label for="jht_newppc_options[text_bullet_icon][3]"></label>
			<input type="radio" name="jht_newppc_options[text_bullet_icon][3]" value="learn" <?php if ( $info['text_bullet_icon'][3] == 'learn' ) echo ' checked="checked" '; ?> /><span class="ppc-icon learn"></span>
			<input type="radio" name="jht_newppc_options[text_bullet_icon][3]" value="locate" <?php if ( $info['text_bullet_icon'][3] == 'locate' ) echo ' checked="checked" '; ?> /><span class="ppc-icon locate"></span>
			<input type="radio" name="jht_newppc_options[text_bullet_icon][3]" value="price" <?php if ( $info['text_bullet_icon'][3] == 'price' ) echo ' checked="checked" '; ?> /><span class="ppc-icon price"></span>
			<input type="radio" name="jht_newppc_options[text_bullet_icon][3]" value="none" <?php if ( $info['text_bullet_icon'][3] == 'none' ) echo ' checked="checked" '; ?> />None<br />
		<label for="jht_newppc_options[text_gold]">Gold bar text</label><textarea name="jht_newppc_options[text_gold]" cols="60" rows="3"><?php echo $info['text_gold']; ?></textarea><br />
	</p>
	<hr />
	<p>
		<label for="jht_newppc_options[submit]">Submit Button Text</label><input type="text" name="jht_newppc_options[submit]" value="<?php echo $info['submit']; ?>" size="60" maxlength="20" /><br />
	</p>
    <?php
}

function jht_form_type_metabox() {
	global $post;
	$custom = get_post_meta($post->ID,'jht_form');
	$info = $custom[0];
	if( $info=='') $info = array();

	$chk = ' checked="checked" ';
	$convpage = true;
	$form = array(
		'brochure' => false,
		'buyersguide' => false,
		'quote' => false,
		'tradein' => false,
		);
	if ( isset($info['form']) ) {
		switch ( $info['form'] ) {
			case 'Brochure' :
				$form['brochure'] = true;
				break;
			case 'BuyersGuide' :
				$form['buyersguide'] = true;
				break;
			case 'Quote' :
				$form['quote'] = true;
				break;
			case 'TradeIn' :
				$form['tradein'] = true;
				break;
			case 'Truckload' :
				$form['truckload'] = true;
				break;
			default :
				$convpage = false;
		}
	}
	?>
    <div>
    	<p>Selecting a form option adds additional classes to the main <code>&lt;body&gt;</code> element.</p>
    	<p>Non-form pages<br />
    	<label for="jht_form[form]"><input type="radio" name="jht_form[form]" value="none"<?php if ( ! $convpage ) { echo $chk; } ?> /> None (default)</label></p>
    	<p>Avala integrated form types<br />
    	<label for="jht_form[form]"><input type="radio" name="jht_form[form]" value="Brochure"<?php if ( $form['brochure'] ) { echo $chk; } ?> /> Brochure</label><br />
    	<label for="jht_form[form]"><input type="radio" name="jht_form[form]" value="BuyersGuide"<?php if ( $form['buyersguide'] ) { echo $chk; } ?> /> Buyers Guide</label><br />
    	<label for="jht_form[form]"><input type="radio" name="jht_form[form]" value="Quote"<?php if ( $form['quote'] ) { echo $chk; } ?> /> Quote</label><br />
    	<label for="jht_form[form]"><input type="radio" name="jht_form[form]" value="TradeIn"<?php if ( $form['tradein'] ) { echo $chk; } ?> /> Trade-In</label><br />
    	<label for="jht_form[form]"><input type="radio" name="jht_form[form]" value="Truckload"<?php if ( $form['truckload'] ) { echo $chk; } ?> /> Truckload</label></p>
    	<p><em>Non</em>-Avala Form<br />
    	<label for="jht_form[form]"><input type="radio" name="jht_form[form]" value="other"<?php if ( $form['truckload'] ) { echo $chk; } ?> /> Other Form</label></p>
    </div>
    <?php
}

function jht_pagemenu_metabox() {
	global $post;
	$custom = get_post_meta($post->ID,'jht_pageopts');
	$info = $custom[0];
	if( $info=='') $info = array(
		'menu' => '',
		'b' => 'Yes',
		'q' => 'Yes',
		't' => 'Yes',
		'n' => 'Yes',
		'o' => '',
		'a' => '',
	);
	?>
    <p><label for="jht_pageopts[menu]"><strong>Left Menu (optional)</strong></label><br />
    <select name="jht_pageopts[menu]"><option value="">- None -</option>
    <?php
    $menus = wp_get_nav_menus();
	foreach ( $menus as $m ) echo '<option value="'. $m->term_id . ( $info['menu'] == $m->term_id ? '" selected="selected' : '') .'">'. esc_attr($m->name) .'</option>';
	?></select></p>
    <p><label for="jht_pageopts[g]"><input type="checkbox" name="jht_pageopts[g]" value="Yes"<?php echo isset($info['g']) ? ( $info['g'] == 'Yes' ? ' checked="checked"' : '' ) : '' ?> /> Include "Buyer's Guide" form?</label></p>
    <p><label for="jht_pageopts[b]"><input type="checkbox" name="jht_pageopts[b]" value="Yes"<?php echo isset($info['b']) ? ( $info['b'] == 'Yes' ? ' checked="checked"' : '' ) : '' ?> /> Include "Free Brochure" link?</label></p>
    <p><label for="jht_pageopts[q]"><input type="checkbox" name="jht_pageopts[q]" value="Yes"<?php echo isset($info['q']) ? ( $info['q'] == 'Yes' ? ' checked="checked"' : '' ) : '' ?> /> Include "Request Quote" link?</label></p>
	<p><label for="jht_pageopts[t]"><input type="checkbox" name="jht_pageopts[t]" value="Yes"<?php echo isset($info['t']) ? ( $info['t'] == 'Yes' ? ' checked="checked"' : '' ) : '' ?> /> Include "Trade-In Value" link?</label></p>
	<p><label for="jht_pageopts[a]"><input type="checkbox" name="jht_pageopts[a]" value="Yes"<?php echo isset($info['a']) ? ( $info['a'] == 'Yes' ? ' checked="checked"' : '' ) : '' ?> /> Include "Accessories Store" link?</label></p>
    <?php /* <p><label for="jht_pageopts[n]"><input type="checkbox" name="jht_pageopts[n]" value="Yes"<?php echo isset($info['n']) ? ( $info['n'] == 'Yes' ? ' checked="checked"' : '' ) : '' ?> /> Include "Contact" number?</label></p> */ ?>

    <p><label for="jht_pageopts[c]"><input type="checkbox" name="jht_pageopts[c]" value="Yes"<?php echo isset($info['c']) ? ( $info['c'] == 'Yes' ? ' checked="checked"' : '' ) : '' ?> /> Include "Dealer Checklist" graphic?</label></p>
    <p><label for="jht_pageopts[v]"><input type="checkbox" name="jht_pageopts[v]" value="Yes"<?php echo isset($info['v']) ? ( $info['v'] == 'Yes' ? ' checked="checked"' : '' ) : '' ?> /> Include "Locate Dealer" graphic?</label></p>
    <p><label for="jht_pageopts[x]"><input type="checkbox" name="jht_pageopts[x]" value="Yes"<?php echo isset($info['x']) ? ( $info['x'] == 'Yes' ? ' checked="checked"' : '' ) : '' ?> /> Include "Quote" graphic?</label></p>

    <p><label for="jht_pageopts[o]"><strong>Top Title Override (optional)</strong></label><br />
    <input type="text" name="jht_pageopts[o]" size="45" value="<?php echo esc_attr($info['o']); ?>" /></p>
    <?php
}

function jht_features_metabox() {
	global $post;
	$custom = get_post_meta($post->ID,'jht_info');
	$info = $custom[0];
	if($info=='') $info = array(
		'topheadline' => '',
		'featureblurb' => '',
	);
	?>
    <p><label for="jht_info[topheadline]"><strong>Top Sub Headline</strong></label><br />
    <input type="text" name="jht_info[topheadline]" size="160" value="<?php echo esc_attr($info['topheadline']); ?>" /></p>
    <table width="100%">
    <tr valign="top"><td width="50%">
    <p><strong>Acrylic Shell Colors</strong></p>
    <?php jht_checks($post->ID, 'jht_colors', 'jht_color'); ?>
    </td><td width="50%">
    <p><strong>Cabinetry</strong></p>
    <?php jht_checks($post->ID, 'jht_cabs', 'jht_cabinetry'); ?>
    </td></tr></table>
    <p><label for="jht_info[featureblurb]"><strong><em>Features &amp; Options</em> Blurb</strong></label><br />
    <textarea name="jht_info[featureblurb]" cols="160"><?php echo esc_html($info['featureblurb']); ?></textarea></p>
    <p><strong>Features &amp; Options</strong></p>
    <?php
	jht_checks($post->ID, 'jht_feats', 'jht_feat');
}


function jht_specs_metabox() {
	global $post;
	$custom = get_post_meta($post->ID,'jht_specs');
	$info = $custom[0];
	if($info=='') $info = array(
		'product_id' => '',
		'msrp' => '',
		'seats' => '',
		'dim_us' => '',
		'dim_int' => '',
		'vol_us' => '',
		'vol_int' => '',
		'dry_weight' => '',
		'filled' => '',
		'emoc' => '',
		'smartseal' => '',
		'pump1' => '',
		'pump2' => '',
		'pump3' => '',
		'circulation' => '',
		'diverter' => '',
		'wps' => '',
		'filtration' => '',
		'filters' => '',
		'elec_na' => '',
		'elec_int' => '',
		'lighting' => '',
		'headrests' => '',
		'waterfall' => '',
		'stereo' => '',
		'haslounge' => '',
		'lounge' => '',
		'faces' => '',
	);
	?><table width="100%">
	<tr valign="top">
    <td width="187"><label for="jht_specs[product_id]">Product ID</label></td><td><input type="text" name="jht_specs[product_id]" value="<?php esc_attr_e($info['product_id']); ?>" size="20" /></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[msrp]">MSRP ($)</label></td><td><input type="text" name="jht_specs[msrp]" value="<?php esc_attr_e($info['msrp']); ?>" size="20" /></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[seats]">Seats</label></td><td><input type="text" name="jht_specs[seats]" value="<?php esc_attr_e($info['seats']); ?>" size="10" /></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[dim_us]">Dimensions (US)</label></td><td><input type="text" name="jht_specs[dim_us]" value="<?php esc_attr_e($info['dim_us']); ?>" /></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[dim_int]">Dimensions (INT)</label></td><td><input type="text" name="jht_specs[dim_int]" value="<?php esc_attr_e($info['dim_int']); ?>" /></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[vol_us]">Spa Volume (US)</label></td><td><input type="text" name="jht_specs[vol_us]" value="<?php esc_attr_e($info['vol_us']); ?>" /></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[vol_int]">Spa Volume (INT)</label></td><td><input type="text" name="jht_specs[vol_int]" value="<?php esc_attr_e($info['vol_int']); ?>" /></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[dry_weight]">Dry Weight</label></td><td><input type="text" name="jht_specs[dry_weight]" value="<?php esc_attr_e($info['dry_weight']); ?>" size="75%" /></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[filled]">Total Filled Weight</label></td><td><input type="text" name="jht_specs[filled]" value="<?php esc_attr_e($info['filled']); ?>" size="75%" /></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[emoc]">Estimated Monthly<br />Operating Cost 60&deg;F / 15&deg;C </label></td><td><input type="text" name="jht_specs[emoc]" value="<?php esc_attr_e($info['emoc']); ?>" size="75%" /></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[smartseal]">Monthly Operating Cost<br />with SmartSeal</label></td><td><input type="text" name="jht_specs[smartseal]" value="<?php esc_attr_e($info['smartseal']); ?>" size="75%" /></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[pump1]">Pump 1</label></td><td><textarea name="jht_specs[pump1]" cols="120"><?php esc_attr_e($info['pump1']); ?></textarea></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[pump2]">Pump 2</label></td><td><textarea name="jht_specs[pump2]" cols="120"><?php esc_attr_e($info['pump2']); ?></textarea></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[pump3]">Pump 3</label></td><td><textarea name="jht_specs[pump3]" cols="120"><?php esc_attr_e($info['pump3']); ?></textarea></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[circulation]">Circulation Pump</label></td><td><select name="jht_specs[circulation]"><?php
	$opts = array('Yes', 'No');
	foreach ( $opts as $o ) {
		echo '<option value="'. $o .'"'. ($info[circulation] == $o ? ' selected="selected"' : '') .'>'. $o .'</option>';
	}
	?></select></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[diverter]">Diverter Valves</label></td><td><input type="text" name="jht_specs[diverter]" value="<?php esc_attr_e($info['diverter']); ?>" /></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[wps]">Water Purification System</label></td><td><input type="text" name="jht_specs[wps]" value="<?php esc_attr_e($info['wps']); ?>" size="75%" /></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[filtration]">Filtration</label></td><td><input type="text" name="jht_specs[filtration]" value="<?php esc_attr_e($info['filtration']); ?>" size="75%" /></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[filters]">Filters</label></td><td><textarea name="jht_specs[filters]" cols="120"><?php esc_attr_e($info['filters']); ?></textarea></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[elec_na]">Electrical North America</label></td><td><input type="text" name="jht_specs[elec_na]" value="<?php esc_attr_e($info['elec_na']); ?>" size="75%" /></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[elec_int]">Electrical International</label></td><td><input type="text" name="jht_specs[elec_int]" value="<?php esc_attr_e($info['elec_int']); ?>" size="75%" /></td>
    </tr>
    <tr><td colspan="2"><p><strong>Features</strong></p></td></tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[lighting]">Lighting</label></td><td><input type="text" name="jht_specs[lighting]" value="<?php esc_attr_e($info['lighting']); ?>" size="75%" /></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[headrests]">Headrests</label></td><td><input type="text" name="jht_specs[headrests]" value="<?php esc_attr_e($info['headrests']); ?>" /></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[waterfall]">Waterfalls</label></td><td><input type="text" name="jht_specs[waterfall]" value="<?php esc_attr_e($info['waterfall']); ?>" /></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[stereo]">Stereo</label></td><td><input type="text" name="jht_specs[stereo]" value="<?php esc_attr_e($info['stereo']); ?>" size="75%" /></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[lounge]">Lounge Seating</label></td><td><select name="jht_specs[haslounge]"><option value="no" <?php echo ( esc_attr_e($info['haslounge']) == 'no' ? 'selected="selected"' : '' ); ?>>No</option><option value="yes" <?php echo ( esc_attr_e($info['haslounge']) == 'yes' ? 'selected="selected"' : '' ); ?>>Yes</option></select><input type="text" name="jht_specs[lounge]" value="<?php esc_attr_e($info['lounge']); ?>" size="50%" /></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[faces]">Stainless Steel Jet Faces</label></td><td><input type="text" name="jht_specs[faces]" value="<?php esc_attr_e($info['faces']); ?>" /></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[wizid]">Wizard Identifier</label></td><td><select name="jht_specs[wizid]">
		<option value="price" <?php echo ( esc_attr_e($info['wizid']) == 'price' ? 'selected="selected"' : '' ); ?>>Price</option>
		<option value="performance" <?php echo ( esc_attr_e($info['wizid']) == 'performance' ? 'selected="selected"' : '' ); ?>>Performance</option>
		<option value="design" <?php echo ( esc_attr_e($info['wizid']) == 'design' ? 'selected="selected"' : '' ); ?>>Design</option></select>
	</td>
    </tr>
    <tr><td colspan="2"><p><strong>Featured Image Details</strong></p></td></tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[featuredimgshell]">Shell Color</label></td><td><input type="text" name="jht_specs[featuredimgshell]" value="<?php esc_attr_e($info['featuredimgshell']); ?>" /></td>
    </tr>
    <tr valign="top">
    <td width="187"><label for="jht_specs[featuredimgcabinet]">Cabinetry</label></td><td><input type="text" name="jht_specs[featuredimgcabinet]" value="<?php esc_attr_e($info['featuredimgcabinet']); ?>" /></td>
    </tr>
    </table>
    <?php
}

// helper sorting function
function jht_tub_sort($a,$b) {
	return $a['menu_order'] > $b['menu_order'];
}

function jht_meta_save($post_id){
	// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
	// to do anything
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
	return $post_id;
	
	// Check permissions
	if ( isset( $_POST['post_type'] ) ) {
		if (in_array($_POST['post_type'],array('jht_tub', 'jht_cat', 'page', 'jht_vid', 'post')) ) {
			if ( !current_user_can( 'edit_page', $post_id ) ) return $post_id;
		} else {
		//if ( !current_user_can( 'edit_post', $post_id ) )
		  return $post_id;
		} 
	}else {
	  return $post_id;
	}
	
	if ( isset( $_POST['_progo'] ) ) {
		$direct = $_POST['_progo'];
		
		if ( isset ( $direct[plink] ) ) {
			$direct[plink] = absint( $direct[plink] );
		} else {
			$direct[plink] = progo_default_product_id();
		}
		
		// sanitize the following fields & check max length
		$checklengths = array( 'arrowd', 'toparr', 'rightheadline', 'button' );
		foreach ( $checklengths as $key ) {
			if ( isset ( $direct[$key] ) ) {
				$direct[$key] = substr( wp_kses( $direct[$key], array() ), 0, progo_direct_charcutoff($key) );
			} else {
				$direct[$key] = '';
			}
		}
		update_post_meta($post_id, "_progo", $direct);
		return $direct;
	}

	if($_POST['post_type'] == 'page') {
		$infos = '';

		$info = $_POST['jht_pageopts'];
		update_post_meta($post_id, 'jht_pageopts', $info);
		$infos .= $info;

		$info = $_POST['jht_menuoption'];
		update_post_meta($post_id, 'jht_menuoption', $info);
		$infos .= $info;

		$info = $_POST['jht_popup'];
		update_post_meta($post_id, 'jht_popup', $info);
		$infos .= $info;

		$info = $_POST['jht_newppc_options'];
		update_post_meta($post_id, 'jht_newppc_options', $info);
		$infos .= $info;

		$info = $_POST['jht_form'];
		update_post_meta($post_id, 'jht_form', $info);
		$infos .= $info;

		$info = $_POST['avala_form'];
		update_post_meta($post_id, 'avala_form', $info);
		$infos .= $info;

		return $infos;
	}

	if($_POST['post_type'] == 'post') {
		$infos = '';

		$info = $_POST['jht_pageopts'];
		update_post_meta($post_id, 'jht_pageopts', $info);
		$infos .= $info;

		return $infos;
	}



	if( in_array( $_POST['post_type'] , array( 'jht_cat', 'jht_vid' ) ) ) {
		$info = $_POST['jht_info'];
		update_post_meta($post_id, 'jht_info', $info);
		return $info;
	}
	
	
	// CHECK IF THE TUB IS PUBLISHED OR NOT?!?!
	$tub_published = $_POST['post_status'];
	$not_published = ( $tub_published != 'publish' );
	
	//if($_POST['post_type'] == 'jht_tub') {
	delete_transient('jht_alltubs');
	$custom_tub_arrays = array('jht_cats', 'jht_colors', 'jht_cabs', 'jht_feats', 'jht_info', 'jht_specs', 'jht_jets', 'jht_wars');
	foreach ( $custom_tub_arrays as $c ) {
		$info = $_POST[$c];
		update_post_meta($post_id, $c, $info);
		
		if ( $c == 'jht_cats' ) {
			$post = wp_get_single_post($post_id);
			if ( $post->post_type == 'jht_tub' ) {
				// when we SAVE a TUB DETAIL
				// we also want to go through and update each Category's array of Tubs
				// example : $jht_cats = array(20,39,44,48)
				if ( count($info) > 0 ) {
					$size = $_POST['jht_specs'];
					$seats = $size['seats'];
					
					$sizekey = jht_isca() ? 'dim_int' : 'dim_us';
					$sizekey = apply_filters('hottubsize', $sizekey);
					if ( !isset( $size[$sizekey] ) ) {
						$sizekey = jht_isca() ? 'dim_int' : 'dim_us';
					}
					$size = $size[$sizekey];
					
					$jets = $_POST['jht_jets'];
					$jetcount = 0;
					foreach ( $jets as $j ) $jetcount += $j;
					
					$tag = $post->post_content;
					$tag = wp_kses(substr($tag, 0, strpos($tag, '</h1>')), array());
					
					$post_url = get_permalink($post_id);
					
					$quickinfo =  array(
						'name' => $post->post_title,
						'slug' => $post->post_name,
						'menu_order' => $post->menu_order,
						'url' => $post_url,
						'size' => $size,
						'seats' => $seats,
						'jets' => $jetcount,
						'id' => $post_id,
						'tag' => $tag,
						// image
					);
					update_post_meta($post_id, 'jht_quickinfo', $quickinfo);
					/*
					// rather than looping through only the cats that this tub is IN
					// also want to make sure it is NOT in any cats it shouldnt be in, so
					
					// transient for jht_allcats
					if ( false === ( $special_query_results = get_transient( 'jht_allcats' ) ) ) {
						// It wasn't there, so regenerate the data and save the transient
						$special_query_results = get_posts(array('numberposts'=>-1,'post_type'=>'jht_cat','orderby'=>'menu_order','order'=>'ASC','exclude'=>8));
						set_transient( 'jht_allcats', $special_query_results, 60*60*12 );
					}
					// Use the data like you would have normally...
					$allcats = get_transient( 'jht_allcats' );
					
					foreach($allcats as $c) {
						$cat_id = $c->ID;
						$custom = get_post_meta($cat_id, 'jht_cat_tubs');
						$cat_tubs = $custom[0];
						if($cat_tubs=='') $cat_tubs = array();
						
						if ( ( in_array($cat_id, $info) == false ) || $not_published ) {
							unset($cat_tubs[$post_id]);
						} else {
							$cat_tubs[$post_id] = array(
								'name' => $post->post_title,
								'slug' => $post->post_name,
								'menu_order' => $post->menu_order,
								'url' => $post_url,
								'size' => $size,
								'seats' => $seats,
								'jets' => $jetcount,
								'id' => $post->ID,
								'tag' => $tag,
								// image
							);
						}
						//uasort($cat_tubs, 'jht_tub_sort');
						update_post_meta($cat_id, 'jht_cat_tubs', $cat_tubs);
					}
					*/
				}
			}
		}
	}
	return $info;
}


/**
 * creates a new Direct Response PAGE with default helpful copy & meta values
 * @param isfirst if this is the first Direct page, set the Homepage and other settings
 * @uses progo_direct_meta_defaults()
 * @since Direct 1.0
 */
	function progo_new_direct_page ( $isfirst ) {
		// should we be checking NONCE here too?
		
		$post_date = date( "Y-m-d H:i:s" );
		$post_date_gmt = gmdate( "Y-m-d H:i:s" );

		$new_page = array(
			'slug' => 'direct',
			'title' => __( 'Write a Headline that Captivates', 'progo' ),
			'content' => "<h2>Write a Sub-Headline that Validates Your Offer</h2>
		This is the opening paragraph. It should contain about 3-5 lines and is very important since it needs to catch the attention of the reader. Typically questions of who, what, when, where and why about your offer are answered here. Keep it short and highlight what your product is all about.
		<ul>
		<li>Write a primary feature about your product</li>
		<li>Write a secondary feature about your product</li>
		<li>Write a tertiary feature about your product</li>
		</ul>
		<h3>Write a Secondary Subhead Example right here</h3>
		The following paragraphs go into depth about your product or offer. Give more details of the key features that deliver on your product's benefits.  Keep in mind that you are writing to your customer's needs and wants; and not your own. Break out your information- informative and written with facts, statistics and information that is credible. Be authentic and write article with clarity.

		Tip: Include photography, videos, and other types of multi-media to reinforce and build credibility of your product.
		\nOne more thing: it can be helpful to reiterate your Product Offer and Price again at the bottom of the page."
		); 	
		$new_page_id = wp_insert_post( array(
			'post_title' 	=>	$new_page['title'],
			'post_type' 	=>	'page',
			'post_name'		=>	$new_page['slug'],
			'comment_status'=>	'closed',
			'ping_status' 	=>	'closed',
			'post_content' 	=>	$new_page['content'],
			'post_status' 	=>	'publish',
			'post_author' 	=>	1,
			'menu_order'	=>	0
		));
		update_post_meta( $new_page_id, '_wp_page_template', 'page-direct.php' );
		update_post_meta( $new_page_id, '_wp_page_template', 'page-directtwo.php' );
		update_post_meta( $new_page_id, '_wp_page_template', 'page-directcanada.php' );
		update_post_meta( $new_page_id, '_wp_page_template', 'page-quote-ppc.php' );
		$default_direct = progo_direct_meta_defaults();
		update_post_meta( $new_page_id, '_progo', $default_direct );
		
		if ( $isfirst ) {
			// now also want to update PERMALINK structure to something nice
			update_option( 'permalink_structure', '/%year%/%monthnum%/%day%/%postname%/' );
			
			// and set HOMEPAGE = $default_page_id
			update_option ( 'show_on_front', 'page' );
			update_option ( 'page_on_front', $new_page_id );
		} else {
			wp_redirect( get_option( 'siteurl' ) . '/wp-admin/post.php?post='. $new_page_id .'&action=edit' );
		}
	}
	if ( ! function_exists( 'progo_direct_box' ) ):
		/**
		 * outputs html for "Direct Response" meta box on EDIT (Direct Response) PAGE
		 * called by add_meta_box( "progo_direct_box", "Direct Response", "progo_direct_box"...
		 * in jht_admin_init()
		 * @uses progo_direct_meta_defaults()
		 * @since Direct 1.0
		 */
		function progo_direct_box() {
			global $post;
			$custom = get_post_meta($post->ID,'_progo');
			$direct = $custom[0];
			if ( $direct == '' ) {
				// set up default values
				$direct = progo_direct_meta_defaults();
			}
			$options = get_option('progo_options');
			// include countChars js if All In One SEO Pack is not installed
			if ( !function_exists( 'aiosp_meta' ) ) { ?>
			<script type="text/javascript">
		    <!-- Begin
		    function countChars( fd, cf ) {
		    cf.value = fd.value.length;
		    }
		    //  End -->
		    </script><?php } ?>
			<script type="text/javascript">
		    <!-- Begin
		    function progo_cc( thefield, counter, pfield ) {
		    	counter.value = thefield.value.length;
				if ( pfield !== false ) {
					jQuery('#'+pfield).html(thefield.value);
				}
		    }
			jQuery(function() {
				jQuery('#title').keyup(function() {
					jQuery('#ptitle').html(jQuery(this).val());
				});
			});
		    //  End -->
		    </script>
		    <p><strong>1. Arrow Headline</strong></p>
		    <p><input type="text" name="_progo[arrowd]" value="<?php esc_html_e( $direct[arrowd] ); ?>" size="80" maxlength="<?php esc_html_e( $direct[arrowd] ); ?>" onkeydown="progo_cc( this, document.post.c_arrowd, false )" onKeyUp="progo_cc( this, document.post.c_arrowd, 'parr' )" /> <input type="text" name="c_arrowd" size="3" maxlength="3" style="text-align:center;" value="<?php echo strlen( $direct[arrowd] );?>" readonly /> / <?php esc_html_e( progo_direct_charcutoff( 'arrowd' ) ); ?> characters max</p>
			<p><strong>2. Top Right Arrow Text</strong></p>
			<input type="text" name="_progo[toparr]" size="30" maxlength="<?php esc_html_e( $direct[toparr] ); ?>" onkeydown="progo_cc( this, document.post.c_ta, false )" onKeyUp="progo_cc( this, document.post.c_ta, 'pta' )" value="<?php esc_html_e( $direct[toparr] ); ?>" /> <input type="text" name="c_ta" size="2" maxlength="3" value="<?php echo strlen( $direct[toparr] );?>" readonly /> / <?php esc_html_e( progo_direct_charcutoff( 'toparr' ) ); ?> characters max</p>
			<p><strong>3. Statement Leading Into Form</strong></p>
			<input type="text" name="_progo[rightheadline]" size="30" maxlength="<?php esc_html_e( $direct[rightheadline] ); ?>" onkeydown="progo_cc( this, document.post.c_rh, false )" onKeyUp="progo_cc( this, document.post.c_rh, 'prh' )" value="<?php esc_html_e( $direct[rightheadline] ); ?>" /> <input type="text" name="c_rh" size="2" maxlength="3" style="text-align:center;" value="<?php echo strlen( $direct[rightheadline] );?>" readonly /> / <?php esc_html_e( progo_direct_charcutoff( 'rightheadline' ) ); ?> characters max</p>
			<p><strong>4. Button Text</strong></p>
			<p><input type="text" name="_progo[button]" size="18" maxlength="<?php esc_html_e( $direct[button] ); ?>" onkeydown="progo_cc( this, document.post.c_bn, false )" onKeyUp="progo_cc( this, document.post.c_bn, 'pbn' )" value="<?php esc_html_e( $direct[button] ); ?>" /> <input type="text" name="c_bn" size="2" maxlength="3" style="text-align:center;" value="<?php echo strlen( $direct[button] );?>" readonly /> / <?php esc_html_e( progo_direct_charcutoff( 'button' ) ); ?> characters max</p>
			<p><strong>5. "Request a Quote" vs "Download Brochure"</strong></p>
			<p><select name="_progo[form]"><?php
		    $opts = array('quote','brochure','short','canada');
			foreach ( $opts as $o ) {
				echo '<option value="'. $o .'"'. ($direct[form]==$o ? ' selected="selected"' : '') .'>'. esc_attr($o) .'</option>';
			}
			?></select></p>
			<p><strong>6. "Thank You" page URL</strong></p>
			<p><input type="text" name="_progo[thx]" size="38" value="<?php echo esc_url($direct[thx]); ?>" /></p>
			<?php
		}
	endif;
	if ( ! function_exists( 'progo_direct_charcutoff' ) ):
		/**
		 * helper function to return the max char count for a given field
		 * wrapped in function_exists check so children themes can override
		 * @param name of field to grab max length
		 * @return (int) max char count
		 * @since Direct 1.0.43
		 */
		function progo_direct_charcutoff($field) {
			$cut = 0;
			switch($field) {
				case 'arrowd':
					$cut = 75;
					break;
				case 'rightheadline':
				case 'toparr':
					$cut = 30;
					break;
				case 'button':
					$cut = 20;
					break;
				case 'rightheadline':
					$cut = 60;
					break;
			}
			return $cut;
		}
	endif;
	if ( ! function_exists( 'progo_default_product_id' ) ):
		/**
		 * @return integer product ID of first(?) wpsc-product
		 * @since Direct 1.0
		 */
		function progo_default_product_id() {
			$pID = 0;
			// if we have any Products, set pID = first product ID instead of 0
			$products = get_posts( 'post_type=wpsc-product' );
			if( count( $products ) > 0 ) {
				$pID = $products[0]->ID;
			}
			return $pID;
		}
	endif;
	if ( ! function_exists( 'progo_direct_meta_defaults' ) ):
		/**
		 * sets up default values for Direct Response meta box fields
		 * @return array of default values
		 * @since Direct 1.0
		 */
		function progo_direct_meta_defaults() {
			$pID = progo_default_product_id();
			
			$direct = array(
				'arrowd' => 'ARROW HEADLINE GOES HERE',
				'toparr' => 'LIMITED SUPPLY!',
				'rightheadline' => 'Download a FREE Brochure',
				'button' => 'BUY NOW',
				'form' => 'quote',
				'thx' => '/ppc-thanks/'
			);
			return $direct;
		}
	endif;

	add_filter('query_vars','progo_insertvars');
	// Adding the id var so that WP recognizes it
	function progo_insertvars($vars) {
	    array_push($vars, 'kw');
	    array_push($vars, 'keyword');
	    return $vars;
	}
	add_filter('rewrite_rules_array','progo_insertrules');
	function progo_insertrules($rules) {
		$newrules = array();
		
		$stubs = array();
		
		$templates = array('page-direct.php','page-quote-ppc.php','page-directtwo.php','page-directcanada.php','page-thanks.php','page-thankscanada.php');
		foreach($templates as $t) {
			$pages = get_pages(array(
				'meta_key' => '_wp_page_template',
				'meta_value' => $t
			));
			
			foreach ( $pages as $p ) {
				$stubs[] = $p->post_name;
			}
		}
		foreach ( $stubs as $s ) {
			$newrules['('. $s .'/)(.+?)$'] = 'index.php?pagename=$matches[1]&kw=$matches[2]';
			$newrules['('. $s .'/)(.+?)$'] = 'index.php?pagename=$matches[1]&keyword=$matches[2]';
		}
		
		return $newrules + $rules;
	}
	/**
	 * ProGo Site Settings Options defaults
	 * @since Direct 1.0
	 */
	function progo_options_defaults() {
		update_option( 'progo_direct_installed', true );
		
		// set large image size
		update_option( 'large_size_w', 651 );
		update_option( 'large_size_h', 469 );
	}





function jht_divcheck( $text, $force = false ) {
	global $post;
	if ( is_object($post) ) {
	if ( in_array($post->ID, array(3749,3805,3803) ) ) {
		if ( $post->ID == 3749 ) { //about
			$divend = "</div>
</div>
</div>
</div>";
			$fx = "</div>
</div>";
		} else {
			$divend = "</div>
</div>
</div>
</div>
</div>";
			$fx = "</div>
</div>
</div>";
		}
		if ( strrpos($text,$divend) ) {
			$text = substr($text, 0, strpos($text, $divend)) . $fx;
		}
	}
	}
	return $text;
}
add_filter( 'content_save_pre', 'jht_divcheck', 99 );

function jht_admin_menu_cleanup() {
	global $menu;
	$restricted = array('Links','Comments');
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
			unset($menu[key($menu)]);
		}
	}
	
}


function jht_admin_init() {
	$post_id = false;
	if ( isset($_GET['post'])) {
		$post_id = $_GET['post'];
	} else {
		if ( isset($_POST['post_ID']) ) {
			$post_id = $_POST['post_ID'];
		}
	}
	
	if ( $post_id != false ) {
		$template_file = get_post_meta( $post_id, '_wp_page_template', true);
		
		// check for a template type
		switch ( $template_file ) {
			case 'default':
			case 'page-warranty.php':
			case '':
				add_meta_box( "jht_pagemenu_metabox", "Left Sidebar", "jht_pagemenu_metabox", "page", "side", "low" );
				break;
			case 'page-warranty-new.php':
				add_meta_box( "jht_pagemenu_metabox", "Left Sidebar", "jht_pagemenu_metabox", "page", "side", "low" );
				break; 
			case 'page-direct.php':
			case 'page-directcanada.php':
			case 'page-directtwo.php':
			case 'page-directthanks.php':
			case 'page-directthankscanada.php':
			case '':
				add_meta_box( "progo_direct_box", "Calls to Action", "progo_direct_box", "page", "normal", "high" );
				break;
			case 'page-quote-ppc.php':
			case 'page-quote-special-promo.php':
				add_meta_box( "jht_ppc_options_metabox", "PPC Header Options", "jht_ppc_options_metabox", "page", "normal", "low" );
				break;
		}
		add_meta_box( "jht_menuoptions_metabox", "Menu Display Options", "jht_menuoptions_metabox", "page", "side", "low" );
		add_meta_box( "jht_nopopup_metabox", "Pop-up Options", "jht_nopopup_metabox", "page", "side", "low" );
		add_meta_box( "jht_form_type_metabox", "Is this a Form Page?", "jht_form_type_metabox", "page", "side", "low" );

		add_meta_box( "jht_pagemenu_metabox", "Left Sidebar", "jht_pagemenu_metabox", "post", "side", "low" );
	}

	if ( get_option( 'progo_direct_installed' ) != true ) {
		progo_new_direct_page( true );
		
		// set our default SITE options
		progo_options_defaults();
		
		// and send to INSTALLATION (setup step 1) page
		wp_redirect( get_option( 'siteurl' ) . '/wp-admin/index.php' );
	}
}

if ( ! function_exists( 'jht_metabox_cleanup' ) ):
function jht_metabox_cleanup() {
	global $wp_meta_boxes, $post_type, $post;
	
	switch($post_type) {
		case 'jht_color':
		case 'jht_cabinetry':
			$wp_meta_boxes[$post_type]['side']['low']['postimagediv']['title'] = 'Featured (Swatch) Image';
			break;
		case 'jht_tub':
		case 'jht_cat':
			$wp_meta_boxes[$post_type]['side']['low']['postimagediv']['title'] = 'Featured (230x250 Landing) Image';
			break;
		case 'page':
			if ( get_post_meta( $post->ID, '_wp_page_template', true ) == 'page-direct.php' || get_post_meta( $post->ID, '_wp_page_template', true ) == 'page-directtwo.php' || get_post_meta( $post->ID, '_wp_page_template', true ) == 'page-directcanada.php' ) {
				#needswork
				$wp_meta_boxes['page']['side']['low']['postimagediv']['title'] = 'Custom Image for Top of Page';
			}
			break;
	}
}
endif;
add_action( 'do_meta_boxes', 'jht_metabox_cleanup' );

function jht_custom_post_permalink( $permalink, $post, $leavename ) {
	global $wp_query, $wpsc_page_titles;
	$term_url = '';
	$rewritecode = array(
		'%collection%',
		$leavename ? '' : '%postname%',
	);
	if ( is_object( $post ) ) {
		// In wordpress 2.9 we got a post object
		$post_id = $post->ID;
	} else {
		// In wordpress 3.0 we get a post ID
		$post_id = $post;
		$post = get_post( $post_id );
	}
	
	switch( $post->post_type ) {
		case 'jht_cat':
			$permalink = substr($permalink,0,strpos($permalink,'%jht_none')) . $post->post_name .'/';
			break;
		case 'jht_tub':
			$custom = get_post_meta($post->ID,'jht_cats');
			if ( is_array( $custom ) ) {
				if ( count( $custom ) > 0 ) {
					$tub_cats = $custom[0];
					if(is_array($tub_cats)) {
						$lastcat = get_post(absint( array_pop($tub_cats) ));
						$permalink = str_replace('%collection%', $lastcat->post_name, $permalink);
					}
				}
			}
//			$permalink = str_replace('tubs', 'hot-tub', $permalink);
			break;
	}
	return $permalink;
}
add_filter( 'post_type_link', 'jht_custom_post_permalink', 1, 3 );

add_filter( 'post_updated_messages', 'jht_custom_updated_messages' );
function jht_custom_updated_messages( $messages ) {
  global $post, $post_ID;

 $messages['jht_tub'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Hot Tub updated. <a href="%s">View tub</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Hot Tub updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Hot Tub restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Hot Tub published. <a href="%s">View tub</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Hot Tub saved.'),
    8 => sprintf( __('Hot Tub submitted. <a target="_blank" href="%s">Preview tub</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Hot Tub scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview tub</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Hot Tub draft updated. <a target="_blank" href="%s">Preview tub</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

 $messages['jht_cat'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Collection updated. <a href="%s">View Collection</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Collection updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Collection restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Collection published. <a href="%s">View Collection</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Collection saved.'),
    8 => sprintf( __('Collection submitted. <a target="_blank" href="%s">Preview Collection</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Collection scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Collection</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Collection draft updated. <a target="_blank" href="%s">Preview Collection</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  $messages['jht_color'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => __('Color updated.'),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Color updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Color restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => __('Color published.'),
    7 => __('Color saved.'),
    8 => __('Color submitted.'),
    9 => sprintf( __('Color scheduled for: <strong>%1$s</strong>.'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ) ),
    10 => __('Color draft updated.'),
  );
  
  $messages['jht_cabinetry'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => __('Cabinetry updated.'),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Cabinetry updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Cabinetry restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => __('Cabinetry published.'),
    7 => __('Cabinetry saved.'),
    8 => __('Cabinetry submitted.'),
    9 => sprintf( __('Cabinetry scheduled for: <strong>%1$s</strong>.'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ) ),
    10 => __('Cabinetry draft updated.'),
  );
  
  $messages['jht_feat'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => __('Feature updated.'),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Feature updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Feature restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => __('Feature published.'),
    7 => __('Feature saved.'),
    8 => __('Feature submitted.'),
    9 => sprintf( __('Feature scheduled for: <strong>%1$s</strong>.'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ) ),
    10 => __('Feature draft updated.'),
  );

  $messages['jht_jet'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => __('Jet updated.'),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Jet updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Jet restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => __('Jet published.'),
    7 => __('Jet saved.'),
    8 => __('Jet submitted.'),
    9 => sprintf( __('Jet scheduled for: <strong>%1$s</strong>.'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ) ),
    10 => __('Jet draft updated.'),
  );
  
  $messages['jht_warranty'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => __('Warranty updated.'),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Warranty updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Warranty restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => __('Warranty published.'),
    7 => __('Warranty saved.'),
    8 => __('Warranty submitted.'),
    9 => sprintf( __('Warranty scheduled for: <strong>%1$s</strong>.'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ) ),
    10 => __('Warranty draft updated.'),
  );
  
  $messages['jht_vid'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => __('Video updated.'),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Video updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Video restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => __('Video published.'),
    7 => __('Video saved.'),
    8 => __('Video submitted.'),
    9 => sprintf( __('Video scheduled for: <strong>%1$s</strong>.'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ) ),
    10 => __('Video draft updated.'),
  );
  
  $messages['jht_acc'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => __('Accessory updated.'),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Accessory updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Accessory restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => __('Accessory published.'),
    7 => __('Accessory saved.'),
    8 => __('Accessory submitted.'),
    9 => sprintf( __('Accessory scheduled for: <strong>%1$s</strong>.'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ) ),
    10 => __('Accessory draft updated.'),
  );
  return $messages;
}

// returns array of images for nav rollover / cat landing page
function jht_tubimgs( $alltubs ) {
	if ( false === ( $special_query_results = get_transient( 'jht_alltubimgs' ) ) ) {
		$oot = array();
		foreach ( $alltubs as $t ) {
			// nav rollover
			$nav_img = '';
			if (class_exists('MultiPostThumbnails')) {
				$img_id = MultiPostThumbnails::get_post_thumbnail_id('jht_tub', 'nav-rollover', $t->ID);
				if ( $img_id ) {
					$imgsrc = wp_get_attachment_image_src($img_id, 'navright');
					$nav_img = $imgsrc[0];
				}
			}
			// landing page
			$landing_img = '';
			$img_id = get_post_meta( $t->ID, '_thumbnail_id', true );
			if ( $img_id ) {
				$img = get_post($img_id);
				$landing_img = $img->guid;
			}
			// three quarter nav
			$nav34_img = '';
			$nav34_src = '';
			if (class_exists('MultiPostThumbnails')) {
				$nav34_img = MultiPostThumbnails::get_the_post_thumbnail('jht_tub', 'three-quarter', $t->ID, 'three-quarter-nav');
				$img_id = MultiPostThumbnails::get_post_thumbnail_id('jht_tub', 'three-quarter', $t->ID);
				if ( $img_id ) {
					$imgsrc = wp_get_attachment_image_src($img_id, 'three-quarter-nav');
					$nav34_src = $imgsrc[0];
				}
			}
			
			$oot[$t->ID] = array(
				'rollover' => $nav_img,
				'landing' => $landing_img,
				'nav34' => $nav34_img,
				'nav34src' => $nav34_src,
			);
		}
		set_transient( 'jht_alltubimgs', $oot, 60*60*12 );
	}
	// Use the data like you would have normally...
	$tub_imgs = get_transient( 'jht_alltubimgs' );
	return $tub_imgs;
}

function jht_findtubs_forcat($cid) {
	$thesetubs = array();
	$alltubs = jht_alltubs();
	$tub_imgs = jht_tubimgs($alltubs);
	
	$checklang = false;
	
	global $polylang;
	if ( !empty($polylang) ) {
		if ( is_object($polylang) ) {
			if ( isset($polylang->curlang) ) {
				$checklang = true;
			}
		}
	}
	$baseurl = '/';
	$baseurl = apply_filters('hottubbase', $baseurl);
	
	foreach ( $alltubs as $t ) {
		$custom = get_post_meta($t->ID, 'jht_cats');
		$tub_cats = $custom[0];
		if ( $tub_cats == '' ) $tub_cats = array();
		if ( in_array($cid, $tub_cats) ) {
			$custom = get_post_meta($t->ID, 'jht_quickinfo');
			$quickinfo = $custom[0];
			$quickinfo['imgs'] = $tub_imgs[$t->ID];
			// check lang?
			$lang = '';
			if ( $checklang ) {
				$lang = $polylang->get_post_language($t->ID)->slug;
			}
			$quickinfo['lang'] = $lang;
			
			// fix perm
			$cstart = substr($quickinfo['slug'], 0, 3);
			$quickinfo['url'] = $baseurl. $cstart . ( $cstart == 'j-l' ? 'x' : '00' ) .'/'. $quickinfo['slug'] .'/';
			/*
			if ( function_exists('jhtpolylangfix_fixurl') ) {
				$quickinfo['url'] = jhtpolylangfix_fixurl( $quickinfo['url'] );
			}
			*/
			// and then
			if ( $checklang ) {
				if ( $lang == $polylang->curlang->slug ) {
					$thesetubs[$t->ID] = $quickinfo;
				}
			} else {
				$thesetubs[$t->ID] = $quickinfo;
			}
		}
	}
	
	usort($thesetubs, 'jht_tub_sort');
	return $thesetubs;
}

function jht_alltubs() {
	// transient for jht_alltubs
	if ( false === ( $special_query_results = get_transient( 'jht_alltubs' ) ) ) {
		// It wasn't there, so regenerate the data and save the transient
		$alltubs = get_posts( array( 'numberposts' => -1, 'post_type' => 'jht_tub', 'orderby' => 'menu_order', 'order' => 'ASC', 'post_status' => 'publish' ) );
		//wp_die('alltubs <pre>'. print_r($alltubs,true) .'</pre>');
		// also add lang to the infos?
		/*
		global $polylang;
		if ( !empty($polylang) ) {
			if ( is_object($polylang) ) {
				foreach ( $arr as $i
			}
		}
        */
		set_transient( 'jht_alltubs', $alltubs, 60*60*12 );
	}
	// Use the data like you would have normally...
	$alltubs = get_transient( 'jht_alltubs' );
	return $alltubs;
}

// returns array of categories/collections, with sub arrays of associated TUBS
function jht_tub_collection_setup() {
	
	// transient for jht_tubcats
	//if ( false === ( $special_query_results = get_transient( 'jht_tubcats' ) ) ) {
		// It wasn't there, so regenerate the data and save the transient
		
		// main HOT TUBS category is id #8, so we can skip that...
		
		// transient for jht_allcats
		//if ( false === ( $special_query_results = get_transient( 'jht_allcats' ) ) ) {
			// It wasn't there, so regenerate the data and save the transient
			$args = array('numberposts'=>-1,'post_type'=>'jht_cat','orderby'=>'menu_order','order'=>'ASC');
			$allcats = get_posts( $args );
			//wp_die('allcats <pre>'. print_r($allcats,true) .'</pre>');
			//set_transient( 'jht_allcats', $allcats, 60*60*12 );
		//}
		// Use the data like you would have normally...
		//$allcats = get_transient( 'jht_allcats' );
		
		$alltubs = jht_alltubs();
		$tub_imgs = jht_tubimgs($alltubs);
		
//		wp_die('<pre>'. print_r($alltubs,true) .'</pre>');
		$cats = array();
		$subcats = array();
		$checklang = false;
		
		global $polylang;
		if ( !empty($polylang) ) {
			if ( is_object($polylang) ) {
				if ( isset($polylang->curlang) ) {
					$checklang = true;
				}
			}
		}
		
		foreach ( $allcats as $c ) {
			$lang = '';
			if ( $checklang ) {
				$lang = $polylang->get_post_language($c->ID)->slug;
			}
			if ( $c->post_parent != '' ) {
				$custom = get_post_meta($c->ID, 'jht_info');
				$info = $custom[0]; // array('navheadline'=>'')
				if ( $info == '' ) $info = array('navheadline'=>'');
				
				if ( !isset($subcats[$c->post_parent]) ) $subcats[$c->post_parent] = array();
				if ( !isset($subcats[$c->post_parent]['subcats']) ) $subcats[$c->post_parent]['subcats'] = array();
				
				$cat_tubs = jht_findtubs_forcat($c->ID);
				
				// nav img
				$nav_img = '';
				$img_src = '';
				if (class_exists('MultiPostThumbnails')) {
					$nav_img = MultiPostThumbnails::get_the_post_thumbnail('jht_cat', 'nav-rollover', $c->ID);
					$img_id = MultiPostThumbnails::get_post_thumbnail_id('jht_cat', 'nav-rollover', $c->ID);
					if ( $img_id ) {
						$img_src = wp_get_attachment_image_src($img_id, 'three-quarter-nav');
						$img_src = $img_src[0];
					}
				}
				$subcats[$c->post_parent]['subcats'][$c->ID] = array(
					'name' => str_replace(' Collection', '', $c->post_title),
					'fullname' => str_replace(' Collection', '<sup>&trade;</sup> Collection', $c->post_title),
					'tag' => $info['navheadline'],
					'url' => get_bloginfo('url') .'/'. $c->post_name .'/',//get_permalink($c->ID),
					'tubs' => $cat_tubs,
					'slug' => $c->post_name,
					'lang' => $lang,
					'menu_order' => $c->menu_order,
					'img' => $nav_img,
					'imgsrc' => $img_src,
				);
			} else { // for the actual COLLECTIONS
				if ( !isset($cats[$c->ID]) ) $cats[$c->ID] = array();
				
				$cats[$c->ID]['name'] = $c->post_title;
				$cats[$c->ID]['url'] = get_bloginfo('url') .'/'. $c->post_name .'/'; //get_permalink($c->ID);
				$cats[$c->ID]['tubs'] = array();
				$cats[$c->ID]['lang'] = $lang;
				
				if (class_exists('MultiPostThumbnails')) {
					$img_id = MultiPostThumbnails::get_post_thumbnail_id('jht_cat', 'nav-rollover', $c->ID);
					$cat_img = get_post($img_id);
					if ( is_object($cat_img) ) {
						$cat_img = $cat_img->guid;
					} else {
						$cat_img = '';
					}
				} else {
					$cat_img = '';
				}
				
				$cats[$c->ID]['img'] = $cat_img;
				
				$cat_tubs = jht_findtubs_forcat($c->ID);
				
				$cats[$c->ID]['tubs'] = $cat_tubs;
			}
		}
		foreach ( $subcats as $k => $v ) {
			$cats[$k]['subcats'] = $v['subcats'];
		}
		$curlang = 'en';	
		if ( $checklang ) {
			$curlang = $polylang->curlang->slug;
			if ( function_exists('jhtpolylangfix_servercheck') ) {
				$curlang = jhtpolylangfix_servercheck() ? 'ca' : 'en';
			}
		}
		foreach ( $cats as $i => $c ) {
			
			if ( $c['name'] == 'Hot Tubs' ) {
				unset( $cats[$i] );
			} else {
				if ( $checklang ) {
					if ( ( $c['lang'] != $curlang ) || ( $i == 8 ) ) {
						unset($cats[$i]);
					}
				}
			}
		}
		
			//wp_die('<pre>'. print_r($cats,true) .'</pre>');
		
		//set_transient( 'jht_tubcats', $cats, 60*60*12 );
	//}
	// Use the data like you would have normally...
	//$cats = get_transient( 'jht_tubcats' );
	global $tubcats;
	$tubcats = $cats;
	
//	wp_die('<pre>'. print_r($cats,true) .'</pre>');
}

function jht_add_scripts() {
	if ( ! is_admin() ) {
		//wp_deregister_script('jquery');
		//wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', array(), '1.7.2', true);
		wp_register_script( 'mbox', 'http://www.jacuzzihottubs.com/mbox/mbox.js', array(), '1', true);
		
		if ( is_page(3888) ) {
			wp_enqueue_script( 'jquery-ui-accordion' );
		}
		if ( is_page_template('page-mobile.php') ) {
			wp_enqueue_script( 'jht-html5', get_template_directory_uri() .'/js/html5.js' );
			wp_enqueue_script( 'jht-mobile', get_template_directory_uri() .'/js/mobile.js', array('jquery'), '1.0', true );
		} else {
			wp_enqueue_script( 'jquery.cookie', get_template_directory_uri() .'/js/jquery.cookie.js', array('jquery'), '1.0', true );
			wp_enqueue_script( 'jquery-ui-tooltip', get_template_directory_uri() .'/js/jquery-ui-1.10.3.custom.min.js', array('jquery'), '1.10.3', true );
			wp_enqueue_script( 'jht-frontend', get_template_directory_uri() .'/js/frontend.js', array('jquery', 'jquery.cookie', 'thickbox'), '1.2.2', true );
			wp_enqueue_script( 'jht-modal', get_template_directory_uri() .'/js/modalmaker.min.js', array('jquery'), '1.0', true );
			wp_enqueue_script( 'youTubeTracker', get_template_directory_uri() .'/js/youTubeTracker.min.js', array('jquery'), '2.1', true );
			wp_enqueue_script( 'jquery.placeholder', get_stylesheet_directory_uri() .'/js/jquery.placeholder.js', array('jquery'), '1.0', true );
		}
		if ( is_page_template('page-direct.php') 
			|| is_page_template('page-directtwo.php')
			|| is_page_template('page-directcanada.php')
			|| is_page_template('page-directthanks.php')
			|| is_page_template('page-directthankscanada.php') ) {
			wp_enqueue_script( 'cufon', get_template_directory_uri() .'/js/cufon-yui.js', array('jquery'), '1.09i', true );
			wp_enqueue_script( 'cufon-GillSans', get_template_directory_uri() .'/js/GillSans_400.font.js', array('cufon'), '1.09i', true );
			wp_enqueue_script( 'progo', get_template_directory_uri() .'/js/progo-frontend.js', array('jquery','swfobject','cufon-GillSans'), '1.0', true );
			wp_enqueue_script( 'thickbox' );
		}

	}
}

function jht_enqueued_scripts() {
	wp_enqueue_script( 'vidora-js', '//assets.vidora.com/js/ninthlink.36e3663509be5e4f.js' );
}

function jht_add_styles() {
	if ( ! is_admin() ) {
		$theme = wp_get_theme();
		if ( is_page_template('page-mobile.php') ) {
			wp_enqueue_style( 'jht-mobile', get_bloginfo( 'template_url' ) .'/mobile.css', array(), $theme->Version );
		} else {
			wp_enqueue_style( 'jht', get_bloginfo( 'stylesheet_url' ), array(), $theme->Version );
		}
		wp_enqueue_style( 'jquery-ui-css', get_template_directory_uri() . '/css/ui-lightness/jquery-ui-1.10.3.custom.min.css', array(), $theme->Version );
		wp_enqueue_style('dealer-landing', get_bloginfo( 'template_url' ) .'/style-dlanding.css', array(), $theme->Version );
		wp_enqueue_style('thickbox');
		wp_enqueue_style('Lato', 'http://fonts.googleapis.com/css?family=Lato:300,400,700,900');
		wp_enqueue_style('Coustard', 'http://fonts.googleapis.com/css?family=Coustard:900');
		if ( is_page_template('page-direct.php') 
			|| is_page_template('page-directtwo.php')
			|| is_page_template('page-directcanada.php')
			|| is_page_template('page-directthanks.php')
			|| is_page_template('page-directthankscanada.php') ) {
			wp_enqueue_style( 'direct-base', get_bloginfo( 'template_url' ) .'/css/base.css', array(), $theme->Version );
			wp_enqueue_style( 'direct-ppc', get_bloginfo( 'template_url' ) .'/css/ppc.css', array(), $theme->Version );
			wp_enqueue_style( 'proGoColorschemeLightGrey', get_stylesheet_directory_uri() .'/css/styleLightGrey.css' );
			wp_enqueue_style( 'thickbox' );
		}
	}
}

function jht_custom_login_logo() { ?>
<style type="text/css">
.login h1 a { background-image: url(<?php bloginfo( 'template_url' ); ?>/images/logo.png); width: 177px; height: 85px; background-size: auto }
</style>
<?php
}

function jht_custom_login_url() {
	return get_bloginfo( 'url' );
}

// takes in img src URL
// returns URL of resized image, or FALSE if error
function jht_get_resized_src( $src, $width, $height, $crop = true ) {
	$width = absint($width);
	$height = absint($height);
	$crop = ($crop==false ? false : true );
	$updir = wp_upload_dir();
	$baseurl = $updir['baseurl'];
	$basedir = $updir['basedir'];
	$imgpath = $basedir . substr($src, strpos($src, '/wp-content/uploads') + 19);
	$thm = image_resize($imgpath, $width, $height, $crop);
	if ( is_wp_error($thm) == false ) {
		$thmsrc = $baseurl . substr($thm, strpos($thm, '/wp-content/uploads') + 19);
		return $thmsrc;
	}
	return $src;
}


function jht_embed($oembvideo, $url, $attr) {
	if(strpos($url,'youtube.com') || strpos($url,'youtu.be') ) {
		if ( strpos( $oembedvideo, 'wmode' ) ) return $oembvideo;
		return str_replace('feature=oembed', 'feature=oembed&amp;wmode=opaque',$oembvideo);//
	}
	return $oembedvideo;
}

function jht_shortcode_warranties( $atts ){
	$oot = '<div class="warranties">';
	$postargs = array(
		'numberposts' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'post_type' => 'jht_warranty',
	);
	
	$jht_wars = get_posts( $postargs );
	foreach ( $jht_wars as $w ) {
		$oot .= '<div class="warranty">';
		$oot .= '<p>'. get_the_post_thumbnail($w->ID, 'warranty', array('class'=>'alignleft')) .'<strong>'. esc_attr($w->post_title) .'</strong> - '. ($w->post_content) .'</p>';
		$oot .= '</div>';
	}
	$oot .= '</div>';
	return $oot;
}
add_shortcode( 'jht_warranties', 'jht_shortcode_warranties' );

function jht_searchfilter($query) {
    if ($query->is_search) {
        $query->set('post__not_in', array(4422,4922,4513));
    }
    return $query;
}
add_filter('pre_get_posts','jht_searchfilter');

function jht_socialmenu($plusone = false) {
	?><ul class="socialMenu">
        <li class="first"><a href="http://www.facebook.com/jacuzziofficial" target="_blank" class="icon fb" title="Join us on Facebook">Facebook</a></li><?php
		if ( $plusone ) { ?>
        <li><g:plusone size="medium" annotation="none"></g:plusone></li><?php } ?>
        <li><a href="http://twitter.com/jacuzziofficial" target="_blank" class="icon tw" title="Follow us on Twitter">Twitter</a></li>
        <li><a href="http://www.youtube.com/jacuzziofficial" target="_blank" class="icon yt" title="Watch us on YouTube">YouTube</a></li>
        <li class="last"><a href="<?php echo get_permalink(5) ?>" class="icon rss" title="Read Our Blog">Blog</a></li>
    </ul><?php
}

/* lets try some transient stuff ... */
// jht_rec_posts : used in sidebar-blog.php
function jht_publish_post_transient($post_id) {
    delete_transient( 'jht_rec_posts' );
}
add_action( 'publish_post', 'jht_publish_post_transient' );

// jht_acc_cats : on sitemap.php & elsewhere?
function jht_edit_acccat_transient($c_id) {
    delete_transient( 'jht_acc_cats' );
}
add_action( 'edit_jht_acc_cat', 'jht_edit_acccat_transient' );

// jht_vid_cats : on page-video.php
function jht_edit_vidcat_transient($c_id) {
    delete_transient( 'jht_vid_cats' );
}
add_action( 'edit_jht_vid_cat', 'jht_edit_vidcat_transient' );

// wp_list_categories : on front-page & sidebar-blog
function jht_edit_category_transients($c_id) {
    delete_transient( 'wp_list_categories' );
}
add_action( 'edit_category', 'jht_edit_category_transients' );

// [slug]-accs : on sitemap.php & elsewhere?
function jht_publish_acc_transients($post_id) {
	$thispost = wp_get_single_post($post_id);
	$thisterms = wp_get_object_terms($post_id, 'jht_acc_cat', array('fields' => 'slugs'));
	foreach ( $thisterms as $t ) {
		delete_transient( $t .'-accs' );
	}
}
add_action( 'publish_jht_acc', 'jht_publish_acc_transients' );

// [slug]-vinfo : on page-video.php
function jht_publish_vid_transient($post_id) {
	$thispost = wp_get_single_post($post_id);
	$thisterms = wp_get_object_terms($post_id, 'jht_vid_cat', array('fields' => 'slugs'));
	foreach ( $thisterms as $t ) {
		delete_transient( $t .'-vinfo' );
	}
}
add_action( 'publish_jht_vid', 'jht_publish_vid_transient' );

function jht_w3tcwipealltransients() {
    delete_transient( 'jht_tubcats' );
    delete_transient( 'jht_alltubs' );
    delete_transient( 'jht_alltubimgs' );
    delete_transient( 'jht_hdrop' );
	// and more?
}
add_action( 'w3tc_pgcache_flush', 'jht_w3tcwipealltransients' );

function jht_flush_tubcats_transient($post_id) {
	$thispost = wp_get_single_post($post_id);
	// we know we want to flush jht_tubcats
    delete_transient( 'jht_tubcats' );
    delete_transient( 'jht_alltubs' );
    delete_transient( 'jht_alltubimgs' );
    delete_transient( 'jht_hdrop' );
	
	switch ( $thispost->post_type ) {
		case 'jht_tub':
    		//delete_transient( 'jht_alltubs' );
    		//delete_transient( 'jht_alltubimgs' );
			break;
		case 'jht_cat':
    		delete_transient( 'jht_allcats' );
			break;
		case 'jht_jet':
    		delete_transient( 'jht_alljets' );
			break;
	}
	
}
add_action( 'publish_jht_tub', 'jht_flush_tubcats_transient' );
add_action( 'publish_jht_cat', 'jht_flush_tubcats_transient' );
add_action( 'publish_jht_jet', 'jht_flush_tubcats_transient' );

function jht_template_redir_check() {
	if( session_id() == '' ) {
		session_start();
	}
	
	$wipemdir = true;
	
	global $post;
	if ( is_page() ) {
		$checkmobileredir = get_post_meta($post->ID, 'jht_mobileredirect', true);
		if ( $checkmobileredir ) {
			// we are on a page that SHOULD redir
			// check if mobile
			include("Mobile_Detect.php");
			$detect = new Mobile_Detect();
		
			if ( $detect->isMobile() && ( $detect->isTablet() == false ) ) {
				// if on page with redir for 1st time (no ONMDIR ), redir to mobile
				// once on mobile page, set ONMDIR
				// if hit any other page after ONMDIR, wipe on ONMDIR
				$_SESSION['jht_redirto'] = $checkmobileredir;
				
				if ( !isset($_SESSION['jht_onmdir']) ) {
					$wipemdir = false;
					// check for conversion string!!
					$qstr = $_SERVER['QUERY_STRING'];
					$qstr = ( $qstr ? '?'. $qstr : '' );
					wp_redirect( get_bloginfo('url') .'/'. $checkmobileredir . $qstr );
					//wp_die('HELLO! redir to '. $checkmobileredir .' : qstr '. $qstr);
				}
			}
		} else {
			// we are on some other page
			if ( isset($_SESSION['jht_redirto']) ) {
				if ( is_page($_SESSION['jht_redirto']) ) {
					// on mobile page - set onmdir
					$_SESSION['jht_onmdir'] = true;
					$wipemdir = false;
				}
			}
		}
	}
	if ( $wipemdir && isset($_SESSION['jht_onmdir']) ) {
		unset($_SESSION['jht_onmdir']);
	}
}
add_action( 'wp', 'jht_template_redir_check' );


function nlkTwitterRelativeTime($t) {
	$ts = strtotime($t);
	$d = time() - strtotime($t);
	
	if ($d < 60) {
		$nt = 'less than a minute ago';
	} elseif($d < 120) {
		$nt = 'about a minute ago';
	} elseif($d < 3600) { // 60seconds x 60minutes
		$nt = round($d / 60) .' minutes ago';
	} elseif($d < 7200) { // 60seconds x 60minutes x 2
		$nt = 'about an hour ago';
	} elseif($d < (24*60*60)) {
		$nt = 'about '. round($d / 3600) .' hours ago';
	} elseif($d < (48*60*60)) {
		$nt = '1 day ago';
	} else {
		$nt = round($d / 86400) .' days ago';
	}
	return '<span title="'. $d .'">'. $nt .'</span>';
}

function nlkTwitterTweet( $text, $ents ) {
	$oot = $text;
	$lc = 0;
	
	$allents = array();
	
	if ( isset( $ents['hashtags'] ) ) {
		foreach ( $ents['hashtags'] as $h ) {
			$allents[$h['indices'][0]] = array(
				'type' => 'hashtags',
				'startat' => $h['indices'][0],
				'endat' => $h['indices'][1],
				'replacewith' => '<a href="https://twitter.com/search?q=%23'. $h['text'] .'&src=hash" target="_blank">#'. $h['text'] .'</a>'
			);
		}
	}
	
	
	if ( isset( $ents['urls'] ) ) {
		foreach ( $ents['urls'] as $h ) {
			$allents[$h['indices'][0]] = array(
				'type' => 'urls',
				'startat' => $h['indices'][0],
				'endat' => $h['indices'][1],
				'replacewith' => '<a href="'. $h['expanded_url'] .'" target="_blank">'. $h['display_url'] .'</a>'
			);
		}
	}
	
	if ( isset( $ents['user_mentions'] ) ) {
		foreach ( $ents['user_mentions'] as $h ) {
			$allents[$h['indices'][0]] = array(
				'type' => 'user_mentions',
				'startat' => $h['indices'][0],
				'endat' => $h['indices'][1],
				'replacewith' => '<a href="https://twitter.com/'. $h['screen_name'] .'" target="_blank">@'. $h['screen_name'] .'</a>'
			);
		}
	}
	
	ksort($allents);
	
	foreach ( $allents as $h ) {
		$oldlength = strlen($oot);
		$newt = substr( $oot, 0, $h['startat'] + $lc ) . $h['replacewith'] . substr( $oot, $h['endat'] + $lc );
		$oot = $newt;
		$lc = ( strlen($oot) - $oldlength ) + $lc;
	}
		
	return $oot;
}

// cookie to collect browsing data

function search_engine_query_string($url = false) {
    if(!$url) {
        $url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : false;
    }
    if($url == false) {
        return '';
    }
    $parts = parse_url($url);
    parse_str($parts['query'], $query);
    $search_engines = array(
        'bing' => 'q',
        'google' => 'q',
        'yahoo' => 'p'
    );
    preg_match('/(' . implode('|', array_keys($search_engines)) . ')\./', $parts['host'], $matches);
    return isset($matches[1]) && isset($query[$search_engines[$matches[1]]]) ? $query[$search_engines[$matches[1]]] : '';
}

function jht_404fix2() {
	global $wp_query;
	global $post;
	
	// check for fixing permalinks of accessories & tubs & cats...
	if ( ( $wp_query->query_vars['post_type'] == 'jht_acc' ) && ( $wp_query->post_count == 0 ) ) {
		/*
		 * make sure it really is...
		 * check for jht_cat & jht_tub
		 */
		//$req = $_SERVER['REQUEST_URI'];
		$req = strpos($_SERVER['REQUEST_URI'], "?") ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], "?")) : $_SERVER['REQUEST_URI']; //debug??
		if ( strpos($req, 'accessories') > 0 ) {
			$unslashed = substr( $req, strrpos( $req, '/', -2)+1, -1 );
			$old_query = $wp_query;
			$args = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'jht_acc_cat',
						'field' => 'slug',
						'terms' => $unslashed,
					)
				)
			);
			$wp_query = new WP_Query( $args );
			if ( $wp_query->post_count > 0 ) {
					status_header(200);
					nocache_headers();
			} else {
				$wp_query = $old_query;
			}
		}
	}
	if ( $wp_query->query_vars['error'] == '404' ) {
		/*
		 * make sure it really is...
		 * check for jht_cat & jht_tub
		 */
		//$req = $_SERVER['REQUEST_URI'];
		$req = strpos($_SERVER['REQUEST_URI'], "?") ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], "?")) : $_SERVER['REQUEST_URI']; //debug??
		if ( strpos($req, 'accessories') > 0 ) {
			$unslashed = substr( $req, strrpos( $req, '/', -2)+1, -1 );
			$old_query = $wp_query;
			$args = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'jht_acc_cat',
						'field' => 'slug',
						'terms' => $unslashed,
					)
				)
			);
			$wp_query = new WP_Query( $args );
			if ( $wp_query->post_count > 0 ) {
					status_header(200);
					nocache_headers();
			} else {
				$wp_query = $old_query;
			}
		} else {
			/**
			 * if we are in a 404 & not looking in /accessories/,
			 * then we must be looking for a hot tub or hot tub category?
			 */
			$catslash = 2;
			// jacuzzihottubs.CA or something else i forget
			if ( isset( $wp_query->query_vars['term'] ) ) {
				if ( ( $wp_query->query_vars['term'] != 'en' ) && ( !defined( 'JHTCA' ) ) ){
					$catslash = 3;
				}
			}
			// if not in root level but instead like in /hot-tubs/
			if ( in_array($_SERVER['SERVER_NAME'],array('www.jacuzzi.com','www.jacuzzi.ca','www.nlkdevj.com','beta.jacuzzi.ca')) ) {
				$catslash++;
			}
			// for tim's localhost case, it was like http://localhost/jacuzzi.com/hot-tubs/j-300/j-365/
			//if ( in_array($_SERVER['SERVER_NAME'],array('localhost')) ) {
			//	$catslash = 4;
			//}
			// and in any case, check if we had defined JHTCATSLASH constant, overwrite
			if ( defined( 'JHTCATSLASH' ) ) {
				$catslash = JHTCATSLASH;
			}
			
			$tubslash = $catslash + 1;
			$slashcount = substr_count($req, '/');
			
			if ( in_array($slashcount, array( $catslash, $tubslash ) ) ) {
				$old_query = $wp_query;
				$morevars = array( 'page' => 0 );
				if ( $slashcount == $catslash ) {
					$ptype = 'jht_cat';
				} else {
					$ptype = 'jht_tub';
				}
				$slash2 = strrpos($req, '/');
				$slash1 = strrpos(substr($req,0,$slash2-2), '/')+1;
				$unslashed = substr($req,$slash1, $slash2-$slash1);
				$wp_query = new WP_Query(array('post_type'=>$ptype, 'name'=> $unslashed));
				$morevars[$ptype] = $unslashed;
				
				if ( $wp_query->post_count > 0 ) {
					$wp_query->query_vars = array_merge($morevars, $wp_query->query_vars);
					$morevars['page'] = '';
					$wp_query->query = array_merge($morevars, $wp_query->query);
					
					// check polylang?
					if ( $wp_query->post_count > 1 ) {
						global $polylang;
						if ( empty($polylang) ) {
							// nada
						} else {
							if ( is_object($polylang) ) {
								$curlang = $polylang->curlang->slug;
								// OVERRIDE
								if ( defined('JHTCA') ) $curlang = 'ca';
								
								$postfound = false;
								foreach ( $wp_query->posts as $i => $p ) {
									if ( $postfound == false ) {
										if ( $polylang->get_post_language($p->ID)->slug == $curlang ) {
											$postfound = $p;
										}
									}
								}
								if ( $postfound !== false ) {
									$wp_query->post = $postfound;
									$wp_query->posts = array($postfound);
									$wp_query->post_count = 1;
									$wp_query->found_posts = 1;
								}
							}
						}
					}
					$post = $wp_query->post;
					status_header(200);
					nocache_headers();
				} else {
					$wp_query = $old_query;
				}
			}
		}
	}
	$GLOBALS['wp_query'] = $wp_query;
	$GLOBALS['wp_the_query'] = $wp_query;
	
	if ( is_page('mobile-dealer-locator') ) {
		include("Mobile_Detect.php");
		$detect = new Mobile_Detect();
		$redir = true;
		if ( $detect->isMobile() ) {
			$redir = false;
		}
		if ( $redir ) {
			wp_redirect( get_bloginfo('url') .'/dealer-locator/' );
		}
	}
}
add_action( 'wp', 'jht_404fix2', 98 );

function jht_homeurl_tfix() {
	$url = get_bloginfo('url');
	global $polylang;
	if ( is_object($polylang) ) {
		$url = $polylang->get_home_url();
	}
	return $url;
}

//Owners corner - Receive Savings form: ajax page scroll to top
add_filter("gform_confirmation_anchor_11", create_function("","return 0;"));

// # functions_avala.php is required for all lead forms...
include('functions_avala.php');

// fix missing EDIT admin bar links for Tubs and Collections!!
add_action( 'wp_before_admin_bar_render', 'jht_adminbar_fx');
function jht_adminbar_fx() {
	global $wp_admin_bar;
	global $post;
	if ( !is_admin() ) {
		if ( current_user_can('edit_posts') ) {
			if ( is_singular( 'jht_cat' ) ) { //$post->post_type == 'jht_cat' ) {
				$wp_admin_bar->add_menu( array('id'=>'edit', 'title' => __('Edit Collection'), 'href'=>admin_url('post.php?post='. $post->ID .'&action=edit')));
			}
			if ( is_singular( 'jht_tub' ) ) { //$post->post_type == 'jht_tub' ) {
				$wp_admin_bar->add_menu( array('id'=>'edit', 'title' => __('Edit Hot Tub'), 'href'=>admin_url('post.php?post='. $post->ID .'&action=edit')));
			}
		}
	}
}


function jht_create_squeeze_page() {
	if ( is_page() ) {
		global $post;
		$is_squeeze_page = get_post_meta( $post->ID, 'squeeze_page', true );
		if ( strtolower($is_squeeze_page) == 'true' ) {
			?>
			<script type="text/javascript">
				( function( $ ) {
					$('.topMenu').addClass('hideme');
					$('.primaryMenu').addClass('hideme');
					$('.silverMenu').addClass('hideme');
					$('.silverMenu + .threeCol').addClass('hideme');
				} )( jQuery );
			</script>
			<?php
		}
	}
}
add_action( 'wp_footer', 'jht_create_squeeze_page');

function sms_dealer_email() {
	if ( isset($_POST['emailTo']) ) {
		$mailTo = $_POST['emailTo'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		$mailFrom = 'Jacuzzi Hot Tubs <noreply@jacuzzihottubs.com>';
		wp_mail($mailTo, $subject, $message, "From: ".$mailFrom);
	}
}
add_action('wp_ajax_sms_dealer_email', 'sms_dealer_email');
add_action('wp_ajax_nopriv_sms_dealer_email', 'sms_dealer_email');

function jht_uniqueslug_override( $slug, $post_ID, $post_status, $post_type, $post_parent, $original_slug ) {
	if ( in_array($post_type, array('jht_cat', 'jht_tub') ) ) {
		$slug = $original_slug;
	}
	return $slug;
}
add_filter( 'wp_unique_post_slug', 'jht_uniqueslug_override', 10, 6 );

function jht_hottublandingurl() {
	$ht = get_bloginfo('url') .'/hot-tubs/';
	$ht = apply_filters('hottublandingurl', $ht);
	return $ht;
}

function jht_get_collectionslandingid( $us = true ) {
	$id = 8;
	global $polylang;
	if ( !empty($polylang) ) {
		if ( is_object($polylang) ) {
			$sname = $_SERVER['SERVER_NAME'];
			if ( strpos( $sname, 'staging.jacuzzihottubs' ) === false ) {
				// on live or beta or local or whatever
				if ( $us == false ) {
					$id = 8988;
				}
			} else {
				// i guess i switched them, on staging, by accident
				if ( $us ) {
					$id = 8190;
				} /*else {
					$id = 8;
				} */
			}
		}
	}
	return $id;
}

function jht_get_collectionslandingid2() {
	$id = 44;
	if ( defined('JHTCA') ) {
		$id = 9005;
	}
	return $id;
}

function jht_getregion() {
	if ( in_array( $_SERVER['SERVER_NAME'], array( 'www.jacuzzi.ca','beta.jacuzzi.ca' ) ) ) {
		return 'ca';
	}
	return 'us';
}
function jht_isca() {
	$r = jht_getregion();
	if ( $r === 'ca' )
		return true;
	return false;
}
function jht_rooturl() {
	$r = ( jht_isca() ) ? 'http://www.jacuzzi.ca/' : 'http://www.jacuzzi.com/';
	return $r;
}

function jht_getslug() {
	if ( is_admin() )
		return;
	global $post;
	$slug = '';
	if ( is_object($post) ) {
		$slug = $post->post_name ;
	} else {
		$slug = get_post( $post )->post_name ;
	}
	return $slug;
}

// is this a blog page? [ bool ]
function jht_is_blog() {
	// if not a post, or if a post within custom taxonomies -> false
	if( ( !is_home() && !is_archive() && !is_singular('post') ) || ( is_category(5) || in_category(5) || is_tax('jht_vid_cat') || is_tax('jht_acc_cat') || is_tax('jht_sales_cat') ) ) { 
		return false;
	}
	// otherwise -> true
	else {
		return true;
	}
}

// Is this a backyard designer page? [ bool ]
function jht_is_backyard() {
	if ( strpos( $_SERVER['REQUEST_URI'], 'backyardDesigner' ) !== false || is_page('bdfooter') ) {
		return true;
	}
	return false;
}

// Is this a single tub page? [ bool ]
function jht_is_tub() {
	global $wp_query;
	if ( $wp_query->query_vars['post_type'] == 'jht_tub' )
		return true;
	return false;
}

// is this a conversion page / form page? [ bool ]
function jht_is_convpage() {
	return false;
}

function jht_is_ppcpage() {
	return false;
}

function jht_my_server() {
	$url = get_bloginfo('url');
	switch ( $url ) {
		case 'http://www.jacuzzi.com/hot-tubs' :
		case 'http://www.jacuzzi.com/hot-tubs/' :
		case 'http://www.jacuzzi.ca/hot-tubs' :
		case 'http://www.jacuzzi.ca/hot-tubs/' :
			return 'live';
			break;
		case 'http://www.nlkdevj.com/hot-tubs' :
		case 'http://www.nlkdevj.com/hot-tubs/' :
			return 'dev';
			break;
		case 'http://localhost/jacuzzi.com/hot-tubs' :
		case 'http://localhost/jacuzzi.com/hot-tubs/' :
		case 'http://localhost.jacuzzi.com/hot-tubs/' :
		case 'http://localhost/jacuzzi.ca/hot-tubs' :
		case 'http://localhost/jacuzzi.ca/hot-tubs/' :
		case 'http://localhost.jacuzzi.ca/hot-tubs/' :
			return 'local';
			break;
	}
	return 'live';
}

// Should we include the main flop navigation? [ bool ]
function jht_incl_navflop() {
	if ( is_page_template('page-brochure.php') ||
			is_page_template('page-buyersguide.php') ||
			is_page_template('page-escape.php') ||
			is_page_template('page-quote.php') ||
			is_page_template('page-tradein.php') ||
			is_page_template('page-twoColForm.php') ) {
		return false;
	}
	return true;
}


function jht_copyright_meta() {
	if ( !jht_is_blog() ) { ?>
		<meta name="copyright" content="Jacuzzi, Inc." />
	<?php }
}
add_action('wp_head', 'jht_copyright_meta');


// Tracking codes enqueued in different file
//include('functions_trackingcodes.php');




// session tracking
function tracker_session() {
	if( session_id() == '' ) {
		session_start();
	}
	$t = time();
	$title = wp_title('', false);
	$url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$lru = strrev( $url );
	if ( strpos($url,'/wp-content/') !== false || $lru[0] !== '/' )
		return false;
	if ( empty( $_SESSION['page_history'] ) ) :
		unset($a);
		$a = array();
		$a[0] = array( '0' => $t, '1' => $t, 'title' => $title, 'url' => $url );
	else :
		$a = $_SESSION['page_history'];
		$i = count($a);
		$j = $i - 1 ;
		$a[$j][1] = $t;
		if ( $a[$j]['url'] != $url )
		{
			$a[$i] = array( '0' => $t, '1' => $t, 'title' => $title, 'url' => $url );
		}
	endif;
	$_SESSION['page_history'] = $a;
}
add_action('template_redirect','tracker_session'); // set the session data 

function getUrl() {
	$url = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] : 'https://'.$_SERVER["SERVER_NAME"];
	$url .= $_SERVER["REQUEST_URI"];
	return $url;
}
// return website tracking results from session data
function ws_track( $result_type = 'time_on_site' ) {
	if ( $_SESSION['page_history'] ) 
	{
		$a = $_SESSION['page_history'];
		$i = count($a);
		$j = $i - 1;
		if ($result_type == 'time_on_site') 
		{
			$time_on_site = time() - $a[0][0];
			return $time_on_site;
		}
		if ($result_type == 'page_count') { return $j; }
		if ($result_type == 'array') { return $a; }
		if ($result_type == 'enter_time') { return $a[0][0]; }
		if ($result_type == 'exit_time') { return $a[$j][1]; }
		if ($result_type == 'pages_viewed') {
			$output = '<ul>';
			$z = array_slice( $a, -6 );
			foreach ( $z as $b ) 
			{
				$output .= '<li><a href="' . $b['url'] . '" target="_blank">' . $b['title'] . '</a></li>';
			}
			$output .= '</ul>';
			return $output;
		}
	}
	return false;
}
// Time on site tracking
function time_on_site() {
	$t = 0;
	if ( !function_exists('ws_track') ) {
		return $t;
	}
	if ( ws_track('enter_time') > 0 && ws_track('enter_time') < time() ) {
		$total_time_in_seconds = ( time() - ws_track('enter_time') );
		$h = floor( $total_time_in_seconds / (60 * 60) );
		$m = floor( ( $total_time_in_seconds - ( $h * 60 * 60 ) ) / 60 );
		$s = floor( ( $total_time_in_seconds - ( ( $h * 60 * 60 ) + ( $m * 60 ) ) ) );
		$t = $h . ":" . str_pad($m, 2, "0", STR_PAD_LEFT) . ":" . str_pad($s, 2, "0", STR_PAD_LEFT);
	}
	return $t;
}
// get keywords from referrer
function get_search_keywords( $url = '' ) {
	// Get the referrer
	$referrer = (!empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : '';
	$referrer = (!empty($url)) ? $url : $referrer;
	if (empty($referrer))
		return false;
	// Parse the referrer URL
	$parsed_url = parse_url($referrer);
	if (empty($parsed_url['host']))
		return false;
	$host = $parsed_url['host'];
	$query_str = (!empty($parsed_url['query'])) ? $parsed_url['query'] : '';
	$query_str = (empty($query_str) && !empty($parsed_url['fragment'])) ? $parsed_url['fragment'] : $query_str;
	if (empty($query_str))
		return false;
	// Parse the query string into a query array
	parse_str($query_str, $query);
	// Check some major search engines to get the correct query var
	$search_engines = array(
		'q' => 'alltheweb|aol|ask|ask|bing|google',
		'p' => 'yahoo',
		'wd' => 'baidu'
	);
	foreach ($search_engines as $query_var => $se)
	{
		$se = trim($se);
		preg_match('/(' . $se . ')\./', $host, $matches);
		if (!empty($matches[1]) && !empty($query[$query_var]))
			return $query[$query_var];
	}
	return false;
}

// returns formatted phone number
function format_phone_us( $phone = '', $format='standard', $convert = true, $trim = true ) {
	if ( empty( $phone ) ) {
		return false;
	}
	// Strip out non alphanumeric
	$phone = preg_replace( "/[^0-9A-Za-z]/", "", $phone );
	// Keep original phone in case of problems later on but without special characters
	$originalPhone = $phone;
	// If we have a number longer than 11 digits cut the string down to only 11
	// This is also only ran if we want to limit only to 11 characters
	if ( $trim == true && strlen( $phone ) > 11 ) {
		$phone = substr( $phone, 0, 11 );
	}
	// letters to their number equivalent
	if ( $convert == true && !is_numeric( $phone ) ) {
		$replace = array(
			'2'=>array('a','b','c'),
			'3'=>array('d','e','f'),
			'4'=>array('g','h','i'),
			'5'=>array('j','k','l'),
			'6'=>array('m','n','o'),
			'7'=>array('p','q','r','s'),
			'8'=>array('t','u','v'),
			'9'=>array('w','x','y','z'),
			);
		foreach ( $replace as $digit => $letters ) {
			$phone = str_ireplace( $letters, $digit, $phone );
		}
	}
	$a = $b = $c = $d = null;
	switch ( $format ) {
		case 'standard':
			$a = '(';
			$b = ') ';
			$c = '-';
			$d = '(';
			break;
		case 'decimal':
			$a = '';
			$b = '.';
			$c = '.';
			$d = '.';
			break;
		case 'period':
			$a = '';
			$b = '.';
			$c = '.';
			$d = '.';
			break;
		case 'hypen':
			$a = '';
			$b = '-';
			$c = '-';
			$d = '-';
			break;
		case 'dash':
			$a = '';
			$b = '-';
			$c = '-';
			$d = '-';
			break;
		case 'space':
			$a = '';
			$b = ' ';
			$c = ' ';
			$d = ' ';
			break;
		default:
			$a = '(';
			$b = ') ';
			$c = '-';
			$d = '(';
			break;
	}
	$length = strlen( $phone );
	// Perform phone number formatting here
	switch ( $length ) {
		case 7:
			// Format: xxx-xxxx / xxx.xxxx / xxx-xxxx / xxx xxxx
			return preg_replace( "/([0-9a-zA-Z]{3})([0-9a-zA-Z]{4})/", "$1$c$2", $phone );
		case 10:
			// Format: (xxx) xxx-xxxx / xxx.xxx.xxxx / xxx-xxx-xxxx / xxx xxx xxxx
			return preg_replace( "/([0-9a-zA-Z]{3})([0-9a-zA-Z]{3})([0-9a-zA-Z]{4})/", "$a$1$b$2$c$3", $phone );
		case 11:
			// Format: x(xxx) xxx-xxxx / x.xxx.xxx.xxxx / x-xxx-xxx-xxxx / x xxx xxx xxxx
			return preg_replace( "/([0-9a-zA-Z]{1})([0-9a-zA-Z]{3})([0-9a-zA-Z]{3})([0-9a-zA-Z]{4})/", "$1$d$2$b$3$c$4", $phone );
		default:
			// Return original phone if not 7, 10 or 11 digits long
			return $originalPhone;
	}
}

// GEO FUNCTIONS
function geo_data( $zip = null, $debug = false ) {
	// do nothing if viewing admin pages (geo not needed)
	if ( is_admin() )
		return false;
	/*if( session_id() == '' ) {
		session_start();
	}*/

	$a = null;

	$ip = get_the_ip();

	$zip = ( isset( $_POST['PostalCode'] ) ) ? $_POST['PostalCode'] : ( isset( $_GET['zip'] ) ) ? $_GET['zip'] : $zip;

	if ( !empty( $zip ) ) :
		$a = geo_data_mysql_zip( $zip );
		//$_SESSION['geoDbLookupData'] = ( !empty($a) && is_array($a) ) ? $a : null;
	elseif ( $ip ) :
		$a = geo_data_mysql_ip( $ip );
	//elseif ( isset($_SESSION['geoDbLookupData']) ) :
		//$a = $_SESSION['geoDbLookupData'];
	else : 
		$a = array(
			'locId'				=>	0,
			'country'			=>	'US',
			'region'			=>	'',
			'city'				=>	'',
			'postalCode'		=>	'00000',
			'latitude'			=>	'',
			'longitude'			=>	'',
			'metroCode'			=>	'',
			'areacode'			=>	'',
			'ip'				=>	'',
			);
	endif;

	// And finally we return the resulting array to wherever it is needed...
	return $a;
}

function geo_data_curl( $ip ) { /*
	// no longer using curl option / API
	return false;

	if ( !$ip ) {
		$ip = 'me';
	}
	$username = '66659';
	$password = 'FJv62Mz6ezIB';

	$ch = curl_init('https://geoip.maxmind.com/geoip/v2.0/city/' . $ip . '');
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	$httpResult = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	$a = json_decode($result, true);
	$b = array(
		'locId'				=>	0,
		'country'			=>	$a['country']['iso_code'],
		'region'			=>	$a['subdivisions'][0]['iso_code'],
		'city'				=>	$a['city']['names']['en'],
		'postalCode'		=>	$a['postal']['code'],
		'latitude'			=>	$a['location']['latitude'],
		'longitude'			=>	$a['location']['longitude'],
		'metroCode'			=>	$a['location']['metro_code'],
		'areacode'			=>	'',
		'ip'				=>	$ip,
		'queries_remaining'	=>	$a['maxmind']['queries_remaining'],
		);
	if ( $httpResult == 200 ) {
		return $b;
	}
	return $result; */
	return false;
}

function geo_data_mysql_connect() {
	//$livehost		= array( 'jacuzzi.com', 'www.jacuzzi.com', 'www.jacuzzihottubs.com', 'www.jacuzzi.ca/hot-tubs', 'beta.jacuzzihottubs.com', 'www.jacuzzi.ca', 'beta.jacuzzi.com', 'beta.jacuzzi.ca' );
	$devhost		= array( 'jht.ninthlink.me' );
	$localhost		= array( 'localhost', 'local.jht', 'localhost/jacuzzi.com', 'localhost.jacuzzi.com', 'localhost.jacuzzi.ca', 'local.jacuzzi' );
	
	//if ( in_array( $_SERVER['SERVER_NAME'], $livehost ) ) {
	// set up "live" credentials by default
	$the_user = "jacuzzi_geoip";
	$the_pass = "g9WpMRjuPf";
	$the_name = "jacuzzi_geoip";
	//}
	if ( in_array( $_SERVER['SERVER_NAME'], $devhost ) ) {
		$the_user = "admin_geoip";
		$the_pass = "r4e3w2q1";
		$the_name = "admin_geoip";
	}
	if ( in_array( $_SERVER['SERVER_NAME'], $localhost ) ) {
		$the_user = "root";
		$the_pass = "";
		$the_name = "nlk_geoip";
	}
	$mysqli = new mysqli(DB_HOST, $the_user, $the_pass, $the_name);
	
	return $mysqli;
}

function geo_data_mysql_ip( $ip ) {
	$a = false;

	$mysqli = geo_data_mysql_connect();

	// Unable to MySQL? Return false
	if ($mysqli->connect_errno) {
		$error = "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		return false;
	}
	$query = "SELECT gl.* FROM geoip_locations gl LEFT JOIN geoip_blocks gb ON gb.locId = gl.locId WHERE gb.startIpNum <= INET_ATON( ? ) AND gb.endIpNum >= INET_ATON( ? ) LIMIT 1";
	if ( $stmt = $mysqli->prepare( $query ) ) {
		$stmt->bind_param( "ss", $ip, $ip );
		$stmt->execute();
		$stmt->bind_result( $locId, $country, $region, $city, $postalCode, $latitude, $longitude, $metroCode, $areaCode );
		while ( $stmt->fetch() ) {
			$a = array(
				'locId'			=>	$locId,
				'country'		=>	$country,
				'region'		=>	$region,
				'city'			=>	$city,
				'postalCode'	=>	$postalCode,
				'latitude'		=>	$latitude,
				'longitude'		=>	$longitude,
				'metroCode'		=>	$metroCode,
				'areacode'		=>	$areaCode,
				'ip'			=>	$ip,
				);
		}
		$stmt->close();
	}
	$mysqli->close();
	return $a;
}

function geo_data_mysql_zip( $zip ) {
	$a = false;
	$mysqli = geo_data_mysql_connect();
	
	// Unable to MySQL? Return false
	if ($mysqli->connect_errno) {
		$error = "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		return false;
	}
	$clean_zip = clean_zip( $zip );
	$query = "SELECT * FROM geoip_locations WHERE postalCode = ? LIMIT 1";
	if ( $stmt = $mysqli->prepare( $query ) ) {
		$stmt->bind_param( "s", $clean_zip );
		$stmt->execute();
		$stmt->bind_result( $locId, $country, $region, $city, $postalCode, $latitude, $longitude, $metroCode, $areaCode );
		while ( $stmt->fetch() ) {
			$a = array(
				'locId'			=>	$locId,
				'country'		=>	$country,
				'region'		=>	$region,
				'city'			=>	$city,
				'postalCode'	=>	$zip,
				'latitude'		=>	$latitude,
				'longitude'		=>	$longitude,
				'metroCode'		=>	$metroCode,
				'areacode'		=>	$areaCode,
				'ip'			=>	get_the_ip(),
				);
		}
		$stmt->close();
	}
	$mysqli->close();
	return $a;
}

function getRemoteIPAddress() {

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) :
        return $_SERVER['HTTP_CLIENT_IP'];
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) :
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    endif;

    return $_SERVER['REMOTE_ADDR'];
}
function get_the_ip() {

	if ( isset($_GET['ip']) ) :
		$ip = $_GET['ip'];
	elseif ( !empty($_SERVER['HTTP_CLIENT_IP']) ) :
        $ip = $_SERVER['HTTP_CLIENT_IP'];
	elseif ( !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) :
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else :
    	$ip = $_SERVER['REMOTE_ADDR'];
    endif;
	if ( !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE) || !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE) || $ip == '127.0.0.1' ) {
		return false;
	}
	return $ip;
}

function clean_zip( $zip ) {

	$zip = strtoupper( preg_replace( "/\s/", '', $zip ) );
	$valid_country = false;

	$reg	=	array(
		"US"	=>	"^\d{5}([\-]?\d{4})?$",
		"CA"	=>	"^([ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ])\ {0,1}(\d[ABCEGHJKLMNPRSTVWXYZ]\d)$",
		"UK"	=>	"^(GIR|[A-Z]\d[A-Z\d]??|[A-Z]{2}\d[A-Z\d]??)[ ]??(\d[A-Z]{2})$",
		"DE"	=>	"\b((?:0[1-46-9]\d{3})|(?:[1-357-9]\d{4})|(?:[4][0-24-9]\d{3})|(?:[6][013-9]\d{3}))\b",
		"FR"	=>	"^(F-)?((2[A|B])|[0-9]{2})[0-9]{3}$",
		"IT"	=>	"^(V-|I-)?[0-9]{5}$",
		"AU"	=>	"^(0[289][0-9]{2})|([1345689][0-9]{3})|(2[0-8][0-9]{2})|(290[0-9])|(291[0-4])|(7[0-4][0-9]{2})|(7[8-9][0-9]{2})$",
		"NL"	=>	"^[1-9][0-9]{3}\s?([a-zA-Z]{2})?$",
		"ES"	=>	"^([1-9]{2}|[0-9][1-9]|[1-9][0-9])[0-9]{3}$",
		"DK"	=>	"^([D-d][K-k])?( |-)?[1-9]{1}[0-9]{3}$",
		"SE"	=>	"^(s-|S-){0,1}[0-9]{3}\s?[0-9]{2}$",
		"BE"	=>	"^[1-9]{1}[0-9]{3}$"
	);

	// Check if we can validate the zip against one of the above countries
	foreach ( $reg as $k => $v ) {
		if ( preg_match( "/" . $v . "/i", $zip ) ) {
			$valid_country = $k;
			break;
		}
	}
	// For US or CA, clean the zip for geo search
	if ( $valid_country == 'US' ) :
		list($clean_zip) = explode('-', $zip);
	elseif ( $valid_country == 'CA' ) :
		$clean_zip = substr( $zip, 0, 3 );
	else :
		$clean_zip = $zip;
	endif;

	$clean_zip = strtolower( $clean_zip );

	return $clean_zip;
}
function zip_to_geo( $original_zip ) {
	$a = false;

	$zip = clean_zip( $original_zip );

	if ( $zip[1] !== false ) {
		$mysqli = geo_data_mysql_connect();

		if ($mysqli->connect_errno) {

			$error = "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;

			return false;
		}

		$query = "SELECT * FROM geoip_locations WHERE postalCode = ? LIMIT 1";

		if ( $stmt = $mysqli->prepare( $query ) ) {

			$stmt->bind_param( "s", $zip );

			$stmt->execute();

			$stmt->bind_result( $locId, $country, $region, $city, $postalCode, $latitude, $longitude, $metroCode, $areaCode );

			while ( $stmt->fetch() ) {

				$a = array(

					'locId'			=>	$locId,
					'country'		=>	$country,
					'region'		=>	$region,
					'city'			=>	$city,
					'postalCode'	=>	$original_zip,
					'latitude'		=>	$latitude,
					'longitude'		=>	$longitude,
					'metroCode'		=>	$metroCode,
					'areacode'		=>	$areaCode,
					'ip'			=>	get_the_ip(),

					);

			}

			$stmt->close();

		}

		$mysqli->close();

	}

	return $a;
}





function catch_warranty_details_h4( $string ) {
	if( is_admin() ) return;
	preg_match("'<h4>(.*?)</h4>'si", $string, $match);
	if($match) {
		return $match[1];
	}
	// else
	return $string;
}


/** GOOGLE TAG MANAGER AND SCRIPTS **/

// Google Tag Manager Main
add_action('do_google_tag_manager', 'google_tag_manager_container');
function google_tag_manager_container() {
	$str = <<<GTM
	<!-- Google Tag Manager -->
	<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MPVB5L"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-MPVB5L');</script>
	<!-- End Google Tag Manager -->
GTM;
	echo $str;
}
function google_tag_manager() {
	do_action('do_google_tag_manager');
}
	// Custom data layer
	add_action('do_custom_data_layer', 'custom_data_layer_container');
	function custom_data_layer_container() {
		global $post;

		$str = '<script>dataLayer = [{';
		$str .= '\'customerId\': \'' . get_current_user_id() . '\',';

		if(isset($_COOKIE['jhtsession']))
			$str .= '\'interestedInOwning\': \'' . $_COOKIE['jhtsession'] . '\',';

		// add custom data layer vars here...
		
		$str .= '}];</script>';

		echo $str;
	}
	function custom_data_layer() {
		do_action('do_custom_data_layer');
	}

/** END GOOGLE **/



function form_submit_button($button,$form){
    return '<input type="submit" class="btn submit bigGoldBtn" id="gform_submit_button_' . $form['id'] . '" value="' . $form['button']['text'] . '">';
}
add_filter('gform_submit_button','form_submit_button',10,12);




/** BV : BazaarVoice Integrations **/

	// load SDK
	require('includes/bvseosdk.php');

	// Enqueue BV scripts
	if ( ! function_exists('bazaar_voice_scripts') ) {
		function bazaar_voice_scripts() {
			// load bvpai.js
			if ( is_page('reviews') ) {
				if ( jht_my_server() != 'live' ) {
					wp_enqueue_script( 'bvapi-js', '//display-stg.ugc.bazaarvoice.com/static/jacuzzi/ReadOnly/en_US/bvapi.js', array(), '1.0', false);
				}
				else {
					wp_enqueue_script( 'bvapi-js', '//display.ugc.bazaarvoice.com/static/jacuzzi/ReadOnly/en_US/bvapi.js', array(), '1.0', false);
				}
			}
			else {
				if ( jht_my_server() != 'live' ) {
					wp_enqueue_script( 'bvapi-js', '//display-stg.ugc.bazaarvoice.com/static/jacuzzi/en_US/bvapi.js', array(), '1.0', false); //staging
				}
				else {
					wp_enqueue_script( 'bvapi-js', '//display.ugc.bazaarvoice.com/static/jacuzzi/en_US/bvapi.js', array(), '1.0', false); //production
				}
			}
		}
		add_action( 'wp_enqueue_scripts', 'bazaar_voice_scripts' );
	}

	// Remove Canonical Link Added By Yoast WordPress SEO Plugin if URL has query string (this is for BV SEO Pagination)
	function remove_yoast_canonical_link() {
		return false;
	}
	if ( $_GET )
		add_filter( 'wpseo_canonical', 'remove_yoast_canonical_link' );

	function pixel_bazaarinvoice() {

		global $post;
		$custom = get_post_meta($post->ID,'jht_specs');
		$jht_specs = $custom[0];
		$prod = esc_attr($jht_specs['product_id']);
		$val = get_post_meta( $post->ID, 'lead-type', true );

		if ( !empty( $prod ) ) { ?>
			<script type="text/javascript"> 
			$BV.configure("global", { productId : "<?php echo $prod; ?>" });
			</script>
		<?php }
		
		if ( !empty( $val ) ) { ?>
			<script>
			$BV.SI.trackConversion({
			"type" : "lead-<?php echo $val; ?>",
			"value" : "<?php echo $val; ?>"
			});
			</script>
		<?php }
	}

	add_action('wp_head', 'pixel_bazaarinvoice');

/** END BazaarVoice **/


/** Site Catalyst **/
function pixel_site_catalyst() { 
  if(!is_page_template('page-dlresults.php') || strpos($_SERVER['URI'], 'dealer-locator') !== false) {
		if ( !defined('JHTMOBPX') ) {
			?>
		<!-- SiteCatalyst code version: H.10.
		Copyright 1997-2007 Omniture, Inc. More info available at
		http://www.omniture.com -->
		<script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/SiteCatalyst.js"></script>
		<script type="text/javascript"><!--
		/* You may give each page an identifying name, server, and channel on
		the next lines. sidebar-trackingcode loaded. */
		s.pageName=""
		s.server=""
		s.channel=""
		s.pageType=""
		s.prop1=""
		s.prop2=""
		s.prop3=""
		s.prop4=""
		s.prop5=""
		s.referrer=""
		/* Conversion Variables */
		s.campaign=""
		s.state=""
		s.zip=""
		s.events="<?php
			if ( is_page(4422) ) { // brochure-thanks
				print 'event2';
			} elseif( is_page(4513) ) { // quote-thanks
				print 'event4';
			} elseif( is_page(6782) ) { // truckload-thanks 
				print 'event9';
			} elseif( is_page(6329) ) { // appointment-thanks 
				print 'event10';
			} elseif( is_page_template('page-dlresults.php') ) { // delaer result
				print 'event7';
			} elseif( is_page_template('page-dllanding.php') ) { // delaer landing
				print '';
			} elseif( is_page('thank-you') ) { // deals/thank-you/
				print 'event3';
			}
			?>"
		s.products=""
		s.purchaseID=""
		s.eVar1=""
		s.eVar2=""
		s.eVar3=""
		s.eVar4=""
		s.eVar5=""
		/************* DO NOT ALTER ANYTHING BELOW THIS LINE ! **************/
		var s_code=s.t();if(s_code)document.write(s_code)//--></script>
		<script language="JavaScript"><!--
		if(navigator.appVersion.indexOf('MSIE')>=0)document.write(unescape('%3C')+'\!-'+'-')
		//--></script>
		<noscript><?php } ?>
		<a href="http://www.omniture.com" title="Web Analytics"><img src="http://jacuzzipremiumhottubs.jacuzzi.com.112.2O7.net/b/ss/jacuzzipremiumhottubs.jacuzzi.com/1/H.10--NS/0" height="1" width="1" border="0" alt=""/></a>
		<?php if ( !defined('JHTMOBPX') ) { ?></noscript><!--/DO NOT REMOVE/-->
		<!-- End SiteCatalyst code version: H.10. -->
		<?php 
		}
	}
}
add_action('wp_footer', 'pixel_site_catalyst');
// end site catalyst


add_action('wp_head', 'jht_do_hreflang');
function jht_do_hreflang() {
	$url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
	$p = parse_url($url);
	$a = array(
		'/hot-tubs/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/" hreflang="en-us" />',
		'/hot-tubs/3-person-hot-tub/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/3-person-hot-tub/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/3-person-hot-tub/ hreflang="en-us" />',
		'/hot-tubs/6-person-hot-tub/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/6-person-hot-tub/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/6-person-hot-tub/ hreflang="en-us" />',
		'/hot-tubs/accessories/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/ hreflang="en-us" />',
		'/hot-tubs/accessories/aquasound-remote/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/aquasound-remote/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/aquasound-remote/ hreflang="en-us" />',
		'/hot-tubs/accessories/clearray/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/clearray/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/clearray/ hreflang="en-us" />',
		'/hot-tubs/accessories/complements/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/complements/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/complements/ hreflang="en-us" />',
		'/hot-tubs/accessories/cover-caddy/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/cover-caddy/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/cover-caddy/ hreflang="en-us" />',
		'/hot-tubs/accessories/covermate2/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/covermate2/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/covermate2/ hreflang="en-us" />',
		'/hot-tubs/accessories/covermate-freestyle/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/covermate-freestyle/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/covermate-freestyle/ hreflang="en-us" />',
		'/hot-tubs/accessories/covermate-i/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/covermate-i/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/covermate-i/ hreflang="en-us" />',
		'/hot-tubs/accessories/covers-lifts/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/covers-lifts/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/covers-lifts/ hreflang="en-us" />',
		'/hot-tubs/accessories/cover-valet/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/cover-valet/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/cover-valet/ hreflang="en-us" />',
		'/hot-tubs/accessories/first-step-clean-n-fill-prefilter/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/first-step-clean-n-fill-prefilter/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/first-step-clean-n-fill-prefilter/ hreflang="en-us" />',
		'/hot-tubs/accessories/gamespa-vacuum/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/gamespa-vacuum/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/gamespa-vacuum/ hreflang="en-us" />',
		'/hot-tubs/accessories/handi-step/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/handi-step/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/handi-step/ hreflang="en-us" />',
		'/hot-tubs/accessories/jacuzzi-filters/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/jacuzzi-filters/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/jacuzzi-filters/ hreflang="en-us" />',
		'/hot-tubs/accessories/microfiber-prefilter/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/microfiber-prefilter/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/microfiber-prefilter/ hreflang="en-us" />',
		'/hot-tubs/accessories/ozone-systems/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/ozone-systems/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/ozone-systems/ hreflang="en-us" />',
		'/hot-tubs/accessories/proclarity/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/proclarity/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/proclarity/ hreflang="en-us" />',
		'/hot-tubs/accessories/proclear-mineral-sanitizer/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/proclear-mineral-sanitizer/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/proclear-mineral-sanitizer/ hreflang="en-us" />',
		'/hot-tubs/accessories/safe-t-rail/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/safe-t-rail/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/safe-t-rail/ hreflang="en-us" />',
		'/hot-tubs/accessories/smart-cartridge/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/smart-cartridge/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/smart-cartridge/ hreflang="en-us" />',
		'/hot-tubs/accessories/spa-filters/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/spa-filters/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/spa-filters/ hreflang="en-us" />',
		'/hot-tubs/accessories/spa-pad/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/spa-pad/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/spa-pad/ hreflang="en-us" />',
		'/hot-tubs/accessories/water-purification-systems/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/accessories/water-purification-systems/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/accessories/water-purification-systems/ hreflang="en-us" />',
		'/hot-tubs/backyardDesigner/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/backyardDesigner/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/backyardDesigner/ hreflang="en-us" />',
		'/hot-tubs/become-a-dealer/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/become-a-dealer/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/become-a-dealer/ hreflang="en-us" />',
		'/hot-tubs/become-a-dealer/about-jacuzzi-dealers/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/become-a-dealer/about-jacuzzi-dealers/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/become-a-dealer/about-jacuzzi-dealers/ hreflang="en-us" />',
		'/hot-tubs/become-a-dealer/dealer-inquiry-form/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/become-a-dealer/dealer-inquiry-form/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/become-a-dealer/dealer-inquiry-form/ hreflang="en-us" />',
		'/hot-tubs/become-a-dealer/effective-marketing/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/become-a-dealer/effective-marketing/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/become-a-dealer/effective-marketing/ hreflang="en-us" />',
		'/hot-tubs/become-a-dealer/engineering/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/become-a-dealer/engineering/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/become-a-dealer/engineering/ hreflang="en-us" />',
		'/hot-tubs/become-a-dealer/merchandising/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/become-a-dealer/merchandising/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/become-a-dealer/merchandising/ hreflang="en-us" />',
		'/hot-tubs/become-a-dealer/superior-support/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/become-a-dealer/superior-support/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/become-a-dealer/superior-support/ hreflang="en-us" />',
		'/hot-tubs/become-a-dealer/the-jacuzzi-brand/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/become-a-dealer/the-jacuzzi-brand/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/become-a-dealer/the-jacuzzi-brand/ hreflang="en-us" />',
		'/hot-tubs/become-a-dealer/training/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/become-a-dealer/training/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/become-a-dealer/training/ hreflang="en-us" />',
		'/hot-tubs/best-selling-hot-tubs/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/best-selling-hot-tubs/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/best-selling-hot-tubs/ hreflang="en-us" />',
		'/hot-tubs/buyers-guide/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/buyers-guide/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/buyers-guide/ hreflang="en-us" />',
		'/hot-tubs/calgary-hot-tub-dealer/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/calgary-hot-tub-dealer/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/calgary-hot-tub-dealer/ hreflang="en-us" />',
		'/hot-tubs/collections/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/collections/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/collections/ hreflang="en-us" />',
		'/hot-tubs/contact/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/contact/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/contact/ hreflang="en-us" />',
		'/hot-tubs/customer-experience-survey/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/customer-experience-survey/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/customer-experience-survey/ hreflang="en-us" />',
		'/hot-tubs/customer-showcase/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/customer-showcase/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/customer-showcase/ hreflang="en-us" />',
		'/hot-tubs/customer-showcase/10/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/customer-showcase/10/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/customer-showcase/10/ hreflang="en-us" />',
		'/hot-tubs/customer-showcase/11/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/customer-showcase/11/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/customer-showcase/11/ hreflang="en-us" />',
		'/hot-tubs/customer-showcase/12/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/customer-showcase/12/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/customer-showcase/12/ hreflang="en-us" />',
		'/hot-tubs/customer-showcase/6/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/customer-showcase/6/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/customer-showcase/6/ hreflang="en-us" />',
		'/hot-tubs/customer-showcase/7/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/customer-showcase/7/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/customer-showcase/7/ hreflang="en-us" />',
		'/hot-tubs/customer-showcase/8/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/customer-showcase/8/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/customer-showcase/8/ hreflang="en-us" />',
		'/hot-tubs/customer-showcase/9/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/customer-showcase/9/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/customer-showcase/9/ hreflang="en-us" />',
		'/hot-tubs/customer-showcase/submit-your-hot-tub/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/customer-showcase/submit-your-hot-tub/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/customer-showcase/submit-your-hot-tub/ hreflang="en-us" />',
		'/hot-tubs/dealer-locator/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/dealer-locator/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/dealer-locator/ hreflang="en-us" />',
		'/hot-tubs/deals/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/deals/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/deals/ hreflang="en-us" />',
		'/hot-tubs/energy-efficient-hot-tubs/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/energy-efficient-hot-tubs/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/energy-efficient-hot-tubs/ hreflang="en-us" />',
		'/hot-tubs/financing/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/financing/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/financing/ hreflang="en-us" />',
		'/hot-tubs/for-jacuzzi-dealers/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/for-jacuzzi-dealers/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/for-jacuzzi-dealers/ hreflang="en-us" />',
		'/hot-tubs/get-a-quote/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/get-a-quote/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/get-a-quote/ hreflang="en-us" />',
		'/hot-tubs/hydrotherapy/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/hydrotherapy/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/hydrotherapy/ hreflang="en-us" />',
		'/hot-tubs/j-200/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-200/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-200/ hreflang="en-us" />',
		'/hot-tubs/j-200/j-210/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-200/j-210/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-200/j-210/ hreflang="en-us" />',
		'/hot-tubs/j-200/j-235/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-200/j-235/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-200/j-235/ hreflang="en-us" />',
		'/hot-tubs/j-200/j-245/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-200/j-245/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-200/j-245/ hreflang="en-us" />',
		'/hot-tubs/j-200/j-275/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-200/j-275/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-200/j-275/ hreflang="en-us" />',
		'/hot-tubs/j-200/j-280/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-200/j-280/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-200/j-280/ hreflang="en-us" />',
		'/hot-tubs/j-300/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-300/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-300/ hreflang="en-us" />',
		'/hot-tubs/j-300/j-315/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-300/j-315/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-300/j-315/ hreflang="en-us" />',
		'/hot-tubs/j-300/j-325/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-300/j-325/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-300/j-325/ hreflang="en-us" />',
		'/hot-tubs/j-300/j-335/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-300/j-335/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-300/j-335/ hreflang="en-us" />',
		'/hot-tubs/j-300/j-345/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-300/j-345/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-300/j-345/ hreflang="en-us" />',
		'/hot-tubs/j-300/j-355/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-300/j-355/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-300/j-355/ hreflang="en-us" />',
		'/hot-tubs/j-300/j-365/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-300/j-365/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-300/j-365/ hreflang="en-us" />',
		'/hot-tubs/j-300/j-375/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-300/j-375/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-300/j-375/ hreflang="en-us" />',
		'/hot-tubs/j-400/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-400/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-400/ hreflang="en-us" />',
		'/hot-tubs/j-400/j-415/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-400/j-415/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-400/j-415/ hreflang="en-us" />',
		'/hot-tubs/j-400/j-425/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-400/j-425/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-400/j-425/ hreflang="en-us" />',
		'/hot-tubs/j-400/j-465/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-400/j-465/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-400/j-465/ hreflang="en-us" />',
		'/hot-tubs/j-400/j-470/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-400/j-470/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-400/j-470/ hreflang="en-us" />',
		'/hot-tubs/j-400/j-480/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-400/j-480/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-400/j-480/ hreflang="en-us" />',
		'/hot-tubs/j-400/j-495/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-400/j-495/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-400/j-495/ hreflang="en-us" />',
		'/hot-tubs/j-lx/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-lx/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-lx/ hreflang="en-us" />',
		'/hot-tubs/owners-corner/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/owners-corner/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/owners-corner/ hreflang="en-us" />',
		'/hot-tubs/promo/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/promo/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/promo/ hreflang="en-us" />',
		'/hot-tubs/request-brochure/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/request-brochure/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/request-brochure/ hreflang="en-us" />',
		'/hot-tubs/trade-in-value/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/trade-in-value/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/trade-in-value/ hreflang="en-us" />',
		'/hot-tubs/truckload/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/truckload/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/truckload/ hreflang="en-us" />',
		'/hot-tubs/video-gallery/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/video-gallery/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/video-gallery/ hreflang="en-us" />',
		'/hot-tubs/warranty-options/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/warranty-options/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/warranty-options/ hreflang="en-us" />',
		'/hot-tubs/warranty-registration/' => '<link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/warranty-registration/" hreflang="en-ca" /><link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/warranty-registration/ hreflang="en-us" />',
		'/hot-tubs/4-person-hot-tubs/' => '<link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/4-person-hot-tubs/" hreflang="en-us" /><link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/4-person-hot-tubs/" hreflang="en-ca" />',
		'/hot-tubs/5-person-hot-tubs/' => '<link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/5-person-hot-tubs/" hreflang="en-us" /><link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/5-person-hot-tubs/" hreflang="en-ca" />',
		'/hot-tubs/request-brochure/download-manuals/' => '<link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/request-brochure/download-manuals/" hreflang="en-us" /><link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/request-brochure/download-manuals/" hreflang="en-ca" />',
		'/hot-tubs/j-300/j-385/' => '<link rel="alternate" href="http://www.jacuzzi.com/hot-tubs/j-300/j-385/" hreflang="en-us" /><link rel="alternate" href="http://www.jacuzzi.ca/hot-tubs/j-300/j-385/" hreflang="en-ca" />',
		);
	if ( array_key_exists($p['path'], $a) )
		print $a[ $p['path'] ];
}

// For Template Dropdown on jht_cat post type

# Define your custom post type string
define('JHT_CAT_POST_TYPE', 'jht_cat');

/**
 * Register the meta box
 */
add_action('add_meta_boxes', 'page_templates_dropdown_metabox');
function page_templates_dropdown_metabox(){
    add_meta_box(
        JHT_CAT_POST_TYPE.'-page-template',
        __('Template', 'rainbow'),
        'render_page_template_dropdown_metabox',
        JHT_CAT_POST_TYPE,
        'side', #I prefer placement under the post actions meta box
        'low'
    );
}

/**
 * Render your metabox - This code is similar to what is rendered on the page post type
 * @return void
 */
function render_page_template_dropdown_metabox(){
    global $post;
    $template = get_post_meta($post->ID, '_wp_page_template', true);
    echo "
        <label class='screen-reader-text' for='page_template'>Page Template</label>
            <select name='_wp_page_template' id='page_template'>
            <option value='default'>Default Template</option>";
            page_template_dropdown($template);
    echo "</select>";
}

/**
 * Save the page template
 * @return void
 */
function save_page_template($post_id){

    # Skip the auto saves
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
    elseif ( defined( 'DOING_AJAX' ) && DOING_AJAX )
        return;
    elseif ( defined( 'DOING_CRON' ) && DOING_CRON )
        return;

    # Only update the page template meta if we are on our specific post type
    elseif(JHT_CAT_POST_TYPE === $_POST['post_type'])
        update_post_meta($post_id, '_wp_page_template', esc_attr($_POST['_wp_page_template']));
}
add_action('save_post', 'save_page_template');


/**
 * Set the page template
 * @param string $template The determined template from the WordPress brain
 * @return string $template Full path to predefined or custom page template
 */
function set_page_template($template){
    global $post;
    if(JHT_CAT_POST_TYPE === $post->post_type){
        $custom_template = get_post_meta($post->ID, '_wp_page_template', true);
        if($custom_template)
            #since our dropdown only gives the basename, use the locate_template() function to easily find the full path
            return locate_template($custom_template);
    }
    return $template;
}
add_filter('single_template', 'set_page_template');

