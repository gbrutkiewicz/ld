<?php
/**
 * The template for displaying all single posts.
 *
 * @package properlite
 */
$customs=get_post_custom($post->ID) ;
get_header(); 
?>

	<?php while ( have_posts() ) : the_post(); ?>
    
    <?php if (has_post_thumbnail( $post->ID ) ): ?>
		<?php //$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'properlite-max-control' );
        $image = wp_get_attachment_image_src(( $customs['cover_picture'][0]), 'properlite-max-control' );
        ;
			  $image = $image[0]; ?>
	    <?php endif; ?>
        
	<header class="page-entry-header"> 
    	<div class="grid grid-pad overflow">
        	<div class="col-1-1">
            	<div class="animated fadeInUp delay">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </div><!-- .animated -->
            </div><!-- .col-1-1 -->
        </div><!-- .grid -->
        <div class="page-bg-image" data-parallax="scroll" data-image-src="<?php echo $image; ?>" data-z-index="1"></div> 
	</header><!-- .entry-header -->

<section id="page-content-container" class="animated fadeIn delay-2">
    <div class="grid grid-pad page-contain-full">
       	<div class="col-1-1">     
            <div id="primary" class="content-area shortcodes">
                <main id="main" class="site-main" role="main">
                    <div class="left-button">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="featured-link">
                                <button>RETOUR</button>
                            </a>
                    </div>
                    <?php get_template_part( 'content', 'single' ); ?>

                    <?php echo do_shortcode('[wonderplugin_slider id="'.$customs['slider_id'][0].'"]'); ?>
                    <div class="desctiption-project"> 
                        <?php echo $customs['description'][0];?>
                    </div>   
          
                    <?php //properlite_the_post_navigation(); ?> 
                    <div class="right-button">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="featured-link">
                                <button>RETOUR</button>
                            </a>
                    </div>
                    <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || get_comments_number() ) :
                            //scomments_template();
                        endif;
                    ?>
        
                <?php endwhile; // end of the loop. ?>
        
                </main><!-- #main -->
            </div><!-- #primary -->
		</div><!-- .col -->
  	</div><!-- .grid -->
</section><!-- .page-content-container --> 

<?php get_footer(); ?>
