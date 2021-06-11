<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<?php
	do_action('t21_single_page',get_the_title());
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header alignwide">
	<?php echo apply_filters('demo_filter','Demo Filterable Text'); ?>
	<?php do_action('t21_before_title'); ?>
		<?php echo apply_filters('t21_test_text_filter','text 1','text 2','text 3'); ?>
		<?php  the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php do_action('t21_after_title'); ?>
		<?php twenty_twenty_one_post_thumbnail(); ?>
		<?php the_post_thumbnail("t21_square"); ?>
		<?php the_post_thumbnail("t21_landscape"); ?>
		<?php the_post_thumbnail("t21_potrait"); ?>
		<?php the_post_thumbnail("thumbnail"); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content();
		do_action('t21_after_desc'); 
		wp_link_pages(
			array(
				'before'   => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'twentytwentyone' ) . '">',
				'after'    => '</nav>',
				/* translators: %: Page number. */
				'pagelink' => esc_html__( 'Page %', 'twentytwentyone' ),
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer default-max-width">
		<?php twenty_twenty_one_entry_meta_footer(); ?>
	</footer><!-- .entry-footer -->

	<?php if ( ! is_singular( 'attachment' ) ) : ?>
		<?php get_template_part( 'template-parts/post/author-bio' ); ?>
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
