<?php
/* Template Name: Page Content / Confirmation */
get_header();

?>

<div id="wrapper">
  <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <?php get_template_part('partials/hero-archive'); ?>
        <?php get_template_part('partials/breadcrumbs'); ?>

        <section>
        <div class="page-content">
            <div class="section page-content-first">
            <div class="container">
                <?php the_content(); ?>
            </div>
            </div>
        </div>
        </section>

        <div class="backToTop js-backToTop">
        <i class="icon icon-up-arrow"></i>
        </div>
    </div>
</div>

<?php get_footer(); ?>
