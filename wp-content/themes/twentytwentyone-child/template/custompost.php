<?php 
/**
 * Template Name:   custompost
 * Template Post Type:post,page,my-post-type;
 */
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/style.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
<!-- Font Google -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div style="margin-top: 30px;">
<div align='center'>
<form class="search" action="<?php echo home_url( '/' ); ?>">
        <input type="search" name="s" placeholder="Search&hellip;">
        <input type="submit" value="Search">
        <input type="hidden" name="post_type" value="custom_post">
</form>
</div>
<div style="margin-top: 10px;">
<div class="container blog-page">
    <div class="row clearfix">
<?php
$args = array( 'post_type' => 'custom_post',
            's' => $search_term,
          'post_status' => 'publish',
          'posts_per_page' => -1,
          'order'    => 'ASC'); 
         
          $loop = new WP_Query( $args );
          while ( $loop->have_posts() ) : $loop->the_post();   
          ?>
        <div class="col-lg-4 col-md-12">
            <div class="card single_post">            
                <div class="body">
                    <div class="img-post m-b-15">
                    <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?> 
                        <img src="<?php echo $url; ?>" alt="Awesome Image">
                    </div>
                    <h4 style="margin-top: 1rem;font-size: 25px;font-weight:700"><?php the_title(); ?></h4>
                    <p style="line-height: 1.3;margin-top: 1.0rem;"><?php echo apply_filters( 'the_content', wp_trim_words( get_the_content(), 30) ); ?></p>
                    <div style="display: flex;justify-content: space-between;">
					 <?php $date = get_field('date');
                   $date2 = date("j F, Y", strtotime($date)); ?>
                    <p style="font-weight: 500;"><?php  echo $date2; ?></p>
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
        ?>
    </div>
</div>
</div>

