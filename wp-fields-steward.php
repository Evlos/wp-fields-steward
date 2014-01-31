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

function adding_box_by_fields_steward($post) {
    add_meta_box( 
        'my-meta-box',
        __('WP-Fields-Steward'),
        'render_box_by_fields_steward',
        'post',
        'normal',
        'default'
    );
}
function render_box_by_fields_steward($post, $metabox) {
	?>
	<div id="fields_steward_tips" style="display: none;">
		<p><strong>Example:</strong></p>
		<p>http://www.youtube.com/watch?v=0lPgJfvskig</p>
		<p>http://localhost/wp-content/uploads/2014/01/14372.jpg</p>
	</div>
	<textarea name="fields_steward" id="fields_steward" placeholder="Paste here."></textarea>
	<script type="text/javascript">
	(function() {
		// Dirty code, will be tried to be improved later.
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
add_action('add_meta_boxes_post', 'adding_box_by_fields_steward');

function process_input_data() {

}
// http://www.youtube.com/watch?v=0lPgJfvskig
// <iframe width="560" height="315" src="//www.youtube.com/embed/0lPgJfvskig" frameborder="0" allowfullscreen></iframe>

function wp_fields_steward() {
	echo 'test';
}
