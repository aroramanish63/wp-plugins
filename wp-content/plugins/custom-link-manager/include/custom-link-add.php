<?php

// Add Links

?>
<?php 
global $wpdb;
if(isset($_POST['save_link'])){
    
  if(($_POST['linkm_name'] != '') && ($_POST['linkm_url'] != '') && ($_POST['link_cate'] != '')){
      $linkname = $_POST['linkm_name'];
      $linkm_url = $_POST['linkm_url'];
      if(is_array($_POST['link_cate'])){
         $link_cate = serialize($_POST['link_cate']);
      }
      
      $tblname = $wpdb->prefix.'custom_category_links';
//    $wpdb->insert($tblname, array('cate_name'=>$catname,'description',$catdescription));
      $wpdb->query( $wpdb->prepare( 
	"
		INSERT INTO $tblname
		( cat_id, link_name, link_path )
		VALUES ( %s, %s, %s )
	", 
        $link_cate,
        $linkname, 
	$linkm_url
) );
 $wpdb->show_errors(); ?>

    <div class="updated"><p><strong><?php _e('Link Added Successfully.'); ?></strong></p></div>
    
 <?php }
  else{ ?>
      <div class="updated"><p><strong><?php  _e('Validation Errors.'); ?></strong></p></div>
 <?php }
}
?>
<div class="wrap">
 
    <div id="icon-edit" class="icon32"></div>
    <h2>Add New Link</h2>
    
    <form id="addlinkm" action="" method="post" name="addlinkm">
        <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-2">
                <div id="post-body-content">
                    <div id="namediv" class="stuffbox">
                        <h3>
                            <label for="linkm_name">Name</label>
                        </h3>
                        <div class="inside">
                            <input id="linkm_name" type="text" value="" size="30" name="linkm_name">
                            <p>Example: Nifty blogging software</p>
                        </div>
                    </div>
                    <div id="addressdiv" class="stuffbox">
                    <h3>
                    <label for="linkm_url">Web Address</label>
                    </h3>
                    <div class="inside">
                    <input id="linkm_url" class="code" type="text" value="" size="30" name="linkm_url">
                    <p>
                    Example:
                    <code>http://wordpress.org/</code>
                    — don’t forget the
                    <code>http://</code>
                    </p>
                    </div>
                    </div>
                    <div id="linkcategorydiv" class="postbox ">
                        <h3 class="hndle">
                            <span>Categories</span>
                        </h3>
                        <div class="inside">
                            <?php $cate_res = get_cate(); 
                            if(is_array($cate_res)){
                                foreach($cate_res as $cate){ ?>
                                    <input type="checkbox" name="link_cate[]" value="<?php echo $cate->id; ?>" />
                                    &nbsp;<label><?php echo $cate->cate_name; ?></label><br/>
                               <?php }
                            }
                            else{
                                echo 'No Category found';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="postbox-container-1" class="postbox-container" style="float: right;
    width: 280px;">
                <div id="side-sortables" class="meta-box-sortables ui-sortable">
                    <div id="linksubmitdiv" class="postbox ">
                        <div class="handlediv" title="Click to toggle">
                        <br>
                        </div>
                        <h3 class="hndle">
                        <span>Save</span>
                        </h3>
                        <div class="inside">
                            <div id="submitlink" class="submitbox">
                                <div id="major-publishing-actions">
                                    <input id="save_link" class="button-primary" type="submit" value="Add Link" tabindex="4" name="save_link">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
