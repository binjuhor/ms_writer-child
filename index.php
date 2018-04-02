<?php
/**
 * The main template file.
 *
 * Used to display the homepage when home.php doesn't exist.
 */
$mts_options = get_option(MTS_THEME_NAME);

get_header(); ?>

<div id="page">
	<div class="home-slider">
		<div class="container">
			<?php 
			if ( !is_paged() ) {
				if ( is_home() && $mts_options['mts_featured_slider'] == '1' ) { ?>
				<div class="___top-page">
				
					<?php foreach( $mts_options['mts_custom_slider'] as $index => $slide ) : ?>
						<div class="primary-slider-item binjuhor_home-slider slider-items__<?php echo esc_attr($index);?>">
							<a href="<?php echo esc_url( $slide['mts_custom_slider_link'] ); ?>">
								<?php echo wp_get_attachment_image( $slide['mts_custom_slider_image'], 'writer-slider', false, array('title' => '') ); ?>
								<div class="slide-caption">
									<h2 class="slide-title"><?php echo esc_html( $slide['mts_custom_slider_title'] ); ?></h2>
								</div>
							</a>
						</div>
					<?php endforeach; ?>	
				<?php }?>
				</div>
				<?php
			}?>
		</div>
	</div><!--End .home-slider-->

	<div class="article">
		<div id="content_box">
			<?php if ( !is_paged() ) {
				$featured_categories = array();
				if ( !empty( $mts_options['mts_featured_categories'] ) ) {
					foreach ( $mts_options['mts_featured_categories'] as $section ) {
						$category_id = $section['mts_featured_category'];
						$featured_categories[] = $category_id;
						$posts_num = $section['mts_featured_category_postsnum'];

						if ( 'latest' == $category_id ) { ?>

							<div class="<?php echo $section['mts_featured_category_layout']; ?>">
								<?php $j = 0; if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
									<article class="latestPost excerpt <?php echo (++$j % 3 == 0) ? 'last' : ''; ?>">
										<?php mts_archive_post($layout = $section['mts_featured_category_layout']); ?>
									</article>
								<?php endwhile; endif; ?>
								<?php if ( $j !== 0 ) { // No pagination if there is no posts ?>
									<?php mts_pagination(); ?>
								<?php } ?>
							</div>
							
						<?php } else { // if $category_id != 'latest': ?>

							<div class="<?php echo $section['mts_featured_category_layout']; ?>">
								<h3 class="featured-category-title"><a href="<?php echo esc_url( get_category_link( $category_id ) ); ?>" title="<?php echo esc_attr( get_cat_name( $category_id ) ); ?>"><?php echo esc_html( get_cat_name( $category_id ) ); ?></a></h3>
								<?php
								$j = 0;
								$cat_query = new WP_Query('cat='.$category_id.'&posts_per_page='.$posts_num);
								if ( $cat_query->have_posts() ) : while ( $cat_query->have_posts() ) : $cat_query->the_post(); ?>
									<article class="latestPost excerpt <?php echo (++$j % 3 == 0) ? 'last' : ''; ?>">
										<?php mts_archive_post($layout = $section['mts_featured_category_layout']); ?>
									</article>
								<?php
								endwhile; endif; wp_reset_postdata(); ?>
							</div>

						<?php }
					}
				} ?>

			<?php } else { //Paged 
				$featured_categories = array();
				$post_layout = 'small-thumb';
				if ( !empty( $mts_options['mts_featured_categories'] ) ) {
					foreach ( $mts_options['mts_featured_categories'] as $section ) {
						$category_id = $section['mts_featured_category'];
						$featured_categories[] = $category_id;
						if('latest' == $category_id) {
							$post_layout = $section['mts_featured_category_layout'];
						}
					}
				} ?>
				<div class="<?php echo $post_layout; ?>">
					<?php $j = 0; if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<article class="latestPost excerpt <?php echo (++$j % 3 == 0) ? 'last' : ''; ?>">
							<?php mts_archive_post($layout = $post_layout); ?>
						</article>
					<?php endwhile; endif; ?>

					<?php if ( $j !== 0 ) { // No pagination if there is no posts ?>
						<?php mts_pagination(); ?>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>