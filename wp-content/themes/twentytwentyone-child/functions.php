<?php 
/* Child theme generated with WPS Child Theme Generator */
            
if ( ! function_exists( 'b7ectg_theme_enqueue_styles' ) ) {            
    add_action( 'wp_enqueue_scripts', 'b7ectg_theme_enqueue_styles' );
    
    function b7ectg_theme_enqueue_styles() {
        wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
    }
}

/*custom logo*/
add_theme_support( 'custom-logo' );

function tutsplus_widgets_init() {
 
    // First footer widget area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'First Footer Widget Area', 'tutsplus' ),
        'id' => 'first-footer-widget-area',
        'description' => __( 'The first footer widget area', 'tutsplus' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}
 
// Register sidebars by running tutsplus_widgets_init() on the widgets_init hook.
add_action( 'widgets_init', 'tutsplus_widgets_init' );



function save_posted_data( $posted_data ) {

    $data=$posted_data['your-email'].'<br>';
    $data.=$posted_data['your-subject'].'<br>';
    $data.=$posted_data['your-message'].'<br>';

    $args = array(
      'post_type' => 'contact_form',
      'post_status'=>'publish',
      'post_title'=>$posted_data['your-name'],
      'post_content'=>$data,
    );
    $post_id = wp_insert_post($args);

    if(!is_wp_error($post_id)){
      if( isset($posted_data['your-name']) ){
        update_post_meta($post_id, 'your-name', $posted_data['your-name']);
      }
      if( isset($posted_data['your-email']) ){
        update_post_meta($post_id, 'your-email', $posted_data['your-email']);
     }
     if( isset($posted_data['your-subject']) ){
       update_post_meta($post_id, 'your-subject', $posted_data['your-subject']);
      }
      if( isset($posted_data['your-message']) ){
        update_post_meta($post_id, 'your-message', $posted_data['your-message']);
      }
   //and so on ...
   return $posted_data;
  }
}

add_filter( 'wpcf7_posted_data', 'save_posted_data' );
?>

<?php
add_action( 'init', 'my_setcookie' );
function my_setcookie() {
//setcookie( 'my-name', '1', time() + 3600, COOKIEPATH, COOKIE_DOMAIN   );
}
/**add_action( 'wp_head', 'my_getcookie' );
function my_getcookie() {
$alert = isset( $_COOKIE['my-name'] ) ? $_COOKIE['my-name'] : 'not set';
 echo "<script type='text/javascript'>alert('$alert')</script>";
}*/

add_action( 'wp_footer', 'showpanel' );
function showpanel() {
    ?>
    <script>
    $(document).ready(function(){
      //  alert('call');
    var value=$.cookie("the_cookie");
    if(value == null){
        //alert('hi');
        $('#myModal').modal('show');

    }
   /**  $.cookie('the_cookie', 'true', { expires: 1 ,path :'/'});
    var now = new Date();
  var time = now.getTime();
  var expireTime = time + (24 * 60 * 60 * 1000); //for 1 day
  now.setTime(expireTime);
  */
  var date = new Date();
date.setTime(date.getTime() + (10 * 1000));
$.cookie('the_cookie', '', { expires: date ,path :'/' });  // expires after 30 second
});
    </script>

<?php
}
?>