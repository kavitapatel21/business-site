<html>

<head lang="en">
  <meta charset="UTF-8">
  <title>Testimonial</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
  <style>
  
.testimonial {
  border-right: 4px solid #2a3d7d;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);
  padding: 30px 30px 30px 130px;
  margin: 0 15px 30px 15px;
  overflow: hidden;
  position: relative;
}
.testimonial:before {
  content: "";
  position: absolute;
  bottom: -4px;
  left: -17px;
  border-top: 25px solid #29d18b;
  border-left: 25px solid transparent;
  border-right: 25px solid transparent;
  transform: rotate(45deg);
}
.testimonial:after {
  content: "";
  position: absolute;
  top: -4px;
  left: -17px;
  border-top: 25px solid #29d18b;
  border-left: 25px solid transparent;
  border-right: 25px solid transparent;
  transform: rotate(135deg);
}
.testimonial .pic {
  display: inline-block;
  width: 80px;
  height: 80px;
  border-radius: 50%;
  overflow: hidden;
  position: absolute;
  top: 60px;
  left: 20px;
}
.testimonial .pic img {
  width: 100%;
  height: auto;
}
.testimonial .description {
  font-size: 15px;
  letter-spacing: 1px;
  color: #6f6f6f;
  line-height: 25px;
  margin-bottom: 15px;
}
.testimonial .title {
  display: inline-block;
  font-size: 20px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: #29d18b;
  margin: 0;
}
.testimonial .post {
  display: inline-block;
  font-size: 17px;
  color: #29d18b;
  font-style: italic;
}
.owl-theme .owl-controls .owl-page span {
  border: 2px solid #2a3d7d;
  background: #fff !important;
  border-radius: 0 !important;
  opacity: 1;
}
.owl-theme .owl-controls .owl-page.active span,
.owl-theme .owl-controls .owl-page:hover span {
  background: #29d18b !important;
  border-color: #29d18b;
}
@media only screen and (max-width: 767px) {
  .testimonial {
    padding: 20px;
    text-align: center;
  }
  .testimonial .pic {
    display: block;
    position: static;
    margin: 0 auto 15px;
  }
}

  </style>
</head>
<?php

/**
 * Plugin Name: Testimonial
 * Plugin URI: https://github.com/WebDevStudios/custom-post-type-ui/
 * Description: Admin panel for creating custom post types and custom taxonomies in WordPress
 * Author: WebDevStudios
 * Version: 1.11.2
 * Author URI: https://webdevstudios.com/

 */

global $jal_db_version;
$jal_db_version = '1.0';

function jal_install() {
	global $wpdb;
	global $jal_db_version;

	$table_name = $wpdb->prefix . 'testimonial';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		name tinytext NOT NULL,
		content text NOT NULL,
		img varchar(55) DEFAULT '' NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );

	add_option( 'jal_db_version', $jal_db_version );
}

function jal_install_data() {
	global $wpdb;
    ?>
    <form name="foo" method="post" enctype="multipart/form-data">
    <input type="file" value="images/avatar3.png">
</form>
	<?php
	$all_items = array(

        array( 'name' => 'test', 'content' => 'Congratulations, you just completed the installation!', 'img' => '4' ), 
      
        array( 'name' => 'testone', 'content' => 'Congratulations, you just completed the installation!', 'img' => '5' ), 
      
        array( 'name' => 'testtwo', 'content' => 'Congratulations, you just completed the installation!', 'img' => '6' ),  
      
      );

	$table_name = $wpdb->prefix . 'testimonial';
	$q = "INSERT INTO $table_name (name, content, img) VALUES ";

foreach ( $all_items as $an_item ) {
  $q .= $wpdb->prepare(
    "(%s, %s, %d),",
    $an_item['name'], $an_item['content'], $an_item['img']
  );
}

$q = rtrim( $q, ',' ) . ';';

$wpdb->query( $q );
}
register_activation_hook( __FILE__, 'jal_install' );
register_activation_hook( __FILE__, 'jal_install_data' );

register_deactivation_hook( __FILE__, 'my_plugin_remove_database' );
function my_plugin_remove_database() {
     global $wpdb;
     $table_name = $wpdb->prefix . 'testimonial';
     $sql = "DROP TABLE IF EXISTS $table_name";
     $wpdb->query($sql);
     delete_option("my_plugin_db_version");
}   

function display_data(){
    global $wpdb;
?>
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div id="testimonial-slider" class="owl-carousel">
          <?php
    $userTable =$wpdb->prefix."testimonial";
    $rows = $wpdb->get_results("SELECT * FROM $userTable"); 
   // echo '<pre>';
    //print_r($rows);
    $array = json_decode(json_encode( $rows), true);
    foreach (  $array as $row ) {
        $name=$row['name'];
        $content=$row['content'];
        $img=$row['img'];
        ?>
        <div class="testimonial">
            <div class="pic">
              <img src="https://images.pexels.com/photos/638700/pexels-photo-638700.jpeg?w=940&h=650&auto=compress&cs=tinysrgb">
            </div>
            <p class="description"><?php echo $content ?></p>
            <h3 class="title"><?php echo $name; ?></h3>
          </div>
   <?php } ?>
   </div>
   </div>
 </div>
</div>
<?php }
add_shortcode('show_data','display_data');
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>

  <script>
    $(document).ready(function() {
      $("#testimonial-slider").owlCarousel({
        items: 2,
        itemsDesktop: [1000, 2],
        itemsDesktopSmall: [990, 2],
        itemsTablet: [768, 1],
        pagination: true,
        navigation: false,
        navigationText: ["", ""],
        slideSpeed: 1000,
        autoPlay: true
      });
    });
  </script>
</body>

</html>
