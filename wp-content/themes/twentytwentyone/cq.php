<?php
/**
 * Template Name: custom query
 */

get_header();
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
	$posts_IDs = [63,65,69,75,78,72];
	$posts_per_page = 2;
	$_p = get_posts([
		'post__in' => $posts_IDs,
		'order' => 'asc',
		'posts_per_page' => $posts_per_page,
		'paged' => $paged,
	]);
	// Load posts loop.
	foreach($_p as $post){  setup_postdata($post) ?>
	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <br>
	
	<?php }  


	wp_reset_postdata();

		echo paginate_links(array(
			'total' => ceil(count($posts_IDs)/$posts_per_page),
		));



get_footer();
