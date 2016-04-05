<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class="activity-comments buddyboss-media-form-wrapper" style="display:none">
	<form id="frm_buddyboss-media-tag-friends" method="POST" onsubmit="return buddyboss_media_tag_friends_complete();" class="standard-form">
		<input type="hidden" name="action" value="buddyboss_media_get_tags" >
		<input type="hidden" name="action_tag" value="buddyboss_media_tag_friends" >
		<input type="hidden" name="action_tag_complete" value="buddyboss_media_tag_complete" >
		<?php wp_nonce_field( 'buddyboss_media_tag_friends', 'buddyboss_media_tag_friends_nonce' );?>
		<input type="hidden" name="activity_id" value="">
		
		<div class="invite">
			<div class="left-menu">
				<div id="invite-list">
					<p class="preloading"></p>
				</div>
			</div>
		</div>
		<div class="field submit">
			<input type="submit" value="<?php _e( 'Done Tagging', 'buddyboss-media' );?>" > &nbsp; &nbsp;
			<a class='buddyboss_media_tag_friends_cancel' href='#' onclick='return buddyboss_media_tag_friends_close();'>
				<?php _e( 'Cancel', 'buddyboss-media' );?>
			</a>
		</div>
		<div id="message"></div>
	</form>
</div>