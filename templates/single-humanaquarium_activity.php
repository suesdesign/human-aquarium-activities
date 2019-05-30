<?php
/*
*** Suesdesign Custom Posts 1.0 ***
*   Single Custom Post page
*/
?>

<?php get_header(); ?>

<main id="maincontent" class="column2" role="main">

<?php if ( have_posts () ) : while (have_posts()) : the_post(); ?>
	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
		<header>
			<h1 class="entry-title">
				<?php the_title(); ?>
			</h1>
		</header>
		<div class="entry">
			<?php the_content() ?>
		</div><!--.entry-->
	</article><!-- finish enclosing post-->  

<?php endwhile; else :?>
   
<?php endif; ?>

</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>