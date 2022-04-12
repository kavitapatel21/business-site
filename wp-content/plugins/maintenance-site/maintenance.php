<?php
/**
 * MNT Maintenance Mode
 *
 * Plugin Name: Maintenance Mode
 * Description: Easy to set Maintenance site mode. 
 * Version: 1.0.0
 * Author: Chirag Gauswami
 * Author URI: #
 * GitHub Plugin URI: #
 * License URI: #
 * Plugin URI: #
 * Text Domain: mnt-maintenance-mode
 * Domain Path: /languages
 * WordPress Available:  no
 * Requires License:    no
 */

defined( 'ABSPATH' ) || exit;

/**
 * DEFINE PATHS
 */
define( 'MNT_PATH', plugin_dir_path( __FILE__ ) );
/*define( 'MNT_CLASSES_PATH', MNT_PATH . 'includes/classes/' );
define( 'MNT_FUNCTIONS_PATH', MNT_PATH . 'includes/functions/' );
define( 'MNT_LANGUAGES_PATH', basename( MNT_PATH ) . '/languages/' );
define( 'MNT_VIEWS_PATH', MNT_PATH . 'views/' );
define( 'MNT_CSS_PATH', MNT_PATH . 'assets/css/' );
*/

/*
 * Add the admin page
 */
add_action('admin_menu', 'maintenance_admin_page');
function maintenance_admin_page(){
    add_menu_page('maintenance Settings', 'Maintenance Settings', 'administrator', 'maintenance-settings', 'maintenance_admin_page_callback');
}

/*
 * Register the settings
 */
add_action('admin_init', 'maintenance_register_settings');
function maintenance_register_settings(){
    //this will save the option in the wp_options table as 'maintenance_settings'
    //the third parameter is a function that will validate your input values
    register_setting('maintenance_settings', 'maintenance_settings', 'maintenance_settings_validate');
}

function maintenance_settings_validate($args){
    //$args will contain the values posted in your settings form, you can validate them as no spaces allowed, no special chars allowed or validate emails etc.
    /*echo "<pre>";
    print_r($args);
    echo "</pre>";
    if(!isset($args['maintenance_enable']) || !is_email($args['maintenance_enable'])){
        //add a settings error because the email is invalid and make the form field blank, so that the user can enter again
        $args['maintenance_enable'] = '';
    add_settings_error('maintenance_settings', 'maintenance_invalid_email', 'Please enter a valid email!', $type = 'error');   
    }*/

    //make sure you return the args
    return $args;
}

//Display the validation errors and update messages
/*
 * Admin notices
 */
add_action('admin_notices', 'maintenance_admin_notices');
function maintenance_admin_notices(){
  	settings_errors();
}

//The markup for your plugin settings page
function maintenance_admin_page_callback(){ ?>
    <div class="wrap">
    <h2>maintenance Settings</h2>
    <form action="options.php" method="post"><?php
        settings_fields( 'maintenance_settings' );
        do_settings_sections( __FILE__ );

        //get the older values, wont work the first time
        $options = get_option( 'maintenance_settings' ); 

        wp_enqueue_style( 'wp-color-picker');
        wp_enqueue_script( 'wp-color-picker');

        ?>
        <table class="form-table">
            <tr>
                <th scope="row">Enable/Disable</th>
                <td>
                    <fieldset>
                        <label>
                            <input name="maintenance_settings[maintenance_enable]" type="checkbox" id="maintenance_enable" value="1" <?php echo (isset($options['maintenance_enable']) && $options['maintenance_enable'] == '1') ? 'checked' : ''; ?>/>                            
                            <span class="description">Enable Maintenance Site .</span>
                        </label>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">Title</th>
                <td>
                    <fieldset>
                        <label>
                            <input name="maintenance_settings[mm_title]" type="text" id="mm_title" value="<?php echo (isset($options['mm_title']) && $options['mm_title'] != '') ? $options['mm_title'] : ''; ?>" />                            
                            <span class="description"></span>
                        </label>
                        <input class="my-color-field" type="text" name="maintenance_settings[font_color]" value="<?php echo (isset($options['font_color']) && $options['font_color'] != '') ? $options['font_color'] : ''; ?>" data-default-color="#effeff" />
                    </fieldset>
                </td>
            </tr>
            <script type="text/javascript">
                jQuery(document).ready(function($){
                    $('.my-color-field').wpColorPicker();
                });
            </script>
            <tr>
                <th scope="row">Background Image</th>
                <?php
                wp_enqueue_script('jquery');
                // This will enqueue the Media Uploader script
                wp_enqueue_media();
                ?>
                <td>
                    <fieldset>
                        <label>
                            <input type="text" name="maintenance_settings[image_url]" id="image_url" class="regular-text" value="<?php echo (isset($options['image_url']) && $options['image_url'] != '') ? $options['image_url'] : ''; ?>">
                            <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload Image">      
                            <span class="description"></span>
                        </label>
                    </fieldset>
                    <script type="text/javascript">
                        jQuery(document).ready(function($){
                            $('#upload-btn').click(function(e) {
                                e.preventDefault();
                                var image = wp.media({ 
                                    title: 'Upload Image',
                                    // mutiple: true if you want to upload multiple files at once
                                    multiple: false
                                }).open()
                                .on('select', function(e){
                                    // This will return the selected image from the Media Uploader, the result is an object
                                    var uploaded_image = image.state().get('selection').first();
                                    // We convert uploaded_image to a JSON object to make accessing it easier
                                    // Output to the console uploaded_image
                                    console.log(uploaded_image);
                                    var image_url = uploaded_image.toJSON().url;
                                    // Let's assign the url value to the input field
                                    $('#image_url').val(image_url);
                                });
                            });
                        });
                    </script>
                </td>
            </tr>
            <tr>
                <th scope="row">Maintenace Description</th>
                <td>
                    <fieldset>
                        <label>
                            <!-- <textarea name="maintenance_settings[mm_description]" type="text" id="mm_description" value="" rows="4" cols="50"><?php echo (isset($options['mm_description']) && $options['mm_description'] != '') ? $options['mm_description'] : ''; ?></textarea> -->
                            <?php 
                                /*$post_id   = '';
                                $post      = get_post( $post_id, OBJECT, 'edit' );
                                $content   = $post->post_content;
                                $editor_id = 'editpost';
                                 
                                wp_editor( $content, $editor_id );*/
                                $user_custom_text = $options['user_cutom_text_msg'];
                                $settings  = array('textarea_rows' => 5,'textarea_name' => 'maintenance_settings[user_cutom_text_msg]');
                                wp_editor( $user_custom_text,'user_custom_text', $settings  ); 
                            ?>
                            <!-- <input name="maintenance_settings[mm_description]" type="text" id="mm_description" value="<?php //echo (isset($options['mm_description']) && $options['mm_description'] != '') ? $options['mm_description'] : ''; ?>" />    -->                         
                            <span class="description"></span>
                        </label>
                    </fieldset>
                    <input class="my-color-field" type="text" name="maintenance_settings[descripe_color]" value="<?php echo (isset($options['descripe_color']) && $options['descripe_color'] != '') ? $options['descripe_color'] : ''; ?>" data-default-color="#effeff" />
                </td>
            </tr>
            
        </table>
        <input type="submit" value="Save" />
    </form>
</div>
<?php }

function maintenance_mode() {
	$options = get_option( 'maintenance_settings' );
    $mm_title = $options['mm_title'];
    $font_color = $options['font_color'];
    $image_url = $options['image_url'];
    $user_cutom_text_msg = $options['user_cutom_text_msg'];
    $descripe_color = $options['descripe_color'];
    if ( isset($options['maintenance_enable']) && $options['maintenance_enable'] == '1' ) {
        nocache_headers();
        ob_start();
        ?>
            <!DOCTYPE html>
                <html>
                    <head>
                        <meta charset="UTF-8">
                        <title>Maintenance Mode</title>
                        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
                        
                        <?php
                        do_action( 'wm_head' ); // this hook will be removed in the next versions
                        do_action( 'wpmm_head' );

                        if (!empty($image_url)) {
                            $background = 'url(' . (!empty($image_url) ? $image_url : '') .')';
                        }else{
                            $background = '#8c8c8c';                            
                        }
                        ?>
                    </head>
                    <body class="background" style="background : <?php echo $background ?> ;background-size: cover;">
                        <?php do_action( 'wpmm_after_body' ); ?>

                        <div class="wrap">
                            <?php
                                if (!empty($mm_title)) {
                            ?> 
                                <h1 style="color:<?php echo (!empty($font_color) ? $font_color : '') ?>; font-size: 30px; font-weight: 700; margin: 0 0 90px;"><?php echo $mm_title; ?></h1>
                            <?php        
                                }

                                if (!empty($user_cutom_text_msg)) {
                            ?>
                            <div class="content-descrip" style="font-size: 24px; font-weight: 400; line-height: 45px; margin: 0 0 80px; color:<?php echo $descripe_color; ?>" >
                                <?php echo $user_cutom_text_msg ?>
                            </div>
                            <?php } ?>
                        </div>                       

                        <?php
                        do_action( 'wm_footer' ); // this hook will be removed in the next versions
                        do_action( 'wpmm_footer' );
                        ?>
                        <style type="text/css">
                            .wrap {
                                width: 605px;
                                margin: 100px auto 0;
                                text-align: center;
                            }
                        </style>
                    </body>
                </html>
        <?php
        ob_flush();
        exit();
    }
	/*
		wp_die('currently site is on maintenance mode');
	*/
}

add_action('get_header', 'maintenance_mode');


?>