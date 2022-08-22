<html>

<head lang="en">
  <meta charset="UTF-8">
  <title>Testimonial</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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

//require_once( ABSPATH . '/wp-includes/pluggable.php' );
//$user_info = wp_get_current_user();
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
		img longtext NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );

	add_option( 'jal_db_version', $jal_db_version );
}

function jal_install_data() {
	global $wpdb;
  $ids = get_posts( 
    array(
        'post_type'      => 'attachment', 
        'post_mime_type' => 'image', 
        'post_status'    => 'inherit', 
        'posts_per_page' => -1,
        'fields'         => 'ids',
    ) 
);
$images = array();
foreach ( $ids as $id )
    $images[]= $id;

$one= $images[0] ;
$two= $images[1] ;
$three=$images[2] ;
echo $one;
echo $two;
echo $three;

 // $a=wp_get_attachment_url( 153);FF
    ?>

	<?php
	$all_items = array(

        array( 'name' => 'test', 'content' => 'Congratulations, you just completed the installation!', 'img' =>  $one  ), 
      
        array( 'name' => 'testone', 'content' => 'Congratulations, you just completed the installation!', 'img' => $two ), 
      
        array( 'name' => 'testtwo', 'content' => 'Congratulations, you just completed the installation!', 'img' => $three ),  
      
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

//display testimonial on frontend using shortcode
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
    //echo '<pre>';
  //print_r($rows);
    $array = json_decode(json_encode( $rows), true);
    foreach (  $array as $row ) {
        $name=$row['name'];
        $content=$row['content'];
        $img_id=$row['img'];
        $image_thumb = wp_get_attachment_image_src($img_id, 'thumbnail');
 
        // display the image
        $url= $image_thumb[0];
       // echo $url;
       // echo $imgid;
       // echo wp_get_attachment_image_src( $imgid);
        //echo $img;
        ?>
        <div class="testimonial">
            <div class="pic">
              <img src="<?php echo $url; ?>">
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


//add menu on dashboard
add_action('admin_menu', 'at_try_menu');
function at_try_menu() {
    //adding plugin in menu
    add_menu_page('employee_list', //page title
        'Employee Listing', //menu title
        'manage_options', //capabilities
        'Employee_Listing', //menu slug
        'employee_list' //function
    );
    //adding submenu to a menu
    add_submenu_page('Employee_Listing',//parent page slug
        'employee_insert',//page title
        'Employee Insert',//menu titel
        'manage_options',//manage optios
        'Employee_Insert',//slug
        'employee_insert'//function
    );
    add_submenu_page( null,//parent page slug
        'employee_update',//$page_title
        'Employee Update',// $menu_title
        'manage_options',// $capability
        'Employee_Update',// $menu_slug,
        'employee_update'// $function
    );
    add_submenu_page( null,//parent page slug
        'employee_delete',//$page_title
        'Employee Delete',// $menu_title
        'manage_options',// $capability
        'Employee_Delete',// $menu_slug,
        'employee_delete'// $function
    );
}

//listing data
function employee_list() {
    ?>
    <style>
        table {
            border-collapse: collapse;
        }
        table, td, th {
            border: 1px solid black;
            padding: 20px;
            text-align: center;
        }
    </style>
    <div class="wrap">
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Content</th>
                <th>img</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            global $wpdb;
            $table_name = $wpdb->prefix . 'testimonial';
            $rows = $wpdb->get_results("SELECT * from $table_name");
            //$rowcount = $wpdb->num_rows;
           // echo $rowcount;
            $employees= json_decode(json_encode( $rows), true);
            foreach ($employees as $employee) {
              $img_id=$employee['img'];
              $image_thumb = wp_get_attachment_image_src($img_id, 'thumbnail');
              // display the image
            
              $id = $employee['id'];
              $name = $employee['name'];
              $content = $employee['content'];
              $url= $image_thumb[0];
              ?>
                <tr>
                    <td><?php echo  $id; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo  $content; ?></td>
                    <td> <img src="<?php echo $url; ?>"></td>
                    <td><a href="<?php echo admin_url('admin.php?page=Employee_Insert&id=' . $employee['id']);?>">Add</a> </td>
                    <td><a href="<?php echo admin_url('admin.php?page=Employee_Update&id=' . $employee['id']); ?>">Edit</a> </td>
                    <td><a href="<?php echo admin_url('admin.php?page=Employee_Delete&id=' . $employee['id']); ?>"> Delete</a></td>
                </tr>
            <?php }
            } 
            
            
//insert data

function employee_insert()
{
    //echo "insert page";
    ?>
<table>
    <thead>
    <tr>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <form name="frm" action="#" method="post" enctype='multipart/form-data'>
    <tr>
        <td>Name:</td>
        <td><input type="text" name="nm"></td>
    </tr>
    <tr>
        <td>Content:</td>
        <td><input type="text" name="adrs"></td>
    </tr>
    <tr>
        <td>Image:</td>
        <td>
        <input type="file" id="fileToUpload" name="fileToUpload"></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" value="Insert" name="ins"></td>
    </tr>
    </form>
    </tbody>
</table>
<?php
    if(isset($_POST['ins'])){
        global $wpdb;
        $nm=$_POST['nm'];
        $ad=$_POST['adrs'];
    //Add image in to wordpress media library from input type
    $file_name = $_FILES['fileToUpload']['name'];
    $file_temp = $_FILES['fileToUpload']['tmp_name'];
    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents( $file_temp );
    $filename = basename( $file_name );
    $filetype = wp_check_filetype($file_name);
    $filename = time().'.'.$filetype['ext'];
    if ( wp_mkdir_p( $upload_dir['path'] ) ) {
      $file = $upload_dir['path'] . '/' . $filename;
    }
    else {
      $file = $upload_dir['basedir'] . '/' . $filename;
    }
    file_put_contents( $file, $image_data );
    $wp_filetype = wp_check_filetype( $filename, null );
    $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_title' => sanitize_file_name( $filename ),
      'post_content' => '',
      'post_status' => 'inherit'
    );

    $attach_id = wp_insert_attachment( $attachment, $file );
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    wp_update_attachment_metadata( $attach_id, $attach_data );

   // echo $attach_id;

        $table_name = $wpdb->prefix . 'testimonial';
       // Insert record
        $insert_sql = "INSERT INTO ".$table_name."(name,content,img) values('".$nm."','".$ad."','".  $attach_id."') ";
       $wpdb->query($insert_sql);
        echo "inserted";
    ?>
        <script type="text/javascript">
       window.location = "admin.php?page=Employee_Listing";
        </script>
        <?php
    }
  }



//echo "update page";
function employee_update(){
  //echo "update page in";
 
  $i=$_GET['id'];
  global $wpdb;
  $table_name = $wpdb->prefix . 'testimonial';
  $employees = $wpdb->get_results("SELECT * from $table_name where id=$i");
 // echo $employees[0]->id;
  $img_id=$employees[0]->img;
  $image_thumb = wp_get_attachment_image_src($img_id, 'thumbnail');
  // display the image
  $url= $image_thumb[0];
// $imgname=basename( $url);
 //echo $imgname;
  ?>
  <table>
      <thead>
      <tr>
          <th></th>
          <th></th>
      </tr>
      </thead>
      <tbody>
      <form name="frm" action="#" method="post" enctype='multipart/form-data'>
          <input type="hidden" name="id" value="<?= $employees[0]->id; ?>">
          <tr>
              <td>Name:</td>
              <td><input type="text" name="nm" value="<?= $employees[0]->name; ?>"></td>
          </tr>
          <tr>
              <td>Content:</td>
              <td><input type="text" name="adrs" value="<?= $employees[0]->content; ?>"></td>
          </tr>
          <tr>
        <td>Image:</td>
        <td>
        <input type="file" id="fileToUpload" name="fileToUpload">
      <input type=hidden name="hiddenField" id="hiddenField" value="<?php echo $img_id?>"></td>
    </tr>
          <tr>
              <td></td>
              <td><input type="submit" value="Update" name="upd"></td>
          </tr>
      </form>
      </tbody>
  </table>
  <?php
  
  
  
if(isset($_POST['upd']))
{
  
  global $wpdb;
  $table_name=$wpdb->prefix.'testimonial';
  $id=$_POST['id'];
  $nm=$_POST['nm'];
  $ad=$_POST['adrs'];
  //echo $_POST['hiddenField'];
  if($_FILES['fileToUpload']['name']=='')
  { 
  $m=$_POST['hiddenField'];
  }
  else{
    $file_name = $_FILES['fileToUpload']['name'];
    $file_temp = $_FILES['fileToUpload']['tmp_name'];
    $upload_dir = wp_upload_dir();
      $image_data = file_get_contents( $file_temp );
      $filename = basename( $file_name );
      $filetype = wp_check_filetype($file_name);
      $filename = time().'.'.$filetype['ext'];
      if ( wp_mkdir_p( $upload_dir['path'] ) ) {
        $file = $upload_dir['path'] . '/' . $filename;
      }
      else {
        $file = $upload_dir['basedir'] . '/' . $filename;
      }
      file_put_contents( $file, $image_data );
      $wp_filetype = wp_check_filetype( $filename, null );
      $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name( $filename ),
        'post_content' => '',
        'post_status' => 'inherit'
      );
    
      $attach_id = wp_insert_attachment( $attachment, $file );
      require_once( ABSPATH . 'wp-admin/includes/image.php' );
      $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
      wp_update_attachment_metadata( $attach_id, $attach_data );
     $m= $attach_id;
  }
  $wpdb->update(
      $table_name,
      array(
          'name'=>$nm,
          'content'=>$ad,
          'img'=> $m
      ),
      array(
          'id'=>$id
      )
  );
 // header('Location:admin.php?page=Employee_Listing');
  ?>
  <script type="text/javascript">
 window.location = "admin.php?page=Employee_Listing";
</script>
<?php }
}


//echo "employee delete";
function employee_delete(){
  echo "employee delete";
  if(isset($_GET['id'])){
      global $wpdb;
      $table_name=$wpdb->prefix.'testimonial';
      $i=$_GET['id'];
      $wpdb->delete(
          $table_name,
          array('id'=>$i)
      );
      echo "deleted";
  }
  ?>
  <script type="text/javascript">
window.location = "admin.php?page=Employee_Listing";
</script> );
<?php
}
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
