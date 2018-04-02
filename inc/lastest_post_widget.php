<?php
/**
 * Lastest post widget
 * Get recent posts and display in widget
 *
 * @package Wordpress
 * @since 1.0
 */

add_action( 'widgets_init', 'binjuhor_latest_news_load_widget' );

function binjuhor_latest_news_load_widget() {
	register_widget( 'binjuhor_latest_news_widget' );
}

class binjuhor_latest_news_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'binjuhor_latest_news_widget', 'description' => esc_html__('A widget that displays your recent posts from all categories or a category', 'soledad') );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'binjuhor_latest_news_widget' );

		/* Create the widget. */
		global $wp_version;
		if( 4.3 > $wp_version ) {
			$this->WP_Widget( 'binjuhor_latest_news_widget', esc_html__('.Soledad Recent Posts', 'soledad'), $widget_ops, $control_ops );
		} else {
			parent::__construct( 'binjuhor_latest_news_widget', esc_html__( '.Soledad Recent Posts', 'soledad' ), $widget_ops, $control_ops );
		}
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title       = apply_filters( 'widget_title', $instance['title'] );
		$categories  = isset( $instance['categories'] ) ? $instance['categories'] : '';
		$number      = isset( $instance['number'] ) ? $instance['number'] : '';
		$featured    = isset( $instance['featured'] ) ? $instance['featured'] : false;
		$twocolumn   = isset( $instance['twocolumn'] ) ? $instance['twocolumn'] : false;
		$featured2   = isset( $instance['featured2'] ) ? $instance['featured2'] : false;
		$allfeatured = isset( $instance['allfeatured'] ) ? $instance['allfeatured'] : false;
		$thumbright  = isset( $instance['thumbright'] ) ? $instance['thumbright'] : false;
		$postdate    = isset( $instance['postdate'] ) ? $instance['postdate'] : false;
		$icon        = isset( $instance['icon'] ) ? $instance['icon'] : false;

		$query = array( 'showposts' => $number );

		$term_name = get_cat_name( $categories );
		$term = term_exists( $term_name, 'category');
		
		if ($term !== 0 && $term !== null) {
			$query['cat'] = $categories;
		}

		$loop = new WP_Query($query);
		if ($loop->have_posts()) :

			/* Before widget (defined by themes). */
			echo ent2ncr( $before_widget );

			/* Display the widget title if one was input (before and after defined by themes). */
			if ( $title )
				echo ent2ncr( $before_title . $title . $after_title );

			?>
			<ul class="side-newsfeed<?php if( $twocolumn && ! $allfeatured ): echo ' binjuhor-feed-2columns'; if( $featured ){ echo ' binjuhor-2columns-featured'; } else { echo ' binjuhor-2columns-feed'; } endif;?>">

				<?php $num = 1; while ($loop->have_posts()) : $loop->the_post(); ?>
					<li class="binjuhor-feed">
						<div class="side-item">
							<?php 
							if(has_post_thumbnail( )):
							?>
							<div class="side-image">
								<a class="binjuhor-image-holder small-fix-size" rel="bookmark" href="<?php echo get_the_permalink( );?>" title="" style="display: inline-block; background-image: url('<?php echo the_post_thumbnail_url( 'thumbnail' )?>'); background-repeat:no-repeat; height:110px;"></a>
							</div>
							<?php endif; ?>
							<div class="side-item-text">
								<h4 class="side-title-post">
									<a href="<?php echo get_the_permalink();?>" rel="bookmark" title="<?php echo get_the_title();?>"><?php echo get_the_title();?></a>
								</h4>
								<span class="side-item-meta">
								</span>
							</div>
						</div>
					</li>

					<?php $num++; endwhile; ?>

			</ul>

			<?php
		endif;
		wp_reset_postdata();

		/* After widget (defined by themes). */
		echo ent2ncr( $after_widget );
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title']       = strip_tags( $new_instance['title'] );
		$instance['categories']  = $new_instance['categories'];
		$instance['number']      = strip_tags( $new_instance['number'] );
		$instance['featured']    = strip_tags( $new_instance['featured'] );
		$instance['twocolumn']   = strip_tags( $new_instance['twocolumn'] );
		$instance['featured2']   = strip_tags( $new_instance['featured2'] );
		$instance['allfeatured'] = strip_tags( $new_instance['allfeatured'] );
		$instance['thumbright']  = strip_tags( $new_instance['thumbright'] );
		$instance['postdate']    = strip_tags( $new_instance['postdate'] );
		$instance['icon']        = strip_tags( $new_instance['icon'] );

		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => esc_html__('Recent Posts', 'soledad'), 'number' => 5, 'categories' => '', 'featured' => false, 'allfeatured' => false, 'thumbright' => false, 'twocolumn' => false, 'featured2' => false, 'postdate' => false, 'icon' => false );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title:', 'soledad'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo sanitize_text_field( $instance['title'] ); ?>"  />
		</p>

		<!-- Category -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('categories') ); ?>"><?php esc_html_e('Filter by Category:', 'soledad'); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id('categories') ); ?>" name="<?php echo esc_attr( $this->get_field_name('categories') ); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>><?php esc_html_e('All categories', 'soledad'); ?></option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
					<option value='<?php echo esc_attr( $category->term_id ); ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo sanitize_text_field( $category->cat_name ); ?></option>
				<?php } ?>
			</select>
		</p>

		<!-- Number of posts -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e('Number of posts to show:', 'soledad'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" value="<?php echo esc_attr( $instance['number'] ); ?>" size="3" />
		</p>

		<!-- Display thumbnail right -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'thumbright' ) ); ?>"><?php esc_html_e('Display thumbnail on right?:','soledad'); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'thumbright' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumbright' ) ); ?>" <?php checked( (bool) $instance['thumbright'], true ); ?> />
		</p>

		<!-- 2 Columns -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'twocolumn' ) ); ?>"><?php esc_html_e('Display on 2 columns?:','soledad'); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'twocolumn' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twocolumn' ) ); ?>" <?php checked( (bool) $instance['twocolumn'], true ); ?> />
			<span class="description" style="display: block; padding: 0;font-size: 12px;">If you use 2 columns option, it will ignore option display thumbnail on right.</span>
		</p>

		<!-- Display latest post featured -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'featured' ) ); ?>"><?php esc_html_e('Display 1st post featured?:','soledad'); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'featured' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'featured' ) ); ?>" <?php checked( (bool) $instance['featured'], true ); ?> />
		</p>

		<!-- Display latest post featured style 2 -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'featured2' ) ); ?>"><?php esc_html_e('Display featured post style 2?:','soledad'); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'featured2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'featured2' ) ); ?>" <?php checked( (bool) $instance['featured2'], true ); ?> />
		</p>

		<!-- Display big post -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'allfeatured' ) ); ?>"><?php esc_html_e('Display all post featured?:','soledad'); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'allfeatured' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'allfeatured' ) ); ?>" <?php checked( (bool) $instance['allfeatured'], true ); ?> />
			<span class="description" style="display: block; padding: 0;font-size: 12px;">If you use all post featured option, it will ignore option display thumbnail on right & 2 columns.</span>
		</p>

		<!-- Hide post date -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'postdate' ) ); ?>"><?php esc_html_e('Hide post date?:','soledad'); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'postdate' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postdate' ) ); ?>" <?php checked( (bool) $instance['postdate'], true ); ?> />
		</p>

		<!-- Enable post format icon -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>"><?php esc_html_e('Enable icon post format?:','soledad'); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon' ) ); ?>" <?php checked( (bool) $instance['icon'], true ); ?> />
		</p>

		<?php
	}
}
?>