<?php 

add_action( 'wp_enqueue_scripts', 'salient_child_enqueue_styles');
function salient_child_enqueue_styles() {
	
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array('font-awesome'));

    if ( is_rtl() ) 
   		wp_enqueue_style(  'salient-rtl',  get_template_directory_uri(). '/rtl.css', array(), '1', 'screen' );
}

function remove_admin_menus() {
	remove_menu_page( 'edit.php?post_type=home_slider' );
	remove_menu_page( 'edit.php?post_type=nectar_slider' );
	remove_menu_page( 'edit-comments.php' );
	remove_menu_page( 'edit.php' );
	remove_menu_page( 'edit.php?post_type=portfolio' );
}
add_action( 'admin_menu', 'remove_admin_menus', 999);


// Retrieve bookable product info 

function getBookableProduct($id){
	if(!class_exists('WC_Product_Booking'))
		return;
	$product = wc_get_product($id);
	return new WC_Product_Booking($product);
}



function city_limit_text($text, $limit=30){
	$array = explode( "\n", wordwrap( $text, $limit));
	return $array['0'];
}


/* customize login screen */
function buzzcity_images_custom_login_page() {
    echo '<style type="text/css">
        .login h1 a { background-image:url("'. get_stylesheet_directory_uri().'/images/logo.png") !important; height: 100px !important; width: 100% !important; margin: 0 auto !important; background-size: contain !important; }
		h1 a:focus { outline: 0 !important; box-shadow: none; }
        body.login { background-image:url("'. get_stylesheet_directory_uri().'/images/banner.jpg") !important; background-repeat: no-repeat !important; background-attachment: fixed !important; background-position: center !important; background-size: cover !important; position: relative; z-index: 999;}
  		body.login:before { background-color: rgba(0,0,0,0.8); position: absolute; width: 100%; height: 100%; left: 0; top: 0; content: ""; z-index: -1; }
  		.login form {
  			background: rgba(255,255,255, 0.2) !important;
  		}
		.login form .input, .login form input[type=checkbox], .login input[type=text] {
			background: transparent !important;
			color: #ddd;
		}
		.login label {
			color: #DDD !important;
		}
		.login #login_error, .login .message {
			color: #ddd;
			margin-top: 20px;
			background: rgba(255,255,255, 0.2) !important;
		}
		#login {
		    padding: 7% 0 0;
		}
    </style>';
}
add_action('login_head', 'buzzcity_images_custom_login_page', 99);
function cabinet_login_logo_url_title() {
 	return 'Business Simple';
}
add_filter( 'login_headertitle', 'cabinet_login_logo_url_title' );
function cabinet_login_logo_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'cabinet_login_logo_url' );
