<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package accesspress_parallax
 */
//ABCD
	$sections = of_get_option('parallax_section');

	if(!empty($sections)):
	foreach ($sections as $section) :
		$page = get_post( $section['page'] ); 
		$overlay = $section['overlay'];
		$image = $section['image'];
		$layout = $section['layout'];
		$category = $section['category']; 
		$googlemapclass = $layout == "googlemap_template" ? " google-map" : "";
	?>
	
	<?php if(!empty($section['page'])): ?>
		<section class="parallax-section clearfix<?php echo esc_attr($googlemapclass)." ".esc_attr($layout);  ?>" id="<?php echo "section-".absint($page->ID); ?>">
		<?php if(!empty($image) && $overlay != "overlay0") : ?>
			<div class="overlay"></div>
		<?php endif; ?>

		<?php if($layout != "googlemap_template") :?>
			<div class="mid-content">
		<?php endif; ?>
			<?php  
	            $query = new WP_Query( 'page_id='.$section['page'] );
	            while ( $query->have_posts() ) : $query->the_post();
	        ?>
				<?php 
				if($layout != "action_template" && $layout != "blank_template" && $layout != "googlemap_template"): ?>
					<h2><span><?php the_title(); ?></span></h2>

					<div class="parallax-content">
					<?php if(get_the_content() != "") : ?>
						<div class="page-content">
						<?php the_content(); ?>
						</div>
					<?php endif; ?>
					</div> 
				<?php endif; ?>
			<?php 
		        endwhile;    
	        ?>

					<?php 
						switch ($layout) {
							case 'default_template':
								$template = "layouts/default";
								break;

							case 'service_template':
								$template = "layouts/service";
								break;

							case 'team_template':
								$template = "layouts/team";
								break;

							case 'portfolio_template':
								$template = "layouts/portfolio";
								break;

							case 'testimonial_template':
								$template = "layouts/testimonial";
								break;

							case 'action_template':
								$template = "layouts/action";
								break;

							case 'blank_template':
								$template = "layouts/blank";
								break;

							case 'googlemap_template':
								$template = "layouts/googlemap";
								break;

							case 'blog_template':
								$template = "layouts/blog";
								break;
							
							default:
								$template = "layouts/default";
								break;
						}
					?>

					<?php include(locate_template($template."-section.php"));?>
        		
			<?php if($layout != "googlemap_template") :?>
			</div>
			<?php endif; ?>
		</section>
	<?php
	endif; 
	endforeach;
	else:
        get_template_part('demo');
	endif;