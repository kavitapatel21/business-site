<?php 
/**
 * Template Name:   category-filter-post
 * Template Post Type:post,page,my-post-type;
 */
?>
<!--Filter post with category using chkbox-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/style.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
<!-- Font Google -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
<!--            Cities select filter -->
        <?php
   /**if( $terms = get_terms( 'category', 'orderby=name' ) ) : // to make it simple I use default categories
        echo '<select value ="" name="cityfilter"><option>Select Category</option>';
        foreach ( $terms as $term ) :
            echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option
        endforeach;
        echo '</select>';
    endif;*/?>
<!--        Categories filter -->
        <div class="categories-list">
        <?php 
          $categories = get_categories(); 
         // echo '<pre>';
         // print_r($categories);
          foreach ($categories as $category) {
            echo '<input type="checkbox" name="categoryfilter" value="'.$category->cat_ID.'"> '.$category->name.'<br />';
          }
        ?>
        </div>
            <button class="itenerary-filter">Apply filter</button>
<input type="hidden" name="action" value="myfilter">
    </form> 
    
<div style="margin-top: 10px;">
<div class="container blog-page">
    <div class="row clearfix">
<?php


$args = array( 'post_type' => 'post',
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