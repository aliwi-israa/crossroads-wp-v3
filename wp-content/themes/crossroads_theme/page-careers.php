<?php
/**
 * Template Name: Careers Page
 */
get_header();
?>
<main id="primary" class="site-main">

    <?php get_template_part('partials/hero-archive'); ?>
     <!-- get_template_part('partials/breadcrumbs');  -->
        <div class="page-content">
            <div class="section page-content-first">
                <div class="container">
                    <?php get_template_part( 'template-parts/careers', 'page' ); ?>
                </div>
            </div>
        </div>

</main><!-- #main -->

<?php get_footer(); ?>