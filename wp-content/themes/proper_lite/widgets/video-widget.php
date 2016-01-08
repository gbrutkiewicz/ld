<?php



class properlite_Video_Widget extends WP_Widget { 



// constructor

    function properlite_video_widget() {

		$widget_ops = array('classname' => 'properlite_video_widget_widget', 'description' => __( 'Video for your sidebar.', 'properlite') ); 

        parent::__construct(false, $name = __('MT - Video Widget', 'properlite'), $widget_ops); 

		$this->alt_option_name = 'properlite_video_widget';

		

		add_action( 'save_post', array($this, 'flush_widget_cache') );

		add_action( 'deleted_post', array($this, 'flush_widget_cache') );

		add_action( 'switch_theme', array($this, 'flush_widget_cache') );		

    } 

	

	// widget form creation

	function form($instance) {



	// Check values

		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

		$url    = isset( $instance['url'] ) ? esc_url( $instance['url'] ) : '';

	?>



	<p>

	<label for="<?php echo sanitize_text_field( $this->get_field_id('title')); ?>"><?php _e('Title', 'properlite'); ?></label>

	<input class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id('title')); ?>" name="<?php echo sanitize_text_field( $this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /> 

	</p>



	<p><label for="<?php echo sanitize_text_field( $this->get_field_id( 'url' )); ?>"><?php _e( 'Paste the URL of the video (only from a network that supports oEmbed, like Youtube, Vimeo etc.):', 'properlite' ); ?></label>

	<input class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id( 'url' )); ?>" name="<?php echo sanitize_text_field( $this->get_field_name( 'url' )); ?>" type="text" value="<?php echo esc_url( $url ); ?>" size="3" /></p>

	 

	<?php

	}



	// update widget

	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title'] = esc_attr($new_instance['title']);

		$instance['url'] = esc_url_raw($new_instance['url']);

		$this->flush_widget_cache();



		$alloptions = wp_cache_get( 'alloptions', 'options' );

		if ( isset($alloptions['properlite_video_widget']) )

			delete_option('properlite_video_widget');		  

		  

		return $instance;

	}

	

	function flush_widget_cache() {

		wp_cache_delete('properlite_video_widget', 'widget');

	}

	

	// display widget

	function widget($args, $instance) {

		$cache = array();

		if ( ! $this->is_preview() ) {

			$cache = wp_cache_get( 'properlite_video_widget', 'widget' );

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



		$title = ( ! empty( $instance['title'] ) ) ? esc_attr( $instance['title'] ) : __( 'Video', 'properlite' );



		$title = apply_filters( 'widget_title', esc_attr( $title ), $instance, $this->id_base );



		$url   = isset( $instance['url'] ) ? esc_url( $instance['url'] ) : '';



		echo $before_widget; 

		

		if ( $title ) echo $before_title . esc_attr( $title ) . $after_title;

		

		if( ($url) ) {

			echo wp_oembed_get($url);

		}

		echo $after_widget;





		if ( ! $this->is_preview() ) {

			$cache[ $args['widget_id'] ] = ob_get_flush();

			wp_cache_set( 'properlite_video_widget', $cache, 'widget' );

		} else {

			ob_end_flush();

		}

	}

	

}	