<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package accesspress_parallax
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<?php if(is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')) :?>
		<div class="top-footer footer-column-<?php echo accesspress_footer_count(); ?>">
			<div class="mid-content">
            <div class="top-footer-wrap clearfix">
				<?php if(is_active_sidebar('footer-1')): ?>
				<div class="footer-block">
					<?php dynamic_sidebar('footer-1'); ?>
				</div>
				<?php endif; ?>

				<?php if(is_active_sidebar('footer-2')): ?>
				<div class="footer-block">
					<?php dynamic_sidebar('footer-2'); ?>
				</div>
				<?php endif; ?>

				<?php if(is_active_sidebar('footer-3')): ?>
				<div class="footer-block">
					<?php dynamic_sidebar('footer-3'); ?>
				</div>
				<?php endif; ?>

				<?php if(is_active_sidebar('footer-4')): ?>
				<div class="footer-block">
					<?php dynamic_sidebar('footer-4'); ?>
				</div>
				<?php endif; ?> 
            </div>
			</div>
		</div>
		<?php endif; ?>
		

		<div class="bottom-footer">
			<div class="mid-content clearfix">
				<div  class="copy-right">
                	<span style="font-weight: bold;">Thanks for donation either Widecoin or Bitcoin</span><br />
                    <span style="font-weight: bold;">Widecoin</span> (WCN) : WcPNtDxj5UdwZ6JKb92pKFMQ43MboQ4py3<br />
                    <span style="font-weight: bold;">Bitcoin</span> (BTC)  : 1KgoViPr71NBqDzojepyt6SmSKncojwbs2<br />
					<a href="https://widecoin.org/donation/" target="_blank"><span style="font-weight: bold;">Donation with other currencies</span></a><br/>
					E-mail: support@widecoin.org <br />
					&copy; <?php echo date('Y')." "; bloginfo('name'); ?> 
				</div><!-- .copy-right -->
				<div class="footer-right-row">
					
					<div class="site-info site-info-ext-lng">
						<?php echo do_shortcode('[gtranslate]'); ?>
					</div>
					<div class="site-info">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</div>
					<div class="site-info site-info-ext-cmc">
						<a href="https://coinpaprika.com/coin/wcn-widecoin/" target="_blank"><img src="https://widecoin.org/wp-content/uploads/2021/05/coinpaprika_logo56x56.png"/></a>
					</div><!-- .site-info -->
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<div id="go-top"><a href="#page"><i class="fa fa-angle-up"></i></a></div>

<?php wp_footer(); ?>
</body>
</html>