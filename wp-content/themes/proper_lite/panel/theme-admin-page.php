<?php


function properlite_admin_page_styles() {
    wp_enqueue_style( 'properlite-font-awesome-admin', get_template_directory_uri() . '/fonts/font-awesome.css' ); 
	wp_enqueue_style( 'properlite-style-admin', get_template_directory_uri() . '/panel/css/theme-admin-style.css' ); 
}
add_action( 'admin_enqueue_scripts', 'properlite_admin_page_styles' );

     
    add_action('admin_menu', 'properlite_setup_menu');
     
    function properlite_setup_menu(){
    	add_theme_page( __('Proper Lite Theme Details', 'properlite' ), __('Proper Lite Theme Details', 'properlite' ), 'edit_theme_options', 'properlite-setup', 'properlite_init' ); 
    }  
     
 	function properlite_init(){
	 	echo '<div class="grid grid-pad"><div class="col-1-1"><h1 style="text-align: center;">';
		printf(__('Thank you for using Proper Lite!', 'properlite' )); 
        echo "</h1></div></div>";
			
		echo '<div class="grid grid-pad" style="border-bottom: 1px solid #ccc; padding-bottom: 40px; margin-bottom: 30px;" ><div class="col-1-3"><h2>'; 
		printf(__('Premium Plugins', 'properlite' )); 
        echo '</h2>';
		
		echo '<p>';
		printf(__('Want to add more functionality to your theme? Use ModernThemes Premium Plugins to add content to your widget areas and pages.', 'properlite' )); 
		echo '</p>';
		
		echo '<a href="https://modernthemes.net/plugins/" target="_blank"><button>'; 
		printf(__('Get Plugins', 'properlite' ));  
		echo "</button></a></div>";
		
		echo '<div class="col-1-3"><h2>'; 
		printf(__('Documentation', 'properlite' ));
        echo '</h2>';  
		
		echo '<p>';
		printf(__('Check out our Proper Documentation to learn how to use Proper and for tutorials on theme functions. ', 'properlite' ));  
		echo '</p>'; 
		
		echo '<a href="https://modernthemes.net/proper-lite-documentation/" target="_blank"><button>';
		printf(__('Read Docs', 'properlite' ));
		echo "</button></a></div>";
		
		echo '<div class="col-1-3"><h2>'; 
		printf(__('ModernThemes', 'properlite' )); 
        echo '</h2>';  
		
		echo '<p>';
		printf(__('Need some more themes? We have a large selection of both free and premium themes to add to your collection.', 'properlite' ));
		echo '</p>';
		
		echo '<a href="https://modernthemes.net/" target="_blank"><button>'; 
		printf(__('Visit Us', 'properlite' ));
		echo '</button></a></div></div>';
		
		echo '<div class="grid grid-pad senswp"><div class="col-1-1"><h1 style="padding-bottom: 30px; text-align: center;">';
		printf( __('Get the Premium Experience.', 'properlite' )); 
		echo '</h1></div>';
		
        echo '<div class="col-1-4"><i class="fa fa-cogs"></i><h4>';
		printf( __('Plugin Compatibility', 'properlite' ));
		echo '</h4>';
		
        echo '<p>';
		printf( __('Use our new free plugins with this theme to add functionality for things like projects, clients, team members and more. Compatible with all premium themes!', 'properlite' ));
		echo '</p></div>';
		
		echo '<div class="col-1-4"><i class="fa fa-home"></i><h4>';
        printf( __('More Home Sections', 'properlite' ));
		echo '</h4>';
		
        echo '<p>';
		printf( __('Add more plugin content to your home page with Proper Premium as we offer <em>3 additional home widget areas</em> to work with. More room for more information.', 'properlite' )); 
		echo '</p></div>'; 
		
        echo '<div class="col-1-4"><i class="fa fa-image"></i><h4>';
        printf( __('Sliders + Video', 'properlite' ));
		echo '</h4>';
		
        echo '<p>';
		printf( __('Make your brand more modern with sliders or fullscreen video on your home page. The best looking websites give the best first impressions.', 'properlite' ));
		echo '</p></div>'; 
		
		echo '<div class="col-1-4"><i class="fa fa-th"></i><h4>';
        printf( __('Footer Widget Areas', 'properlite' ));
		echo '</h4>';
		
        echo '<p>';
		printf( __('Want more content for your footer? Proper Premium has footer widget areas to populate with any content you want.', 'properlite' ));
		echo '</p></div>';
		
            
        echo '<div class="grid grid-pad senswp"><div class="col-1-4"><i class="fa fa-th-list"></i><h4>';
		printf( __( 'More Sidebars', 'properlite' ));
		echo '</h4>';
		
        echo '<p>';
		printf( __( 'Sometimes you need different sidebars for different pages. We got you covered, offering up to 5 different sidebars.', 'properlite' ));
		echo '</p></div>';
		
       	echo '<div class="col-1-4"><i class="fa fa-font"></i><h4>More Google Fonts</h4><p>';
		printf( __( 'Access an additional 65 Google fonts with Proper right in the WordPress customizer.', 'properlite' ));
		echo '</p></div>'; 
		
       	echo '<div class="col-1-4"><i class="fa fa-file-image-o"></i><h4>';
		printf( __( 'PSD Files', 'properlite' ));
		echo '</h4>';
		
        echo '<p>';
		printf( __( 'Premium versions include PSD files. Preview your own content or showcase a customized version for your clients.', 'properlite' ));
		echo '</p></div>';
            
        echo '<div class="col-1-4"><i class="fa fa-support"></i><h4>';
		printf( __( 'Free Support', 'properlite' )); 
		echo '</h4>';
		
        echo '<p>';
		printf( __( 'Call on us to help you out. Premium themes come with free support that goes directly to our support staff.', 'properlite' ));
		echo '</p></div></div>';
		
		echo '<div class="grid grid-pad" style="border-bottom: 1px solid #ccc; padding-bottom: 50px; margin-bottom: 30px;"><div class="col-1-1"><a href="https://modernthemes.net/premium-wordpress-themes/proper/" target="_blank"><button class="pro">'; 
		printf( __( 'View Premium Version', 'properlite' )); 
		echo '</button></a></div></div>';
		
		
		
		echo '<div class="grid grid-pad senswp"><div class="col-1-1"><h1 style="padding-bottom: 30px; text-align: center;">';
		printf( __('Premium Membership. Premium Experience.', 'properlite' )); 
		echo '</h1></div>';
		
        echo '<div class="col-1-4"><i class="fa fa-cogs"></i><h4>'; 
		printf( __('Plugin Compatibility', 'properlite' ));
		echo '</h4>';
		
        echo '<p>';
		printf( __('Use our new free plugins with this theme to add functionality for things like projects, clients, team members and more. Compatible with all premium themes!', 'properlite' ));
		echo '</p></div>';
		
		echo '<div class="col-1-4"><i class="fa fa-desktop"></i><h4>'; 
        printf( __('Agency Designed Themes', 'properlite' ));
		echo '</h4>';
		
        echo '<p>';
		printf( __('Look as good as can be with our new premium themes. Each one is agency designed with modern styles and professional layouts.', 'properlite' ));
		echo '</p></div>'; 
		
        echo '<div class="col-1-4"><i class="fa fa-users"></i><h4>';
        printf( __('Membership Options', 'properlite' ));
		echo '</h4>';
		
        echo '<p>';
		printf( __('We have options to fit every budget. Choose between a single theme, or access to all current and future themes for a year, or forever!', 'properlite' ));
		echo '</p></div>'; 
		
		echo '<div class="col-1-4"><i class="fa fa-calendar"></i><h4>'; 
		printf( __( 'Access to New Themes', 'properlite' )); 
		echo '</h4>';
		
        echo '<p>';
		printf( __( 'New themes added monthly! When you purchase a premium membership you get access to all premium themes, with new themes added monthly.', 'properlite' ));   
		echo '</p></div>';
		
		
		echo '<div class="grid grid-pad" style="border-bottom: 1px solid #ccc; padding-bottom: 50px; margin-bottom: 30px;"><div class="col-1-1"><a href="https://modernthemes.net/premium-wordpress-themes/" target="_blank"><button class="pro">'; 
		printf( __( 'Get Premium Membership', 'properlite' ));
		echo '</button></a></div></div>';
		
		
		
		echo '<div class="grid grid-pad"><div class="col-1-1"><h2 style="text-align: center;">';
		printf( __( 'Changelog' , 'properlite' ) );
        echo "</h2>";
		
		echo '<p style="text-align: center;">'; 
		printf( __('1.0.0 - New Theme!', 'properlite' ));
		echo '</p></div></div>';
		
    }
?>