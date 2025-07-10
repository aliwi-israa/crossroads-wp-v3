<?php get_header(); ?>
<div id="wrapper">
  <div class="no-bottom no-top" id="content">
    <div id="top"></div>
    <div class="entry-content">
      <?php get_template_part('partials/hero-archive'); ?>
      <section class="pb-0">
        <div class="container mb-4">
          <div class="row">
            <?php get_template_part('partials/sidebar-services'); ?>

            <?php if (have_rows('flexible_content_services')): ?>
            <?php while (have_rows('flexible_content_services')): the_row(); ?>
            <?php
                $layout = get_row_layout();

                if ($layout === 'service_content_block') {
                  include get_template_directory() . '/template-parts/flexible/service-content-block.php';
                }
              ?>
            <?php endwhile; ?>
            <?php else: ?>
            <?php the_content(); ?>
            <?php endif; ?>
          </div>
        </div>
      </section>
      <?php
      if (wp_is_mobile()) {
          get_template_part('partials/contact-form-mobile');
      }
      get_template_part('partials/banner-section'); 
      ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>