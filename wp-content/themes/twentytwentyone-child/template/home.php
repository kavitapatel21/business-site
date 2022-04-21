<?php 
/**
 * Template Name:   home
 * Template Post Type:post,page,my-post-type;
 */
get_header();
?>

<?php

//get current page id 
global $wp_query;
$postID = $wp_query->post->ID;
//echo $postID; ?>

<!-- pop up -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <!--         <h4 class="modal-title">Modal Header</h4> -->
      </div>
      <div class="modal-body text-center">
        <h1>Full screen Transparent Bootstrap Modal</h1>
        <p>FEEL FRREE TO GET YOUR MODAL CODE HERE FOLKS.</p>
        <a class="pre-order-btn" href="#">GET THE MODAL CODE</a>
      </div>
      <div class="modal-footer">
        <!--         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
      </div>
    </div>

  </div>
</div>

<!-- Banner Image -->
<?php
          $args = array( 'post_type' => 'banner',
          'post_status' => 'publish',
          'posts_per_page' => -1,
          'order'    => 'ASC'); 
          $loop = new WP_Query( $args );
          while ( $loop->have_posts() ) : $loop->the_post(); 
      ?>
      <?php $thumb = get_the_post_thumbnail_url(); ?>
        <div class="banner text-center" data-scroll-index='0' style="background-image: url('<?php echo $thumb;?>')">
  <div class="banner-overlay">
    <div class="container">
      <h1 class="text-capitalize"><?php the_title(); ?></h1>
      <p><?php the_content(); ?></p>
      <a href="#" class="banner-btn"><?php echo get_field("button"); ?></a> </div>
  </div>
</div>
<?php
          endwhile;
        ?>

<!-- End Banner Image --> 
<div align="center">
<p><?php dynamic_sidebar('custom-widget-area');?></p>
</div>
<!-- About -->

<div class="about-us section-padding" data-scroll-index='1'>
  <div class="container">
    <div class="row">
      <div class="col-md-12 section-title text-center">
        <h3><?php echo get_field("main_heading",$postID); ?></h3>
        <p><?php echo get_field("paragraph",$postID); ?></p>
        <span class="section-title-line"></span> </div>
      <div class="col-md-6 mb-50">
        <div class="section-info">
          <div class="sub-title-paragraph">
            <?php $value=get_field("sub_heading",$postID); ?>
            <h4><?php echo $value; ?></h4>
            <h5><?php echo get_field("sub_paragraph",$postID); ?></h5>
            <p><?php echo get_field("sub_paragraph_one",$postID); ?></p>
          </div>
          <a href="#" class="anchor-btn"><?php echo get_field("learn_more",$postID); ?> <i class="fas fa-arrow-right pd-lt-10"></i></a>
         </div>
      </div>
      <div class="col-md-6 mb-50">
          <?php $image = get_field("image",$postID); 
         // echo $image;?> 
        <div class="section-img"> <img src="<?php echo $image['url']; ?>" alt="" class="img-responsive"/> </div>
      </div>
    </div>
  </div>
</div>

<!-- End About --> 

<!-- Services -->
<div class="services section-padding bg-grey" data-scroll-index='2'>
  <div class="container">
    <div class="row">
      <div class="col-md-12 section-title text-center">
        <h3>We Are Best At Our Service</h3>
        <p>Vestibulum elementum dui tempus dolor gravida, vel mattis erat fermentum.</p>
        <span class="section-title-line"></span> </div>
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-30">
        <div class="service-box bg-white text-center">
          <div class="icon"> <i class="fas fa-chart-line"></i> </div>
          <div class="icon-text">
            <h4 class="title-box">Chart Line</h4>
            <p>Sed malesuada, est eget condimentum iaculis, nisi ex facilisis metus.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-30">
        <div class="service-box bg-white text-center">
          <div class="icon"> <i class="fas fa-bullhorn "></i> </div>
          <div class="icon-text">
            <h4 class="title-box">Quick Anouncement</h4>
            <p>Sed malesuada, est eget condimentum iaculis, nisi ex facilisis metus.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-30">
        <div class="service-box bg-white text-center">
          <div class="icon"> <i class="fas fa-map-marked"></i> </div>
          <div class="icon-text">
            <h4 class="title-box">Mark Location</h4>
            <p>Sed malesuada, est eget condimentum iaculis, nisi ex facilisis metus.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-30">
        <div class="service-box bg-white text-center">
          <div class="icon"> <i class="fas fa-bug"></i> </div>
          <div class="icon-text">
            <h4 class="title-box">Bug Solution</h4>
            <p>Sed malesuada, est eget condimentum iaculis, nisi ex facilisis metus.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-30">
        <div class="service-box bg-white text-center">
          <div class="icon"> <i class="fas fa-comments"></i> </div>
          <div class="icon-text">
            <h4 class="title-box">Fast Communication</h4>
            <p>Sed malesuada, est eget condimentum iaculis, nisi ex facilisis metus.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-30">
        <div class="service-box bg-white text-center">
          <div class="icon"> <i class="fas fa-paint-brush"></i> </div>
          <div class="icon-text">
            <h4 class="title-box">Clean Design</h4>
            <p>Sed malesuada, est eget condimentum iaculis, nisi ex facilisis metus.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- End Services --> 

<!-- Gallery -->
<div class="portfolio section-padding" data-scroll-index='3'>
<div class="container text-center mt-5 mb-2">
    <h1 class="mb-0">Meet our agents</h1>
</div>

<div class="container mt-3">
    <div class="row">
<?php
$args = array( 'post_type' => 'our_team',
          'post_status' => 'publish',
          'posts_per_page' => -1,
          'order'    => 'ASC'); 
          $loop = new WP_Query( $args );
          while ( $loop->have_posts() ) : $loop->the_post(); 
      ?>
        <div class="col-md-3">
            <div class="bg-white p-3 text-center rounded box">
            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                <img class="img-responsive rounded-circle" src="<?php echo $image[0]; ?>" width="90">
                <h5 class="mt-3 name"><?php the_title(); ?></h5>
                <div class="mt-4 about"><span><?php echo apply_filters( 'the_content', wp_trim_words( get_the_content(), 12) ); ?></span></div>
                <div class="mt-4">
                    <h6 class="v-profile"><?php echo get_field("view_profile"); ?></h6>
                </div>
            </div>
        </div>
        <?php
          endwhile;
        ?>
    </div>
</div>
</div>

<!-- End Gallery -->
<!-- Testimonials -->
<div class="testimonials">
  <div class="testimonials-overlay section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-10 offset-md-1">
          <div class="owl-carousel owl-theme">
            <div class="testimonial-item text-center">
              <div class="icon"> <i class="fas fa-comments"></i> </div>
              <p class="m-auto">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
              <div class="testimonial-author text-center">
                <h5>Rup Jakhar</h5>
                <h6>Web Desinger</h6>
              </div>
            </div>
            <div class="testimonial-item text-center">
              <div class="icon"> <i class="fas fa-comments"></i> </div>
              <p class="m-auto">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              <div class="testimonial-author text-center">
                <h5>Yogesh Singh</h5>
                <h6>Web Desinger</h6>
              </div>
            </div>
            <div class="testimonial-item text-center">
              <div class="icon"> <i class="fas fa-comments"></i> </div>
              <p class="m-auto">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
              <div class="testimonial-author text-center">
                <h5>Vivek Singh</h5>
                <h6>Web Desinger</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Testimonials --> 

<!-- Contact -->
<div class="contact section-padding" data-scroll-index='4'>
  <div class="container">
    <div class="row">
      <div class="col-md-12 section-title text-center">
        <h3>Contact Us For More</h3>
        <p>Vestibulum elementum dui tempus dolor gravida, vel mattis erat fermentum.</p>
        <span class="section-title-line"></span> </div>
      <div class="col-lg-5 col-md-4">
        <div class="part-info">
          <div class="info-box">
            <div class="icon"> <i class="fas fa-phone"></i> </div>
            <div class="content">
              <h4>Phone :</h4>
              <p>0123456789</p>
            </div>
          </div>
          <div class="info-box">
            <div class="icon"> <i class="fas fa-map-marker-alt"></i> </div>
            <div class="content">
              <h4>Address :</h4>
              <p>New Delhi, India</p>
            </div>
          </div>
          <div class="info-box">
            <div class="icon"> <i class="fas fa-envelope"></i> </div>
            <div class="content">
              <h4>Mail :</h4>
              <p><a href="#">info@123.com</a></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-7 col-md-8">
        <div class="contact-form">
          <form class='form' id='contact-form' method='post' data-toggle='validator'>
            <input type='hidden' name='form-name' value='contact-form' />
            <div class="messages"></div>
            <div class="controls">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <input id="form_name" type="text" name="name" placeholder="Name *" required data-error="name is required.">
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <input id="form_email" type="email" name="email" placeholder="Email *" required data-error="Valid email is required.">
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <input id="form_subject" type="text" name="subject" placeholder="Subject">
                  </div>
                </div>
                <div class="col-lg-12 form-group">
                  <textarea id="form_message" name="message" class="form-control" placeholder=" Type Your Message " rows="4" required data-error="Please,leave us a message."></textarea>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="col-lg-12 text-center">
                  <button class="bttn">Send Message</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
<?php  echo do_shortcode( '[contact-form-7 id="69" title="Contact form 1"]' ); ?>
  </div>
</div>
<!-- End Contact -->


<?php
get_footer();
?>