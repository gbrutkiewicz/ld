<?php



class mt_projects extends WP_Widget { 



// constructor

    function mt_projects() {

		$widget_ops = array('classname' => 'mt_projects_widget', 'description' => __( 'With this widget you can display all those projects you are proud of.', 'mtprojects') );

        parent::__construct(false, $name = __('MT - Projects', 'mtprojects'), $widget_ops); 

		$this->alt_option_name = 'mt_projects_widget'; 

		

		add_action( 'save_post', array($this, 'flush_widget_cache') );

		add_action( 'deleted_post', array($this, 'flush_widget_cache') );

		add_action( 'switch_theme', array($this, 'flush_widget_cache') );		

    }

	

	// widget form creation

	function form($instance) { 



	// Check values

		$title     		= isset( $instance['title'] ) ? wp_kses_post( $instance['title'] ) : ''; 

		$number    		= isset( $instance['number'] ) ? intval( $instance['number'] ) : -1;
		
		$category    	= isset( $instance['category'] ) ? esc_html( $instance['category'] ) : '';
		
		$columnset    	= isset( $instance['columnset'] ) ? intval( $instance['columnset'] ) : 3;

		$see_all   		= isset( $instance['see_all'] ) ? esc_url_raw( $instance['see_all'] ) : '';

		$see_all_text  	= isset( $instance['see_all_text'] ) ? esc_html( $instance['see_all_text'] ) : '';
		
		$project_style 	= isset( $instance['project_style'] ) ? esc_html( $instance['project_style'] ) : ''; 	

	?>



	<p><?php _e('In order to display this widget, you must first add some Projects custom post types.', 'mtprojects'); ?></p> 

	<p>

	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'mtprojects'); ?></label>

	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo wp_kses_post( $title );  ?>" />

	</p>

	<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of Projects to show (-1 shows all):', 'mtprojects' ); ?></label>

	<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
    
    <p><label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'mtprojects' ); ?></label>

	<input class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" type="text" value="<?php echo $category; ?>" size="3" /></p>
    
    <p><label for="<?php echo $this->get_field_id( 'columnset' ); ?>"><?php _e( 'Number of columns:', 'mtprojects' ); ?></label> 

	<input id="<?php echo $this->get_field_id( 'columnset' ); ?>" name="<?php echo $this->get_field_name( 'columnset' ); ?>" type="text" value="<?php echo intval( $columnset ); ?>" size="3" /></p>
    

    <p><label for="<?php echo $this->get_field_id('see_all'); ?>"><?php _e('Enter the URL for your Projects page:', 'mtprojects'); ?></label>

	<input class="widefat custom_media_url" id="<?php echo $this->get_field_id( 'see_all' ); ?>" name="<?php echo $this->get_field_name( 'see_all' ); ?>" type="text" value="<?php echo esc_url_raw( $see_all ); ?>" size="3" /></p> 	

    <p><label for="<?php echo $this->get_field_id('see_all_text'); ?>"><?php _e('Button Text (Default is <em>See All</em>):', 'mtprojects'); ?></label>

	<input class="widefat" id="<?php echo $this->get_field_id( 'see_all_text' ); ?>" name="<?php echo $this->get_field_name( 'see_all_text' ); ?>" type="text" value="<?php echo esc_html( $see_all_text ); ?>" size="3" /></p>	

	<!-- Style Selector -->
    
     <p>
      <label for="<?php echo $this->get_field_id('text'); ?>">Style: 
        <select class='widefat' id="<?php echo $this->get_field_id('project_style'); ?>"
                name="<?php echo $this->get_field_name('project_style'); ?>" type="text">
          <option value='Image with Hover'<?php echo ($project_style=='Image with Hover')?'selected':''; ?>>
            Image with Hover
          </option>
          <option value='Image'<?php echo ($project_style=='Image')?'selected':''; ?>> 
            Image
          </option> 
        </select>                
      </label>
     </p>
     
     <!-- Style Selector END -->

	<?php

	}



	// update widget

	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title'] 			= wp_kses_post($new_instance['title']);

		$instance['number'] 		= intval($new_instance['number']);
		
		$instance['category'] 		= esc_html($new_instance['category']);
		
		$instance['columnset'] 		= intval($new_instance['columnset']);

		$instance['see_all'] 		= esc_url_raw( $new_instance['see_all'] );	

		$instance['see_all_text'] 	= esc_html($new_instance['see_all_text']);	
		
		$instance['project_style'] 	= esc_html($new_instance['project_style']);		

		$this->flush_widget_cache();



		$alloptions = wp_cache_get( 'alloptions', 'options' );

		if ( isset($alloptions['mt_projects']) )

			delete_option('mt_projects');		  

		  

		return $instance;

	}

	

	function flush_widget_cache() {

		wp_cache_delete('mt_projects', 'widget');

	}

	

	// display widget

	function widget($args, $instance) {

		$cache = array();

		if ( ! $this->is_preview() ) {

			$cache = wp_cache_get( 'mt_projects', 'widget' );

		}



		if ( ! is_array( $cache ) ) {

			$cache = array();

		}



		if ( ! isset( $args['widget_id'] ) ) {

			$args['widget_id'] = $this->id;

		}



		if ( isset( $cache[ $args['widget_id'] ] ) ) {

			echo $cache[ $args['widget_id'] ];

			return;

		}



		ob_start();

		extract($args);



		/** This filter is documented in wp-includes/default-widgets.php */

		$title = isset( $instance['title'] ) ? wp_kses_post($instance['title']) : '';

		$see_all 		= isset( $instance['see_all'] ) ? esc_url($instance['see_all']) : '';

		$see_all_text 	= isset( $instance['see_all_text'] ) ? esc_html($instance['see_all_text']) : '';
		
		$category 		= isset( $instance['category'] ) ? esc_html($instance['category']) : '';
		
		$project_style 	= isset( $instance['project_style'] ) ? esc_html( $instance['project_style'] ) : ''; 

		$number 		= ( ! empty( $instance['number'] ) ) ? intval( $instance['number'] ) : -1;

		if ( ! $number ) {

			$number = -1;

		}
		
		$columnset 		= ( ! empty( $instance['columnset'] ) ) ? intval( $instance['columnset'] ) : 3;
		
		if ( ! $columnset ) {

			$columnset = 3;

		}

		$mt = new WP_Query( apply_filters( 'widget_posts_args', array(

			'no_found_rows'       => true,

			'post_status'         => 'publish',

			'post_type' 		  => 'project', 
			
			'category_name'       => $category,

			'posts_per_page'	  => -1

		) ) );



		if ($mt->have_posts()) :

?>

		<?php if ( $project_style=='Image with Hover' ) : ?>


		<section id="mt-projects">

		<?php if ( $title ) : ?>

			<div class="grid grid-pad">
        		<div class="col-1-1">
					<?php echo $before_title . $title . $after_title; ?> 
                </div>
        	</div>
            
        <?php endif; ?> 
            
            <div class="grid grid-pad overflow">		

				<?php $c = 1; ?>				
				<?php $num = 1; ?>

				<?php while ( $mt->have_posts() ) : $mt->the_post(); ?>
                
                <div class="col-1-<?php if ( $columnset ) echo  $columnset; ?> mt-column-clear <?php if($num>$number){echo 'hide-cell';} ?>" id="cell-<?php echo $num; ?>">  
                	<div class="project-box">
                    	<a href="<?php the_permalink(); ?>">
                    	<div class="project-content"><div><span>
                     	<?php the_title( '<h3>', '</h3>' ); ?>  
                         
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'project-thumb', array( 'class' => 'project-img' ) );
                              $image = $image[0]; ?> 
                        
                        <div class="project-bg" style="background-image: url(<?php echo esc_url( $image ); ?>);"></div>
                        </span></div></div> 
                        </a>
                     </div>
            	</div>
            	<?php $num++; ?>
				<?php endwhile; ?>

			</div>

			<?php if ($see_all != '') : ?>
				<script> var initNumber=0; </script>
				<button onclick="javascript:seeMore(<?php echo $number; ?>,2);" class="see-more">Plus</button>	
				<!--<a href="<?php echo esc_url($see_all); ?>" class="featured-link">

					<?php if ($see_all_text) : ?>

						<button><?php echo esc_html( $see_all_text ); ?></button>
						

					<?php else : ?>

						<button><?php echo __('See All', 'mtprojects'); ?></button>

					<?php endif; ?>

				</a>-->

			<?php endif; ?>
			

		</section>	
        
    <?php endif; ?>	
        
    <?php if ( $project_style=='Image' ) : ?>
    
    	<section id="mt-projects">

		<?php if ( $title ) : ?>

			<div class="grid grid-pad">
        		<div class="col-1-1">
					<?php echo $before_title . $title . $after_title; ?> 
                </div>
        	</div>
            
        <?php endif; ?> 
            
            	<div class="grid">	

				
					<?php while ( $mt->have_posts() ) : $mt->the_post(); ?>
                
                	<?php if (has_post_thumbnail( get_the_ID() ) ): ?>
                    	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'max-control' ); 
                          	  $image = $image[0]; ?> 
                	<?php endif; ?>
                    
                    <a href="<?php the_permalink(); ?>"> 
                     
                    	<?php if (has_post_thumbnail( get_the_ID() ) ): ?>
                        
                    		<div class="home-project-image-bg" style="background-image: url('<?php echo esc_url( $image ); ?>');">
                            
                        <?php else: ?>
                        
                        	<div class="home-project-image-bg"> 
                            
                        <?php endif; ?>
                        
                        	<span>
                            	<?php the_title( '<h5>','</h5>' ); ?>  
                            </span>
                            
                        <?php if (has_post_thumbnail( get_the_ID() ) ): ?>
                        
                    		</div>
                            
                        <?php else: ?>
                        
                        	</div>
                            
                        <?php endif; ?>
                    
                    </a> 

				<?php endwhile; ?>

			</div>
            
            
            <?php if ($see_all != '') : ?>

				<a href="<?php echo esc_url($see_all); ?>" class="featured-link">  

					<?php if ($see_all_text) : ?>

						<button><?php echo esc_html( $see_all_text ); ?></button>

					<?php else : ?>

						<button><?php echo __('See All', 'mtprojects'); ?></button>

					<?php endif; ?>

				</a>

			<?php endif; ?> 
           
			

		</section>
        
    
    <?php endif; ?>	 
    

	<?php

		// Reset the global $the_post as this query will have stomped on it

		wp_reset_postdata();



		endif;



		if ( ! $this->is_preview() ) {

			$cache[ $args['widget_id'] ] = ob_get_flush();

			wp_cache_set( 'mt_projects', $cache, 'widget' );

		} else {

			ob_end_flush();

		}

	}

	

}