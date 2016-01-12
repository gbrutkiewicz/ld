<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after 
 *
 * @package properlite
 */
?>

	</div><!-- #content -->
    
    

	<footer id="colophon" class="site-footer" role="contentinfo">
    		 
			<?php if ( get_theme_mod( 'properlite_footer_logo' ) ) : ?>
 
                <!--<div class="site-logo2">               
                    <a  href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
                                       
                    </a>    
                </div>--><!-- site-logo -->                            
    			<div class="site-logo site-title">

                 
       				<a  href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
                    <!--<img class="site-left-logo" src='<?php echo esc_url( get_theme_mod( 'properlite_footer_logo_left' ) ); ?>' <?php if ( get_theme_mod( 'footer_logo_size_left' ) ) : ?>width="<?php echo esc_attr( get_theme_mod( 'footer_logo_size_left', '120' )); ?>"<?php endif; ?> alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">-->
                    <?php if ( get_theme_mod( 'footer_logo_size_left' ) ) : ?><!--<img class="site-left-logo" src='<?php echo esc_url( get_theme_mod( 'properlite_footer_logo_left' ) ); ?>' width="<?php echo esc_attr( get_theme_mod( 'footer_logo_size_left', '120' )); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">--><?php endif; ?>
                    <img src='<?php echo esc_url( get_theme_mod( 'properlite_footer_logo' ) ); ?>' <?php if ( get_theme_mod( 'footer_logo_size' ) ) : ?>width="<?php echo esc_attr( get_theme_mod( 'footer_logo_size', '120' )); ?>"<?php endif; ?> alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                    
                    </a> 
                    
    			</div><!-- site-logo -->
                
			<?php else : ?>
             
    			<hgroup>
       				<h1 class='site-title'>
                    
                    	<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
                        
							<?php bloginfo( 'name' ); ?>
                            
                    	</a>
                        
                    </h1><!-- .site-title --> 
    			</hgroup>
                
			<?php endif; ?>
            
        
        	<?php if ( get_theme_mod( 'properlite_footer_text' ) ) : ?> 
        		<p class="footer-text"><?php echo wp_kses_post( get_theme_mod( 'properlite_footer_text' )); ?></p><!-- footer info text --> 
            <?php endif; ?>
            
        
		<div class="site-info">
        
        	<?php if( get_theme_mod( 'active_social' ) == '') : ?> 
        
        		<?php if ( is_active_sidebar('social-widget-area') ) : ?>
                
					<div class="grid grid-pad">
        				<div class="col-1-1">
            				<?php dynamic_sidebar('social-widget-area');  ?>
						</div><!-- col-1-1 -->
        			</div><!-- grid -->
                    
            	<?php endif; ?>
        
        	<?php endif; ?>
        
        	<?php if( get_theme_mod( 'active_byline' ) == '') : ?>
            
				<?php if ( get_theme_mod( 'properlite_footerid' ) ) : ?> 
                
        			<?php echo wp_kses_post( get_theme_mod( 'properlite_footerid' )); // footer id ?>
                    
				<?php else : ?>
                
     <?php if ( is_active_sidebar('footer-cta') ) : ?>
    
        <div class="footer-cta"> 
            <div class="grid grid-pad">
                <div class="col-1-1">
                
                    <?php dynamic_sidebar('footer-cta'); ?>
                
                </div><!-- .col-1-1 --> 
            </div><!-- .grid --> 
        </div><!-- .footer-cta --> 
        
    <?php endif; ?>                   
				<?php endif; ?> 
                
        	<?php endif; ?>
            
		</div><!-- .site-info --> 
        
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
