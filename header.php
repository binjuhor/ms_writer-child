<?php
/**
 * The template for displaying the header.
 *
 * Displays everything from the doctype declaration down to the navigation.
 */
$mts_options = get_option(MTS_THEME_NAME);
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head itemscope itemtype="http://schema.org/WebSite">
	<meta charset="<?php bloginfo('charset'); ?>">
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php mts_meta(); ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
	<meta property="fb:app_id" content="1843228312373267" />
</head>
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.12&appId=1843228312373267&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<body id="blog" <?php body_class('main'); ?> itemscope itemtype="http://schema.org/WebPage">	   
	<div class="main-container">
		<header id="site-header" role="banner" itemscope itemtype="http://schema.org/WPHeader">
			<?php if ( $mts_options['mts_nav_bar_location'] == 'above' && (!empty( $mts_options['mts_show_primary_nav'] ) || !empty( $mts_options['mts_header_search'] )) ) { ?>
				<?php if ( $mts_options['mts_sticky_nav'] == '1' ) { ?>
					<div class="clear" id="catcher"></div>
	 			<div class="navigation-wrap sticky-navigation">
				<?php } else { ?>
					<div class="navigation-wrap">
				<?php } ?>
						<div class="container">
				 			<?php if ( $mts_options['mts_show_primary_nav'] == '1' ) { ?>
								<div id="secondary-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
					  				<a href="#" id="pull" class="toggle-mobile-menu"><?php _e('Menu', 'writer' ); ?></a>
									<?php if ( has_nav_menu( 'mobile' ) ) { ?>
										<nav class="navigation clearfix">
											<?php if ( has_nav_menu( 'primary-menu' ) ) { ?>
												<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu clearfix', 'container' => '', 'walker' => new mts_menu_walker ) ); ?>
											<?php } else { ?>
												<ul class="menu clearfix">
													<?php wp_list_categories('title_li='); ?>
												</ul>
											<?php } ?>
										</nav>
										<nav class="navigation mobile-only clearfix mobile-menu-wrapper">
											<?php wp_nav_menu( array( 'theme_location' => 'mobile', 'menu_class' => 'menu clearfix', 'container' => '', 'walker' => new mts_menu_walker ) ); ?>
										</nav>
									<?php } else { ?>
									<nav class="navigation clearfix mobile-menu-wrapper">
										<?php if ( has_nav_menu( 'primary-menu' ) ) { ?>
											<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu clearfix', 'container' => '', 'walker' => new mts_menu_walker ) ); ?>
										<?php } else { ?>
											<ul class="menu clearfix">
												<?php wp_list_categories('title_li='); ?>
											</ul>
										<?php } ?>
									</nav>
									<?php } ?>
								</div>
							<?php } ?>
							<?php if ( $mts_options['mts_header_search'] == '1' ) { ?>
								<span class="searchbox-icon"><i class="fa fa-search"></i></span>
								<form method="get" id="searchform" class="searchbox search-form" action="<?php echo esc_attr( home_url() ); ?>" _lpchecked="1">
							 		<input type="text" name="s" id="s" class="searchbox-input" value="<?php the_search_query(); ?>" <?php if (!empty($mts_options['mts_ajax_search'])) echo ' autocomplete="off"'; ?> />
							 		<input type="submit" value="<?php esc_html_e("Tìm kiếm","ms_writer");?>">
					  			</form>
			 				<?php } ?>
				  		</div>
  					</div>
				<?php } ?> 
				<?php if ( $mts_options['mts_header_section2'] == '1' || !empty($mts_options['mts_header_text'])) { ?>
					<div class="header-top">
						<div class="container">
							<div class="hotnews__box pull-left col-md-6">
								<span class="hotnews-item">Hot news</span><a href="#">Cách sử dụng Bollinger Band trong phân ... </a>
							</div>
							<div class="social-box pull-right col-md-6">
								<a href="#" class="social"><i class="fa fa-facebook"></i></a>
								<a href="#" class="social"><i class="fa fa-twitter"></i></a>
								<a href="#" class="social"><i class="fa fa-google-plus"></i></a>
								<a href="#" class="social"><i class="fa fa-youtube"></i></a>
								<a href="#"  class="hotnews-item">Liên hệ</a>
							</div>
						</div>
					</div><!--End .header-top-->

					<div id="header">
						<div class="container">
							<div class="logo-wrap">
								<?php if ( $mts_options['mts_logo'] != '' && $mts_logo = wp_get_attachment_image_src( $mts_options['mts_logo'], 'full' ) ) { ?>
									<?php if ( is_front_page() || is_home() || is_404() ) { ?>
										<h1 id="logo" class="image-logo" itemprop="headline">
											<a href="<?php echo esc_url( home_url() ); ?>"><img src="<?php echo esc_url( $mts_logo[0] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="<?php echo esc_attr( $mts_logo[1] ); ?>" height="<?php echo esc_attr( $mts_logo[2] ); ?>">
											</a>
										</h1><!-- END #logo -->
									<?php } else { ?>
										<h2 id="logo" class="image-logo" itemprop="headline">
											<a href="<?php echo esc_url( home_url() ); ?>">
												<img src="<?php echo esc_url( $mts_logo[0] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="<?php echo esc_attr( $mts_logo[1] ); ?>" height="<?php echo esc_attr( $mts_logo[2] ); ?>">
											</a>
										</h2><!-- END #logo -->
									<?php } ?>

								<?php } else { ?>

									<?php if ( is_front_page() || is_home() || is_404() ) { ?>
										<h1 id="logo" class="text-logo" itemprop="headline">
											<a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>
										</h1><!-- END #logo -->
									<?php } else { ?>
										<h2 id="logo" class="text-logo" itemprop="headline">
											<a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>
										</h2><!-- END #logo -->
									<?php } ?>
								<?php } ?>
							</div>
					 		<?php if ($mts_options['mts_header_text']) { ?>
				 				<div class="header-text">
			  						<?php echo $mts_options['mts_header_text']; ?>
				 				</div>
		 					<?php } ?>
						</div>
					</div>
				<?php } ?>

				<?php if ( $mts_options['mts_nav_bar_location'] == 'below' && (!empty( $mts_options['mts_show_primary_nav'] ) || !empty( $mts_options['mts_header_search'] )) ) { ?>
				<?php if ( $mts_options['mts_sticky_nav'] == '1' ) { ?>
					<div class="clear" id="catcher"></div>
	 			<div class="navigation-wrap sticky-navigation">
				<?php } else { ?>
					<div class="navigation-wrap">
				<?php } ?>
						<div class="container">
				 			<?php if ( $mts_options['mts_show_primary_nav'] == '1' ) { ?>
								<div id="secondary-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
					  				<a href="#" id="pull" class="toggle-mobile-menu"><?php _e('Menu', 'writer' ); ?></a>
									<?php if ( has_nav_menu( 'mobile' ) ) { ?>
										<nav class="navigation clearfix">
											<?php if ( has_nav_menu( 'primary-menu' ) ) { ?>
												<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu clearfix', 'container' => '', 'walker' => new mts_menu_walker ) ); ?>
											<?php } else { ?>
												<ul class="menu clearfix">
													<?php wp_list_categories('title_li='); ?>
												</ul>
											<?php } ?>
										</nav>
										<nav class="navigation mobile-only clearfix mobile-menu-wrapper">
											<?php wp_nav_menu( array( 'theme_location' => 'mobile', 'menu_class' => 'menu clearfix', 'container' => '', 'walker' => new mts_menu_walker ) ); ?>
										</nav>
									<?php } else { ?>
									<nav class="navigation clearfix mobile-menu-wrapper">
										<?php if ( has_nav_menu( 'primary-menu' ) ) { ?>
											<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu clearfix', 'container' => '', 'walker' => new mts_menu_walker ) ); ?>
										<?php } else { ?>
											<ul class="menu clearfix">
												<?php wp_list_categories('title_li='); ?>
											</ul>
										<?php } ?>
									</nav>
									<?php } ?>
								</div>
							<?php } ?>
							<?php if ( $mts_options['mts_header_search'] == '1' ) { get_search_form( true ); } ?>
				  		</div>
  					</div>
				<?php } ?> 
		</header>
