<?php
/*
Plugin Name: CG Scroll To Top
Plugin URI: http://codersgod.com/
Description: A Fancy Scroll to Top with lot's of effects.
Version: 3.5
Author: Chandan Garg
Author URI: https://profiles.wordpress.org/chandan_garg_129/
License: GPLv2 or later
Text Domain: cg-scroll-to-top
*/

/* Runs when plugin is activated */
register_activation_hook(__FILE__,'cg_scroll_to_top_register'); 
function cg_scroll_to_top_register() {
	$option_name = 'cg_stt_options' ;
	$option_design_name = 'cg_stt_design_options' ;
	$data = array();
		$data['width'] = '52';
		$data['height'] = '52';
		$data['color'] = '#00539b';
		$data['dial_bg_color'] = '#EEEEEE';
		$data['arrow_width'] = '15';
		$data['arrow_position'] = 'right';
		$data['scroll_speed'] = '700';
		$data['show_scroller_after'] = '100';
		$data['dial_thickness'] = '1';
		$data['show_at'] = '';
		$data['scroller_background_color'] = '#EEEEEE';
		$data['scroller_width'] = '40';
		/* new data field for design */
		$data_design['design'] = '1';
		$data_design['attachment_id'] = '';
		$data_design['custom_image_url'] = '';
		$data_design['custom_arrow_url'] = '';		
		$data_design['arrow_attachment_id'] = '';
		
		$deprecated = null;
		$autoload = 'no';
		add_option( $option_name, $data, $deprecated, $autoload );
		add_option( $option_design_name, $data_design, $deprecated, $autoload );
}

/* Runs on plugin deactivation*/
register_deactivation_hook( __FILE__, 'cg_scroll_to_top_deregister' );
function cg_scroll_to_top_deregister() {
	delete_option('cg_stt_options');
	delete_option('cg_stt_design_options');
}

if( isset($_REQUEST['action']) && !empty($_REQUEST['action']) ){
	
	if( $_REQUEST['action'] == 'save_design_options' ){
		$data = array();
		$data['design'] = $_REQUEST['design'];
		$data['attachment_id'] = $_REQUEST['attachment_id'];
		$data['custom_image_url'] = $_REQUEST['custom_image_url'];
		$data['arrow_attachment_id'] = $_REQUEST['arrow_attachment_id'];
		$data['custom_arrow_url'] = $_REQUEST['custom_arrow_url'];
		
		$option_name = 'cg_stt_design_options' ;		
		if ( get_option( $option_name ) !== false ) {
			update_option( $option_name, $data );
		} else {
			$deprecated = null;
			$autoload = 'no';
			add_option( $option_name, $data, $deprecated, $autoload );
		}
	}

	if( $_REQUEST['action'] == 'save_options' ){
		$data = array();
		$data['width'] = $_REQUEST['width'];
		$data['height'] = $data['width'];
		$data['color'] = $_REQUEST['filling_color'];
		$data['dial_bg_color'] = $_REQUEST['dial_bg_color'];
		$data['arrow_width'] = $_REQUEST['arrow_width'];
		$data['arrow_position'] = $_REQUEST['arrow_position'];
		$data['scroll_speed'] = $_REQUEST['scroll_speed'];
		$data['show_scroller_after'] = $_REQUEST['show_scroller_after'];	
		$data['dial_thickness'] = $_REQUEST['dial_thickness'];
		$data['show_at'] = serialize($_REQUEST['show_at']);
		$data['scroller_background_color'] = $_REQUEST['scroller_background_color'];
		$data['scroller_width'] = $_REQUEST['scroller_width'];
		
		$option_name = 'cg_stt_options' ;		
		if ( get_option( $option_name ) !== false ) {
			update_option( $option_name, $data );
		} else {
			$deprecated = null;
			$autoload = 'no';
			add_option( $option_name, $data, $deprecated, $autoload );
		}	
	}
}
add_action( 'init', 'cg_stt_theme_name_scripts' );
function cg_stt_theme_name_scripts() {
	wp_enqueue_style( 'custom_style', plugins_url( '/css/cg-style.css' , __FILE__ ) );
	wp_enqueue_script( 'custom_script_1', plugins_url( '/js/cg-knob.js' , __FILE__ ), array(), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'cg_stt_add_color_picker' );
function cg_stt_add_color_picker( $hook ) {
    if( is_admin() ) {
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'cg-custom-script-handle', plugins_url( 'js/cg-custom-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true ); 
    }
}
function cg_stt_hook_footer() {
	$option_name = 'cg_stt_options' ;
	$options_val = get_option($option_name);   
	global $height,$width, $arrow_position, $show_scroller_after, $scroll_speed, $dial_bg_color, $color, $dial_thickness, $scroller_background_color, $scroller_width;
	$width=$options_val['width'];
	$arrow_width=$options_val['arrow_width'];
	$height=$width;
	
	if( !empty($options_val['scroller_width'] ) ){
		$scroller_width=$options_val['scroller_width'];
		$scroller_height = $scroller_width;
	}
	if( empty($width) ){ $width = '52'; $height = '52';}
	$arrow_position=$options_val['arrow_position'];
	if( empty($arrow_position) ){ $arrow_position = 'right';}
	$color=$options_val['color']; 
	if( empty($color) ){ $color = '#00539b';}
	$dial_bg_color=$options_val['dial_bg_color'];
	if( empty($dial_bg_color) ){ $dial_bg_color= '#EEEEEE';}
	
	$scroll_speed = $options_val['scroll_speed'];
	/*if( empty($scroll_speed) ){ $scroll_speed = '700';}*/
	$show_scroller_after = $options_val['show_scroller_after']; 
	if( empty($show_scroller_after) ){ $show_scroller_after = '100';}
	$dial_thickness = $options_val['dial_thickness'];
	if( empty($dial_thickness) ){ $dial_thickness = '1';}
	$show_at = maybe_unserialize($options_val['show_at']);
	if( empty($show_at) ){	$show_at = array('post','page'); }
	$current_post_type = get_post_type();
	$scroller_background_color= '#EEEEEE';
	if( !empty($options_val['scroller_background_color']) ){
		$scroller_background_color=$options_val['scroller_background_color'];
	}	
	
	$option_name = 'cg_stt_design_options';
	$options_design_val = get_option($option_name); 
	$design_val = $options_design_val['design'];
	$design_custom_image_url = $options_design_val['custom_image_url'];
	$arrowurl = $options_design_val['custom_arrow_url'];	
	if( empty($arrowurl) ){
		$arrowurl = plugins_url( '/images/arrow-top.png' , __FILE__ );
	}	
	
	if( is_array($show_at) && in_array($current_post_type, $show_at) && ( $design_val == '1' || $design_val == '') ){	?>
		<div class="footer-progress-bar cganimateddesign" style="bottom:<?php echo $width;?>px;">
			<div class="customdesign" style="width:<?php echo $width; ?>px; height: <?php echo $height; ?>px;">
				<canvas style="width:<?php echo $width; ?>px; height: <?php echo $height; ?>px"></canvas>
				<input type="text" class="dial" readonly style="">
				<a href="javascript: void(0);" class="btn-top"><img width="<?php echo $arrow_width; ?>" src="<?php echo $arrowurl; ?>" /></a>
			</div>
			<?php include('cg-scroll-css-jquery.php');?>
		</div>
	<?php }else if( is_array($show_at) && in_array($current_post_type, $show_at) && $design_val == 'custom'){ ?>
		<div class="footer-progress-bar" style="<?php echo $arrow_position;?>: 10px; bottom: 10px; width: <?php echo $scroller_width; ?>px; height: <?php echo $scroller_width; ?>px;" >
			<a class="top" href="javascript: void(0);">
				<div class="frontcustomdesign" style="border-radius: <?php if( $design_val == '4'){ echo '50%';}else if( $design_val == '3'){ echo '10px';}else{ echo '0px';} ?>;">
					<img class="front_custom_image" width="<?php echo $arrow_width; ?>" src="<?php echo $design_custom_image_url;?>" />
				</div>
			</a>	
		</div>
		<script>
			var e = <?php echo $show_scroller_after; ?>,
				r = <?php echo $scroll_speed; ?>,
				a = jQuery(".btn-top"),
				l = jQuery(".dial"),
				o = jQuery(".footer-progress-bar");
			jQuery(window).scroll(function() {
				jQuery(this).scrollTop() > e ? o.addClass("is-visible") : o.removeClass("is-visible");
			});
			jQuery('.footer-progress-bar .top').on("click", function(e) {
				e.preventDefault(), jQuery("body,html").animate({
					scrollTop: 0
				}, r)
			});;
		</script>
	<?php }else{ 
		if( is_array($show_at) && in_array($current_post_type, $show_at) ){ ?>
			<div class="footer-progress-bar" style="<?php echo $arrow_position;?>: 10px; bottom: 10px; width: <?php echo $scroller_width; ?>px; height: <?php echo $scroller_width; ?>px;" >
				<a class="top" href="javascript: void(0);">
					<div class="simpledesign" style="border-radius: <?php if( $design_val == '4'){ echo '50%';}else if( $design_val == '3'){ echo '10px';}else{ echo '0px';} ?>; background: <?php echo $scroller_background_color;?> none repeat scroll 0% 0%;">
						<img class="front_arrow" width="<?php echo $arrow_width; ?>" src="<?php echo $arrowurl; ?>" />
					</div>
				</a>	
			</div>
			<script>
				var e = <?php echo $show_scroller_after; ?>,
					r = <?php echo $scroll_speed; ?>,
					a = jQuery(".btn-top"),
					l = jQuery(".dial"),
					o = jQuery(".footer-progress-bar");
				jQuery(window).scroll(function() {
					jQuery(this).scrollTop() > e ? o.addClass("is-visible") : o.removeClass("is-visible");
				});
				jQuery('.footer-progress-bar .top').on("click", function(e) {
					e.preventDefault(), jQuery("body,html").animate({
						scrollTop: 0
					}, r)
				});;
			</script>
	<?php } }
}
add_action( 'wp_footer', 'cg_stt_hook_footer' ); 
add_action( 'admin_menu', 'cg_stt_custom_admin_menu' ); 
function cg_stt_custom_admin_menu() {
    add_options_page(
        'CG Scroll To Top',
        'CG Scroll To Top',
        'manage_options',
        'cg-scroll-to-top-plugin',
        'cg_scroll_to_top_options_page'
    );
}

/* code to add media button */
add_action ( 'admin_enqueue_scripts', function () {
    if (is_admin ())
        wp_enqueue_media ();
} );

function cg_scroll_to_top_options_page() {
	$option_name = 'cg_stt_options' ;
	$options_val = get_option($option_name);
	global $width, $height, $scroller_width, $scroller_height, $arrow_width, $color, $dial_bg_color, $arrow_position, $scroll_speed, $show_scroller_after, $dial_thickness,$show_at, $scroller_background_color, $design, $custom_image_url, $attachment_id, $custom_arrow_url, $arrow_attachment_id;
	$width = $options_val['width']; $height = $options_val['width'];
	if( !empty($options_val['scroller_width']) ){
		$scroller_width = $options_val['scroller_width']; 
		$scroller_height = $options_val['scroller_width'];
	}	
	if( empty($scroller_width) ){ $scroller_width = '40'; }
	$arrow_width=$options_val['arrow_width'];
	$color=$options_val['color'];
	$dial_bg_color = $options_val['dial_bg_color'];
	$arrow_position=$options_val['arrow_position'];
	$scroll_speed=$options_val['scroll_speed'];
	$show_scroller_after = $options_val['show_scroller_after'];
	$dial_thickness = $options_val['dial_thickness']; 
	$show_at = maybe_unserialize($options_val['show_at']);
	if( empty($show_at) ){ $show_at = array('post', 'page'); }
	$scroller_background_color = '#EEEEEE';
	if( !empty($options_val['scroller_background_color']) ){
		$scroller_background_color = $options_val['scroller_background_color'];
	}	
	$option_name = 'cg_stt_design_options';
	$options_design_val = get_option($option_name);
	$design = $options_design_val['design'];
	$attachment_id = $options_design_val['attachment_id'];
	$custom_image_url = $options_design_val['custom_image_url'];	
	$arrow_attachment_id = $options_design_val['arrow_attachment_id'];
	$custom_arrow_url = $options_design_val['custom_arrow_url'];	
	
	include('cg_scroll_to_top_backend.php'); 
	
}
?>