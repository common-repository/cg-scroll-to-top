(function( $ ) {
    $(function() {
        $('.color-field .my-input-class').wpColorPicker();		
		$('.design .full-width input[type="submit"]').on('click', function(){
			var cistyle = $('#upload_custom_image').attr('style');
			if( $('#upload_custom_image').css('display') == 'none' ){
				$('.process_custom_images').removeAttr('required');
			}else{
				$('.process_custom_images').attr('required');
			}			
		});
		$('.tabs_cg li').on('click', function(){
			var id = $(this).attr('id');
			$('.tabs_cg li').removeClass('active');
			$(this).addClass('active');
			$('.contents .tab_div').hide();
			$('.contents .'+id).show();
		});
		$('.cg_options .sample input').on('click', function(){
			$('.cg_options .sample').removeClass('active');
			$(this).parent().parent().parent().addClass('active');			
			if( $(this).attr('id') == 'custom_design' ){
				$('#upload_custom_image').show();
			}else{
				$('#upload_custom_image').hide();
			}			
		});		
		if ( jQuery('.set_custom_images').length > 0) {
			if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
				jQuery(document).on('click', '.set_custom_images', function(e) {
					e.preventDefault();
					var button = $(this);
					var id = button.prev();
					wp.media.editor.send.attachment = function(props, attachment) {
						var data = '<img style="position:absolute;left: 0;right: 0;bottom: 0;top: 0;margin: auto;" src="'+attachment.url+'" />';
						jQuery('.custom_design_section .image').html(data);
						id.val(attachment.url);						
					};
					wp.media.editor.open(button);
					return false;
				});
			}
		}		
    });
})( jQuery );