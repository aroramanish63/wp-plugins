<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

global $wpdb;
 if (isset($_GET['delete_id'])) {
            $remove_attendee = (int)$_GET['delete_id'];
        } else {
                $remove_attendee = '';
        }

         if ($remove_attendee != '') {
             $tblname = $wpdb->prefix.'custom_category_links';
             
			$wpdb->query('DELETE FROM '.$tblname.' WHERE id = '.$remove_attendee);
			?>
            <div class="updated"><p><strong><?php _e('Link Removed Successfully.' ); ?></strong></p></div>
            <?php
		  }

?>
<div class="wrap nosubsub">
    <div id="icon-link-manager" class="icon32">
    <br>
    </div>
    <h2>
    Links
    <a class="add-new-h2" href="admin.php?page=add_link_manager">Add New</a>
    </h2>
    <table class="wp-list-table widefat fixed bookmarks" cellspacing="0">
        <thead>
            <tr><th id="name" class="manage-column column-name" style="" scope="col">Name</th>
            <th id="url" class="manage-column column-url" style="" scope="col">Url</th>
            <th id="categories" class="manage-column column-categories" style="" scope="col">Categories</th>
            <th id="action" class="manage-column column-action" style="" scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="the-list">
            <?php 
            global $wpdb;
            $tbl_name = $wpdb->prefix.'custom_category_links';
            $sql = "SELECT * FROM $tbl_name";
             $results = $wpdb->get_results($sql);
             if(is_array($results)){
                 foreach($results as $result){ ?>
                    <tr><td><?php echo $result->link_name; ?></td> 
                    <td><?php echo $result->link_path; ?></td> 
                    <td><?php get_tlinkcatname($result->cat_id); ?></td>
                    <td><a href="admin.php?page=view_link_manager&delete_id=<?php echo $result->id; ?>">Delete</a></td>
               <?php  }
             }else{
                 echo "No Links found";
             }   
            
            ?>
        </tbody>
    </table>
</div>