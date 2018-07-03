<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
			</div><!-- .container -->
		</div><!-- #main -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="container">
				<div class="row">
					<?php get_sidebar('footer') ?>
				</div>
			</div><!-- .container -->
		</footer><!-- #colophon -->
	</div><!-- #page -->


	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri() ?>/js/vendor/respond.min.js"></script>
	<![endif]-->

	<?php wp_footer() ?>
	
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-59PG65"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-59PG65');</script>
<!-- End Google Tag Manager -->
</body>
</html>