<?php

// Inclusion des feuilles de style
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

//Ajout des menus
add_action('init', 'ajoutMenus');

//Ajout des classes des sousmenus
add_filter( 'nav_menu_submenu_css_class', 'my_nav_menu_submenu_css_class' );

//Ajout des post types series, films, animes
add_action( 'init', 'create_post_types' );

//Ajout de la taxo genre
add_action( 'init', 'creer_genre_taxo', 0 );

//Limitation du nombre d'articles par page
add_action( 'pre_get_posts', 'limitation_posts_par_page' );

function add_theme_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '1.1', 'all');
}

function ajoutMenus() {
	register_nav_menu( 'primary', 'menu principal');
	register_sidebars( 1, array( 'name' => 'Sidebar numéro 1',
	                             'class'         => 'sidebar',
	                             'before_widget' => '<div class="card">',
	                             'after_widget' => '</div>',
	                             'before_title' => '<h3>',
	                             'after_title' => '</h3>',
	                             'id'            => "sidebar-1",

	));
}

function my_nav_menu_submenu_css_class( $classes ) {
	$classes[] = 'dropdown-menu';
	return $classes;
}



add_theme_support('post-thumbnails');


function create_post_types() {
	register_post_type( 'films',
		array(
			'labels' => array(
				'name' => __( 'Films' ),
				'singular_name' => __( 'Film' )
			),
			'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
			'taxonomies'            => array( 'genre' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 3,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
		)
	);
	register_post_type( 'series',
		array(
			'labels' => array(
				'name' => __( 'Series' ),
				'singular_name' => __( 'Serie' )
			),
			'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
			'taxonomies'            => array( 'genre' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 4,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
		)
	);
	register_post_type( 'animes',
		array(
			'labels' => array(
				'name' => __( 'Animes' ),
				'singular_name' => __( 'Anime' )
			),
			'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
			'taxonomies'            => array( 'genre' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
		)
	);
}

// Register Custom Taxonomy
function creer_genre_taxo() {

	$labels = array(
		'name'                       => _x( 'Genres', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Genre', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Genres', 'text_domain' ),
		'all_items'                  => __( 'Tous les genres', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'Nom du nouveau genre', 'text_domain' ),
		'add_new_item'               => __( 'Ajouter un genre', 'text_domain' ),
		'edit_item'                  => __( 'Editer un genre', 'text_domain' ),
		'update_item'                => __( 'Mettre à jour le genre', 'text_domain' ),
		'view_item'                  => __( 'Voir le genre', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'genre', array( 'films', 'series', 'animes' ), $args );

}

if( !function_exists( 'theme_pagination' ) ) {

	function theme_pagination() {

		global $wp_query, $wp_rewrite;
		$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

		$pagination = array(
			'base' => @add_query_arg('page','%#%'),
			'format' => '',
			'total' => $wp_query->max_num_pages,
			'current' => $current,
			'show_all' => false,
			'end_size'     => 1,
			'mid_size'     => 2,
			'type' => 'list',
			'next_text' => '»',
			'prev_text' => '«'
		);

		if( $wp_rewrite->using_permalinks() )
		$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

		if( !empty($wp_query->query_vars['s']) )
		$pagination['add_args'] = array( 's' => str_replace( ' ' , '+', get_query_var( 's' ) ) );

		echo str_replace('page/1/','', paginate_links( $pagination ) );
	}
}

function limitation_posts_par_page( $query ){
	if ($query->is_archive || $query->is_category || $query->is_search) {
		$query->set('posts_per_page', 6);
	}
	return $query;
}
