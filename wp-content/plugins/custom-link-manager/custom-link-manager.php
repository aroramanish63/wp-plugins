<?php
/**
 * @package Custom Link Manager
 */
/*
Plugin Name: Custom Link Manager
Plugin URI: http://www.wordpress.org/
Description: This Plugin is used to create link under categories.
Version: 1.0
Author: Manish Arora
Author URI: http://www.wordpress.org/
License: GPLv2 or later
*/
/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

define('CUSTOM_LINK_MANAGER_VERSION', '1.0');
define('CUSTOM_LINK_MANAGER_PLUGIN_URL', plugin_dir_url( __FILE__ ));

include 'include/common-functions.php';

ob_start();

function custom_link_manager_install () {
   global $wpdb;
   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
   
  $tbl_name = $wpdb->prefix . "custom_linkcategory";
  $linktable_name = $wpdb->prefix . "custom_category_links";
   
    $sql = "          
            CREATE TABLE IF NOT EXISTS $linktable_name (
		  `id` int(20) NOT NULL AUTO_INCREMENT,
		  `cat_id` varchar(255) NOT NULL,
                  `link_name` varchar(255) NOT NULL,
                  `link_path` varchar(255) NOT NULL,
		   PRIMARY KEY (`id`)
		);
            ";
    $sql1 = "
CREATE TABLE IF NOT EXISTS $tbl_name (
                        `id` INT( 20 ) NOT NULL AUTO_INCREMENT ,
                        `cate_name` VARCHAR( 255 ) NOT NULL ,
                        `description` TEXT NOT NULL ,
                        PRIMARY KEY ( `id` )
                        ) ENGINE = InnoDB;         
";

   dbDelta( $sql );
   dbDelta( $sql1 );
}
 
// Drop table on uninstall or delete plugins

function custom_link_manager_uninstall_hook()
{
     global $wpdb;
     $table_name = $wpdb->prefix . "custom_linkcategory";
     $linktable_name = $wpdb->prefix . "custom_category_links";
     $wpdb->query("DROP TABLE IF EXISTS $table_name");
     $wpdb->query("DROP TABLE IF EXISTS $linktable_name");
}

register_activation_hook( __FILE__, 'custom_link_manager_install' );
register_uninstall_hook(__FILE__, 'custom_link_manager_uninstall_hook');

function custom_link_manager_admin_actions() {
	add_menu_page("Custom Link Manager", "Custom Link Manager", "8",__FILE__,"add_category",NULL);
        add_submenu_page( __FILE__,'View Links', 'View Links', '8', 'view_link_manager', 'view_link_manager' );
        add_submenu_page( __FILE__,'Add Links', '', '8', 'add_link_manager', 'add_link_manager' );
//        add_submenu_page( __FILE__,'Add Link', 'Add Link', '8', __FILE__,'add_link_manager',NULL );
//        add_submenu_page( __FILE__,'Add Property Images', 'Add Property Images', '8', 'add_property_image', 'add_property_image' );
}

add_action('admin_menu', 'custom_link_manager_admin_actions');

function add_category(){
    include 'include/add-categories.php';
    
    
}

function view_link_manager(){
    include 'include/view-link-manager.php';
}

function add_link_manager(){
    include 'include/custom-link-add.php';
}

function enqueue_scripts_styles_init() {
	wp_enqueue_script( 'ajax-script', plugin_dir_url( 'custom-link-manager/include/js/custom-link-category.js'), array('jquery'), 1.0 ); // jQuery will be included automatically
	// get_template_directory_uri() . '/js/script.js'; // Inside a parent theme
	// get_stylesheet_directory_uri() . '/js/script.js'; // Inside a child theme
	// plugins_url( '/js/script.js', __FILE__ ); // Inside a plugin
	wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) ); // setting ajaxurl
}
//add_action('init', 'enqueue_scripts_styles_init');
 
function ajax_action_stuff() {
	$catname = $_POST['cat_name'];
        $cat_desc = $_POST['cat_desc'];
	// doing ajax stuff
	global $wpdb;
        $tblname = $wpdb->prefix.'custom_linkcategory';
         $wpdb->insert($tblname,array('cate_name'=>$catname,'description',$cat_desc));
        echo 'ajax submitted';
	die(); // stop executing script
}
//add_action( 'wp_ajax_ajax_action', 'ajax_action_stuff' ); // ajax for logged in users
//  function property_add_style(){
//		// Register stylesheets
//		wp_register_style('property_style', plugins_url('properties/include/css/property.css'));
//		wp_enqueue_style('property_style');
//	}
//	add_action('init', 'property_add_style');

//function add_property(){
//    include 'include/property-form.php';
//}
//
//function add_property_image(){
//   include 'include/property-image.php';
// }
//
//add_action('admin_enqueue_scripts', 'my_admin_scripts');
// 
//function my_admin_scripts() {
//    if (isset($_GET['page']) && $_GET['page'] == 'add_property_image') {
//        wp_enqueue_media();
//        wp_register_script('my-admin-js', WP_PLUGIN_URL.'/properties/include/js/property.js', array('jquery'));
//        wp_enqueue_script('my-admin-js');
//    }
//}
//
//add_action('wp_head','property_front_style');
//
//function property_front_style(){
//    // Register stylesheets
//		wp_register_style('property_front_style', plugins_url('properties/include/css/property-front.css'));
//		wp_enqueue_style('property_front_style');
//                  wp_register_script('property-front-js', WP_PLUGIN_URL.'/properties/include/js/property-front.js', array('jquery'));
//        wp_enqueue_script('property-front-js');
//}
//
//
//function get_properties(){
//    global $wpdb;
//    $tblname = $wpdb->prefix.'properties';
//    $sql = "SELECT * FROM $tblname";
//    $results = $wpdb->get_results($sql);
//    if(is_array($results)){
//       return $results;
//    }
//    else{
//       return NULL; 
//    }
//}
//
//function get_property_image(){
//    global $wpdb;
//    $tblname = $wpdb->prefix.'property_image';
//    $sql = "SELECT * FROM $tblname";
//    $results = $wpdb->get_results($sql);
//    if(is_array($results)){
//       return $results;
//    }
//    else{
//       return NULL; 
//    }
//}
//
//function get_property_imagebyid($pid = 0){
//    global $wpdb;
//    $tblname = $wpdb->prefix.'property_image';
//    $sql = "SELECT * FROM $tblname WHERE property_id = $pid";
//    $results = $wpdb->get_results($sql);
//    if(is_array($results)){
//        foreach ($results as $result){
//            echo $result->image;
//        }
//    }
//    else{
//            return NULL; 
//    }
//}
//
//
//// Property  Search Form
//
//function property_search_form(){
//    
//   $search_form = '
// <div class="search-form">
//<div class="form-head-bg">
//<h1>Property Search</h1>
//</div>
//<div class="search">
//<div id="msg"></div>
//<form name="propertysearch" id="propertysearch" method="post" action="'.site_url().'/property-search/">
//<div class="search-left">
//<div class="search-input">
//<label class="labtext1">Reference Number :</label>
//<input name="refnumber" id="refnumber" type="text" class="input-field" />
//</div>
//<div class="propery-search-left">
//<label class="labtext1">Property Type :</label>
//  <select name="property_type" id="property_type" class="input-field">
//<option id="propertyTypesdefault" value=" ">--- Select ---</option>
//<option value="item1">item1</option>
//<option>item2</option>
//<option>item3</option>
//<option>item4</option>
//  </select>
//</div>
//<div class="propery-search-right">
//<label class="labtext1">Num. of Bedrooms :</label>
//  <select name="bed_num" id="bed_num" class="input-field">
//<option value=" ">---Num. Rooms---</option>
//<option value="1">1</option>
//<option value="2">2</option>
//<option value="3">3</option>
//<option value="4">4</option>
//<option value="5">5</option>
//<option value="6">6</option>
//<option value="7">7</option>
//<option value="8">8</option>
//  </select>
//</div>
//<div class="propery-search-left">
//<label class="labtext1">Rental Price :</label>
//  <select name="min_price" id="min_price" class="input-field">
//<option id="propertyTypesdefault" value=" ">--- Select Rental ---</option>
//<option>10000</option>
//<option>70000</option>
//<option>60000</option>
//<option>50000</option>
//<option>40000</option>
//<option>30000</option>
//  </select>
//</div>
//<div class="propery-search-right">
//<label class="labtext1">Maximum Price :</label>
//  <select name="max_price" id="max_price" class="input-field">
//<option value=" ">---Max Price---</option>
//<option>10000</option>
//<option>70000</option>
//<option>60000</option>
//<option>50000</option>
//<option>40000</option>
//<option>30000</option>
//
//  </select>
//</div>
//</div>
//<div class="search-right">
//<div class="propery-search-right">
//<label class="labtext1">Location :</label>
//  <select name="prolocation" id="prolocation" class="input-field">
//<option id="areaLevel_2default" value=" ">--- select location ---</option>
//<option>Aloha Golf </option>
//<option>Las Brisas Golf </option>
//<option>Los Naranjos Golf </option>
//<option>La Quinta Golf </option>
//<option>Nueva Andalucía </option>
//<option>Marbella </option>
//<option>Puerto Banús </option>
//<option>The Golden Mile </option>
//  </select>
//</div>
//<div class="radio">
//<div class="radio-one">
//<input name="rent" type="radio" value="rental" class="input-radio" />
//<label class="labtext1">Rent</label>
//</div>
//<div class="radio-two">
//<input name="rent" type="radio" value="selling" class="input-radio" />
//<label class="labtext1">For Sale</label>
//</div>
//</div>
//<div class="search-button">
//<input name="property_search" type="submit" id="property_search" class="search-inner" value="Search" />
//</div>
//</div>
//</form>
//</div>
//</div>';
//     
//   return $search_form;
//}
//
//add_shortcode('prosearchform','property_search_form');
//
//
//function check_image($pid = 0){
//    global $wpdb;
//    $tblname = $wpdb->prefix.'property_image';
//    $sql = "SELECT * FROM $tblname WHERE property_id = $pid";
//    $results = $wpdb->get_results($sql);
//    if(is_array($results)){
//        return 1;
//    }
//    else{
//        return 0; 
//    }
//}

?>