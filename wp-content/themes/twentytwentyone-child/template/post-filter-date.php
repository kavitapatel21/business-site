<?php 
/**
 * Template Name:   post-filter-date
 * Template Post Type:post,page,my-post-type;
 */

?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div style="margin-top: 30px;">
<div align='center'>
<input type="text" name="keyword" id="keyword" placeholder="post title here...."/>
<input type="text" name="first_date" id="first_date"/>
<input type="text" name="second_date" id="second_date"/>
<input type="button" name="apply_filter" value="Apply Filter">
<div id="datafetch">
</div>
</div>
<div style="margin-top: 10px;">
<div class="container blog-page">
    <div class="row clearfix">
<?php


$args = array( 'post_type' => 'custom_post',
          'post_status' => 'publish',
          'posts_per_page' => -1,
          'order'    => 'ASC',      
        );   
          $query = new WP_Query( $args );
         //echo '<pre>';
          //print_r($query);
          while ( $query->have_posts() ) : $query->the_post();   
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
        ?>
    </div>
</div>
</div>
<?php
wp_footer(); 
?>

