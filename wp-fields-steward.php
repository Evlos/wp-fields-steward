<?php
/**
 * @package WP-Fields-Steward
 * @version 1.0.0
 */
/*
Plugin Name: WP-Fields-Steward
Plugin URI: https://github.com/Evlos/WP-Fields-Steward/
Description: Wordpress plugin works on outputing media content from custom fields in specified position.
Version: 1.0.0
Author: Evlos
Author URI: http://chaosoverflow.com/
License: GPLv2 or later
*/

function FS_adding_box_post($post) {
    add_meta_box('my-meta-box', __('WP-Fields-Steward'), 'FS_render_box', 'post', 'normal', 'default');
}
function FS_adding_box_page($post) {
    add_meta_box('my-meta-box', __('WP-Fields-Steward'), 'FS_render_box', 'page', 'normal', 'default');
}
function FS_render_box($post, $metabox) {
	$data = get_post_meta($post->ID, 'FS_source', true);
	?>
	<div id="fields_steward_tips" style="display: none;">
		<p><strong>Example:</strong></p>
		<p>http://www.youtube.com/watch?v=0lPgJfvskig</p>
		<p>http://localhost/wp-content/uploads/2014/01/14372.jpg</p>
		<p><strong>Then run wp_fields_steward() at anywhere.</strong></p>
	</div>
	<textarea name="fields_steward" id="fields_steward" placeholder="Paste here."><?php echo $data; ?></textarea>
	<script type="text/javascript">
	(function() {
		var tips = jQuery("#fields_steward_tips");
		tips.css({"padding": "5px 24px 10px", "background": "#fafafa"});
		
		var textarea = jQuery("#fields_steward");
		textarea.css({"height": "120px", "width": "100%", "border": "none", "padding": "12px", "box-shadow": "none"});
		textarea.parent().css({"margin": "0", "padding": "0", "line-height": "0"});
		textarea.parent().parent().find("h3").append(
			"<span id=\"fields_steward_sign\">(<span style=\"color: #0074a2;\">?</span>)</span>"
		);
		
		var sign = jQuery("#fields_steward_sign");
		sign.css({"cursor": "pointer", "padding": "0 0 0 8px"});
		sign.hover(function() {
			tips.stop(true, true).slideDown();
		}, function() {
			tips.stop(true, true).slideUp();
		});
	})();
	</script>
	<?php
}
add_action('add_meta_boxes_post', 'FS_adding_box_post');
add_action('add_meta_boxes_page', 'FS_adding_box_page');

function FS_process_data($post) {
	$source = $_POST['fields_steward'];
	$data = split("\n", $source);
	$meta = '';
	foreach ($data as $url) {
		if (preg_match('/youtube\.com\/watch/i', $url)) {
			$res = str_replace('http://www.youtube.com/watch?v=', '<iframe width="560" height="315" src="//www.youtube.com/embed/', $url);
			$res .= '" frameborder="0" allowfullscreen></iframe>';
		}
		else {
			$res = '<img src="'.$url.'" />';
		}
		$meta .= '<div class="fields_steward_object">'.$res.'</div>'."\n";
	}
	update_post_meta($post, 'FS_source', $source);
	update_post_meta($post, 'FS_html', $meta);
}
add_action('save_post', 'FS_process_data');

function wp_fields_steward($post) {
	echo get_post_meta($post, 'FS_html', true);
}
