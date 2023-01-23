<?php

//hello

/* Child theme generated with WPS Child Theme Generator */

if (!function_exists('b7ectg_theme_enqueue_styles')) {
  add_action('wp_enqueue_scripts', 'b7ectg_theme_enqueue_styles');

  function b7ectg_theme_enqueue_styles()
  {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));
  }
}

/*custom logo*/
//add_theme_support( 'custom-logo' );

function tutsplus_widgets_init()
{

  // First footer widget area, located in the footer. Empty by default.
  register_sidebar(array(
    'name' => __('First Footer Widget Area', 'tutsplus'),
    'id' => 'first-footer-widget-area',
    'description' => __('The first footer widget area', 'tutsplus'),
    'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));
}

// Register sidebars by running tutsplus_widgets_init() on the widgets_init hook.
add_action('widgets_init', 'tutsplus_widgets_init');



function save_posted_data($posted_data)
{

  $data = $posted_data['your-email'] . '<br>';
  $data .= $posted_data['your-subject'] . '<br>';
  $data .= $posted_data['your-message'] . '<br>';

  $args = array(
    'post_type' => 'contact_form',
    'post_status' => 'publish',
    'post_title' => $posted_data['your-name'],
    'post_content' => $data,
  );
  $post_id = wp_insert_post($args);

  if (!is_wp_error($post_id)) {
    if (isset($posted_data['your-name'])) {
      update_post_meta($post_id, 'your-name', $posted_data['your-name']);
    }
    if (isset($posted_data['your-email'])) {
      update_post_meta($post_id, 'your-email', $posted_data['your-email']);
    }
    if (isset($posted_data['your-subject'])) {
      update_post_meta($post_id, 'your-subject', $posted_data['your-subject']);
    }
    if (isset($posted_data['your-message'])) {
      update_post_meta($post_id, 'your-message', $posted_data['your-message']);
    }
    //and so on ...
    return $posted_data;
  }
}

add_filter('wpcf7_posted_data', 'save_posted_data');
?>



<?php
// add the ajax fetch js
add_action('wp_footer', 'ajax_fetch');
function ajax_fetch()
{
?>
  <script type="text/javascript">
    jQuery('input[name="apply_filter"]').on('click', function() {

      jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        data: {
          action: 'data_fetch',
          keyword: jQuery('#keyword').val(),
          first_date: jQuery('#first_date').val(),
          second_date: jQuery('#second_date').val(),
        },
        success: function(data) {
          jQuery('#datafetch').html(data);
        }
      });

    });
  </script>

  <?php
}

// the ajax function
add_action('wp_ajax_data_fetch', 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch', 'data_fetch');
function data_fetch()
{

  /*'date_query' => array(
        array(
            'after'     => date('2022-01-02 00:00:00'),
            'before'    => date('2022-01-13 00:00:00'),
            'inclusive' => true,
        ),
    ), */

  $first_date = $_POST['first_date'];
  $second_date = $_POST['second_date'];

  // echo $first_date;
  // echo "<br>";
  // echo $second_date;
  // echo "<br>";

  if (!empty($_POST['first_date']) && !empty($_POST['second_date'])) {
    //echo "string";
    $the_query = new WP_Query(
      array(
        'posts_per_page' => -1,
        's' => esc_attr($_POST['keyword']),
        'post_type' => 'custom_post',
        'date_query' => array(
          array(
            'after'     => $first_date,
            'before'    => $second_date,
            'inclusive' => true,
          ),
        )
      )
    );
  } else {
    //echo "121s";
    $the_query = new WP_Query(
      array(
        'posts_per_page' => -1,
        's' => esc_attr($_POST['keyword']),
        'post_type' => 'post',
      )
    );
  }

  if ($the_query->have_posts()) :
    while ($the_query->have_posts()) : $the_query->the_post(); ?>

      <h2><?php the_title(); ?></h2>

<?php endwhile;
    wp_reset_postdata();
  else :
    echo "No Post Found!";
  endif;

  die();
}
?>

<?php
//Filter with categories direct chkbox
function mishaa_filter_function()
{
?>
  <div style="margin-top: 10px;">
    <div class="container blog-page">
      <div class="row clearfix">
        <?php
        $args = array(
          'orderby' => 'date', // we will sort posts by date
          'order' => $_POST['date'] // ASC или DESC
        );

        if (!empty($_POST['categoryfilter']))
          $args['tax_query'] = array(

            array(
              'taxonomy' => 'category',
              'field' => 'id',
              'terms' => $_POST['categoryfilter'],
            ),
          );

        $query = new WP_Query($args);

        if ($query->have_posts()) :
          while ($query->have_posts()) : $query->the_post();
        ?>
            <div class="col-lg-4 col-md-12">
              <div class="card single_post">
                <div class="body">
                  <div class="img-post m-b-15">

                    <img src="<?php echo get_the_post_thumbnail() ?>">
                  </div>
                  <h4 style="margin-top: 1rem;font-size: 25px;font-weight:700"><?php the_title(); ?></h4>
                  <p style="line-height: 1.3;margin-top: 1.0rem;"><?php echo apply_filters('the_content', wp_trim_words(get_the_content(), 30)); ?></p>
                  <div style="display: flex;justify-content: space-between;">
                    <p style="font-weight: 500;"><?php echo get_the_date('Y-m-d'); ?></p>
                    <button type="button" class="btn btn-secondary btn-circle-sm">
                      <a href="<?php the_permalink(); ?>">
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
function mish_filter_function()
{
?>
  <div style="margin-top: 10px;">
    <div class="container blog-page">
      <div class="row clearfix">
        <?php
        $args = array(
          'orderby' => 'date', // we will sort posts by date
          'order' => $_POST['date'] // ASC или DESC
        );

        if (isset($_POST['categorySelect']))
          $args['tax_query'] = array(

            array(
              'taxonomy' => 'category',
              'field' => 'id',
              'terms' => $_POST['categorySelect']
            ),
          );

        $query = new WP_Query($args);

        if ($query->have_posts()) :
          while ($query->have_posts()) : $query->the_post();
        ?>
            <div class="col-lg-4 col-md-12">
              <div class="card single_post">
                <div class="body">
                  <div class="img-post m-b-15">

                    <img src="<?php echo get_the_post_thumbnail() ?>">
                  </div>
                  <h4 style="margin-top: 1rem;font-size: 25px;font-weight:700"><?php the_title(); ?></h4>
                  <p style="line-height: 1.3;margin-top: 1.0rem;"><?php echo apply_filters('the_content', wp_trim_words(get_the_content(), 30)); ?></p>
                  <div style="display: flex;justify-content: space-between;">
                    <p style="font-weight: 500;"><?php echo get_the_date('Y-m-d'); ?></p>
                    <button type="button" class="btn btn-secondary btn-circle-sm">
                      <a href="<?php the_permalink(); ?>">
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

<?php
add_action('init', 'my_setcookie');
function my_setcookie()
{
  //pop up model shows only once a day
  //setcookie( 'my-name', '1', time() + 3600, COOKIEPATH, COOKIE_DOMAIN   );
}
/**add_action( 'wp_head', 'my_getcookie' );
function my_getcookie() {
$alert = isset( $_COOKIE['my-name'] ) ? $_COOKIE['my-name'] : 'not set';
 echo "<script type='text/javascript'>alert('$alert')</script>";
}*/

add_action('wp_footer', 'showpanel');
function showpanel()
{
?>
  <script>
    $(document).ready(function() {
      //  alert('call');
      var value = $.cookie("the_cookie");
      if (value == null) {
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
      $.cookie('the_cookie', '', {
        expires: date,
        path: '/'
      }); // expires after 30 second
    });
  </script>

<?php
}

?>

<?php
// Creating the widget
class wpb_widget extends WP_Widget
{

  function __construct()
  {
    parent::__construct(

      // Base ID of your widget
      'wpb_widget',

      // Widget name will appear in UI
      __('WPBeginner Widget', 'wpb_widget_domain'),

      // Widget description
      array('description' => __('Sample widget based on WPBeginner Tutorial', 'wpb_widget_domain'),)
    );
  }

  // Creating widget front-end

  public function widget($args, $instance)
  {
    $title = apply_filters('widget_title', $instance['title']);
    $text = apply_filters('widget_title', $instance['text']);

    // before and after widget arguments are defined by themes
    echo $args['before_widget'];
    if (!empty($title))
      echo $args['before_title'] . $title . $args['after_title'];
    if (!empty($title))
      echo $args['before_title'] . $text . $args['after_title'];

    // This is where you run the code and display the output
    //  echo __( 'Hello, World!', 'wpb_widget_domain' );
    echo $args['after_widget'];
  }

  // Widget Backend
  public function form($instance)
  {
    if (isset($instance['title'])) {
      $title = $instance['title'];
    } else {
      $title = __('New title', 'wpb_widget_domain');
    }
    if (isset($instance['text'])) {
      $text = $instance['text'];
    } else {
      $text = __('New title', 'wpb_widget_domain');
    }
    // Widget admin form
?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
      <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Title:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo esc_attr($text); ?>" />
    </p>
  <?php
  }

  // Updating widget replacing old instances with new
  public function update($new_instance, $old_instance)
  {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
    $instance['text'] = (!empty($new_instance['text'])) ? strip_tags($new_instance['text']) : '';
    return $instance;
  }

  // Class wpb_widget ends here
}

// Register and load the widget
function wpb_load_widget()
{
  register_widget('wpb_widget');
}
add_action('widgets_init', 'wpb_load_widget');


function tutspluss_widgets_init()
{

  // First footer widget area, located in the footer. Empty by default.
  register_sidebar(array(
    'name' => __('Custom Widget', 'tutsplus'),
    'id' => 'custom-widget-area',
    'description' => __('Custom Widget', 'tutsplus'),
    'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));
}

// Register sidebars by running tutsplus_widgets_init() on the widgets_init hook.
add_action('widgets_init', 'tutspluss_widgets_init');

function weichie_load_more()
{

  $ajaxposts = new WP_Query([
    'post_type' => 'our_team',
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $_POST['paged'],
  ]);

  $response = '';
  $max_pages = $ajaxposts->max_num_pages;

  if ($ajaxposts->have_posts()) {
    ob_start();
    while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
      $response .= '<h1>' . the_title() . '</h1>';
    endwhile;
    $output = ob_get_contents();
    ob_end_clean();
  } else {
    $response = '';
  }

  $result = [
    'max' => $max_pages,
    'html' => $output,
    'paged' => $_POST['paged']
  ];

  echo json_encode($result);
  exit;
}

add_action('wp_ajax_weichie_load_more', 'weichie_load_more');
add_action('wp_ajax_nopriv_weichie_load_more', 'weichie_load_more');



function filterexpost()
{
  $val = $_POST['val'];
  $string = implode(', ', $val);
  ?>
  <div class="container-custom mb-60">
    <div class="today-highlights">
      <div class="row flex-wrap-wrap">
        <?php
        $args = array(
          'post_type' => 'custom_post',
          'posts_per_page' => 3,
          'cat' => array($string),
          //'paged' => 1,
        );
        $loop = new WP_Query($args);
        while ($loop->have_posts()) : $loop->the_post();
        ?>
          <div class="col-md-4" id="count-expage" data-countpage="<?php echo $loop->max_num_pages; ?>">
            <div class="highlights-grid-post">
              <div class="highlights-post-image-wrapper">
                <a href="">
                  <?php $url = wp_get_attachment_url(get_post_thumbnail_id($loop->ID)); ?>
                  <div class="highlights-post-image" style="background-image: url('<?php echo $url; ?>');"></div>
                </a>
              </div>
              <div class="latestblog-post-details">
                <h3 class="latestblog-post-title">
                  <a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a>
                </h3>
                <div class="latestblog-post-author">
                  <div class="latestblog-post-author-section">
                    <div class="latestblog-post-author-image">
                      <a href="">
                        <img src="https://transdirect.plutustec.in/wp-content/uploads/2022/08/Screen-Shot-2022-08-15-at-10.22.26-am-modified.png" alt="" />
                      </a>
                      <p class="latestblog-post-autho-name">
                        By<a href=""><?php echo get_field('author'); ?></a>
                      </p>
                    </div>
                  </div>
                  <div class="latestblog-post-date">
                    <?php echo get_field('date'); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile;
        ?>
      </div>
    </div>
  </div>
  <?php wp_reset_postdata(); ?>
  <?php die;
}
add_action('wp_ajax_expost', 'filterexpost');
add_action('wp_ajax_nopriv_expost', 'filterexpost');


//Load more expost
function load_more_exposts()
{
  $val = $_POST['catid'];
  $string = implode(', ', $val);
  $args = array(
    'post_type' => 'custom_post',
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'DESC',
    'cat' => array($string),
    'paged' => $_POST['page'],
  );
  $loop = new WP_Query($args);
  while ($loop->have_posts()) : $loop->the_post();
  ?>
    <div class="col-md-4" id="count-expage" data-countpage="<?php echo $loop->max_num_pages; ?>">
      <div class="highlights-grid-post">
        <div class="highlights-post-image-wrapper">
          <a href="">
            <?php $url = wp_get_attachment_url(get_post_thumbnail_id($loop->ID)); ?>
            <div class="highlights-post-image" style="background-image: url('<?php echo $url; ?>');"></div>
          </a>
        </div>
        <div class="latestblog-post-details">
          <h3 class="latestblog-post-title">
            <a href=""><?php echo the_title(); ?></a>
          </h3>
          <div class="latestblog-post-author">
            <div class="latestblog-post-author-section">
              <div class="latestblog-post-author-image">
                <a href="">
                  <img src="https://transdirect.plutustec.in/wp-content/uploads/2022/08/Screen-Shot-2022-08-15-at-10.22.26-am-modified.png" alt="" />
                </a>
                <p class="latestblog-post-autho-name">
                  By<a href=""><?php echo get_field('author'); ?></a>
                </p>
              </div>
            </div>
            <div class="latestblog-post-date">
              <?php echo get_field('date'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endwhile;
  ?>
<?php wp_reset_postdata();
  exit;
}
add_action('wp_ajax_load_expost', 'load_more_exposts');
add_action('wp_ajax_nopriv_load_expost', 'load_more_exposts');
?>