<?php 
/**
 * Template Name:  check-box-filter
 * Template Post Type:post,page,my-post-type;
 */
?>
<!--Select Dropdown with chkbox filter post by category-->
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<!-- JS & CSS library of MultiSelect plugin -->
<script src="https://phpcoder.tech/multiselect/js/jquery.multiselect.js"></script>
<link rel="stylesheet" href="https://phpcoder.tech/multiselect/css/jquery.multiselect.css">

<script>
  $(document).ready(function() {
  jQuery('#languageSelect').multiselect({
    columns: 1,
    placeholder: 'Select Category',
    search: true,
    selectAll: true
});
});
</script>

<div style="margin-top: 10px;">
<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
<table>
    <tr>
        <td style="padding:10px;">
       <?php $categories = get_categories(); 
          //echo '<pre>';
          //print_r($categories);
         ?>
<select name="categorySelect" multiple="multiple" id="languageSelect">
  <?php
          foreach ($categories as $category) {
            echo '<option value="'.$category->cat_ID.'">'.$category->name.'</option>';
          }?>
</select>
        </td>
        <td>
<button class="itenerary-filter">Filter</button>
<input type="hidden" name="action" value="postfilter">
        </td>
</tr>
</table>
        </form>
        </div>

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
