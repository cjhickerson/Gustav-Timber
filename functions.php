<?php

class Gustav extends TimberSite {

    function __construct(){
        add_theme_support('post-formats');
        add_theme_support('post-thumbnails');
        add_theme_support('menus');
        add_filter('timber_context', array($this, 'add_to_context'));
        add_filter('get_twig', array($this, 'add_to_twig'));
        add_action('init', array($this, 'register_post_types'));
        add_action('init', array($this, 'register_taxonomies'));
        add_action('wp_enqueue_scripts', array($this, 'register_stylesheets'));
        add_action('wp_enqueue_scripts', array($this, 'register_scripts'));
		add_image_size('medium', 360, 0, false);
        parent::__construct();
    }

    function register_post_types(){
        //this is where you can register custom post types
    }

    function register_taxonomies(){
        //this is where you can register custom taxonomies
    }

	function register_stylesheets(){
		wp_enqueue_style('theme_styles', get_template_directory_uri().'/css/theme.min.css');
	}

	function register_scripts(){
		wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/theme.min.js', 'jquery');
	}

    function add_to_context($context){
        $context['headerMenu'] = new TimberMenu('header-menu');
        $context['footerMenu'] = new TimberMenu('footer-menu');

        $context['site'] = $this;

		$context['home'] = (is_home()) ? true : false;

		$context['custom_header'] = get_custom_header();
		$context['settings'] = array (
			'sidebar_position' => get_theme_mod('sidebar_position'),
			'aside_thumbnail_position' => get_theme_mod('aside_thumbnail_position'),
			'tease_width' => get_theme_mod('tease_width'),
		);
        return $context;
    }

    function add_to_twig($twig){
        /* this is where you can add your own fuctions to twig */
        $twig->addExtension(new Twig_Extension_StringLoader());

		$function = new Twig_SimpleFunction('get_post_format', function($id) {
			return get_post_format($id);
		});
		$twig->addFunction($function);

		$get_theme_mod = new Twig_SimpleFunction('get_theme_mod', function($id) {
			return get_theme_mod($id);
		});
		$twig->addFunction($get_theme_mod);

        $gustav_comment_form = new Twig_SimpleFunction('gustav_comment_form', function($id) {
            $args = array(
                'comment_field' => '<div class="form-group"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" class="form-control" name="comment" aria-required="true"></textarea></p>',
                'class_submit' => 'btn btn-default',
                'title_reply' => null
            );

            ob_start();
            comment_form($args, $id);
            $output = ob_get_contents();
            ob_end_clean();

            return $output;
        });
        $twig->addFunction($gustav_comment_form);

        return $twig;
    }

}
Timber::$dirname = 'templates';
new Gustav();

require_once('theme_settings.php');
