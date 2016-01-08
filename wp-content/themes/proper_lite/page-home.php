<?php
/**
Template Name: Home Page
 *
 * @package properlite
 */

get_header(); ?>


<section id="home-hero">

	<div class="hero-content-container">
    	<div class="hero-content animated fadeInUp delay">
        
        	<?php if ( get_theme_mod( 'properlite_home_title' ) ) : ?>
        		<h1><?php echo wp_kses_post( get_theme_mod( 'properlite_home_title' )); ?></h1>
            <?php endif; ?>
            
            <?php if ( get_theme_mod( 'properlite_home_central_logo' ) ) : ?>
                <img id= "featured-central-logo" src="<?php echo wp_kses_post( get_theme_mod( 'properlite_home_central_logo' )); ?>">
            <?php endif; ?>

            <?php if ( get_theme_mod( 'properlite_home_button_url' ) ) : ?>
             	<a href="<?php echo esc_url( get_page_link( get_theme_mod('properlite_home_button_url'))) ?>" class="featured-link"> 
            <?php endif; ?>
            
            	<?php if ( get_theme_mod( 'properlite_home_button_text' ) ) : ?> 
                	<button>
                        <?php echo esc_html( get_theme_mod( 'properlite_home_button_text' )); ?>
                    </button>
                <?php endif; ?>
                
            <?php if ( get_theme_mod( 'properlite_home_button_url' ) ) : ?>
            	</a> 
            <?php endif; ?> 
            
        </div><!-- .hero-content -->
    </div><!-- .hero-content-container -->     
    <?php if ( get_theme_mod( 'properlite_home_bg_image' ) ) : ?>
    	<div id="hero-background-1" data-parallax="scroll" data-image-src="<?php echo get_theme_mod( 'properlite_home_bg_image' ); ?>" data-z-index="1"></div>
    <?php endif; ?>
    <?php if ( get_theme_mod( 'properlite_home_bg_image2' ) ) : ?>
        <div id="hero-background-2" data-parallax="scroll" data-image-src="<?php echo get_theme_mod( 'properlite_home_bg_image2' ); ?>" data-z-index="1"></div>
    <?php endif; ?>  
    <?php if ( get_theme_mod( 'properlite_home_bg_image2' ) ) : ?>
        <div id="hero-background-3" data-parallax="scroll" data-image-src="<?php echo get_theme_mod( 'properlite_home_bg_image2' ); ?>" data-z-index="1"></div>
    <?php endif; ?>     
    
</section>


		<?php if ( get_theme_mod( 'active_hw_1' ) == '' ) : ?>
			<?php if ( is_active_sidebar('home-widget-area-one') ) : ?> 
            
            	<div class="home-widget home-widget-one shortcodes">
                	<div class="grid grid-pad">
                    	<div class="col-1-1">
                	
							<?php dynamic_sidebar('home-widget-area-one'); ?>
                	
                    	</div>
                    </div>
                </div><!-- .home-widget -->
                
			<?php endif; ?>
        <?php endif; ?>
            
            
        <?php if ( get_theme_mod( 'active_hw_2' ) == '' ) : ?>
        	<?php if ( is_active_sidebar('home-widget-area-two') ) : ?>
        
        		<div class="home-widget home-widget-two shortcodes">
                	<div class="grid grid-pad">
                    	<div class="col-1-1">
                	
							<?php dynamic_sidebar('home-widget-area-two'); ?>
                		
                        </div>
                	</div> 
                </div><!-- .home-widget -->
                
            <?php endif; ?>
        <?php endif; ?>
            
            
        <?php if ( get_theme_mod( 'active_hw_3' ) == '' ) : ?>
			<?php if ( is_active_sidebar('home-widget-area-three') ) : ?>
        
        		<div class="home-widget home-widget-three shortcodes">
                	<div class="grid grid-pad">
                    	<div class="col-1-1">
                	
							<?php dynamic_sidebar('home-widget-area-three'); ?> 
                	
                    	</div> 
                    </div>    
                </div><!-- .home-widget -->
                
            <?php endif; ?> 
        <?php endif; ?> 
            

<?php get_footer(); ?>
