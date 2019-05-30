<?php
/*
*** Human Aquarium Activities 1.0 ***
*/
?>

<?php 
	get_header();
?>

<main id="maincontent" class="column2" role="main">

	<header>
		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1>
	</header>

	<div id="ha_activities-list">

	<?php if ( have_posts () ) : ?>

		<?php  $args = array(
			'posts_per_page' => '9',
			'post_type' => 'ha_activities',
			'paged' => get_query_var('paged') ? get_query_var('paged') : 1
		);?>

		<?php $ha_activities = new WP_Query ( $args );

		while ( $ha_activities->have_posts() ) : $ha_activities->the_post(); ?>

	<div class="ha_activities">
		<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="ha_activities-title"><?php the_title(); ?></a></h2>
		
	<?php if ( has_post_thumbnail() ) :?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail('medium'); ?>
		</a>
	<?php endif; ?>
		<?php if( get_field('activity_description') ): ?>
			<?php the_field('activity_description'); ?>
		<?php endif; ?>
		
		<?php if( get_field('date_and_time') ): ?>
			<h3>Date and time</h3>
			<?php the_field('date_and_time'); ?>
		<?php endif; ?>
		<?php if( get_field('location') ): ?>
			<h3>Location</h3>
			<?php the_field('location'); ?>
		<?php endif; ?>

	</div><!--.ha_activities-->

	<?php endwhile; else :?>
	<?php endif; ?>
	</div><!--#custom-posts-list-->

	<!--bottom navigation to older and newer posts if there is more than one page of posts-->
	<div class="page-navigation">
		<?php
		/*
		** pagination
		*/

		$big = 999999999; // need an unlikely integer

		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $ha_activities->max_num_pages,
		) );
		?>

		<?php wp_reset_postdata(); ?>
	</div><!--.navigation-->

</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
