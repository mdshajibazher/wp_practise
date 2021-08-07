<?php 
/* Template Name: Elementor Balank */ 

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'woo-test' ); ?></a>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

            the_content();

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->




</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

