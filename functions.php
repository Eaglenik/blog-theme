<?php
/**
 * my-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package my-theme
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
function my_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on my-theme, use a find and replace
		* to change 'my-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'my-theme', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		[
			'header-menu' => 'Главное меню',
			'footer-menu' => 'Меню в подвале',
			'social-menu' => 'Меню соц сетей',
		]
	);

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
			'my_theme_custom_background_args',
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
add_action( 'after_setup_theme', 'my_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function my_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'my_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'my_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function my_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => 'sidebar right',
			'id'            => 'sidebar-1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);
	register_sidebar(
		array(
			'name'          => 'slogan',
			'id'            => 'slogan',
			'before_widget' => '<div id="%1$s" class="ten columns centered text-center widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h1>',
			'after_title'   => '</h1>',
		)
	);
}
add_action( 'widgets_init', 'my_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function my_theme_scripts() {
	wp_enqueue_style( 'my-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'my-theme-style', 'rtl', 'replace' );
	wp_enqueue_script( 'my-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	
	// my-styles
	wp_enqueue_style('default',get_template_directory_uri().'/assets/css/default.css');
	wp_enqueue_style('layout',get_template_directory_uri().'/assets/css/layout.css');
	wp_enqueue_style('media',get_template_directory_uri().'/assets/css/media-queries.css');
	// my-scripts
	wp_deregister_script('jquery');
	wp_register_script('my-jquery',get_template_directory_uri().'/assets/js/jquery-1.10.2.min.js');
	wp_enqueue_script('my-jquery');
	
	wp_enqueue_script('flexslider',get_template_directory_uri().'/assets/js/jquery.flexslider.js');
	wp_enqueue_script('doubletaptogo',get_template_directory_uri().'/assets/js/doubletaptogo.js');
	wp_enqueue_script('init',get_template_directory_uri().'/assets/js/init.js');
	wp_enqueue_script('modernizr',get_template_directory_uri().'/assets/js/modernizr.js');
	
	
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'my_theme_scripts' );

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

// настройка краткого описания
add_filter( 'excerpt_more', 'new_excerpt_more' );
function new_excerpt_more( $more ){
	global $post;
	return '<a class="more-link" href="'. get_permalink($post) . '">Read More<i class="fa fa-arrow-circle-o-right"></i></a>';
}
add_filter( 'excerpt_length', function(){
	return 32;
} );

// удаляет H2 из шаблона пагинации
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
	return '
	<nav class="col full pagination navigation %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>
	';
}
// регистрация нового типа записи
add_action( 'init', 'register_post_types' );
function register_post_types(){
	register_post_type( 'slider', [
		'label'  => null,
		'labels' => [
			'name'               => 'Слайдер', // основное название для типа записи
			'singular_name'      => 'Слайдер', // название для одной записи этого типа
			'add_new'            => 'Добавить новый', // для добавления новой записи
			'add_new_item'       => 'Добавление слайда', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование слайда', // для редактирования типа записи
			'new_item'           => 'Новый слайд', // текст новой записи
			'view_item'          => 'Смотреть слайд', // для просмотра записи этого типа.
			'search_items'       => 'Искать слайд', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Слайдер', // название меню
		],
		'description'         => '',
		'public'              => true,
		// 'publicly_queryable'  => null, // зависит от public
		// 'exclude_from_search' => null, // зависит от public
		// 'show_ui'             => null, // зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'        => null, // показывать ли в меню адмнки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => 4,
		'menu_icon'           => 'dashicons-format-gallery',
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'thumbnail' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	] );
	register_post_type( 'info', [
		'label'  => null,
		'labels' => [
			'name'               => 'Информация', // основное название для типа записи
			'singular_name'      => 'запись', // название для одной записи этого типа
			'add_new'            => 'Добавить новую', // для добавления новой записи
			'add_new_item'       => 'Добавление записи', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование записи', // для редактирования типа записи
			'new_item'           => 'Новый текст', // текст новой записи
			'view_item'          => 'Смотреть запись', // для просмотра записи этого типа.
			'search_items'       => 'Искать запись', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Информация', // название меню
		],
		'description'         => '',
		'public'              => true,
		// 'publicly_queryable'  => null, // зависит от public
		// 'exclude_from_search' => null, // зависит от public
		// 'show_ui'             => null, // зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'        => null, // показывать ли в меню адмнки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-welcome-write-blog',
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	] );
	register_post_type( 'portfolio', [
		'label'  => null,
		'labels' => [
			'name'               => 'Портфолио', // основное название для типа записи
			'singular_name'      => 'работа', // название для одной записи этого типа
			'add_new'            => 'Добавить новую', // для добавления новой записи
			'add_new_item'       => 'Добавление работу', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование работы', // для редактирования типа записи
			'new_item'           => 'Новый текст', // текст новой записи
			'view_item'          => 'Смотреть работу', // для просмотра записи этого типа.
			'search_items'       => 'Искать работу', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Портфолио', // название меню
		],
		'description'         => '',
		'public'              => true,
		// 'publicly_queryable'  => null, // зависит от public
		// 'exclude_from_search' => null, // зависит от public
		// 'show_ui'             => null, // зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'        => null, // показывать ли в меню адмнки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-portfolio',
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor','thumbnail','excerpt' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	] );
	// список параметров: wp-kama.ru/function/get_taxonomy_labels
	register_taxonomy( 'portfolio-category', [ 'portfolio' ], [
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Категории',
			'singular_name'     => 'Категории',
			'search_items'      => 'Искать категории',
			'all_items'         => 'Все категории',
			'view_item '        => 'Смотреть категорию',
			'parent_item'       => 'Родительская категория',
			'parent_item_colon' => 'Родительская категория:',
			'edit_item'         => 'Редактировать категорию',
			'update_item'       => 'Обновить категорию',
			'add_new_item'      => 'Добавить новую',
			'new_item_name'     => 'Новое имя категории',
			'menu_name'         => 'Категории',
			'back_to_items'     => '← Назад к категориям',
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		// 'publicly_queryable'    => null, // равен аргументу public
		// 'show_in_nav_menus'     => true, // равен аргументу public
		// 'show_ui'               => true, // равен аргументу public
		// 'show_in_menu'          => true, // равен аргументу show_ui
		// 'show_tagcloud'         => true, // равен аргументу show_ui
		// 'show_in_quick_edit'    => null, // равен аргументу show_ui
		'hierarchical'          => true,

		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => 'post_categories_meta_box', // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => null, // добавить в REST API
		'rest_base'             => null, // $taxonomy
		// '_builtin'              => false,
		//'update_count_callback' => '_update_post_term_count',
	] );
}