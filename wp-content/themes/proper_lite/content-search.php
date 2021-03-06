<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package properlite 
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="grid grid-pad">
    	<div class="col-1-1">
            <header class="entry-header">
                <?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
            </header><!-- .entry-header -->
        
            <div class="entry-summary">
                <?php the_excerpt(); ?>
            </div><!-- .entry-summary -->
     	</div><!-- .col-1-1 -->
  	</div><!-- .grid -->
</article><!-- #post-## -->
