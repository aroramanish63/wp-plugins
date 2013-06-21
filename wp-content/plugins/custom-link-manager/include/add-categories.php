<?php 
global $wpdb;
if(isset($_POST['customsubmit'])){
  if($_POST['customcategory'] != ''){
      $catname = $_POST['customcategory'];
      $catdescription = $_POST['cat_desc'];
      $tblname = $wpdb->prefix.'custom_linkcategory';
//    $wpdb->insert($tblname, array('cate_name'=>$catname,'description',$catdescription));
      $wpdb->query( $wpdb->prepare( 
	"
		INSERT INTO $tblname
		( cate_name, description )
		VALUES ( %s, %s )
	", 
        $catname, 
	$catdescription
) );
 $wpdb->show_errors(); ?>

    <div class="updated"><p><strong><?php _e('Category Added Successfully.'); ?></strong></p></div>
    
 <?php }
  else{ ?>
      <div class="updated"><p><strong><?php  _e('Validation Errors.'); ?></strong></p></div>
 <?php }
}

 if (isset($_GET['delete_id'])) {
            $remove_attendee = (int)$_GET['delete_id'];
        } else {
                $remove_attendee = '';
        }

         if ($remove_attendee != '') {
             $tblname = $wpdb->prefix.'custom_linkcategory';
             
			$wpdb->query('DELETE FROM '.$tblname.' WHERE id = '.$remove_attendee);
			?>
            <div class="updated"><p><strong><?php _e('Category Removed.' ); ?></strong></p></div>
            <?php
		  }

?>
<div class="wrap">
    <div id="icon-edit" class="icon32"></div>
    <h2>
        Add Custom Link Categories
    </h2>
    <hr/>
    <div id="col-container">
        <div id="col-right">
            <div class="col-wrap">
                <table class="wp-list-table widefat fixed tags" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="manage-column column-name" style="" scope="col">Name</th>
                            <th class="manage-column column-name" style="" scope="col">Description</th>
                            <!--<th class="manage-column column-name" style="" scope="col">Links</th>-->
                            <th class="manage-column column-name" style="" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="the-list" class="list">
                        <?php 
                        $tblname = $wpdb->prefix.'custom_linkcategory';
                        $sql = "SELECT * FROM $tblname";
                        $results = $wpdb->get_results($sql);
                        
                        if(is_array($results)){ 
                            foreach ($results as $cat){
                            ?>
                        <tr>
                            <td><?php echo $cat->cate_name; ?></td>
                            <td><?php echo $cat->description; ?></td>
                            <!--<td><?php // count_links($cat->id); ?></td>-->
                            <td><a href="admin.php?page=custom-link-manager/custom-link-manager.php&delete_id=<?php echo $cat->id; ?>">Delete</a></td>
                        </tr>
                        <?php } }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="col-left">
            <div class="col-wrap">
                <div class="form-wrap">
                <form name="custom_category" id="custom_category" action="" method="post">
                    <div class="form-field">
                    <label for="customcategory">Category Name</label>
                    <input type="text" name="customcategory" id="customcategory" value="" />
                    </div>
                    <div class="form-field">
                    <label for="cat_desc">Description</label>
                    <textarea name="cat_desc" id="cat_desc"></textarea>
                    </div>
                    <p class="submit">
                    <input type="submit" name="customsubmit" id="customsubmit" value="Save" class="button-primary" />
                    </p>
                </form>
                </div>
        </div>
        </div>
    </div>
</div>