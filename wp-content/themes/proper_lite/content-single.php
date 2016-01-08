<?php
/**
 * @package properlite
 */
 $attachment_id = 60; // attachment ID
 $image = wp_get_attachment_image_src( $attachment_id,'full' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
	<header class="entry-header">
		<div class="entry-meta">
			<?php //properlite_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
	<div class="header-project">
			<img src="<?php echo $image[0]; ?>">
	</div>
	<div class="entry-content page-title">
		<?php the_content(); ?> 
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'properlite' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php //properlite_entry_footer(); ?> 
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
