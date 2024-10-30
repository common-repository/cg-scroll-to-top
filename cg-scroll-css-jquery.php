<?php global $height,$width, $arrow_position, $show_scroller_after, $scroll_speed, $dial_bg_color, $color, $dial_thickness;  ?>
<style>
.footer-progress-bar{ height: <?php echo $height;?>px;width: <?php echo $width;?>px; <?php echo $arrow_position;?>: 30px; }			
.btn-top {height: <?php echo $height;?>px;width: <?php echo $width;?>px;position: absolute;bottom: 0;text-align: center;text-decoration: none;background-size: 50%;top: 0;right: 0;left: 0;margin: auto;}
</style>
<script>
jQuery(document).ready(function() {
	jQuery("a[href*=#]:not([href=#])").click(function() {
		if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
			var e = jQuery(this.hash);
			if (e = e.length ? e : jQuery("[name=" + this.hash.slice(1) + "]"), e.length) return jQuery("html,body").animate({
				scrollTop: e.offset().top - 80
			}, 500), !1
		}
	});
	var e = <?php echo $show_scroller_after; ?>,
		r = <?php echo $scroll_speed; ?>,
		a = jQuery(".btn-top"),
		l = jQuery(".dial"),
		o = jQuery(".footer-progress-bar");
	l.knob({
		min: 0,
		max: 100,
		width: '<?php echo $width; ?>',
		height: '<?php echo $height; ?>',
		bgColor: '<?php echo $dial_bg_color; ?>',
		fgColor: '<?php echo $color; ?>',
		thickness: '.<?php echo $dial_thickness; ?>',
		displayInput: !1,
		displayPreview: !1,
		readOnly: !0
	}), jQuery(window).scroll(function() {
		jQuery(this).scrollTop() > e ? o.addClass("is-visible") : o.removeClass("is-visible");
		var r = jQuery(window).scrollTop(),
			a = jQuery(document).height(),
			l = jQuery(window).height();
			scrollPercent = r / (a - l) * 100, jQuery(".dial").val(scrollPercent).change(), r > 0 && jQuery("nav").addClass("scrolled fade"), 0 >= r && jQuery("nav").removeClass("scrolled fade")
	}), a.on("click", function(e) {
		e.preventDefault(), jQuery("body,html").animate({
			scrollTop: 0
		}, r)
	});
	jQuery('.dial').parent().attr('style','display:inline;width:<?php echo $width; ?>px;height:<?php echo $height; ?>px;position: absolute;left: 0;right: 0;top: 0;bottom: 0;margin: auto;');
});
</script>