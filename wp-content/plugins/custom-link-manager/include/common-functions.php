<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function count_links($cid=0){
    global $wpdb;
    if(is_numeric($cid)){
        $tblname = $wpdb->prefix."custom_category_links";
//        $sql = "SELECT COUNT(cat_id) AS links FROM $tblname WHERE cat_id = $cid";
        $catcount = $wpdb->get_results( "SELECT * FROM $tblname WHERE cat_id = $cid" );
        
            print_r($catcount);
           
        
    }
    
}

function get_cate(){
    global $wpdb;
        $tblname = $wpdb->prefix."custom_linkcategory";
//        $sql = "SELECT COUNT(cat_id) AS links FROM $tblname WHERE cat_id = $cid";
        $cats = $wpdb->get_results( "SELECT * FROM $tblname" );
        if(is_array($cats)){
            return $cats;
        }
        else{
            return NULL;
        }
        
}

function get_tlinkcatname($cids){
    if(!is_array($cids)){
        $carr = unserialize($cids);
        if(is_array($carr)){
            foreach($carr as $cid){
                echo get_namecate_link($cid);
            }
        }
    }
}

function get_namecate_link($id=0){
     global $wpdb;
        $tblname = $wpdb->prefix."custom_linkcategory";
//        $sql = "SELECT COUNT(cat_id) AS links FROM $tblname WHERE cat_id = $cid";
        $cats = $wpdb->get_results( "SELECT cate_name FROM $tblname WHERE id=$id" );
        if(is_array($cats)){
            foreach($cats as $name){
                echo $name->cate_name.',';
            }
        }
        else{
            return NULL;
        }
}
?>
