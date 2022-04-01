<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Elegant Template By W3 Template</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/jquery.fancybox.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/owl.carousel.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/owl.theme.default.min.css"/>

<!-- Font Google -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
  <div class="container"> <a class="navbar-brand navbar-logo" href="#">
	  <!--custom logo-->
        <?php if ( function_exists( 'the_custom_logo' ) ) {
    		the_custom_logo();
			}?>
			<!-- <img src="http://localhost/business/wp-content/uploads/2022/03/logo-black.png" alt="logo" class="logo-1 sticky-logo">-->
			</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="fas fa-bars"></span> </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
		  <?php
	  $menu = '2';
	  $args        = array(
		'order'       => 'ASC',
		'orderby'     => 'menu_order',
		'post_type'   => 'nav_menu_item',
		'post_status' => 'publish',
		'output'      => ARRAY_A,
		'output_key'  => 'menu_order',
		'nopaging'    => true,
		);
		$items=wp_get_nav_menu_items( $menu, $args);
		$a=0;
		foreach( $items as $item ){
        // set up title and url
        $title = $item->title;
        $link = $item->url;
		?>
        <li class="nav-item"><a class="nav-link" href="<?php echo $link; ?>" data-scroll-nav="<?php echo $a;?>"><?php echo $title; ?></a> </li> 

      </ul>
	  <?php
		$a++;
	}
	  ?>
    </div>
  </div>
</nav>
<!-- End Navbar --> 
