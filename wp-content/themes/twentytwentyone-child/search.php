<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/style.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
<!-- Font Google -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script> 

<div align="center"> 
<div class="wapper">
 <div class="contentarea clearfix">
   <div class="content">
	   <ul>
		   <?php if ( have_posts() ) : ?>

	   <header class="page-header">
		   <p><?php printf( __( 'Search Results for: %s', 'twentyfourteen' ), get_search_query() ); ?></p>
	   </header><!-- .page-header -->

				   <?php
				   // Start the Loop.
				   while ( have_posts() ) : the_post();
				   ?>
				  <div class="col-lg-4 col-md-12">
            <div class="card single_post">            
                <div class="body">
                    <div class="img-post m-b-15">
                    <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?> 
                        <img src="<?php echo $url; ?>" alt="Awesome Image">
                    </div>
                    <h4 style="margin-top: 1rem;font-size: 25px;font-weight:700"><?php the_title(); ?></h4>
                    <p><?php the_content(); ?></p>
					 <?php $date = get_field('date');
                   $date2 = date("j F, Y", strtotime($date)); ?>
                    <h5><?php  echo $date2; ?></h5>   
                </div>
            </div>
        </div>
				   <?php
				   endwhile;
		   else :
		   // If no content, include the "No posts found" template.
		echo "No Post Found";
		   endif;
		   ?>       
	                                  

   </div>
 </div>
</div>
		</div>

