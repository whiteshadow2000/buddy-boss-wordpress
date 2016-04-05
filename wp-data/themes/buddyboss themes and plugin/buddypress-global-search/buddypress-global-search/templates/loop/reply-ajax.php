<div class="bboss_ajax_search_item bboss_ajax_search_item_reply">
	<a href="<?php echo esc_url(add_query_arg( array( 'no_frame' => '1' ), bbp_get_reply_url(get_the_ID()) )); ?>">
		<div class="item">
			<?php $forum_title = bbp_forum_title(get_the_ID());	?>
			<div class="item-title">
				<?php if ( $forum_title ) { echo $forum_title .'<br />'; } ?>
				<?php echo buddyboss_global_search_reply_intro( 10 );?>
			</div>
		</div>
	</a>
</div>