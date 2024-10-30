<?php 
global $width, $height, $scroller_width, $scroller_height, $arrow_width, $color, $dial_bg_color, $arrow_position, $scroll_speed, $show_scroller_after, $dial_thickness,$show_at, $scroller_background_color, $design, $custom_image_url, $attachment_id, $custom_arrow_url, $arrow_attachment_id;
$arrowurl = $custom_arrow_url;
if( empty($arrowurl) ){
	$arrowurl = plugins_url( '/images/arrow-top.png' , __FILE__ );
} ?>	
	<div class="wrap">
        <h2>CG Scroll To Top Settings</h2>
		<ul class="tabs_cg">
			<li id="design" class="active">Design</li>
			<li id="settings" class="">Settings</li>
		</ul>
        <div class="contents">
			<div class="design tab_div">
				<form name="design_data" class="cg_options" method="POST" enctype="multipart/form-data">
					<div class="row">
						<h4>Filling Animated designs</h4>
						<div class="sample <?php if( $design == '1' || $design == ''){ echo "active"; }?>" >
							<div style="position:relative">								
								<input type="text" style="border:<?php echo ($dial_thickness*2.5);?>px solid <?php echo $color; ?>; border-left:<?php echo ($dial_thickness*2.5);?>px solid <?php echo $dial_bg_color;?>; border-radius:50px; width:<?php echo $width; ?>px; height: <?php echo $height; ?>px" disabled  />
								<img style="position:absolute;left: 0;right: 0;bottom: 0;top: 0;margin: auto;" width="<?php echo $arrow_width; ?>" src="<?php echo $arrowurl; ?>" />				
							</div>
							<div class="name">
								<label for="dial_filler">
									<input type="radio" <?php if( $design == '1' || $design == ''){ echo "checked"; }?> value="1" name="design" id="dial_filler">
									<span>Dial Filler</span>
								</label>
							</div>	
						</div>
					</div>	
					<hr>
					<div class="row">
						<h4>Simple Animated designs</h4>
						<div id="upload_custom_arrow" >
							<label>Upload custom arrow image</label>
							<input type="hidden" id="arrow_attachment_id" name="arrow_attachment_id" value="" />
							<input type="text" value="<?php echo $custom_arrow_url;?>" class="regular-text process_custom_arrow" id="process_custom_arrow" name="custom_arrow_url" />							
							<button class="set_custom_images button">Upload Arrow</button>
						</div>
						<div class="sample <?php if( $design == '2'){ echo "active"; }?>" >
							<div style="position:relative; text-align: center; margin:0 auto; width: 50px; ">
								<div style="background: <?php echo $scroller_background_color;?>; height:50px;">
									<img style="position:absolute;left: 0;right: 0;bottom: 0;top: 0;margin: auto;" width="<?php echo $arrow_width; ?>" src="<?php echo $arrowurl; ?>" />
								</div>
							</div>
							<div class="name">
								<label for="square">
									<input type="radio" <?php if( $design == '2'){ echo "checked"; }?> value="2" name="design" id="square">
									<span>Square</span>
								</label>
							</div>		
						</div>
						<div class="sample <?php if( $design == '3'){ echo "active"; }?>" >
							<div style="position:relative; text-align: center; margin:0 auto; width: 50px; ">
								<div style="background: <?php echo $scroller_background_color;?>; height:50px; border-radius: 10px; ">
									<img style="position:absolute;left: 0;right: 0;bottom: 0;top: 0;margin: auto;" width="<?php echo $arrow_width; ?>" src="<?php echo $arrowurl;?>" />
								</div>
							</div>
							<div class="name">
								<label for="rounded_square">
									<input type="radio" <?php if( $design == '3'){ echo "checked"; }?> value="3" name="design" id="rounded_square"><span>Rounded Square</span>
								</label>
							</div>								
						</div>
						<div class="sample <?php if( $design == '4'){ echo "active"; }?>" >
							<div style="position:relative; text-align: center; margin:0 auto; width: 50px; ">
								<div style="background: <?php echo $scroller_background_color;?>; height:50px; border-radius: 50%; ">
									<img style="position:absolute;left: 0;right: 0;bottom: 0;top: 0;margin: auto;" width="<?php echo $arrow_width; ?>" src="<?php echo $arrowurl; ?>" />
								</div>
							</div>
							<div class="name">
								<label for="circular">
									<input type="radio" <?php if( $design == '4'){ echo "checked"; }?> value="4" name="design" id="circular"><span>Circular</span>
								</label>
							</div>								
						</div>
					</div>
					<div class="row">
						<h4>Custom design</h4>
						<div class="sample custom_design_section <?php if( $design == 'custom'){ echo "active"; }?>" >
							<div style="position:relative; text-align: center; margin:0 auto; width: 50px; ">
								<?php if( !empty($custom_image_url) ){ ?>
									<div style="height:50px;">
										<img class="image" style="position:absolute;left: 0;right: 0;bottom: 0;top: 0;margin: auto; width:100%;" width="<?php echo $arrow_width; ?>" src="<?php echo $custom_image_url; ?>" />
									</div>		
								<?php }else{ ?>
									<div style="background: <?php echo $scroller_background_color;?>; height:50px;">
										<img class="image" style="position:absolute;left: 0;right: 0;bottom: 0;top: 0;margin: auto;" width="<?php echo $arrow_width; ?>" src="<?php echo plugins_url( '/images/arrow-top.png' , __FILE__ )?>" />
									</div>
								<?php }	?>
							</div>
							<div class="name">
								<label for="custom_design">
									<input type="radio" <?php if( $design == 'custom'){ echo "checked"; }?> value="custom" name="design" id="custom_design">
									<span>Custom</span>
								</label>
							</div>		
						</div>		
						<div id="upload_custom_image" <?php if($design == 'custom'){ echo "style='display:block;'";}else{ echo "style='display:none;'"; }?> >
							<input type="hidden" id="attachment_id" name="attachment_id" value="" />
							<input required type="text" value="<?php echo $custom_image_url;?>" class="regular-text process_custom_images" id="process_custom_images" name="custom_image_url" />							
							<button class="set_custom_images button">Upload Image</button>
						</div>						
					</div>
					<div class="full-width">
						<input type="submit" value="Save" />
						<input type="hidden" name="action" value="save_design_options" />
					</div>
				</form>	
			</div>
			<div class="settings tab_div" style="display: none">				
				<div class="form_content">
					<form class="cg_options" method="POST" enctype="multipart/form-data" >
						<div class="full-width">
							<div class="row"><h4>Filling Animated Settings</h4></div>
							<div class="col-md-3">
								<div class="label"><strong>Dial Height/Width</strong></div>
								<div class="input"><input type="text" name="width" value="<?php echo $width; ?>" placeholder="width in px" /></div>
							</div>	
							<div class="col-md-3">
								<div class="label"><strong>Dial Thickness</strong></div>
								<div class="input color-field"><input type="number" min="1" max="5" name="dial_thickness" value="<?php echo $dial_thickness; ?>" placeholder="Values upto 5"></div>
							</div>
							<div class="col-md-3">
								<div class="label"><strong>Dial Filling Color</strong></div>
								<div class="input color-field"><input type="text" name="filling_color" class="my-input-class" value="<?php echo $color; ?>"></div>
							</div>
						</div>	
						<div class="full-width">	
							<div class="col-md-3">
								<div class="label"><strong>Dial BG Color</strong></div>
								<div class="input color-field"><input type="text" name="dial_bg_color" class="my-input-class" value="<?php echo $dial_bg_color; ?>"></div>
							</div>
						</div>
						<div class="full-width">	
							<div class="row"><h4>General Settings</h4></div>
							<div class="col-md-3">
								<div class="label"><strong>Scroller Width/Height</strong></div>
								<div class="input"><input type="text" name="scroller_width" value="<?php echo $scroller_width; ?>" placeholder="width in px" /></div>
							</div>
							<div class="col-md-3">
								<div class="label"><strong>Scroller Background Color</strong></div>
								<div class="input color-field"><input type="text" name="scroller_background_color" class="my-input-class" value="<?php echo $scroller_background_color; ?>"></div>
							</div>
							<div class="col-md-3">
								<div class="label"><strong>Arrow Width</strong></div>
								<div class="input"><input type="text" name="arrow_width" value="<?php echo $arrow_width; ?>" placeholder="width in px" /></div>
							</div>
							
						</div>
						<div class="full-width">						
							<div class="col-md-3">
								<div class="label"><strong>Smooth Scroll Speed</strong></div>
								<div class="input"><input type="text" name="scroll_speed" value="<?php echo $scroll_speed; ?>" placeholder="Scrolling Speed" /></div>
							</div>
							<div class="col-md-3">
								<div class="label"><strong>Show Scroller After</strong></div>
								<div class="input"><input type="text" name="show_scroller_after" value="<?php echo $show_scroller_after; ?>" placeholder="Show after x height from top" /></div>
							</div>
							<div class="col-md-3">
								<div class="label"><strong>Arrow Position</strong></div>
								<div class="input radio">
									<input type="radio" name="arrow_position" <?php if( $arrow_position == 'right'){ echo "checked"; } ?> value="right" /><label>Right</label>
									<input type="radio" name="arrow_position" <?php if( $arrow_position == 'left'){ echo "checked"; } ?> value="left" /><label>Left</label>
								</div>
							</div>
						</div>		
									
						<div class="full-width">
													
						</div>
						<div class="full-width">
							<?php $args = array('public'   => true,'_builtin' => false);
							$output = 'objects';	$operator = 'or';
							$post_types = get_post_types( $args, $output, $operator ); ?>
							<div class="label"><strong>Display at Screens</strong></div>
							<ul>
							<?php foreach ( $post_types  as $post_type ) { ?>
									<li>
										<input <?php if( is_array($show_at) && in_array($post_type->name, $show_at)){ echo "checked";}?> type="checkbox" name="show_at[]" value="<?php echo $post_type->name;?>" />
										<?php echo $post_type->label;?>
									</li>
							<?php }	?>
							</ul>   
						</div>					
						<div class="full-width">
							<input type="submit" value="Save" />
							<input type="hidden" name="action" value="save_options" />
						</div>
					</form>
				</div>
			</div>	
				
		</div>
		<div class="credit">
			<div class="" style="text-align:center;">
				<p>You may show your appreciation and support future development by Donating!!!</p>
				<div class="donation_tabs">
					<a class="donate" target="_blank" href="https://www.paypal.me/ChandanGarg/1">Donate <b>$1</b></a>
					<a class="donate" target="_blank" href="https://www.paypal.me/ChandanGarg/2">Donate <b>$2</b></a>
					<a class="donate" target="_blank" href="https://www.paypal.me/ChandanGarg/3">Donate <b>$3</b></a>
					<a class="donate" target="_blank" href="https://www.paypal.me/ChandanGarg/5">Donate <b>$5</b></a>
					<a class="donate donate_more" target="_blank" href="https://www.paypal.me/ChandanGarg/"><b>DONATE MORE</b></a>
				</div>	
			</div>
		</div>
		<div class="credit">
			<div class="" style="text-align:center;">
				<h2>Developed By</h2>
				<a target="_blank" href="http://codersgod.com"><img height="150" src="http://codersgod.com/wp-content/uploads/2016/04/logo.svg" /></a>
			</div>
		</div>
    </div>