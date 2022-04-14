
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/style.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
<!-- Font Google -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
  //pop up model shows only once a day
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

<?php
//fiter post between two dates
function misha_filter_function(){

	if( isset( $_POST['startdate'] ) && isset( $_POST['enddate'] ) ) {
    $start=$_POST['startdate'];
    $end=$_POST['enddate'];
    //$startdate=date( 'Y-m-d H:i:s', strtotime($start) );
    //$enddate=date( 'Y-m-d H:i:s', strtotime($end) );
   //echo  $startdate;
    $args = array( 'post_type' => 'custom_post',
  'post_status' => 'publish',
  'posts_per_page' => -1,
  'order'    => 'ASC',   
  'date_query' => array(
    array(
        'after'     => sanitize_text_field($start),
        'before'    => sanitize_text_field($end),
        'inclusive' => true,
    ),
  ),
);   
	$query = new WP_Query( $args );
  //echo '<pre>';
	//print_r($query);
	if( $query->have_posts() ) :
		while( $query->have_posts() ): $query->the_post();
			echo '<h4>' . $query->post->post_title . '</h4>';
		endwhile;
		wp_reset_postdata();
	else :
		echo 'No posts found';
	endif;
	
	die();
}
	} 
add_action('wp_ajax_myfilter', 'misha_filter_function'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_myfilter', 'misha_filter_function');
?>

<?php
//Filter with categories direct chkbox
function mishaa_filter_function(){
  ?>
  <div style="margin-top: 10px;">
<div class="container blog-page">
    <div class="row clearfix">
      <?php
  $args = array(
      'orderby' => 'date', // we will sort posts by date
      'order' => $_POST['date'] // ASC или DESC
  );
  
  if(  !empty( $_POST['categoryfilter']) )
      $args['tax_query'] = array(

          array(
              'taxonomy' => 'category',
              'field' => 'id',
              'terms' => $_POST['categoryfilter'],
          ),
      );

  $query = new WP_Query( $args );

  if( $query->have_posts() ) :
      while( $query->have_posts() ): $query->the_post();
      ?>
      <div class="col-lg-4 col-md-12">
      <div class="card single_post">            
          <div class="body">
              <div class="img-post m-b-15">
             
                  <img src="<?php echo get_the_post_thumbnail() ?>">
              </div>
              <h4 style="margin-top: 1rem;font-size: 25px;font-weight:700"><?php the_title(); ?></h4>
              <p style="line-height: 1.3;margin-top: 1.0rem;"><?php echo apply_filters( 'the_content', wp_trim_words( get_the_content(), 30) ); ?></p>
              <div style="display: flex;justify-content: space-between;">
              <p style="font-weight: 500;"><?php echo get_the_date( 'Y-m-d' ); ?></p>
              <button type="button" class="btn btn-secondary btn-circle-sm">
              <a href="<?php the_permalink();?>">
              <span class="glyphicon glyphicon-arrow-right"></span>
              </a>
              </button>
          </div>
          </div>
      </div>
  </div>
<?php
      endwhile;
      wp_reset_postdata();
      ?>
      </div>
  </div>
  </div>
  <?php
  else :
      echo 'No posts found';
  endif;

  die();
}
add_action('wp_ajax_myfilter', 'mishaa_filter_function'); 
add_action('wp_ajax_nopriv_myfilter', 'mishaa_filter_function');
?>


<?php
//filter post with dropdown & chkbox
function mish_filter_function(){
  ?>
  <div style="margin-top: 10px;">
<div class="container blog-page">
    <div class="row clearfix">
      <?php
  $args = array(
      'orderby' => 'date', // we will sort posts by date
      'order' => $_POST['date'] // ASC или DESC
  );
 
  if( isset( $_POST['categorySelect'] ))
      $args['tax_query'] = array(
          
          array(
              'taxonomy' => 'category',
              'field' => 'id',
              'terms' => $_POST['categorySelect']
          ),
      );

  $query = new WP_Query( $args );

  if( $query->have_posts() ) :
    while( $query->have_posts() ): $query->the_post();
    ?>
    <div class="col-lg-4 col-md-12">
    <div class="card single_post">            
        <div class="body">
            <div class="img-post m-b-15">
           
                <img src="<?php echo get_the_post_thumbnail() ?>">
            </div>
            <h4 style="margin-top: 1rem;font-size: 25px;font-weight:700"><?php the_title(); ?></h4>
            <p style="line-height: 1.3;margin-top: 1.0rem;"><?php echo apply_filters( 'the_content', wp_trim_words( get_the_content(), 30) ); ?></p>
            <div style="display: flex;justify-content: space-between;">
            <p style="font-weight: 500;"><?php echo get_the_date( 'Y-m-d' ); ?></p>
            <button type="button" class="btn btn-secondary btn-circle-sm">
            <a href="<?php the_permalink();?>">
            <span class="glyphicon glyphicon-arrow-right"></span>
            </a>
            </button>
        </div>
        </div>
    </div>
</div>
<?php
    endwhile;
    wp_reset_postdata();
    ?>
    </div>
</div>
</div>
<?php
  else :
      echo 'No posts found';
  endif;

  die();
}
add_action('wp_ajax_postfilter', 'mish_filter_function'); 
add_action('wp_ajax_nopriv_postfilter', 'mish_filter_function');
?>
