<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package crossroads_theme
 */
?>

<div id="wrapper">
  <div class="no-bottom no-top" id="content">
      <div id="top"></div>
      <?php get_template_part('partials/hero-archive'); ?>
      <?php get_template_part('partials/breadcrumbs'); ?>
      <?php if (have_rows('flexible_content_subpage')): ?>
        <?php while (have_rows('flexible_content_subpage')): the_row(); ?>
          <?php
            $layout = get_row_layout();
            if ($layout === 'content_block') {
              get_template_part('template-parts/flexible/content', 'block');
            }
          ?>
        <?php endwhile; ?>
      <?php else: ?>
        <!-- <div class="container"> -->
          <section> 
        <?php the_content(); ?>
        </section>
        <!-- </div> -->
      <?php endif; ?>
  </div>
</div>
