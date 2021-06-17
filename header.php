<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="UTF-8">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="fb:pages" content="103630105150174" />
    <?php 
        if($post->ID<>""){
            $stcontents=wp_trim_words(get_post_field('post_content', $post->ID),25,"..."); 
        }else{
            $stcontents="WCN is the digital crypto currency executing on secure block-chain technology which is allowed user to perform immediate cashless payment transaction via Web, Windows, Mac, Linux, Andriod and iOS wallet embedding with digital signature feature.";
        }
    ?>   
    <?php $fb_image = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID() ), 'thumnail'); ?>
    
	<meta property="fb:app_id" content="2858698304403973" />
	<meta property="fb:admins" content="100000431023858" />
	<meta property="og:title" content="<?php single_post_title(''); ?>" />
   	<meta property="og:image" content="<?php echo $fb_image[0]; ?>" />
   	<meta property="og:url" content="<?php the_permalink() ?>"/>
	<meta property="og:description" content="<?php echo wp_trim_words(get_post_field('post_content', $post->ID),25,"..."); ?>"/>
    <meta property="og:site_name" content="Widecoin (WCN)" />
    <meta property="og:type" content="website" />
    
    
    <meta name="Content-Type-Script" content="text/javascript" />
	<meta name="Content-Type-Style" content="text/css" />
    <link rel="image_src" href="<?php echo $fb_image[0]; ?>" />
	<meta name="description" content="<?php echo $stcontents; ?>" />
    

<meta name="keywords" content=Widecoin Digtial Currency WCN Crypto Currency" />	
	
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
<![endif]-->

<?php wp_head();  ?>
																			 
																			
																			 
<script src='https://www.google.com/recaptcha/api.js'></script>
																			 
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119129204-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-119129204-3');
</script>
															  
</head>
<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";                                                            
   $sturl = explode('/', $actual_link);
   $strbase = $sturl[3];
?>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php if ($strbase!="questions") {?>							 
	<header id="masthead" class="<?php echo of_get_option('header_layout'); ?>">
		<div class="mid-content clearfix">
        
        <div class="flex-box">
		
		<div id="site-logo">
		<?php if ( get_header_image() ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>">
		</a>
		<?php else:?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		<?php endif; ?>
		</div>

		<nav id="site-navigation" class="main-navigation">
		<div class="menu-toggle">
								
								<?php _e( 'Menu', 'accesspress-parallax' ); ?></div>
									 
			<?php 
			$sections = of_get_option('parallax_section');
			if((of_get_option('enable_parallax') == 1 && of_get_option('enable_parallax_nav') == 1) || (is_page_template('home-page.php') && of_get_option('enable_parallax_nav') == 1)):
			?>
			<ul class="nav single-page-nav">
				<?php
				$home_text = of_get_option('home_text');
				if(of_get_option('show_slider')== "yes" && !empty($home_text)) : 
					if(function_exists('pll__')){
						$home_text = pll__($home_text);
					}
					?>
					<li class="current"><a href="<?php echo esc_url( home_url( '/' ) ); ?>#main-slider"><?php echo esc_html($home_text); ?></a></li>
				<?php endif;
				
				if(!empty($sections)):
				foreach ($sections as $single_sections): 
					if($single_sections['layout'] != "action_template" && $single_sections['layout'] != "blank_template" && $single_sections['layout'] != "googlemap_template" && !empty($single_sections['page'])) :
						if(function_exists('pll_get_post')){
							$title_id = pll_get_post($single_sections['page']);
							$title = empty($title_id) ? get_the_title($single_sections['page']) : get_the_title($title_id);
						}else{
							$title = get_the_title($single_sections['page']); 
						}	
						?>
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#section-<?php echo $single_sections['page']; ?>"><?php echo esc_html($title); ?></a></li>
					<?php 
					endif;
				endforeach; 
				endif; ?>
			</ul>
			<?php	
			else: 
				wp_nav_menu( array( 
				'theme_location' => 'primary' , 
				'container'      => false
				) );
			endif; ?>
		
		</nav><!-- #site-navigation -->
	    
        </div>
		</div>
		

		<?php 
		if(of_get_option('show_social') == 1):
			do_action('accesspress_social');
		endif; ?>
	</header><!-- #masthead -->

	<?php 
	$accesspress_show_slider = of_get_option('show_slider') ;
	$content_class = "";
	if(empty($accesspress_show_slider) || $accesspress_show_slider == "no"):
		$content_class = "no-slider";
	endif;
	?>
	<div id="content" class="site-content <?php echo esc_attr($content_class); ?>">
    <?php }?>
	<?php 
	if(is_home() || is_front_page()) :
		// change slider
		do_action('accesspress_bxslider'); 
	endif;
	?>
    
