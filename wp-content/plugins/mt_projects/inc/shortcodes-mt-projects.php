<?php

function mt_projects_shortcode( $atts ) {
	// Attributes
	extract( shortcode_atts(
		array(
			'number' => '-1',
			'category' => '',
			'columns' => '3',
			'style' => 'hover',
		), $atts )
	);

	$output = '';

	$scprojects = new WP_Query( array( 
		'post_type' => 'project', 
		'posts_per_page' => $number, 
		'category_name' => $category
	)); 
	
	

if ( $scprojects->have_posts()) :

 
	if ( $style=='hover' ) : 	
		

		$output .= '<section id="mt-projects"><div class="grid grid-pad">';
					
		while ( $scprojects->have_posts()) : $scprojects->the_post();

			$output .= '<div class="col-1-' . $columns . ' mt-column-clear"><div class="project-box">';
  
  				$output .= '<a href="'.get_the_permalink().'">';
				
					$output .= '<div class="project-content"><div><span>';
				
						$output .= '<h3>'.get_the_title().'</h3>'; 
						
							$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'project-thumb' );
					  		$image = $image[0];
							
						$output .= '<div class="project-bg" style="background-image: url('.$image.');"></div>'; 
		
					
					$output .= '</span></div></div>';
					
				$output .= '</a>';

			$output .= '</div></div>'; 

		endwhile;

		$output .= '</div></section>'; 
		
		
	endif;
	
	
	
	if ( $style=='image' ) : 
	
	
		$output .= '<section id="mt-projects"><div class="grid grid-pad">';
					
				while ( $scprojects->have_posts()) : $scprojects->the_post();
		
					$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'max-control' ); 
						$image = $image[0];
				
					$output .= '<a href="'.get_the_permalink().'">';
			
			
			
						if (has_post_thumbnail( get_the_ID() ) ): 
                        
                    		$output .= '<div class="home-project-image-bg" style="background-image: url('.$image.');">'; 
                            
                         else: 
                        
                        	$output .=  '<div class="home-project-image-bg">';
                            
                         endif;
						 
                        
                        $output .= '<span><h5>'.get_the_title().'</h5></span>';  
						
                        	
                            	
                        if (has_post_thumbnail( get_the_ID() ) ): 
                        
                    		$output .= '</div>';
                            
                        else:
                        
                        	$output .= '</div>';
                            
                        endif;
							

					$output .= '</a>'; 

			endwhile;

		$output .= '</div></section>'; 
		
		
	endif;
	

endif;



	wp_reset_postdata(); 

	return $output;
	

}

add_shortcode( 'projects', 'mt_projects_shortcode' );

?>