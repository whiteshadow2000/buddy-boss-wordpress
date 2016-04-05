<?php
/**
 * buddyboss Cover Photo Functionality
 *
 * @package Boss
 */

 /**
 * This is the file that contains all function for crossover cover photo support.
 */
 
global $bb_cover_photo_support;
$bb_cover_photo_support = array("user","taxonomy","group","forum");
 
 /**
  * This function return the object val from given object and object_id
  * @param <string> $object mention for what you need cover eg. user,taxonomy,group
  * @param <int> $object_id ID of the object
  * @return <string> Object value of object.
  **/
 function buddyboss_cover_photo_get_object($object,$object_id) {
    global $bb_cover_photo_support;
    
    if(!in_array($object,$bb_cover_photo_support)) { //return nothing.
        return false;
    }
  
    //user
    if($object == 'user') {
      $user = get_userdata($object_id);
      if(empty($user)) { return false;  }
      return $user; 
    }
    
    //taxonomy
    if($object == 'taxonomy') {
        return '';
    }
    
    //group
    if($object == 'group') {
        $group = groups_get_group( array( 'group_id' => $object_id ) );
        if(empty($group)) { return false; }
        
        return $group;
    }
	
	//forum
	if($object == 'forum') {
        $forum = get_post( $object_id );
        if(empty($forum)) { return false; }
        
        return $forum;
    }
    
 }
 /**
  * This function return the object val from given object and object_id
  * @param <string> $object mention for what you need cover eg. user,taxonomy,group
  * @param <int> $object_id ID of the object
  * @return <string> Object value of object.
  **/
 function buddyboss_cover_photo_get($object,$object_id) {
    global $bb_cover_photo_support;
    
    if(!in_array($object,$bb_cover_photo_support)) { //return nothing.
        return false;
    }
    
    $attachment = null;
    
    //user
    if($object == 'user') {
        $meta = get_user_meta($object_id,"_bb_cover_photo",true);
        return (array) @$meta;
    }
    
    //taxonomy
    if($object == 'taxonomy') {
        return '';
    }
    
    //group
    if($object == 'group') {
        $meta = groups_get_groupmeta( $object_id, '_bb_cover_photo',true);
        return (array) @$meta;
    }
	
	//forum
	if($object == 'forum') {
        $meta = get_post_meta( $object_id, '_bb_cover_photo', true );
        return (array) @$meta;
    }
    
 }
 
 /**
  * This function will save cover settings into desire object location
  * @param <string> $object mention for what you need cover eg. user,taxonomy,group
  * @param <int> $object_id ID of the object
  * @return <string> Object value of object.
  **/
 function buddyboss_cover_photo_update($object,$object_id,$value) {
    global $bb_cover_photo_support;
    
    if(!in_array($object,$bb_cover_photo_support)) { //return nothing.
        return false;
    }
    
    //user
    if($object == 'user') {
        return update_user_meta($object_id,"_bb_cover_photo",$value);
    }
    
    //taxonomy
    if($object == 'taxonomy') {
        return '';
    }
    
    //group
    if($object == 'group') {
        return groups_update_groupmeta($object_id,"_bb_cover_photo",$value);
    }
	
	//fourm
    if($object == 'forum') {
        return update_post_meta($object_id, "_bb_cover_photo", $value);
    }
 }
 
 
 /*
  * This function return the html for cover photo.
  * @param <string> $object mention for what you need cover eg. user,taxonomy,group
  * @param <int> $object_id ID of the object
  * @return <string> html of cover pic.
  **/
 
 function buddyboss_cover_photo($object,$object_id) {
   
   //look if it need default stock or not.
   buddyboss_cover_photo_update_default($object,$object_id); //simple.
   
   $cover_photo = buddyboss_cover_photo_get($object,$object_id);
         
   if(!$cover_photo) { //its not a valid object.
        return '';
   }
  
    if(empty($cover_photo["attachment"])) { //return nothing.
        return buddyboss_no_cover_photo($object,$object_id); //return blank cover photo
    }
    
    $attachment = wp_get_attachment_image_src($cover_photo["attachment"],"boss-cover-image");
    
    if(empty($attachment)) { //return nothing.
        return buddyboss_no_cover_photo($object,$object_id); //return blank cover photo
    }
    
    $edit = '';
    $edit_button = '';
    if(buddyboss_cover_photo_can_edit($object,$object_id)) { 
      $edit = '
      <button class="update-cover-photo" title="'.__("Ideal size: 1050x320px","boss").'" id="update-cover-photo-btn"><i class="fa fa-camera"></i><div>'.__("Update Cover Photo","boss").'<i class="fa fa-spinner fa-spin" style="display:none"></i></div></button>
      <div class="progress"><span></span></div>
      ';
    }
    //final output.
    $return = '
    <div class="bb-cover-photo" data-obj="'.$object.'" data-objid="'.$object_id.'" data-nonce="'.wp_create_nonce( 'cover-photo-upload' ).'">
    '.$edit.'
    <div class="holder" style="background-image:url('.$attachment[0].')"></div>
    </div>';
    
    if(buddyboss_cover_photo_can_edit($object,$object_id)) {
      $return .= buddyboss_cover_photo_js();
    }
    
    return $return;
    
 }
 
 function buddyboss_no_cover_photo($object,$object_id){
      
   if(!buddyboss_cover_photo_can_edit($object,$object_id)) {
      return '<div class="bb-cover-photo no-photo"></div>';
   }
   
    return '
    <div class="bb-cover-photo no-photo" data-obj="'.$object.'" data-objid="'.$object_id.'">
      <button class="update-cover-photo" title="'.__("Ideal size: 1050x320px","boss").'" id="update-cover-photo-btn"><i class="fa fa-camera"></i><div> '.__("Update Cover Photo","boss").'<i class="fa fa-spinner fa-spin" style="display:none"></i></div></button>
      <div class="progress"><span></span></div>
    </div>'.
    buddyboss_cover_photo_js();
 }
 
 function buddyboss_cover_photo_can_edit($object,$object_id) {
    $can_edit = false;
   
    if($object == "user") {
      if($object_id == get_current_user_id()) {
         $can_edit = true;
      }
    }  
     
    if($object == "group") {
      if(groups_is_user_admin( get_current_user_id(), $object_id )){
         $can_edit = true;
      }
    }
    
    return $can_edit;
 }
 
 function buddyboss_cover_photo_js() {
   return "<script>
      jQuery('document').ready(function() {
         option = {
           flash_swf_url:'" . get_template_directory_uri() . "/js/plupload/Moxie.swf',
           uploader_xap_url:'" . get_template_directory_uri() . "/js/plupload/Moxie.xap',
           nonce:'".wp_create_nonce( 'cover-photo-upload' )."'
         };
         buddyboss_cover_photo(option);   
      });
   </script>";   
   
 }
 
 function buddyboss_cover_photo_js_vars($vars) {
   $vars["bb_cover_photo_failed_upload"] = __("Error uploading cover photo.","boss");
   return $vars;
 }
 
 add_filter("buddyboss_js_vars","buddyboss_cover_photo_js_vars");

 /*
  * Update the default cover photo
  * this will update the cover photo from stock images on the first time.
  */
 function buddyboss_cover_photo_update_default($object,$object_id) {
      
      $cover_photo = buddyboss_cover_photo_get($object,$object_id);
         
      if(!$cover_photo) { //its not a valid object.
           return false;
      }
      if(!@empty($cover_photo["last_update"])) { //looks if its first time or not.
           return false; 
      }                 
      //if its first time, let the magic happen!.
      
      $value = array();
      $value["attachment"] = buddyboss_cover_photo_get_stock_sample(); //get an stock attachment
      $value["last_update"] = gmdate("Y-m-d H:i:s");
      $value["is_stock"] = '1'; //mark it as stock
      buddyboss_cover_photo_update($object,$object_id,$value);
 }
 
 
 /*
  * Upload Stock Sample Attachment and return the ID.
  * @return <int> ID of attachment
  **/
function buddyboss_cover_photo_get_stock_sample() {
   global $buddyboss;
   
   $random_num = rand(1, 23); //currently we have 23 images.
   $random_num = apply_filters("buddyboss_photo_cover_random_stock_num",$random_num);
   
   //pick the random image
   $filename = $buddyboss->tpl_dir.'/images/cover-stocks/'.$random_num.".jpg";
   $filename = apply_filters("buddyboss_cover_photo_stock_pick_filename",$filename);
   
   // Check the type of file. We'll use this as the 'post_mime_type'.
   $filetype = wp_check_filetype( basename( $filename ), null );
   // Get the path to the upload directory.
   $wp_upload_dir = wp_upload_dir();
   
   //copy  it
   copy( $filename, $wp_upload_dir['path']  . '/' . basename($filename) );
   
   $filename = $wp_upload_dir['path']  . '/' . basename($filename); //new path
   
   // Prepare an array of post data for the attachment.
   $attachment = array(
           'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
           'post_mime_type' => $filetype['type'],
           'post_title'     => 'Cover Photo Stock Image',
           'post_content'   => '',
           'post_status'    => 'inherit'
   );
   
   // Insert the attachment.
   $attach_id = wp_insert_attachment( $attachment, $filename, 0 );
   require_once( ABSPATH . 'wp-admin/includes/image.php' );
   $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
   wp_update_attachment_metadata( $attach_id, $attach_data );
   
   return $attach_id;
}
 
/**
 * Uploading cover photo function
 **/
function buddyboss_cover_photo_upload() {
      global $bb_cover_photo_support;
      
      /*
      print_r($_POST);
      */
      
      $object = $_POST["object"];
      $object_id = (int) $_POST["object_id"];
      $nonce = $_POST["nonce"];
    
      if(!in_array($object,$bb_cover_photo_support)) { //return nothing.
         $return["error"] = __("Invalid request try again later.","boss");
         echo json_encode($return);
         exit;
      }
      
      $return = array();
      
      if(empty($object_id)) {
         $return["error"] = __("Invalid request try again later.","boss");
         echo json_encode($return);
         exit;
      }
      
      //security check
      if ( ! wp_verify_nonce( $nonce, 'cover-photo-upload' ) )  {
         $return["error"] = __("Security error try later again.","boss");
         echo json_encode($return);
         exit;
      }
      
      //check for permission
      if(!buddyboss_cover_photo_can_edit( $object , $object_id )) {
         $return["error"] = __("You don't have permission to update cover photo.","boss");
         echo json_encode($return);
         exit;
      }
      
      $get_object = buddyboss_cover_photo_get_object($object,$object_id);
      
      if(empty($get_object)) {
         $return["error"] = __("The section you uploading cover does not exists.","boss");
         echo json_encode($return);
         exit;
      }
      
      //now upload the cover photo.
      
      // These files need to be included as dependencies when on the front end.
      if ( ! function_exists( 'wp_generate_attachment_metadata' ) )
      {
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
        require_once(ABSPATH . "wp-admin" . '/includes/media.php');
      }
      
      if ( ! function_exists('media_handle_upload' ) )
      {
        require_once(ABSPATH . 'wp-admin/includes/admin.php');
      }
      
      $aid = media_handle_upload( 'file', 0 );
    
      $attachment = get_post( $aid );
        
      if ( !empty($attachment) )
      {
        //delete old attachment
        $get_old = buddyboss_cover_photo_get($object,$object_id);
        if(!empty($get_old)) { //if not empty then delete old 
            if(!@empty($get_old["attachment"])) {
               wp_delete_attachment( $get_old["attachment"], true ); 
            }            
        }
        
        //update the attachment
        $value = array();
        $value["attachment"] = $aid;
        $value["last_update"] = gmdate("Y-m-d H:i:s");
        buddyboss_cover_photo_update($object,$object_id,$value);
        
        $url_nfo = wp_get_attachment_image_src( $aid, 'boss-cover-image' );
        $return["success"] = __("Cover photo is successfully updated.","boss");
        $return["image"] = $url_nfo[0];
        echo json_encode($return);
        exit;
      } else {
         $return["error"] = __("Error while uploading the cover photo, try later again.","boss");
         echo json_encode($return);
         exit;         
      }     
}

add_action( 'wp_ajax_buddyboss_cover_photo', 'buddyboss_cover_photo_upload' );
add_action( 'wp_ajax_nopriv_buddyboss_cover_photo', 'buddyboss_cover_photo_upload' );
 
?>