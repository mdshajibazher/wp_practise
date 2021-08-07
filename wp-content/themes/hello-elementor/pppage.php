<?php 

    while(have_posts()) : the_post();
    echo carbon_get_the_post_meta('ct_number_of_post');

    endwhile;

?>