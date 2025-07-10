<?php
/**
 * Template Name: Contact Page
 */
get_header();
?>

<main id="primary" class="site-main">

    <?php get_template_part('partials/hero-archive'); ?>
    <?php get_template_part('partials/breadcrumbs'); ?>
	<?php get_template_part( 'template-parts/contact', 'page' ); ?>

</main><!-- #main -->

<?php get_footer(); ?>