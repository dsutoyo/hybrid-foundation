<?php
/**
 * Template Name: Builder Template
 *
 * @package Make
 */

get_header();
?>

<main id="site-main" class="site-main" role="main">
<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php hybrid_get_content_template(); // Loads the content/*.php template. ?>
		
	<?php endwhile; ?>

<?php endif; ?>
</main>

<?php get_footer(); ?>
