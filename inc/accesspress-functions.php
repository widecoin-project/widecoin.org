<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package accesspress_parallax
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function accesspress_parallax_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'accesspress_parallax_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function accesspress_parallax_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'accesspress_parallax_body_classes' );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function accesspress_parallax_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'accesspress_parallax_setup_author' );

//bxSlider Callback for do action
function accesspress_parallax_bxslidercb(){
		global $post;
		$accesspress_parallax = of_get_option('parallax_section');
		if(!empty($accesspress_parallax)) :
			$accesspress_parallax_first_page_array = array_slice($accesspress_parallax, 0, 1);
			$accesspress_parallax_first_page = $accesspress_parallax_first_page_array[0]['page'];
		endif;
		$accesspress_slider_category = of_get_option('slider_category');
		$accesspress_slider_full_window = of_get_option('slider_full_window') ;
		$accesspress_show_slider = of_get_option('show_slider') ;
		$accesspress_show_caption = of_get_option('show_caption') ;
		$accesspress_enable_parallax = of_get_option('enable_parallax');
		?>

		<?php if( $accesspress_show_slider == "yes" || empty($accesspress_show_slider)) : ?>
		<section id="main-slider" class="full-screen-<?php echo $accesspress_slider_full_window; ?>">

		<?php if(!empty($accesspress_parallax_first_page) && $accesspress_enable_parallax == 1): ?>
		<div class="next-page"><a href="<?php echo esc_url( home_url( '/' ) ); ?>#section-<?php echo esc_attr($accesspress_parallax_first_page); ?>"></a></div>
		<?php endif;
		
		if( !empty($accesspress_slider_category)) :

				$loop = new WP_Query(array(
						'cat' => $accesspress_slider_category,
						'posts_per_page' => -1
					));
					if($loop->have_posts()) : ?>

					<div class="bx-slider">
					<?php
					while($loop->have_posts()) : $loop-> the_post(); 
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false ); 
					$image_url = "";
					if($accesspress_slider_full_window == "yes") : 
						$image_url =  "style = 'background-image:url(".esc_url($image[0]).");'";
				    endif;
					?>
					<div class="main-slides" <?php echo $image_url; ?>>
					
					<?php if($accesspress_slider_full_window == "no") : ?>		
						<img src="<?php echo esc_url($image[0]); ?>">
					<?php endif; ?>
								
						<?php if($accesspress_show_caption == 'yes'): ?>
						<div class="slider-caption">
							<div class="mid-content">
								<div class="caption-title"><?php the_title();?></div>
								<div class="caption-description"><?php the_content();?></div>
							</div>
						</div>
						<?php endif; ?>
				
			        </div>
					<?php endwhile; ?>
					</div>
					<?php endif; ?>
			<?php else: ?>

            <div class="bx-slider">
				<div class="main-slides">
					<img src="<?php echo get_template_directory_uri(); ?>/images/demo/slider1.jpg" alt="slider1">
					<div class="slider-caption">
						<div class="mid-content">
							<h1 class="caption-title"><?php _e('Welcome to AccessPress Parallax!','accesspress-parallax'); ?></h1>
							<h2 class="caption-description">
							<p><?php _e('A full featured parallax theme - and its absolutely free!','accesspress-parallax'); ?></p>
							<p><a href="#"><?php _e('Read More','accesspress-parallax'); ?></a></p>
							</h2>
						</div>
					</div>
				</div>
						
				<div class="main-slides">
					<img src="<?php echo get_template_directory_uri(); ?>/images/demo/slider2.jpg" alt="slider2">
					<div class="slider-caption">
						<div class="ak-container">
							<h1 class="caption-title"><?php _e('Amazing multi-purpose parallax theme','accesspress-parallax'); ?></h1>
							<h2 class="caption-description">
							<p><?php _e('Travel, corporate, small biz, portfolio, agencies, photography, health, creative - useful for anyone and everyone','accesspress-parallax'); ?></p>
							<p><a href="#"><?php _e('Read More','accesspress-parallax'); ?></a></p>
							</h2>
							</div>
					</div>
				</div>
			</div>

			<?php  endif; ?>
		</section>
		<?php endif; ?>
<?php
}

add_action('accesspress_bxslider','accesspress_parallax_bxslidercb', 10);


//add class for parallax
function accesspress_is_parallax($class){
	$is_parallax = of_get_option('enable_parallax');
	if($is_parallax=='1' || is_page_template('home-page.php')):
		$class[] = "parallax-on"; 
	endif;
	return $class;
}

add_filter('body_class','accesspress_is_parallax');


//Dynamic styles on header
function accesspress_header_styles_scripts(){
	$sections = array();
	$sections = of_get_option('parallax_section');
	$favicon = of_get_option('fav_icon');
	$custom_css = of_get_option('custom_css');
	$slider_overlay = of_get_option('slider_overlay');
	$image_url = get_template_directory_uri()."/images/";
	$dyamic_style = "";
	echo "<link type='image/png' rel='icon' href='".esc_url($favicon)."'/>\n";
	echo "<style type='text/css' media='all'>"; 

	if(!empty($sections)){
	foreach ($sections as $section) {
		$dyamic_style .= "#section-".$section['page']."{ background:url(".$section['image'].") ".$section['repeat']." ".$section['attachment']." ".$section['position']." ".$section['color']."; background-size:".$section['size']."; color:".$section['font_color']."}\n";
		$dyamic_style .= "#section-".$section['page']." .overlay { background:url(".$image_url.$section['overlay'].".png);}\n";
	}
	}

	if($slider_overlay == "yes"){
		$dyamic_style .= "#main-slider .main-slides:after{display:none};";
	}
	echo esc_textarea($dyamic_style);
	echo esc_textarea($custom_css);

	echo "</style>\n"; 

	echo "<script>\n";
	if(of_get_option('enable_animation') == '1' && is_front_page()) : ?>
    jQuery(document).ready(function($){
       wow = new WOW(
        {
          offset:  200 
        }
      )
      wow.init();
    });
    <?php endif;
	echo "</script>\n";
}

add_action('wp_head','accesspress_header_styles_scripts');

function accesspress_footer_count(){
	$count = 0;
	if(is_active_sidebar('footer-1'))
	$count++;

	if(is_active_sidebar('footer-2'))
	$count++;

	if(is_active_sidebar('footer-3'))
	$count++;

	if(is_active_sidebar('footer-4'))
	$count++;

	return $count;
}


function accesspress_social_cb(){
	$facebooklink = of_get_option('facebook');
	$twitterlink = of_get_option('twitter');
	$google_pluslink = of_get_option('google_plus');
	$youtubelink = of_get_option('youtube');
	$pinterestlink = of_get_option('pinterest');
	$linkedinlink = of_get_option('linkedin');
	$flickrlink = of_get_option('flickr');
	$vimeolink = of_get_option('vimeo');
	$instagramlink = of_get_option('instagram');
	$skypelink = of_get_option('skype');
	?>
            <style>
        	.fa-discordapp:before{
				content: url('https://www.widecash.org/wp-content/uploads/discordapp.png');
				padding-top: 7px;
				display: block;
			}
			.fa-bitcointalk:before{
				content: url('https://www.widecash.org/wp-content/uploads/bitcointalk.png');
				padding-top: 7px;
				display: block;
			}
			.fa-widecashblock:before{
				content: url('https://www.widecash.org/wp-content/uploads/widecashblock.png');
				padding-top: 7px;
				display: block;
			}
			.fa-telegram:before{
				content: url('https://www.widecash.org/wp-content/uploads/telegram.png');
				padding-top: 7px;
				display: block;
			}
        </style>
	<div class="social-icons">
		<?php if(!empty($facebooklink)){ ?>
		<a href="<?php echo esc_url($facebooklink); ?>" class="facebook" data-title="Facebook" target="_blank"><i class="fa fa-facebook"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($twitterlink)){ ?>
		<a href="<?php echo esc_url($twitterlink); ?>" class="twitter" data-title="Twitter" target="_blank"><i class="fa fa-twitter"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($google_pluslink)){ ?>
		<a href="<?php echo esc_url($google_pluslink); ?>" class="gplus" data-title="Google Plus" target="_blank"><i class="fa fa-google-plus"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($youtubelink)){ ?>
		<a href="<?php echo esc_url($youtubelink); ?>" class="youtube" data-title="Youtube" target="_blank"><i class="fa fa-youtube"></i><span></span></a>
		<?php } ?>

		<?php //if(!empty($pinterestlink)){ ?>
		<!--<a href="<?php //echo esc_url($pinterestlink); ?>" class="pinterest" data-title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i><span></span></a>-->
		<?php //} ?>

		<?php if(!empty($linkedinlink)){ ?>
		<a href="<?php echo esc_url($linkedinlink); ?>" class="linkedin" data-title="Linkedin" target="_blank"><i class="fa fa-linkedin"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($flickrlink)){ ?>
		<a href="<?php echo esc_url($flickrlink); ?>" class="flickr" data-title="Flickr" target="_blank"><i class="fa fa-flickr"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($vimeolink)){ ?>
		<a href="<?php echo esc_url($vimeolink); ?>" class="vimeo" data-title="Vimeo" target="_blank"><i class="fa fa-vimeo-square"></i><span></span></a>
		<?php } ?>

		<?php if(!empty($instagramlink)){ ?>
		<a href="<?php echo esc_url($instagramlink); ?>" class="instagram" data-title="Instagram" target="_blank"><i class="fa fa-instagram"></i><span></span></a>
		<?php } ?>
		
		<?php if(!empty($skypelink)){ ?>
		<a href="<?php echo "skype:".esc_attr($skypelink) ?>" class="skype" data-title="Skype"><i class="fa fa-skype"></i><span></span></a>
		<?php } ?>
        <?php 
		//$widecashtelegram="https://t.me/joinchat/DHOEwg77MLiOeKGfObrZIQ";
		//if(!empty($widecashtelegram)){ ?>
		<!--<a href="<?php //echo esc_url($widecashtelegram); ?>" class="skype" data-title="Telegram" target="_blank"><i class="fa fa-telegram"></i><span></span></a>-->
		<?//php } ?>
        <?php 
		//$discord="https://discord.gg/kmHdnmZ";
		//if(!empty($discord)){ ?>
		<!--<a href="<?php //echo esc_url($discord); ?>" class="skype" data-title="Discordapp" target="_blank"><i class="fa fa-discordapp"></i><span></span></a>-->
		<?//php } ?>
        <?php 
		$bitcointalk="https://bitcointalk.org/index.php?topic=3734686";
		if(!empty($bitcointalk)){ ?>
		<a href="<?php echo esc_url($bitcointalk); ?>" class="skype" data-title="Bitcointalk" target="_blank"><i class="fa fa-bitcointalk"></i><span></span></a>
		<?php } ?>
        <?php 
		$widecashblock="http://167.99.238.97:5001";
		if(!empty($widecashblock)){ ?>
		<a href="<?php echo esc_url($widecashblock); ?>" class="skype" data-title="Widecash Block Explorer" target="_blank"><i class="fa fa-widecashblock"></i><span></span></a>
		<?php } ?>

	</div>

	<script>
	jQuery(document).ready(function($){
		$(window).resize(function(){
			 var socialHeight = $('.social-icons').outerHeight();
			 $('.social-icons').css('margin-top',-(socialHeight/2));
		}).resize();
	});
	</script>
<?php
}
add_action('accesspress_social','accesspress_social_cb', 10);

function accesspress_remove_page_menu_div( $menu ){
    return preg_replace( array( '#^<div[^>]*>#', '#</div>$#' ), '', $menu );
}
add_filter( 'wp_page_menu', 'accesspress_remove_page_menu_div' );

function accesspress_customize_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'accesspress_customize_excerpt_more');

function accesspress_word_count($string, $limit) {
	$words = explode(' ', $string);
	return implode(' ', array_slice($words, 0, $limit));
}

function accesspress_letter_count($content, $limit) {
	$striped_content = strip_tags($content);
	$striped_content = strip_shortcodes($striped_content);
	$limit_content = mb_substr($striped_content, 0 , $limit );

	if( strlen($limit_content) < strlen($content) ){
		$limit_content .= "..."; 
	}
	return $limit_content;
}



function accesspress_register_string(){
	if(function_exists('pll_register_string')){
		$home_text = of_get_option('home_text');
		pll_register_string('Menu: Home Text', $home_text ,'Theme Option Text');
	}
}

add_action('after_setup_theme','accesspress_register_string');
