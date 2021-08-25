<?php
/*
 * Template Name: Elementor Blank Page
 * */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="description" content=" ">
    <meta name="keywords" content=" ">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="author" content="Mosaddek">

    <!--favicon and touch icon-->
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <link rel="apple-touch-icon" href="assets/img/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/img/favicon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/img/favicon-114x114.png">

    <!--site title-->
    <title>Simple Shop</title>
    <!--web font-->
    <?php wp_head(); ?>

</head>


<body class="archive  woocommerce">

        <?php
        while ( have_posts() ) :
            the_post();

            get_template_part( 'template-parts/content', 'page' );



        endwhile; // End of the loop.
        ?>



<?php

<?php wp_footer(); ?>

</body>
</html>
