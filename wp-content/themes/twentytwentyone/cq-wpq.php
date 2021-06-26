<?php
/**
 * Template Name: custom  wp_query
 */

get_header();
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
	$posts_per_page = 4;
	
	$_p = new WP_Query([
		// 'posts_per_page' => $posts_per_page,
		'post_type' => 'post',
		'post_status' => 'draft',
		// 'monthnum' => 4,
		// 'year' => 2021,
		// 'tax_query' => array(
		// 	'relation' => 'OR',
		// 	array(
		// 		'taxonomy' => 'category',
		// 		'field'    => 'name',
		// 		'terms'    => array( 'lorem' ),
		// 	),
		// 	array(
		// 		'taxonomy' => 'post_tag',
		// 		'field'    => 'slug',
		// 		'terms'    => array( 'ff' ),
		// 	),
		// ),


	    'tax_query' => array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'post-format',
				'field'    => 'slug',
				'terms'    => array( 'post-format-audio' ),
			),
		),
		
		'paged' => $paged,
	]);
	// echo "<pre>";
	// die(print_r($_p));

	// echo "<pre>";
	
	// Load posts loop.
	while($_p->have_posts()) :   $_p->the_post() ?>
	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <br>
	
	<?php endwhile;

		wp_reset_query();


		echo paginate_links(array(
			'total' => $_p->max_num_pages,
			'current' => $paged,
			'prev_text' => 'age',
			'next_text' => 'pre',
		));
		


get_footer();
