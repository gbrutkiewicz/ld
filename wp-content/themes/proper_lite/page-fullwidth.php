<?php
/**
Template Name: Page - Fullwidth
 *
 * @package properlite 
 */

//Partages
$redirect_url=urlencode("http://www.laurent-dray.com");
$titre=urlencode("Laurent Dray - Architecte d'intérieur");
$redirect_url=$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ;
$titre="Laurent Dray - Architecte d'intérieur";

get_header(); ?>

	<?php //while ( have_posts() ) : the_post(); ?>
    
    <?php if (has_post_thumbnail( $post->ID ) ): ?>
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'properlite-max-control' );
			  $image = $image[0]; ?>
	    <?php endif; ?>
        
	<header class="page-entry-header"> 
    	<div class="grid grid-pad overflow">
        	<div class="col-1-1">
            	<div class="animated fadeInUp delay">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </div>
            </div>
        </div>
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
                        <?php //get_template_part( 'content', 'page' ); ?>
                    <article id="inspirations">

                        <?php // Display blog posts on any page @ http://m0n.co/l
                        $temp = $wp_query; $wp_query= null;
                        $wp_query = new WP_Query(); $wp_query->query('showposts=5' . '&paged='.$paged);
                        while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

                        <hr>
                        <!--<h2><a href="<?php the_permalink(); ?>" title="Read more"><?php the_title(); ?></a></h2>-->
                        <h2><a href="<?php the_permalink(); ?>" title="Read more"><?php the_title(); ?></a></h2>
                        <div class="inspiration-date"><?php the_date(); ?></div>

                        <?php $attachments = new Attachments( 'attachments' ); /* pass the instance name */ ?>
                        <?php if( $attachments->exist() ) : ?>
                          
                            <?php while( $attachment = $attachments->get() ) : ?>
                              <div class="inspiration-pictures">
                                <!--<pre><?//php print_r( $attachment ); ?></pre>-->
                                <div><img src="<?php echo $attachments->src( 'full' ); ?>">
                                    <div class="inspiration-partage">
                                        <ul class="social-media-icons">                   
                                            <li>
                                                <a href="https://www.facebook.com/dialog/feed?%20app_id=724455497660772%20&display=popup&caption=<?php echo $titre; ?>&link=<?php echo $redirect_url;?>&redirect_uri=<?php echo $redirect_url;?>&description=<?php urlencode(the_title()); ?>&picture=<?php echo $attachments->src( 'full' ); ?>" target="_blank">
                                                <i class="fa inspiration-icons fa-facebook"></i>
                                                </a>
                                                </li>
                                                                                                                                    <li>
                                                <a href="https://www.pinterest.com/pin/create/button/?url=<?php echo $redirect_url;?>&media=<?php echo $attachments->src( 'full' ); ?>&description=<?php urlencode(the_title()); ?>" target="_blank">
                                                <i class="fa inspiration-icons fa-pinterest"></i>
                                                </a>
                                            </li>         
                                        </ul>
                                    </div>
                                </div>
                                <div>

                                    <div class="inspiration-legende"><?php echo $attachments->field( 'caption' ); ?></div>
                              </div>
                            <?php endwhile; ?>
                          
                        <?php endif; ?>

                        <?php endwhile; ?>

                        <?php if ($paged > 1) { ?>

                        <nav id="nav-posts">
                            <div class="prev"><?php next_posts_link('&laquo; Inspirations prédédentes'); ?></div>
                            <div class="next"><?php previous_posts_link('Inspirations suivantes &raquo;'); ?></div>
                        </nav>

                        <?php } else { ?>

                        <nav id="nav-posts">
                            <div class="prev"><?php next_posts_link('&laquo; Previous Posts'); ?></div>
                        </nav>

                        <?php } ?>

                        <?php wp_reset_postdata(); ?>

                    </article>
                        <?php
                            // If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
                        ?>
        
                    <?php //endwhile; // end of the loop. ?>
        
                </main><!-- #main -->
            </div><!-- #primary -->
		</div>
	</div>
</section>
<?php get_footer(); ?>
