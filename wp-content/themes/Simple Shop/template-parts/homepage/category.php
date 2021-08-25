<?php if (get_theme_mod('simpleshop_homepage_display_categories', true)) : ?>
    <!--shop category start-->
    <section class="space-3">
        <div class="container sm-center">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h2 class="title"> <?php echo get_theme_mod('simpleshop_homepage_categories_title'); ?> </h2>
                    </div>
                </div>

                <div class="col-md-12">

                    <?= do_shortcode("[product_categories columns=4]"); ?>

                </div>
            </div>
        </div>
    </section>
    <!--shop category end-->
<?php endif; ?>